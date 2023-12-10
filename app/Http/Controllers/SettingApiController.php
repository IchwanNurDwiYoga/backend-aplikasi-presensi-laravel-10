<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;

class SettingApiController extends Controller
{
    public function getSetting(){
        $setting = Settings::first();
        return response()->json($setting);
    }
}
