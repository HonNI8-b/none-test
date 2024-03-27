<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\VendingMachine;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all(); 
    
        // 検索条件を取得
        $keyword = $request->input('keyword');
        $category_id = $request->input('category_id');
        $min_price = $request->input('min_price');
        $max_price = $request->input('max_price');
    
        // 検索クエリの作成
        $query = VendingMachine::query(); // あなたの商品モデルに合わせて変更してください
    
        // キーワードでの検索
        if (!empty($keyword)) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }
    
        // カテゴリーでの検索
        if (!empty($category_id)) {
            $query->where('category_id', $category_id);
        }
    
        // 価格での検索
        if (!empty($min_price)) {
            $query->where('price', '>=', $min_price);
        }
        if (!empty($max_price)) {
            $query->where('price', '<=', $max_price);
        }
    
        // 検索結果を取得
        $searchResults = $query->paginate(10); // ページネーションを利用する場合
    
        // 商品一覧ビューを返す
        return view('registration.search', compact('searchResults', 'keyword', 'category_id', 'min_price', 'max_price', 'categories'));
    }
}