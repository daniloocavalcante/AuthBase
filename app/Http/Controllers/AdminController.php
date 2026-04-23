<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use ZipArchive;

use Carbon\Carbon;

use App\Models\User;       // <— Importa o modelo User
use App\Models\AppLog;

class AdminController extends Controller
{
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

        return view('admin.logs', compact(
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

    public function dashboard()
    {
        $profile = Auth::user();
        $totalUsers = User::count();
        $totalLogs = AppLog::count();
        $totalRoles = Role::count();

        // Calculando percetual de usuários (diários)      
        $today_users = User::whereDate('created_at', Carbon::today())->count();
        $yesterday_users = User::whereDate('created_at', Carbon::yesterday())->count();

        $percentChangeUsers = 0;
        if ($yesterday_users > 0) {
            $percentChangeUsers = (($today_users - $yesterday_users) / $yesterday_users) * 100;
        }
        $percentChangeUsers = round($percentChangeUsers, 1);


        // Calculando crescimento logs (semanais)             
        $currentPeriod = [
            Carbon::now()->subDays(6)->startOfDay(),  // últimos 7 dias   
            Carbon::now()->endOfDay() 
        ];
        
        $previousPeriod = [
            Carbon::now()->subDays(13)->startOfDay(), // 7 dias anteriores
            Carbon::now()->subDays(7)->endOfDay()
        ];

        $currentLogs = AppLog::whereBetween('created_at', $currentPeriod)->count();
        $previousLogs = AppLog::whereBetween('created_at', $previousPeriod)->count();

        $percentChangeLogs = 0;

        if ($previousLogs > 0) {
            $percentChangeLogs = (($currentLogs - $previousLogs) / $previousLogs) * 100;
        }

        $percentChangeLogs = round($percentChangeLogs, 1);


        // 🗄️ Banco de dados (simples: conexão ok + tempo de resposta)
        $dbStart = microtime(true);
        DB::select("SELECT 1");
        $dbTime = (microtime(true) - $dbStart) * 100;

        $databaseStatus = max(0, min(100, 100 - ($dbTime * 500)));
        $databaseStatus = round($databaseStatus, 1);
        

        // 🧠 CPU (estimado - Linux only idealmente)
        $load = function_exists('sys_getloadavg') ? sys_getloadavg() : [0, 0, 0];

        $cpuUsage = min(100, round($load[0] * 100, 1));


        // 💾 Memória (estimada via PHP)
        $memoryUsage = (memory_get_usage(true) / 1024 / 1024);
        $memoryLimit = (int) ini_get('memory_limit');

        // caso memory_limit seja "128M"
        if (is_string($memoryLimit)) {
            $memoryLimit = (int) $memoryLimit;
        }

        $memoryPercent = $memoryLimit > 0
            ? ($memoryUsage / $memoryLimit) * 100
            : 0;

        $memoryPercent = round(min(100, $memoryPercent), 1);

        // Paginacao

        //30 Logs
        $ids_logs = AppLog::with('user')
        ->orderByDesc('created_at')
        ->limit(20)
        ->pluck('id');

        $logs = AppLog::whereIn('id', $ids_logs)
            ->orderByDesc('created_at')
            ->paginate(5, ['*'], 'logs_page')
            ->withQueryString();

        //20 Usuarios 
        $ids_users = User::orderByDesc('created_at')
        ->limit(20)
        ->pluck('id');

        $users = User::whereIn('id', $ids_users)
            ->orderByDesc('created_at')
            ->paginate(5, ['*'], 'users_page')
            ->withQueryString();



                // ⏱️ início (24h atrás)
                $start = now()->subHours(23)->startOfHour();

                // 📊 buscar logs agrupados por hora completa
                $logsByHour = AppLog::selectRaw("DATE_FORMAT(created_at, '%Y-%m-%d %H:00:00') as hour, COUNT(*) as total")
                    ->where('created_at', '>=', $start)
                    ->groupBy('hour')
                    ->orderBy('hour')
                    ->get()
                    ->keyBy('hour');

                $labels = [];
                $data = [];

                // 🔄 percorre hora por hora (cronológico real)
                for ($i = 0; $i < 24; $i++) {
                    $current = $start->copy()->addHours($i);
                    $key = $current->format('Y-m-d H:00:00');

                    $labels[] = $current->format('H:i');
                    $data[] = $logsByHour[$key]->total ?? 0;
                }
     

        return view('admin.dashboard', compact(
            'profile',
            'totalUsers',
            'percentChangeUsers',
            'totalLogs',
            'percentChangeLogs',
            'totalRoles',       
            'databaseStatus',
            'cpuUsage',
            'memoryPercent',
            'users',
            'logs',
            'labels',
            'data'     
            ));
    }

    public function download()
    {
        $files = glob(storage_path('logs/*.log'));

        if (!$files || count($files) === 0) {
            abort(404, 'Nenhum arquivo de log encontrado.');
        }

        $zip = new ZipArchive;
        $fileName = 'logs.zip';
        $zipPath = storage_path($fileName);

        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {

            foreach ($files as $file) {
                $zip->addFile($file, basename($file));
            }

            $zip->close();
        } else {
            abort(500, 'Erro ao criar o arquivo ZIP.');
        }
        app_log('EXPORT_LOG', null, 'Download do arquivo de log do sistema (laravel.zip)');
        return response()->download($zipPath)->deleteFileAfterSend(true);       

    }

    
    public function roles()
    {
        $profile = Auth::user();
        $roles = Role::with(['permissions', 'users'])->get();

        $permissions = Permission::all();
        $totalUsers = $roles->pluck('users')->flatten()->unique('id')->count();

        return view('admin.roles.index', compact('roles', 'permissions', 'totalUsers', 'profile'));
    }

    public function roles_show(Role $role)
    {
        $users = User::whereDoesntHave('roles', function ($q) use ($role) {
            $q->where('id', $role->id);
        })->get();

        $users_paginate = $role->users()->paginate(5);

        $profile = Auth::user();

        $role->load(['users', 'permissions']);

        return view('admin.roles.show', compact('role', 'profile', 'users', 'users_paginate'));
    }

    public function roles_add(Request $request, Role $role)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::findOrFail($request->user_id);

        // substitui todas as roles pela nova
        $user->syncRoles([$role->name]);

        return back()->with(
            'success',
            "Usuário [{$user->name}] agora é: " . ucfirst($role->name)
        );
    }

    public function roles_remove($roleId, $userId)
    {
        $user = User::findOrFail($userId);

        // pega a role "user"
        $roleUser = Role::where('name', 'user')->firstOrFail();

        // substitui todas as roles
        $user->syncRoles([$roleUser->name]);

        return back()->with(
            'danger',
            'Usuário [' . $user->name . '] agora é: User'
        );
    }

}
