<?php

$app->get('/status/{id}', function ($request, $response, $args) use ($db) {

	$id = $args['id'];


	$statusModel = new StatusModel($db);

	$status = $statusModel->getById($id);


    return json_encode($status);

});


$app->get('/status/{id}/user', function ($request, $response, $args) use ($db) {

	$id = $args['id'];


	$statusModel = new StatusModel($db);

	$status = $statusModel->getById($id);

	$user = $userModel->getById($id);


    return json_encode($user);

});

$app->get('/statuses/user/{user_id}', function ($request, $response, $args) use ($db) {

	$userId = $args['user_id'];


	$statusModel = new StatusModel($db);

	$statuses = $statusModel->getByUserId($userId);


    return json_encode($statuses);

});



$app->post('/status', function ($request, $response, $args) use ($db) {


	$statusModel = new StatusModel($db);


	//validate data, require all to exist

	$statusId = $statusModel->create($_POST);

	$status = $statusModel->getById($statusId);


    return json_encode($status);

});


$app->put('/status', function ($request, $response, $args) use ($db) {


	$statusModel = new StatusModel($db);


	//parse the put data
	$_PUT = $request->getParsedBody();


	//validate data

	//update if the record already exists, else create it
	$existingStatus = $statusModel->getById($_PUT['id']);
	if (isset($_PUT['id']) && $existingStatus !== FALSE && !empty($existingStatus)) {

		$statusId = $_PUT['id'];
		$statusModel->update($statusId, [
			'status'   => $_PUT['status'],
		]);

	}
	else {

		$statusId = $statusModel->create($_PUT);

	}


	$status = $statusModel->getById($statusId);


    return json_encode($status);

});

$app->patch('/status', function ($request, $response, $args) use ($db) {

	$statusModel = new StatusModel($db);

	//parse the patch data
	$_PATCH = $request->getParsedBody();

	foreach ($_PATCH as $patch) {

		//validate data

		$statusModel->update($patch['id'], $patch);

	}


	$status = $statusModel->getById($patch['id']);


    return json_encode($status);

});

$app->delete('/status/{id}', function ($request, $response, $args) use ($db) {

	$id = $args['id'];


	$statusModel = new StatusModel($db);

	$success = $statusModel->delete($id);


    return json_encode(['success' => $success]);

});





