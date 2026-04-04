<?php

namespace App\Http\Controllers;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateEmailRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;


use App\Models\User;       // <— Importa o modelo User
use App\Models\AppLog;


class DashboardController extends Controller
{

    protected function viewWithUser($view, $data = [])
    {
        // pega o usuário logado no momento da chamada
        $user = Auth::user()->load('privilege'); // carrega relacionamentos que precisar
        return view($view, array_merge($data, ['user' => $user]));
    }

    public function index()
    {
        return $this->viewWithUser('dashboard.home');
    }

    public function profile()
    {
        return $this->viewWithUser('dashboard.profile.show');
    }

    public function edit()
    {        
        return $this->viewWithUser('dashboard.profile.edit');
    }


    public function update(UpdateUserRequest $request)
    {
        $user = Auth::user();

        $data = $request->validated(); 

        // remove o email do update
        unset($data['email']);

        // Opcional (evita sujeira)
        $data = array_map(fn($v) => is_string($v) ? trim($v) : $v, $data);

        $user->fill($data);

        if (!$user->isDirty()) {
            return back()->with('info', 'Nenhuma alteração foi realizada.');
        }

        $oldName = $user->getOriginal('name');

        try {
            $user->save();

            return redirect()->route('dashboard.profile')
                ->with('success', 'Perfil atualizado com sucesso!');

        } catch (\Exception $e) {

            app_log(
                'ERROR',
                $user,
                "Falha ao atualizar usuário {$oldName} (#{$user->id}). Motivo: " . $e->getMessage()
            );

            return back()->with('ERROR', 'Não foi possível atualizar o perfil. Tente novamente.');
        }
    }

    public function password(){    
        return $this->viewWithUser('dashboard.profile.password');    
    }


    public function password_update(UpdatePasswordRequest $request)
    {
        $user = Auth::user();

        // garante que a nova senha seja diferente da atual
        if (Hash::check($request->password, $user->password)) {
            return back()->with('error', 'A nova senha deve ser diferente da senha atual.');
        }

        try {
            Auth::logoutOtherDevices($request->current_password);

            $user->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()
                ->route('dashboard.profile.edit')
                ->with('success', 'Senha alterada com sucesso!');

        } catch (\Exception $e) {
            app_log('ERROR', $user, 'Erro ao alterar senha. ' . $e->getMessage());
            return back()->with('error', 'Erro inesperado ao atualizar a senha.');
        }
    }

    public function email()
    {
        return $this->viewWithUser('dashboard.profile.email');
    }


    public function email_update(UpdateEmailRequest $request)
    {
        $user = Auth::user();

        // valida e pega dados do request
        $data = $request->validated();

        // trim em strings
        $data = array_map(fn($v) => is_string($v) ? trim($v) : $v, $data);

        // só preenche email
        $user->email = $data['email'];

        // se nada mudou (provavelmente impossível aqui)
        if (!$user->isDirty('email')) {
            return back()->with('info', 'Nenhuma alteração foi realizada.');
        }

        // marca email como não verificado
        $user->email_verified_at = null;

        try {
            $user->save();

            // envia email de verificação
            $user->sendEmailVerificationNotification();

            return redirect()->route('dashboard.profile')
                ->with('success', 'Email atualizado com sucesso! Verifique seu novo e-mail.');

        } catch (\Exception $e) {

            app_log(
                'ERROR',
                $user,
                "Falha ao atualizar o e-mail do usuário {$user->name} (#{$user->id}). Motivo: " . $e->getMessage()
            );

            return back()->with('ERROR', 'Não foi possível atualizar o e-mail. Tente novamente.');
        }
    }
                 
    

    public function destroy(Request $request)
    {
        $user = Auth::user();        

        Auth::logout();

        // deletar usuário
        $user->delete();        

        return redirect('/')->with('warning', 'Conta excluída com sucesso.');
    }

 
    public function show($id){        
        $user = User::findOrFail($id);
        return view('dashboard.users.show', compact('user'));
    }

    public function users(Request $request){ 
        
        // Query base
        $query = User::query();

        // BUSCA
        if ($request->search) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('surname', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
            });

            // PRIORIDADE: quem começa com o termo no nome ou sobrenome
            $query->orderByRaw("(name LIKE ? OR surname LIKE ?) DESC", ["$search%", "$search%"])
                  ->orderBy('name');

        } else {
            // ORDENAÇÃO SEGURA
            $allowedSorts = ['name', 'email', 'created_at'];
            $sort = in_array($request->get('sort'), $allowedSorts) ? $request->get('sort') : 'created_at';
            $direction = $request->get('direction') === 'asc' ? 'asc' : 'desc';

            $query->orderBy($sort, $direction);
        }

        // PAGINAÇÃO
        $perPage = 10; 
        $users = $query->paginate($perPage)->withQueryString();

        // CONTADORES DINÂMICOS
        $usersCount  = User::count();
        $adminsCount = User::where('privilege_id', 1)->count();
        $todayUsers  = User::whereDate('created_at', now())->count();

        // RETORNA PARA A VIEW
        return view('dashboard.users.index', compact('users', 'usersCount', 'adminsCount', 'todayUsers'));  

    }
    


    public function export(){

        $fileName = 'table_users_' . now()->format('Y-m-d_H-i-s') . '.csv';

        // Cabeçalhos do CSV
        $headers = ['ID', 'Nome', 'Sobrenome', 'Email', 'Criado em'];

        // Obter usuários
        $users = User::all();

        // Criar conteúdo CSV
        $callback = function() use ($users, $headers) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $headers);

            foreach ($users as $user) {
                fputcsv($file, [
                    $user->id,
                    $user->name,
                    $user->surname,
                    $user->email,
                    $user->created_at->format('d/m/Y H:i')
                ]);
            }
            app_log('EXPORT', null, "Exportou a tabela usuários em formato CSV");
            fclose($file);
        };

        // Retornar CSV como download
        return Response::stream($callback, 200, [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename={$fileName}",
        ]);
    }


    public function logs(Request $request)
    {
        // 🔹 Query base com relação
        $query = AppLog::with('user');

        // 🔎 BUSCA (compacta e eficiente)
        if ($request->search) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('description', 'like', "%$search%")
                ->orWhere('action', 'like', "%$search%")
                ->orWhereHas('user', function ($q2) use ($search) {
                    $q2->where('name', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%");
                });
            });

            $query->orderByRaw("
                (description LIKE ?) DESC,
                (action LIKE ?) DESC
            ", [
                "%$search%",
                "%$search%"
            ])
            ->orderByDesc('created_at');

        } else {
            // 🔃 ORDENAÇÃO SEGURA
            $allowedSorts = ['created_at', 'action', 'description'];
            $sort = in_array($request->get('sort'), $allowedSorts) ? $request->get('sort') : 'created_at';
            $direction = $request->get('direction') === 'asc' ? 'asc' : 'desc';

            $query->orderBy($sort, $direction);
        }
        
        $perPage = 10;
        $logs = $query->paginate($perPage)->withQueryString();
        
        $totalLogs = AppLog::count();
        $logsHoje  = AppLog::whereDate('created_at', now())->count();
        $logsErro  = AppLog::where('action', 'error')->count();

        $recentLogs = AppLog::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.admin.logs', compact(
            'logs',
            'totalLogs',
            'logsHoje',
            'logsErro',
            'recentLogs',
        ));
    }


    public function export_logs(){

        $fileName = 'table_logs_' . now()->format('Y-m-d_H-i-s') . '.csv';

        // Cabeçalhos do CSV
        $headers = ['ID', 'Gerado em', 'IP', 'User_ID', 'Ação', 'Descrição', 'Model_ID', 'Model_Type'];

        // Obter usuários
        $logs = AppLog::all();

        // Criar conteúdo CSV
        $callback = function() use ($logs, $headers) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $headers);

            foreach ($logs as $log) {
                fputcsv($file, [
                    $log->id,
                    $log->created_at->format('d/m/Y H:i:s'),
                    $log->ip_address,
                    $log->user_id,
                    $log->action,
                    $log->description,
                    $log->model_id,
                    $log->model_type,
                ]);
            }

            app_log('EXPORT', null, "Gerou exportação da tabela logs em formato CSV");            
            fclose($file);
        };

        // Retornar CSV como download
        return Response::stream($callback, 200, [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename={$fileName}",
        ]);
    }


}

