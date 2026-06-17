<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    function homepage() {
    return view('homepage');
    }

    function work() {
    return view('work');
    }

    function about() {
    return view('about');
    }

    function contact() {
    return view('contact');
    }
}
