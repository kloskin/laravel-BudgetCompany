<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TabController extends Controller
{
    public function setSelectedTab(Request $request)
    {
        session(['selectedTab' => $request->input('tab')]);
        return response()->json(['status' => 'success']);
    }
}
