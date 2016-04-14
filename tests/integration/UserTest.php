<?php
use GuzzleHttp\Client;

class UserTest extends PHPUnit_Framework_TestCase {

    public function testCreateViaPost() {

    	$userPost = [
            'username'   => 'peterparker',
            'first_name' => 'Peter',
            'last_name'  => 'Parker',
    		'email'      => 'peter.parker@spiderman.com',
    	];

    	$userResponse = [
    		'id'         => 1,
            'username'   => 'peterparker',
            'first_name' => 'Peter',
            'last_name'  => 'Parker',
            'email'      => 'peter.parker@spiderman.com',
    	];

        $client = new Client(['base_url' => 'http://localhost:8080']);
        $request = $client->post('/user', ['body' => $userPost]);
        $response = $request->getBody();
        $decodedResponse = $request->json();


        $this->assertEquals(200, $request->getStatusCode());
        $this->assertEquals($userResponse, $decodedResponse);

    }

    public function testCreateViaPut() {

    	$userPut = [
            'id'         => 2,
            'username'   => 'brucewayne',
            'first_name' => 'Bruce',
            'last_name'  => 'Wayne',
            'email'      => 'bruce.wayne@batman.com',
    	];

    	$userResponse = [
            'id'         => 2,
            'username'   => 'brucewayne',
            'first_name' => 'Bruce',
            'last_name'  => 'Wayne',
            'email'      => 'bruce.wayne@batman.com',
    	];


        $client = new Client(['base_url' => 'http://localhost:8080']);
        $request = $client->put('/user', ['body' => $userPut]);
        $response = $request->getBody();
        $decodedResponse = $request->json();


        $this->assertEquals(200, $request->getStatusCode());
        $this->assertEquals($userResponse, $decodedResponse);

    }

    public function testGet() {

    	$userResponse = [
            'id'         => 1,
            'username'   => 'peterparker',
            'first_name' => 'Peter',
            'last_name'  => 'Parker',
            'email'      => 'peter.parker@spiderman.com',
    	];



        $client = new Client(['base_url' => 'http://localhost:8080']);
        $request = $client->get('/user/1');
        $response = $request->getBody();
        $decodedResponse = $request->json();


        $this->assertEquals(200, $request->getStatusCode());
        $this->assertEquals($userResponse, $decodedResponse);

    }

    public function testUpdateViaPut() {

    	$userPut = [
            'id'         => 1,
            'email'      => 'peter.parker@dailybugle.com',
    	];

    	$userResponse = [
            'id'         => '1',
            'username'   => 'peterparker',
            'first_name' => 'Peter',
            'last_name'  => 'Parker',
            'email'      => 'peter.parker@dailybugle.com',
    	];

        $client = new Client(['base_url' => 'http://localhost:8080']);
        $request = $client->put('/user', ['body' => $userPut]);
        $response = $request->getBody();
        $decodedResponse = $request->json();


        $this->assertEquals(200, $request->getStatusCode());
        $this->assertEquals($userResponse, $decodedResponse);

    }

    /*
    public function testUpdatesViaPatch() {

    	$userPatch = [
    		[
                'id'         => 1,
                'username'   => 'peterpark',
                'first_name' => 'Peter',
                'last_name'  => 'Park',
                'email'      => 'peter.park@spiderman.com',
	    	],
	    	[
                'id'         => 1,
                'username'   => 'peterparker',
                'first_name' => 'Peter',
                'last_name'  => 'Parker',
                'email'      => 'peter.parker@spiderman.com',
	    	],
    	];

    	$userResponse = [
            'id'         => 1,
            'username'   => 'peterparker',
            'first_name' => 'Peter',
            'last_name'  => 'Parker',
            'email'      => 'peter.parker@spiderman.com',
    	];


        $client = new Client(['base_url' => 'http://localhost:8080']);
        $request = $client->patch('/user', ['body' => $userPatch]);
        $response = $request->getBody();
        $decodedResponse = $request->json();


        $this->assertEquals(200, $request->getStatusCode());
        $this->assertEquals($userResponse, $decodedResponse);

    }
    */

    public function testDelete() {

        $userResponse = [
            'success' => 1,
        ];


        $client = new Client(['base_url' => 'http://localhost:8080']);
        $request = $client->delete('/user/1');
        $response = $request->getBody();
        $decodedResponse = $request->json();


        $this->assertEquals(200, $request->getStatusCode());
        $this->assertEquals($userResponse, $decodedResponse);

    }

}