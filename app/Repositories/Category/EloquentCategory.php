<?php
namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\Category\CategoryInterface;

class EloquentCategory implements CategoryInterface{

    protected $model;

    public function __construct(Category $model)
    {
        $this->model=$model;
    }

    public function getCategories()
    {
        try {
            return $this->model->all();
        } catch (\Throwable $th) {
             return false;
        }

    }

    public function addNewCategory($attributes)
    {
        try {
            return $this->model->create($attributes->validated());
           
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function deleteCategory($id)
    {
          try {
              $this->model->findOrFail($id)->delete();
              return true;
          } catch (\Throwable $th) {
              return false;
          }
    }
}