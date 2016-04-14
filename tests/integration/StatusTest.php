<?php
use GuzzleHttp\Client;

class StatusTest extends PHPUnit_Framework_TestCase {

    public function testCreateViaPost() {

    	$statusPost = [
    		'user_id' => 1,
    		'status'  => 'Test Create via Post',
    	];

    	$statusResponse = [
    		'id'      => 1,
    		'user_id' => 1,
    		'status'  => 'Test Create via Post',
    	];


        $client = new Client(['base_url' => 'http://localhost:8080']);
        $request = $client->post('/status', ['body' => $statusPost]);
        $response = $request->getBody();
        $decodedResponse = $request->json();


        $this->assertEquals(200, $request->getStatusCode());
        $this->assertEquals($statusResponse, $decodedResponse);

    }


    public function testCreateViaPut() {

    	$statusPut = [
    		'id'      => 2,
    		'user_id' => 2,
    		'status'  => 'Test Create via Put',
    	];

    	$statusResponse = [
    		'id'      => 2,
    		'user_id' => 2,
    		'status'  => 'Test Create via Put',
    	];



        $client = new Client(['base_url' => 'http://localhost:8080']);
        $request = $client->put('/status', ['body' => $statusPut]);
        $response = $request->getBody();
        $decodedResponse = $request->json();


        $this->assertEquals(200, $request->getStatusCode());
        $this->assertEquals($statusResponse, $decodedResponse);

    }

    public function testGet() {

    	$statusResponse = [
    		'id' => '1',
    		'user_id' => '1',
    		'status' => 'Test Create via Post',
    	];



        $client = new Client(['base_url' => 'http://localhost:8080']);
        $request = $client->get('/status/1');
        $response = $request->getBody();
        $decodedResponse = $request->json();

        $this->assertEquals(200, $request->getStatusCode());
        $this->assertEquals($statusResponse, $decodedResponse);

    }

    public function testUpdateViaPut() {

    	$statusPut = [
    		'id'      => 2,
    		'user_id' => 2,
    		'status'  => 'Test Update via Put',
    	];

    	$statusResponse = [
    		'id'      => '2',
    		'user_id' => '2',
    		'status'  => 'Test Update via Put',
    	];


        $client = new Client(['base_url' => 'http://localhost:8080']);
        $request = $client->put('/status', ['body' => $statusPut]);
        $response = $request->getBody();
        $decodedResponse = $request->json();

        $this->assertEquals(200, $request->getStatusCode());
        $this->assertEquals($statusResponse, $decodedResponse);

    }

    /*
    public function testUpdatesViaPatch() {

    	$statusPatch = json_encode([
            [
	    		'id'      => 2,
	    		'user_id' => 2,
	    		'status'  => 'Test Update via Patch',
	    	],
	    	[
	    		'id'      => 2,
	    		'user_id' => 2,
	    		'status'  => 'Test Update via Patch 2',
	    	],
    	]);

    	$statusResponse = [
    		'id'      => '2',
    		'user_id' => '2',
    		'status'  => 'Test Update via Put',
    	];


        $client = new Client(['base_url' => 'http://localhost:8080']);
        $request = $client->patch('/status', ['body' => json_encode($statusPatch)]);
        $response = $request->getBody();
        $decodedResponse = $request->json();

        $this->assertEquals(200, $request->getStatusCode());
        $this->assertEquals($statusResponse, $decodedResponse);

    }
    */

    public function testDelete() {

        $statusResponse = [
            'success' => 1,
        ];


        $client = new Client(['base_url' => 'http://localhost:8080']);
        $request = $client->delete('/status/1');
        $response = $request->getBody();
        $decodedResponse = $request->json();

        $this->assertEquals(200, $request->getStatusCode());
        $this->assertEquals($statusResponse, $decodedResponse);

    }

}