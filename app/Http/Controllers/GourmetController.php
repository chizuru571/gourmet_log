<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gourmet;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Auth;

class GourmetController extends Controller
{
    public function add()
    {
        $categories = Category::all();
        $reviews=['1','2','3','4','5'];
        return view('gourmet.create', compact('categories','reviews'));
    }
    
     // 入力内容を確認画面に送信するアクションを追加
    public function confirm(Request $request)
    { // dd($request);
        // Validationを行う
        $this->validate($request, Gourmet::$rules);

        // $gourmet = new Gourmet;
        $gourmet = $request->all();
        $category= Category::find($gourmet['category_id']);
        if ($category == null){
            abort(404);
        }
        // フォームから画像が送信されてきたら、保存して、image_path に画像のパスを保存する
        if (isset($gourmet['image'])) {
            $path = $request->file('image')->store('public/image');
            $gourmet['food_picture'] = basename($path);
        } else {
            $gourmet['food_picture'] = null;
        }
        unset($gourmet['_token']);
        unset($gourmet['image']);
        // dd($gourmet);
        return view('gourmet.confirm',compact('gourmet','category'));

    }
     // 確認画面の内容を送信するアクションを追加
    public function send(Request $request)
    {
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
        $query = Gourmet::query();
        $posts = $query->orderBy('updated_at')->paginate(20);
        
        $gourmet = null;
        if (empty($request->page) || $request->page == 1) {
            if (count($posts) > 0) {
                $gourmet = $posts->shift();
            }
        }
        return view('gourmet.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    
   public function edit(Request $request)
    {
        $categories = Category::all();
        $reviews=['1','2','3','4','5'];
        // Gourmet Modelからデータを取得する
        $gourmet = Gourmet::find($request->id);
        if (empty($gourmet)) {
            abort(404);
        }
        return view('gourmet.edit', ['gourmet_form' => $gourmet], compact('categories','reviews'));
    }

     // 入力内容を確認画面に送信するアクションを追加
    public function editconfirm(Request $request)
    {
        // Validationを行う
        $this->validate($request, Gourmet::$rules);

        // $gourmet = new Gourmet;
        
        $gourmet = $request->all();
        $category= Category::find($gourmet['category_id']);
        if ($category == null){
            abort(404);
        }
        return view('gourmet.editconfirm', ['gourmet_form' => $gourmet],compact('gourmet','category'));

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
        } elseif ($request->file('image')) {
            $path = $request->file('image')->store('public/image');
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
        $category= Category::find($gourmet['category_id']);
        if ($category == null){
            abort(404);
        }
        
        return view('gourmet.detail', ['gourmet' => $gourmet]);
    }

    //カテゴリー一覧を表示するアクションを追加
    public function category_index(Request $request)
    {
        $query = Category::query();
        $posts = $query->orderBy('updated_at')->paginate(3);
        
        $category = null;
        if (empty($request->page) || $request->page == 1) {
            if (count($posts) > 0) {
                $category = $posts->shift();
            }
        }
        return view('gourmet.category.index', ['posts' => $posts]);
    }
    
    public function category_create(Request $request)
    {   // Validationを行う
        $this->validate($request,Category::$rules);

        $category = new Category;
        $form = $request->all();

        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        
        // データベースに保存する
        $category->fill($form);
        $category->save();
        
        // リダイレクトする
        return redirect('gourmet/category');
    }
    
    public function category_delete(Request $request)
    {
        // 該当するCategory Modelを取得
        $category = Category::find($request->id);

        // 削除する
        $category->delete();

        return redirect('gourmet/category');
    }
    
  public function category_edit(Request $request)
    {
        // Category Modelからデータを取得する
        $category = Category::find($request->id);
        if (empty($category)) {
            abort(404);
        }
        return view('gourmet.category.edit', ['category_form' => $category]);
    }
    
    public function category_update(Request $request)
    {
        // Validationをかける
        $this->validate($request, Category::$rules);
        // Modelからデータを取得する
        $category = Category::find($request->id);
        // 送信されてきたフォームデータを格納する
        $category_form = $request->all();
        unset($category_form['_token']);

        // 該当するデータを上書きして保存する
        $category->fill($category_form)->save();

        return redirect('gourmet/category');
    }
    
    //トップページを表示するアクションを追加
    public function dashboard()
    {
        return view('gourmet.dashboard');
    }
}

