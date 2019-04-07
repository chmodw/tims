<?php

namespace App\Http\Controllers\Admin;

use Kjjdion\LaravelAdminPanel\Controllers\BackendController as LapBackendController;

class BackendController extends LapBackendController
{

    public function index()
    {
        return redirect()->route('' . (auth()->check() ? 'dashboard' : 'login'));
    }

    public function dashboard()
    {
        return view('lap::backend.dashboard');
    }

    public function settingsForm()
    {
        return view('lap::backend.settings');
    }

    public function settingsRules()
    {
        return [
            'example' => 'required',
        ];
    }
}