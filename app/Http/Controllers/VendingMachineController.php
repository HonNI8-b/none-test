<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\VendingMachine;

class VendingMachineController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $vendingmachines = VendingMachine::with('category')->paginate(5);
        return view('registration.index', compact('categories','vendingmachines'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'price' => 'required|numeric',
            'date' => 'required',
            'stock' => 'required|numeric',
            'image' => 'required|image', 
        ]);

        // 画像ファイルの取得
        $image = $request->file('image');

        // ファイル名を生成
        $imageName = uniqid() . '_' . $image->getClientOriginalName();

        // 画像を保存するディレクトリを指定
        $directory = 'uploads';

        // 画像を保存
        $image->storeAs($directory, $imageName);

        // 画像の保存パス
        $imagePath = $directory . '/' . $imageName;

        VendingMachine::create([
            'image' => $imagePath,
            'comment' => $request->comment,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'date' => $request->date,
            'stock' => $request->stock,
        ]);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    //edit.blade.phpへの受け渡し
    public function edit(string $id)
    {
        $vendingmachine = VendingMachine::findOrFail($id);
        $categories = Category::all();
        return view('registration.edit', compact('vendingmachine','categories'));

    }

    //detail.blade.phpへの受け渡し
    public function showEditForm(string $id)
    {
        $vendingmachine = VendingMachine::findOrFail($id);
        return view('registration.detail', compact('vendingmachine'));
    }
    
    //edit.blade.php登録ボタンの処理
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'price' => 'required|numeric',
            'date' => 'required',
            'stock' => 'required|numeric',
        ]);

        // 画像のアップロード処理（適切に実装が必要）
        $vendingmachine = VendingMachine::findOrFail($id);
        $vendingmachine->update([
            'date' => $request->input('date'),
            'category_id' => $request->input('category_id'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'comment' => $request->input('comment'),
            'image' => $request->input('image'),
        ]);
        return redirect('/');
    }

    //削除ボタンの処理
    public function destroy(string $id)
    {
        $vendingmachine = VendingMachine::find($id);
        $vendingmachine->delete();
        return redirect('/');
    }

    //additionページへの偏移
    public function showAdditionForm()
    {
        $categories = Category::all();
        return view('registration.addition', compact('categories'));
    }

}
