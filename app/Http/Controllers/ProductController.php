<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductInventoryRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Number;

class ProductController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $limit = Number::clamp($request->integer('limit', 10), min: 1, max: 100);
        $products = Product::with('category')->paginate($limit)->withQueryString();

        return ProductResource::collection($products);
    }

    public function show(string $id): ProductResource
    {
        $product = Product::findOrFail($id);

        return new ProductResource($product);
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        $product = Product::create($request->validated());

        return response()->json($product);
    }

    public function update(UpdateProductRequest $request, string $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->validated());

        return response()->json(['message' => 'Product updated successfully.']);
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product is deleted.']);

    }

    public function updateInventory(UpdateProductInventoryRequest $request, string $id): JsonResponse
    {
        $product = Product::findOrFail($id);
        $product->update($request->validated());

        return response()->json(['message' => 'Product inventory updated successfully.']);
    }
}
