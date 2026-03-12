<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

use App\Models\User;       // <— Importa o modelo User
use App\Models\Privilege;  // <— Importa o modelo Privilege


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
        return $this->viewWithUser('dashboard.profile');
    }

    public function edit()
    {
        return $this->viewWithUser('dashboard.edit');
    }


    public function update(Request $request)
    {
        $user = Auth::user();

        // Validação
        $data = $request->validate([
            'name' => 'required|string|max:50',
            'surname' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'email_confirmation' => 'required|same:email',
            'birth' => 'required|date|before:today',
            'gender' => 'required|in:Masculino,Feminino,Outro',
        ]);

        // Remove email_confirmation
        unset($data['email_confirmation']);

        $hasChanges = false;
        $emailChanged = false;

        foreach ($data as $key => $value) {
            if ($key === 'birth') {
                // Compara datas como string
                if ($user->birth->format('Y-m-d') != $value) {
                    $hasChanges = true;
                }
            } else {
                if (trim($user->$key) != trim($value)) {
                    $hasChanges = true;
                }
            }

        }

        if (!$hasChanges) {
            return back()->with('info', 'Nenhuma alteração foi realizada.');
        }

        // Se o email mudou, reseta email_verified_at e envia notificação
        if ($user->email !== $data['email']) {
            $data['email_verified_at'] = null;
            $emailChanged = true;
        }   
        
        if ($user->update($data)) {
            // Aqui  dispara o email de confirmação 
            if ($emailChanged) {
                $user->sendEmailVerificationNotification();
            }

            return redirect()->route('dashboard.profile')
                            ->with('success', 'Perfil atualizado com sucesso!');
        }

        return back()->with('error', 'Não foi possível atualizar o perfil. Tente novamente.');
    }




    public function showChangePasswordForm(){        
        $user = Auth::user();
        return view('dashboard.password', compact('user'));
    }

    public function changePassword(Request $request){

        $user = Auth::user();

        // Validação básica
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Verifica se a senha atual está correta
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Senha atual incorreta.');
        }

        // Verifica se a nova senha é diferente da atual
        if (Hash::check($request->password, $user->password)) {
            return back()->with('error', 'A nova senha deve ser diferente da senha atual.');
        }

        // Atualiza a senha somente se passou nas verificações
        if ($request->password && !Hash::check($request->password, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('dashboard.password.edit')
                            ->with('success', 'Senha alterada com sucesso!');
        }

        return back()->with('error', 'Erro inesperado ao atualizar a senha. Tente novamente.');


    }

    public function destroy(Request $request)
    {
        $user = Auth::user();
        // opcional: deslogar antes de deletar
        Auth::logout();

        // deletar usuário
        $user->delete();

        // redirecionar para a página inicial com mensagem
        return redirect('/')->with('warning', 'Conta excluída com sucesso.');
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
        $perPage = 10; // ou $request->get('perPage', 10) se quiser permitir alterar
        $users = $query->paginate($perPage)->withQueryString();

        // CONTADORES DINÂMICOS
        $usersCount  = User::count();
        $adminsCount = User::where('privilege_id', 1)->count();
        $todayUsers  = User::whereDate('created_at', now())->count();

        // RETORNA PARA A VIEW
        return view('dashboard.users', compact('users', 'usersCount', 'adminsCount', 'todayUsers'));  

    }


    public function export(){

        $fileName = 'table_users_' . now()->format('Y-m-d_H-i-s') . '.csv';

        // Cabeçalhos do CSV
        $headers = ['ID', 'Nome', 'Sobrenome', 'Email', 'Criado em'];

        // Obter usuários
        $users = \App\Models\User::all();

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

            fclose($file);
        };

        // Retornar CSV como download
        return Response::stream($callback, 200, [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename={$fileName}",
        ]);
    }




}

