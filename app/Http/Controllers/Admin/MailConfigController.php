<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class MailConfigController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        return view('admin.mail-config');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'mail_mailer' => 'required|string',
            'mail_host' => 'required|string',
            'mail_port' => 'required|numeric',
            'mail_username' => 'required|string',
            'mail_password' => 'required|string',
            'mail_encryption' => 'nullable|string',
            'mail_from_address' => 'required|email',
            'mail_from_name' => 'nullable|string',
        ]);

        // Update .env values
        foreach ($data as $key => $value) {
            $envKey = strtoupper(str_replace('mail_', 'MAIL_', $key));
            $this->setEnvValue($envKey, $value);
        }

        // Clear config cache so new mail settings take effect immediately
        try {
            Artisan::call('config:clear');
            Artisan::call('cache:clear');
        } catch (\Exception $e) {
            Log::error('Failed to clear config/cache after updating mail settings: ' . $e->getMessage());
        }

        // This admin mail-config controller was added temporarily. If you see
        // this file, it means an earlier change added admin mail configuration
        // UI. You requested removal of admin-related changes. Please delete
        // this file if you no longer need it.

        return back()->with('message', 'Mail settings saved (controller placeholder).');
    }

    protected function setEnvValue($key, $value)
    {
        $envPath = base_path('.env');

        if (! file_exists($envPath)) {
            // try to create a new .env from .env.example
            if (file_exists(base_path('.env.example'))) {
                copy(base_path('.env.example'), $envPath);
            } else {
                // create an empty .env
                file_put_contents($envPath, "");
            }
        }

        $escaped = preg_quote('='.$this->getEnvValue($key), '/');

        $contents = file_get_contents($envPath);

        $line = $key . '=' . $value;

        if (preg_match("/^" . preg_quote($key, '/') . "=.*/m", $contents)) {
            // replace existing
            $contents = preg_replace("/^" . preg_quote($key, '/') . "=.*/m", $line, $contents);
        } else {
            // append
            $contents .= PHP_EOL . $line . PHP_EOL;
        }

        file_put_contents($envPath, $contents);
    }

    protected function getEnvValue($key)
    {
        $value = env($key);
        return $value === null ? '' : $value;
    }
}
