<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getAllProducts(Request $request)
    {
        $productsQuery = Product::query();

        if ($request->search) {
            $productsQuery = $productsQuery->whereAny(['name', 'description'], 'LIKE', "%{$request->search}%");
        }

        if ($request->instock) {
            $productsQuery = $productsQuery->where('stock', '>', 0);
        }

        $products = $productsQuery->get()->makeHidden(['description', 'stock', 'created_at', 'updated_at']);

        return $products;
    }

    public function getSingleProduct(int $id)
    {
        $product = Product::find($id);
        return $product;
    }

    public function addProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:1|max:255',
            'description' => 'string|max:500',
            'price' => 'required|numeric|min:0',
            'image' => 'string|max:255',
            'stock' => 'required|integer|min:0'
        ]);

        $product = new Product();

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->image = $request->image;
        $product->stock = $request->stock;

        if ($product->save()) {
            return response('New product created!');
        }

        return response('Oh no');
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response('Invalid product id');
        }

        if ($product->delete()) {
            return response('Product deleted');
        }

        return response('Oh no');
    }

    public function updateProduct(int $id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:1|max:255',
            'description' => 'string|max:500',
            'price' => 'required|numeric|min:0',
            'image' => 'string|max:255',
            'stock' => 'required|integer|min:0'
        ]);

        $product = Product::find($id);

        $product->name = $request->name ?? $product->name;
        $product->description = $request->description ?? $product->description;
        $product->price = $request->price ?? $product->price;
        $product->image = $request->image ?? $product->image;
        $product->stock = $request->stock ?? $product->stock;

        if ($product->save()) {
            return response('Product updated');
        }

        return response('Oh no');
    }
}
