<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gourmet;

class TopController extends Controller
{
    //トップページを表示するアクションを追加
    public function top()
    {
        return view('gourmet.top');
    }
}
