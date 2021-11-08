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


        $data = [
            'name' => "sport"
        ];

        $response = $this->json('POST', 'api/addNewCategory', $data);

        $response
            ->assertStatus(200)
            ->assertJsonFragment($response->original);




        $file=File::create('iphone.jpeg',300);

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


        $this->assertDatabaseHas('products',[
            'name' => "iphone",
        ]);

          $image=Image::latest()->first();

          $this->assertNotNull($image->path);



    }

    public function test_deleteProduct_method()
    {

        $response = $this->json('DELETE', 'api/deleteProduct/1');
        //  print_r($response->original) ;
        $response
            ->assertStatus(200)
            ->assertJsonFragment($response->original);
    }
}
