<?php

namespace App\Repositories\Category;

use App\Models\Category;

interface CategoryInterface{

    public function getCategories();
    public function addNewCategory($attributes);
    public function deleteCategory($id);
}