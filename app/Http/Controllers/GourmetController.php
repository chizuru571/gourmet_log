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
    
     // 入力内容を確認画面に送信するアクションを追加
    public function confirm(Request $request)
    {
        // Validationを行う
        $this->validate($request, Gourmet::$rules);

        // $gourmet = new Gourmet;
        $gourmet = $request->all();
        return view('gourmet.confirm',compact('gourmet'));

    }
     // 確認画面の内容を送信するアクションを追加
    public function send(Request $request)
    {
        // $input = $request->session()->get("form_input");
        // //セッションに値が無い時はフォームに戻る
        // if(!$input){
        //     return redirect('gourmet/confirm');
        // }
        
        // Validationを行う
        $this->validate($request, Gourmet::$rules);
        //dd('send');

        $gourmet = new Gourmet;
        $form = $request->all();

        // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            $gourmet->food_picture = basename($path);
        } else {
            $gourmet->food_picture = null;
        }

        // フォームから送信されてきた_tokenを削除する
        unset($gourmet['_token']);
        // フォームから送信されてきたimageを削除する
        unset($gourmet['image']);

        // データベースに保存する
        $gourmet->fill($form);
        $gourmet->save();
        
        //セッションを空にする
        // $request->session()->forget("form_input");
        
        return redirect('gourmet');
    }

    
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $posts = Gourmet::where('shop_name', $cond_title)->get();
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
    
    // 詳細を表示するアクションを追加
    public function detail(Request $request)
    {
        // 指定されたお店を取得する
        $gourmet = Gourmet::find($request->id);
        if (empty($gourmet)) {
            abort(404);
        }
        
        return view('gourmet.detail', ['gourmet' => $gourmet]);
    }
}

