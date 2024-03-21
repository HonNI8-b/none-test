<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\VendingMachine;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $category_id = $request->input('category_id');
        $sort = $request->input('sort');
        $min_price = $request->input('min_price');
        $max_price = $request->input('max_price');

        $query = VendingMachine::query();

        // キーワードによる検索
        if ($keyword) {
            $query->where('date', 'like', '%' . $keyword . '%');
        }

        // カテゴリーによる絞り込み
        if ($category_id) {
            $query->where('category_id', $category_id);
        }

        // 最小価格が指定されている場合、その価格以上の商品をクエリに追加
        if($min_price){
            $query->where('price', '>=', $min_price);
        }

        // 最大価格が指定されている場合、その価格以下の商品をクエリに追加
        if($max_price){
            $query->where('price', '<=', $max_price);
        }

        // カテゴリーによるソート
        if ($sort === 'category') {
            $query->orderBy('category_id');
        }

        // カテゴリー情報を取得
        $categories = Category::all();

        $results = $query->get();

        // Productモデルに基づいてクエリビルダを初期化
        $query = VendingMachine::query();
 
        return view('registration.index', compact('results', 'keyword', 'category_id','sort', 'categories','min_price','max_price'));
    }

    public function getUsersBySearchName($userName)
    {
        $users = $this->user->where('name', 'like', '%' . $userName . '%')->withCount('items')->orderBy('items_count', 'desc')->get(); //出品数もほしいため、withCountでitemテーブルのレコード数も取得
        return response()->json($users);
    }
}

/*
class SearchController extends Controller
{
    // index.php内検索
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        // データベース検索ロジック
        $results = VendingMachine::where('date', 'like', '%' . $keyword . '%')
                                ->orWhere('category_id', 'like', '%' . $keyword . '%')
                                ->get();

        return view('registration.search', compact('results', 'keyword'));
    
        */
