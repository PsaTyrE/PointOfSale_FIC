<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Http\Requests\StoreproductRequest;
use App\Http\Requests\UpdateproductRequest;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request as HttpRequest;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(HttpRequest $request)
    {
        $product = DB::table('products')
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('pages.products.index', [
            'type_menu' => '',
            'product' => $product
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.products.create', [
            'type_menu' => ''
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HttpRequest $request)
    {
        $validData = $request->all();
        $product = product::create($validData);
        if ($product) {
            return redirect()->route('product.index')->with('success', 'Product Successfuly Created');
        } else {
            return back()->withErrors(['msg' => 'Failed to Create']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = product::findOrFail($id);

        return view('pages.products.edit', [
            'type_menu' => '',
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateproductRequest $request, product $product)
    {
        $validatedData = $request->validated(); // Menggunakan validated() untuk mendapatkan data yang sudah divalidasi

        $product->update($validatedData);

        if ($product) {
            return redirect()->route('product.index')->with('success', 'User Successfully Updated');
        } else {
            return back()->withInput()->with('error', 'Some problem occurred, please try again');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {
        if ($product->delete()) {
            return redirect()->route('product.index')->with('success', 'Product Successfuly Deleted');
        } else {
            return back()->withErrors(['msg' => 'Delete Failed']);
        }
    }
}
