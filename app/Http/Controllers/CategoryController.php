<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $category = Category::orderBy('id')->get();

        return CategoryResource::collection($category);
    }

    public function show(int $id): JsonResponse
    {
        $category = Category::findOrFail($id);

        return response()->json($category);

    }

    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $category = Category::create($request->validated());

        return response()->json(['message' => 'Category created successfully.']);
    }

    public function update(UpdateCategoryRequest $request, int $id): CategoryResource
    {

        $category = Category::findOrFail($id);
        $category->update($request->validated());

        return new CategoryResource($category)->additional(['message' => 'Category updated successfully.']);
    }

    public function destroy(int $id): JsonResponse
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Category is deleted']);

    }
}
