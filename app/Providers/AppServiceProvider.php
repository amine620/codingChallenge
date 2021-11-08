<?php

namespace App\Providers;

use App\Repositories\Category\CategoryInterface;
use App\Repositories\Category\EloquentCategory;
use App\Repositories\Product\EloquentProduct;
use App\Repositories\Product\ProductInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    protected $repositories=[
        CategoryInterface::class=>EloquentCategory::class,
        ProductInterface::class => EloquentProduct::class,
    ];
    public function register()
    {
        foreach ($this->repositories as $interface => $implementation) {
            
            $this->app->bind($interface ,$implementation);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
