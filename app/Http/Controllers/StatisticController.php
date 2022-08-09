<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class StatisticController extends Controller
{
    function request()
    {
        $count = \App\Models\Request::all()->count();
        if ($count) {
            return response()->json($count, 200);
        }
        else {
            return response()->json(0, 200);
        }
    }
    function mechanic()
    {
        $count = User::where('user_type_id', 2)->count();
        if ($count) {
            return response()->json($count, 200);
        }
        else {
            return response()->json(0, 200);
        }
    }
    function user()
    {
        $count = User::where('user_type_id', 3)->count();
        if ($count) {
            return response()->json($count, 200);
        }
        else {
            return response()->json(0, 200);
        }
    }
    function payment()
    {
        $count = \App\Models\Payment::all()->count();
        if ($count) {
            return response()->json($count, 200);
        }
        else {
            return response()->json(0, 200);
        }
    }
}
