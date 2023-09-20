<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gourmet;

class GourmetController extends Controller
{
    private $formItems = ["shop_name", "name_katakana", "category","review","food_picture","map_url","tel","comment"];
    // 入力画面を表示するアクションを追加
    public function add()
    {
        return view('gourmet.create');
    }
    
     // 入力内容を確認画面に送信するアクションを追加
    public function create(Request $request)
    {
        $this->validate($request, Gourmet::$rules);
        $input = $request->only($this->formItems);
        /*$form = $request->all();*/
        
        $request->session()->put("form_input", $input);
        return redirect('gourmet/confirm');

    }
    
    // 確認画面を表示するアクションを追加
    public function confirm(Request $request)
    {
        return view('gourmet.confirm', ['gourmet' => $gourmet]);
    }
    
     // 確認画面の内容を送信するアクションを追加
    public function send(Request $request)
    {
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

