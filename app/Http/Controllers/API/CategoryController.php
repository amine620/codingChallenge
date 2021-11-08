<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Repositories\Category\CategoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $category;

    public function __construct(CategoryInterface $category)
    {
        $this->category = $category;
    }


    // ----------------------------------------get category-------------------------------------

    function getCategories()
    {
        $categories = $this->category->getCategories();
        if ($categories) {
            return response()->json([
                'success' => 'category was fetched successfully',
                'categories' => CategoryResource::collection($categories)
            ], 200);
        }
        return  response()->json(['error' => "something was wrong"]);
    }


    // ----------------------------------------add new category-------------------------------------

    function addNewCategory(CategoryRequest $request)
    {
        $category = $this->category->addNewCategory($request);
        if ($category) {
            return response()->json([
                'success' => 'category was added successfully',
            ], 200);
        }
        return  response()->json(['error' => "something was wrong"]);
    }


    // ----------------------------------------delete category-------------------------------------

    function deleteCategory($id)
    {

        $category = $this->category->deleteCategory($id);
        if ($category) {
            return response()->json([
                'success' => 'category was deleted successfully',
            ], 200);
        }
        return  response()->json(['error' => "something was wrong"]);
    }
}
