<?php

namespace App\Repositories\Product;

use App\Models\Product;

class EloquentProduct  implements ProductInterface{

    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

   public function getProducts()
    {
        try {
            return $this->model->with(['images'])->get();
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function addNewProduct($attributes)
    {
        try {
            return $this->model->create($attributes->validated());
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function deleteProduct($id)
    {
        try {
            $this->model->findOrFail($id)->delete();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}