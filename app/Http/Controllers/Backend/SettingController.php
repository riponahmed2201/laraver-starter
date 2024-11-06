<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SettingController extends Controller
{
    public function general()
    {
        return view('backend.settings.general');
    }

    public function generalUpdate(Request $request)
    {
        $request->validate([
            'site_title' => 'required|string|min:2|max:255',
            'site_description' => 'nullable|string|min:2|max:255',
            'site_address' => 'nullable|string|min:2|max:255',
        ]);

        Setting::updateOrCreate(['name' => 'site_title'], ['value' => $request->get('site_title')]);

        //Update .env
        // Artisan::call("env:set APP_NAME='" . $request->get('site_title') . "'"); package not working: Pacakge Name:-imliam/laravel-env-set-command

        Setting::updateOrCreate(['name' => 'site_description'], ['value' => $request->get('site_description')]);
        Setting::updateOrCreate(['name' => 'site_address'], ['value' => $request->get('site_address')]);

        notify()->success('Settings updated successfully.', 'Success');

        return back();
    }
}
