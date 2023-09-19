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
        
        // フォームから画像が送信されてきたら、保存して、$gourmet->food_picture に画像のパスを保存する
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
        
        // gourmetにリダイレクトする
        return redirect('gourmet');
    }
    
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $posts = Gourmet::where('title', $cond_title)->get();
        } else {
            // それ以外はすべてのお店情報を取得する
            $posts = Gourmet::all();
        }
        return view('gourmet.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    
   public function edit(Request $request)
    {
        // Gourmet Modelからデータを取得する
        $gourmet = Gourmet::find($request->id);
        if (empty($gourmet)) {
            abort(404);
        }
        return view('gourmet.edit', ['gourmet_form' => $gourmet]);
    }

    public function update(Request $request)
    {
        // Validationをかける
        $this->validate($request, Gourmet::$rules);
        // Gourmet Modelからデータを取得する
        $gourmet = Gourmet::find($request->id);
        // 送信されてきたフォームデータを格納する
        $gourmet_form = $request->all();

        if ($request->remove == 'true') {
            $gourmet_form['food_picture'] = null;
        } elseif ($request->file('food_picture')) {
            $path = $request->file('food_picture')->store('public/image');
            $gourmet_form['food_picture'] = basename($path);
        } else {
            $gourmet_form['food_picture'] = $gourmet->food_picture;
        }

        unset($gourmet_form['food_picture']);
        unset($gourmet_form['remove']);
        unset($gourmet_form['_token']);

        // 該当するデータを上書きして保存する
        $gourmet->fill($gourmet_form)->save();

        return redirect('gourmet');
    }

    
    public function delete(Request $request)
    {
        // 該当するGourmet Modelを取得
        $gourmet = Gourmet::find($request->id);

        // 削除する
        $gourmet->delete();

        return redirect('gourmet');
    }
}
