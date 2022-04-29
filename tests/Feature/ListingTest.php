<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Listing;
use Tests\TestCase;

class ListingTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function add_post_to_listing(){
   $this->withoutExceptionHandling();

        $response=$this->post('/api/create',[
            'title' => 'Laravel',
            'company' => 'Kune Food',
            'location' => 'Nairobi',
             'website' => 'www.kunefood.com',
             'email' => 'kune@gmail.com',
             'description' => 'To be php developer with 5 years of experience'
        
        ]);
        $response->assertOk(200);
        $this->assertCount(1,Listing::all());
        
           }
}
