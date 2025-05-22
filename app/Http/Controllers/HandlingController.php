<?php

namespace App\Http\Controllers;

use App\Models\ReportHandling;
use Illuminate\Http\Request;

class HandlingController extends Controller
{
    public function index(){

        $handling = ReportHandling::whereHas('report', function ($query) {
            $query->where('staff_id', auth()->user()->staff->id);
        })->get();
        

        return view('apps.handling.index', compact('handling'));
    }
}
