<?php

namespace App\Http\Controllers;

class DaysController extends Controller
{
    public function __invoke()
    {
        return view('pages.day');
    }
}
