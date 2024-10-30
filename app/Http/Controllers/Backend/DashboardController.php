<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index()
    {
        Gate::authorize('app.dashboard');

        return view('backend.dashboard');
    }
}
