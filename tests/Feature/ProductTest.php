<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Image;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_getProducts_method()
    {

        $response = $this->json('GET', 'api/products');
        $response
            ->assertStatus(200)
            ->assertJsonFragment($response->original);
    }

    public function test_addNewProduct_method()
    {


        // add category first to test product data
        $data = [
            'name' => "sport"
        ];

        $response = $this->json('POST', 'api/addNewCategory', $data);

        $response
            ->assertStatus(200)
            ->assertJsonFragment($response->original);




            // make fake file to test file upload
        $file=File::create('iphone.jpeg',300);

        // submit this data to products table
        $data = [
            'name' => "iphone",
            'description'=>'lorem empsum dolor anatako',
            'price'=>110,
            'photo'=>$file,
            'category_id'=>Category::latest()->first()->id
        ];

        $response = $this->json('POST', 'api/addNewProduct', $data);

        $this->withoutExceptionHandling();

        $response
            ->assertStatus(200)
            ->assertJsonFragment($response->original);


            // check if data exsist in database

        $this->assertDatabaseHas('products',[
            'name' => "iphone",
        ]);


        // check if path field not null and has photo directory
          $image=Image::latest()->first();

          $this->assertNotNull($image->path);



    }

    public function test_deleteProduct_method()
    {

        $response = $this->json('DELETE', 'api/deleteProduct/1');
        $response
            ->assertStatus(200)
            ->assertJsonFragment($response->original);
    }
}
