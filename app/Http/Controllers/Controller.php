<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    protected function requireAuth()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        return null;
    }
}
