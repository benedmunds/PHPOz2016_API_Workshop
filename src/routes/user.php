<?php


$app->get('/user/{id}', function ($request, $response, $args) use ($db) {

	$id = $args['id'];


	$userModel = new UserModel($db);

	$user = $userModel->getById($id);


    return json_encode($user);

});


$app->get('/user/{id}/statuses', function ($request, $response, $args) use ($db) {

	$id = $args['id'];


	$userModel = new UserModel($db);

	$statuses = $userModel->getByUserId($id);


    return json_encode($statuses);

});




$app->post('/user', function ($request, $response, $args) use ($db) {


	$userModel = new UserModel($db);


	//validate data, require all to exist


	$userId = $userModel->create($_POST);

	$user = $userModel->getById($userId);


    return json_encode($user);

});


$app->put('/user', function ($request, $response, $args) use ($db) {


	$userModel = new UserModel($db);


	//parse the put data
	$_PUT = $request->getParsedBody();

	//validate data

	//update if the record already exists, else create it
	$existingUser = $userModel->getById($_PUT['id']);
	if (isset($_PUT['id']) && $existingUser !== FALSE && !empty($existingUser)) {

		$userId = $_PUT['id'];
		$userModel->update($userId, [
			'email'       => $_PUT['email'],
		]);

	}
	else {

		$userId = $userModel->create($_PUT);

	}


	$user = $userModel->getById($userId);


    return json_encode($user);

});

$app->patch('/user', function ($request, $response, $args) use ($db) {


	$userModel = new UserModel($db);

	//parse the patch data
	$_PATCH = $request->getParsedBody();
	foreach ($_PATCH as $patch) {

		//validate data

		$userModel->update($patch['id'], $patch);

	}


	$user = $userModel->getById($patch['id']);


    return json_encode($user);

});

$app->delete('/user/{id}', function ($request, $response, $args) use ($db) {

	$id = $args['id'];


	$userModel = new UserModel($db);

	$success = $userModel->delete($id);


    return json_encode(['success' => $success]);

});




