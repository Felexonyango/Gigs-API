<?php

namespace Tests\Feature;
use App\Models\User;
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


     //Note i have not set permissions so am not using Factory
    // $post =User::factory()->create();
    /** @test */
    public function test_display_posts(): void
    {
        $this->withoutExceptionHandling();

        $response = $this->get('/api');
        $response->assertStatus(200);
    }
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
 /** @test */
    public function a_post_is_updated(){

         $this->withoutExceptionHandling();

       $this->post('/api/create',[
            'title' => 'Laravel',
            'company' => 'Kune Food',
            'location' => 'Nairobi',
             'website' => 'www.kunefood.com',
             'email' => 'kune@gmail.com',
             'description' => 'To be php developer with 5 years of experience'
        
        ]);

        $post=Listing::first();
        $response=$this->put('/api/'.$post->id,[
            'title' => 'React',
            'company' => 'Kune Food',
            'location' => 'Nairobi',
             'website' => 'www.kunefood.com',
             'email' => 'kune@gmail.com',
             'description' => 'To be php developer with 5 years of experience'
        

        ]);

        $this->assertEquals('React',Listing::first()->title);

           }

 /** @test */
        
           public function a_post_can_be_deleted(){


            $this->withoutExceptionHandling();

            $post =User::factory()->create();
            $this->$this->delete('/api/'.$post->id);
            $this->assertResponseStatus(500);
            $this->dontSeeInDatabase('posts', ['id' => $post->id]);
             

           }
}
