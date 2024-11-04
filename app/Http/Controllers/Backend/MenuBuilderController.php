<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuItem;
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

    public function itemStore(Request $request, int $menuId)
    {
        $request->validate([
            'type' => 'required|string',
            'divider_title' => 'nullable|string',
            'title' => 'nullable|string',
            'url' => 'nullable|string',
            'target' => 'nullable|string',
            'icon_class' => 'nullable|string',
        ]);

        $menu = Menu::findOrFail($menuId);

        $menu->menuItems()->create([
            'type' => $request->get('type'),
            'divider_title' => $request->get('divider_title'),
            'title' => $request->get('title'),
            'url' => $request->get('url'),
            'target' => $request->get('target'),
            'icon_class' => $request->get('icon_class'),
        ]);

        notify()->success('Menu item successfully created.', 'Success');

        return to_route('app.menus.builder', $menuId);
    }

    public function itemEdit(int $menuId, int $itemId)
    {
        Gate::authorize('app.menus.edit');

        $menu = Menu::findOrFail($menuId);

        $menuItem = $menu->menuItems()->findOrFail($itemId);

        return view('backend.menus.item.form', compact('menu', 'menuItem'));
    }

    public function itemUpdate(Request $request, int $menuId, int $itemId)
    {
        Gate::authorize('app.menus.edit');

        $request->validate([
            'type' => 'required|string',
            'divider_title' => 'nullable|string',
            'title' => 'nullable|string',
            'url' => 'nullable|string',
            'target' => 'nullable|string',
            'icon_class' => 'nullable|string',
        ]);

        $menu = Menu::findOrFail($menuId);

        $menu->menuItems()->findOrFail($itemId)->update([
            'type' => $request->get('type'),
            'divider_title' => $request->get('divider_title'),
            'title' => $request->get('title'),
            'url' => $request->get('url'),
            'target' => $request->get('target'),
            'icon_class' => $request->get('icon_class'),
        ]);

        notify()->success('Menu item successfully updated.', 'Success');

        return to_route('app.menus.builder', $menuId);
    }

    public function itemDestroy(int $menuId, int $itemId)
    {
        Gate::authorize('app.menus.destroy');

        Menu::findOrFail($menuId)
            ->menuItems()
            ->findOrFail($itemId)
            ->delete();

        notify()->success('Menu item successfully deleted.', 'Success');

        return back();
    }
}
