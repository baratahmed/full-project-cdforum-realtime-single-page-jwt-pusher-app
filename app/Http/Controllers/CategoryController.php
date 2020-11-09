<?php

namespace App\Http\Controllers;

use App\Model\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['index','show']]);
        //$this->middleware('auth:api', ['except' => ['login']]);
    }

    public function index()
    {
        return CategoryResource::collection(Category::latest()->get());
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    public function store(CategoryRequest $request)
    {
        //Category::create($request->all());
        $category = new Category;
        $category->category_name = $request->category_name;
        $category->category_slug = Str::slug($request->category_name);
        $category->save();
        return response( new CategoryResource($category), Response::HTTP_CREATED);
    }



    public function update(Request $request, Category $category)
    {
        $category->update([
            'category_name' => $request->category_name,
            'category_slug' => Str::slug($request->category_name),
        ]);
        return response(new CategoryResource($category), Response::HTTP_ACCEPTED);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
