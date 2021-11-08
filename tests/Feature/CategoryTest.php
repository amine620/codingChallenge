<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_getCategories_method()
    {
       
        $response = $this->json('GET', 'api/categories');
        $response
        ->assertStatus(200)
        ->assertJsonFragment($response->original);

    }

    public function test_addNewCategory_method()
    {
        $data=[
            'name'=>"sport"
        ];

        $response= $this->json('POST','api/addNewCategory',$data);

        $response
         ->assertStatus(200)
        ->assertJsonFragment($response->original);

        
        $this->assertDatabaseHas('categories',[
            'name'=>'sport'
        ]);

    }

    public function test_deleteCategory_method()
    {

        $response = $this->json('DELETE', 'api/deleteCategory/2');
        //  print_r($response->original) ;
        $response
            ->assertStatus(200)
            ->assertJsonFragment($response->original);

        $this->assertDatabaseMissing('categories', [
            'id' => '2'
        ]);
    }
}
