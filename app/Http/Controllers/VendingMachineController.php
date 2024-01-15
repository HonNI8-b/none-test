<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\VendingMachine;

class VendingMachineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('registration.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'price' => 'required|numeric',
            'date' => 'required',
            'stock' => 'required|numeric',
        ]);

        $result = VendingMachine::create([
            'image' => $request->image,
            'comment' => $request->comment,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'date' => $request->date,
            'stock' => $request->stock,
        ]);

        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
