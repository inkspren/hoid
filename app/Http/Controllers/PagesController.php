<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'Welcome to Hoid!';
        return view('pages.index')->with('title', $title);
    }

    public function about(){
        $title = 'About Hoid';
        return view('pages.about')->with('title', $title);
    }

    public function day(){
        $title = 'Information about days go here!';
        return view('pages.day')->with('title', $title);
    }

 /*   public function calendar(){
        return view('pages.calendar');
    }*/
}
