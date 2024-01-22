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
        $vendingmachines = VendingMachine::with('category')->get();
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
        ]);

        // 画像のアップロード処理（適切に実装が必要）

        VendingMachine::create([
            'image' => $request->image,
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    //additionページへの偏移
    public function showAdditionForm()
    {
        $categories = Category::all();
        return view('registration.addition', compact('categories'));
    }
}
