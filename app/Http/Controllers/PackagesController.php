<?php

namespace App\Http\Controllers;

use App\Models\Packages\Package;
use Illuminate\Http\Request;

class PackagesController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.packages.index');
    }

    public function edit(Package $package)
    {
        return view('pages.packages.edit')->with([
            'package' => $package
        ]);
    }
}
