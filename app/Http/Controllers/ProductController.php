<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   public function index()
{
    return response()->json(Product::latest()->get());
}

public function store(Request $request)
{
    try {
        $mediaPaths = [];

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $path = $file->store('products', 'public');
                $mediaPaths[] = $path;
            }
        }

        $product = Product::create([
            'product_name' => $request->product_name,
            'type' => $request->type,
            'sub_section' => $request->sub_section,
            'country_name' => $request->country_name,
            'hs_code' => $request->hs_code,
            'description' => $request->description,
            'price' => $request->price,
            'media' => $mediaPaths
        ]);

        return response()->json($product);

    } catch (\Exception $e) {
        return response()->json([
            'error' => $e->getMessage()
        ], 500);
    }
}
// edit & delete product
public function update(Request $request, $id) {
    $product = Product::findOrFail($id);

    $product->product_name = $request->product_name ?? $product->product_name;
    $product->type = $request->type ?? $product->type;
    $product->sub_section = $request->sub_section ?? $product->sub_section;
    $product->country_name = $request->country_name ?? $product->country_name;
    $product->hs_code = $request->hs_code ?? $product->hs_code;
    $product->description = $request->description ?? $product->description;
    $product->price = $request->price ?? $product->price;

    if($request->hasFile('media')) {
        $files = [];
        foreach($request->file('media') as $file) {
            $path = $file->store('products', 'public');
            $files[] = $path;
        }
        $product->media = $files;
    }

    $product->save();
    return response()->json($product);
}

public function destroy($id) {
    $product = Product::findOrFail($id);
    $product->delete();
    return response()->json(['message'=>'Product deleted']);
}
}