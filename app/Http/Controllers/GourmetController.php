<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gourmet;

class GourmetController extends Controller
{
    public function add()
    {
        return view('gourmet.create');
    }
    
    public function create(Request $request)
    {
        $this->validate($request, Gourmet::$rules);

        $gourmet = new Gourmet;
        $form = $request->all();
        
        // フォームから画像が送信されてきたら、保存して、$gourmet->image_path に画像のパスを保存する
        if (isset($form['food_picture'])) {
            $path = $request->file('food_picture')->store('public/image');
            $gourmet->food_picture = basename($path);
        } else {
            $gourmet->food_picture = null;
        }

        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // フォームから送信されてきたfood_pictureを削除する
        unset($form['food_picture']);

        // データベースに保存する
        $gourmet->fill($form);
        $gourmet->save();
        
        // gourmet/createにリダイレクトする
        return redirect('gourmet/create');
    }
}
