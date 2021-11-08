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

    // the getProduct() , addNewProduct() , deleteproduct() those methods comming 
    // from Product Interface implemented inside EloquentProduct class

    protected $product;

    public function __construct(ProductInterface $product)
    {
        $this->product = $product;
    }


    // ----------------------------------------get products-------------------------------------
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

    // ----------------------------------------add new product-------------------------------------


    function addNewProduct(ProductRequest $request, ServiceForUploadingFile $uploadFileService)
    {
        $product = $this->product->addNewProduct($request);;

        // this to add the productId and categoryId in the join table
        $product->categories()->syncWithoutDetaching($request->category_id);

        // check if the imput field has file or not
        if ($request->hasFile('photo')) {

            // take the path from Storage Facade inside service class 
            $path = $uploadFileService->takeFilePath($request->file("photo"), "productImages");

            // save path name and and model inside images table 
            // NOTICE : i use the morph relationship and make one single table called image 
            // that we can using it to store all images from different model
            $product->images()->save(new Image(["path" => $path]));
        }

        if ($product) {
            return response()->json([
                'success' => 'product was added successfully',
            ], 200);
        }
        return  response()->json(['error' => "something was wrong"]);
    }


    // ----------------------------------------delete product-------------------------------------

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
