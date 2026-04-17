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


use App\Models\User;       // <— Importa o modelo User
use App\Models\AppLog;


class DashboardController extends Controller
{

    protected function viewWithUser($view, $data = [])
    {
        // pega o usuário logado no momento da chamada
        $user = Auth::user(); // carrega relacionamentos que precisar
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
        $user = Auth::user();
        $logs = AppLog::where('user_id', $user->id)
                    ->latest()
                    ->paginate(3); // pode trocar por get() se não quiser paginação
        return view('dashboard.profile.edit', compact('logs', 'user')); 
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

            return redirect()->route('profile')
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
                ->route('profile.edit')
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

            return redirect()->route('profile')
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
        $adminsCount = 2;
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
}

