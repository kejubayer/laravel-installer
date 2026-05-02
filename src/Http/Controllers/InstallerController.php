<?php

namespace Kejubayer\Installer\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Kejubayer\Installer\Helpers\EnvEditor;

class InstallerController extends Controller
{
    public function index(): RedirectResponse
    {
        return redirect()->route('installer.requirements');
    }

    public function requirements(): View
    {
        $requirements = [
            'php' => version_compare(PHP_VERSION, config('installer.required.php', '8.1.0'), '>='),
            'openssl' => extension_loaded('openssl'),
            'pdo' => extension_loaded('pdo'),
            'mbstring' => extension_loaded('mbstring'),
            'tokenizer' => extension_loaded('tokenizer'),
            'xml' => extension_loaded('xml'),
            'ctype' => extension_loaded('ctype'),
            'json' => extension_loaded('json'),
        ];

        return view('installer::installer.step1', compact('requirements'));
    }

    public function permissions(): View
    {
        $permissions = [
            'storage' => is_writable(storage_path()),
            'bootstrap/cache' => is_writable(base_path('bootstrap/cache')),
        ];

        return view('installer::installer.step2', compact('permissions'));
    }

    public function database(): View
    {
        return view('installer::installer.step3');
    }

    public function saveDatabase(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'db_host' => ['required', 'string'],
            'db_port' => ['required', 'integer'],
            'db_name' => ['required', 'string'],
            'db_user' => ['required', 'string'],
            'db_pass' => ['nullable', 'string'],
        ]);

        config([
            'database.connections.installer_test' => [
                'driver' => 'mysql',
                'host' => $validated['db_host'],
                'port' => $validated['db_port'],
                'database' => $validated['db_name'],
                'username' => $validated['db_user'],
                'password' => $validated['db_pass'],
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
            ],
        ]);

        try {
            DB::connection('installer_test')->getPdo();
        } catch (\Throwable $e) {
            return back()->withErrors(['database' => 'Database connection failed: ' . $e->getMessage()])->withInput();
        }

        EnvEditor::set([
            'DB_HOST' => $validated['db_host'],
            'DB_PORT' => $validated['db_port'],
            'DB_DATABASE' => $validated['db_name'],
            'DB_USERNAME' => $validated['db_user'],
            'DB_PASSWORD' => $validated['db_pass'] ?? '',
        ]);

        file_put_contents(storage_path('installed'), now()->toDateTimeString());

        return redirect()->route('installer.finish');
    }

    public function migrate(): RedirectResponse
    {
        Artisan::call('migrate', ['--force' => true]);

        if (config('installer.seed', true)) {
            Artisan::call('db:seed', ['--force' => true]);
        }

        return redirect()->route('installer.finish');
    }

    public function finish(): View
    {
        return view('installer::installer.finish');
    }
}
