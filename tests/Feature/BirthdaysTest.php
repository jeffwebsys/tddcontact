<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Contact;


class BirthdaysTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function contacts_with_birthdays_in_the_current_month_can_be_fetched(){
        //make a user
        //if unauthenticated persists make use of route API

        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $birthdayContact = factory(Contact::class)->create([

            'user_id' => $user->id,
            'birthday' => now()->subYear(),

        ]);

        $noBirthdayContacts = factory(Contact::class)->create([
            
            'user_id' => $user->id,
            'birthday' => now()->subMonth(),

        ]);
        //assert if there is data
        // if unauthenticated in tests results = use API token as solution
        $this->get('/api/birthdays?api_token='.$user->api_token)
        ->assertJsonCount(1)
        ->assertJson([

            'data' => [
    
                [
                    'data' => [ 
            
                        'contact_id' => $birthdayContact->id
                    ]
            
                ]
            ]
        ]);

    }
}
