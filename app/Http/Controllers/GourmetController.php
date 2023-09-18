<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GourmetController extends Controller
{
    public function add()
    {
        return view('gourmet.create');
    }
    
    public function create(Request $request)
    {
        // gourmet/createにリダイレクトする
        return redirect('gourmet/create');
    }
}
