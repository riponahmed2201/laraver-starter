<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MenuBuilderController extends Controller
{
    public function index(int $menuId)
    {
        Gate::authorize('app.menus.index');

        $menu = Menu::findOrFail($menuId);

        return view('backend.menus.builder', compact('menu'));
    }

    public function itemCreate(int $menuId)
    {
        Gate::authorize('app.menus.create');

        $menu = Menu::findOrFail($menuId);

        return view('backend.menus.item.form', compact('menu'));
    }
}
