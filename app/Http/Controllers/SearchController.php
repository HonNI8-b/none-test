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

        $query = VendingMachine::query();

        // キーワードによる検索
        if ($keyword) {
            $query->where('date', 'like', '%' . $keyword . '%');
        }

        // カテゴリーによる絞り込み
        if ($category_id) {
            $query->where('category_id', $category_id);
        }

        // カテゴリーによるソート
        if ($sort === 'category') {
            $query->orderBy('category_id');
        }

        // カテゴリー情報を取得
        $categories = Category::all();

        $results = $query->get();

        return view('registration.search', compact('results', 'keyword', 'category_id','sort', 'categories'));
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
