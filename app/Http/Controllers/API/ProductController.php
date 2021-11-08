<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Image;
use App\Models\Product;
use App\Repositories\Product\ProductInterface;
use App\Services\UploadFileService as ServiceForUploadingFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use UploadFileService;

class ProductController extends Controller
{

    protected $product;

    public function __construct(ProductInterface $product)
    {
        $this->product = $product;
    }


    function getProducts()
    {
        $products = $this->product->getProducts();

        if ($products) {
            return response()->json([
                'success' => 'products was fetched successfully',
                'products' => ProductResource::collection($products)
            ], 200);
        }
        return  response()->json(['error' => "something was wrong"]);
    }

    function addNewProduct(ProductRequest $request, ServiceForUploadingFile $uploadFileService)
    {
        $product = $this->product->addNewProduct($request);;

        $product->categories()->syncWithoutDetaching($request->category_id);

        if ($request->hasFile('photo')) {
            $path = $uploadFileService->takeFilePath($request->file("photo"), "productImages");

            $product->images()->save(new Image(["path" => $path]));
        }

        if ($product) {
            return response()->json([
                'success' => 'product was added successfully',
            ], 200);
        }
        return  response()->json(['error' => "something was wrong"]);
    }

    function deleteProduct($id)
    {
        $product = $this->product->deleteProduct($id);
        if ($product) {
            return response()->json([
                'success' => 'product was deleted successfully',
            ], 200);
        }
        return  response()->json(['error' => "something was wrong"]);
    }
}
