<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Contact;
use Carbon\Carbon;

class ContactsTest extends TestCase
{
    use RefreshDatabase;

protected $user;

protected function setUp(): void{
    parent::setUp();
$this->user = factory(User::class)->create();

}
/** @test */
public function a_list_of_contacts_can_be_fetched_for_the_authenticated_user(){

    $this->withoutExceptionHandling();

    $user = factory(User::class)->create();
    $anotherUser = factory(User::class)->create();

    $contact = factory(Contact::class)->create(['user_id' => $user->id]);
    $anotherContact = factory(Contact::class)->create(['user_id' => $anotherUser->id]);

    $response = $this->get('/api/contacts?api_token=' . $user->api_token);

    $response->assertJsonCount(1)->assertJson([['id' => $contact->id]]);


}


/** @test */
public function an_unauthenticated_user_should_redirected_to_login(){

$response = $this->post('/api/contacts', array_merge($this->data(),['api_token' => '']));

$response->assertRedirect('/login');
$this->assertCount(0, Contact::all());
}

    /** @test */
public function an_authenticated_user_can_add_a_contact()
{

// $this->withoutExceptionHandling();

$user = factory(User::class)->create();


$this->post('/api/contacts', $this->data());

$contact = Contact::first();

$this->assertEquals('Test Name', $contact->name);
$this->assertEquals('jeff@gmail.com', $contact->email);
$this->assertInstanceOf(Carbon::class, Contact::first()->birthday);
$this->assertEquals('Oracle', $contact->company);



}

/** @test */
public function fields_are_required(){

    // $this->withoutExceptionHandling();
    collect(['name','email','birthday','company'])->each(function ($field) {
    $response = $this->post('/api/contacts', 
    array_merge($this->data(), [$field => '']));

    $contact = Contact::all();

    $response->assertSessionHasErrors($field);
    $this->assertCount(0, $contact);

    });
}



/** @test */
public function email_must_be_a_valid_email(){

    // $this->withoutExceptionHandling();
    $response = $this->post('/api/contacts', 
    array_merge($this->data(), ['email' => 'NOT AN EMAIL']));

    $contact = Contact::all();

    $response->assertSessionHasErrors('email');
    $this->assertCount(0, $contact);

}
/** @test */
public function birthdays_are_properly_stored(){
    $this->withoutExceptionHandling();
    $response = $this->post('/api/contacts', 
    array_merge($this->data()));

  
    $this->assertCount(1, Contact::all());
    $this->assertInstanceOf(Carbon::class, Contact::first()->birthday);
    $this->assertEquals('09-24-1989', Contact::first()->birthday->format('m-d-Y'));

}
/** @test */
public function a_contact_can_be_retrieved(){

    $contact = factory(Contact::class)->create(['user_id' => $this->user->id]);
  $response = $this->get('/api/contacts/'. $contact->id . '?api_token=' . $this->user->api_token);
  $response->assertJson([

    'name' => $contact->name,
    'email' => $contact->email,
    'birthday' => $contact->birthday->format('Y-m-d\TH:i:s.\0\0\0\0\0\0\Z'),
    'company' => $contact->company,
    
    ]);
}
/** @test */
public function only_the_users_contacts_can_be_retrieved(){

    $contact = factory(Contact::class)->create(['user_id' => $this->user->id]);
    $anotherUser = factory(User::class)->create();

    $response = $this->get('/api/contacts/'. $contact->id . '?api_token=' . $anotherUser->api_token);
    $response->assertStatus(403);
}

/** @test */
public function a_contact_can_be_patched(){

    // $this->withoutExceptionHandling(); 

$contact = factory(Contact::class)->create(['user_id' => $this->user->id]);
$response = $this->patch('/api/contacts/'. $contact->id, $this->data());
$contact = $contact->fresh();



$this->assertEquals('Test Name', $contact->name);
$this->assertEquals('jeff@gmail.com', $contact->email);
// $this->assertInstanceOf(Carbon::class, Contact::first()->birthday);
$this->assertEquals('09/24/1989', $contact->birthday->format('m/d/Y'));
$this->assertEquals('Oracle', $contact->company);



}

/** @test */
public function only_the_owner_of_the_contact_can_patch_the_contact(){

    $contact = factory(Contact::class)->create();
    $anotherUser = factory(User::class)->create();


  $response = $this->patch('/api/contacts/'. $contact->id, array_merge($this->data(), ['api_token' => $anotherUser->api_token]));
  $response->assertStatus(403);


}   

/** @test */
public function a_contact_can_be_deleted(){

    $contact = factory(Contact::class)->create(['user_id' => $this->user->id]);

    $response = $this->delete('/api/contacts/'.$contact->id, ['api_token' => $this->user->api_token]);
    $this->assertCount(0, Contact::all());
}
/** @test */
public function only_the_owner_can_delete_the_contact(){

    $contact = factory(Contact::class)->create();
    $anotherUser = factory(User::class)->create();

    $response = $this->delete('/api/contacts/'.$contact->id, ['api_token' => $this->user->api_token]);
   


    $response->assertStatus(403);
}

private function data(){

    return [
    
        'name' => 'Test Name',
        'email' => 'jeff@gmail.com',
        'birthday' => '09/24/1989',
        'company' => 'Oracle',
        'api_token' => $this->user->api_token,
        
    ];
}

// /** @test */
// public function a_name_is_required()
// {

// // $this->withoutExceptionHandling();

// $response = $this->post('/api/contacts', 
// array_merge($this->data(), ['name' => '']));

// $contact = Contact::all();

// $response->assertSessionHasErrors('name');
// $this->assertCount(0, $contact);

// }
// /** @test */
// public function email_is_required()
// {

// // $this->withoutExceptionHandling();

// $response = $this->post('/api/contacts', 
// array_merge($this->data(), ['email' => '']));

// $contact = Contact::all();

// $response->assertSessionHasErrors('email');
// $this->assertCount(0, $contact);

// }

}
