<?php 
namespace App\Repositories\Product;

Interface ProductInterface{
    public function getProducts();
    public function addNewProduct($attributes);
    public function deleteProduct($id);
}