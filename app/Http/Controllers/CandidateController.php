<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CandidateController extends Controller
{
    function dashboard(){
        return view('candidate.dashboard');
    }
}
