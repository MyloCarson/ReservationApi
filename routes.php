<?php 
	use Controllers\UserController;
	use Controllers\BookingController;
	use Controllers\ReviewsController;

	$app->get("/users",function($request,$response,$args){
		$res = UserController::show();
		$response = $response
				->withHeader('Content-Type', 'application/json')
				->withJson(["code"=>0, "message"=>"Fetched Successfully","resources"=>$res])
				->withStatus(200);
			return $response;

	});
	$app->post("/user",function($request,$response,$args){
		$parsedBody = $request->getParsedBody();

		$email = $parsedBody["email"];
		$password = $parsedBody["password"];
		$username = $parsedBody["username"];
		

		$res = UserController::create($username,$email,$password);
		if ($res) {
			$response = $response
				->withJson(["code"=>0, "message"=>"Created Successfully","resources"=>$res])
				->withStatus(201);
			return $response;
		}else{
			$response = $response
				->withJson(["code"=>1, "message"=>"check username or password","resources"=>[]])
				->withHeader('Content-Type', 'application/json')
				->withStatus(400);
			return $response;
		}


	})->add($emptyBody);
	
	$app->post("/login", function($request,$response,$args){
		$parsedBody = $request->getParsedBody();

		$email = $parsedBody["email"];
		$password = $parsedBody["password"];
		$res = UserController::login($email,$password);
		if ($res) {
			$response = $response
				->withJson(["code"=>0, "message"=>"Login Successful","resources"=>$res])
				->withHeader('Content-Type', 'application/json')
			 	->withStatus(200);
			return $response;
		}else{
			$response = $response
				->withJson(["code"=>1, "message"=>"check username or password","resources"=>[]])
				->withHeader('Content-Type', 'application/json')
				->withStatus(400);
			return $response;
		}
	})->add($emptyBody);


	$app->post("/user/{id}",function($request,$response,$args){
		$parsedBody = $request->getParsedBody();

		$user_id = $args["id"];
		$email = $parsedBody["email"];
		$username = $parsedBody["username"];

		$password = $parsedBody["password"];

		$res =  UserController::update($user_id,$username,$email,$password);
		if ($res) {
			$response = $response
				->withJson(["code"=>0, "message"=>"Updated Successfully","resources"=>$res])
				->withHeader('Content-Type', 'application/json')
				->withStatus(201);
			return $response;
		}else{
			$response = $response
				->withJson(["code"=>1, "message"=>"Bad credentials","resources"=>[]])
				->withHeader('Content-Type', 'application/json')
				->withStatus(400);
			return $response;
		}

	})->add($emptyBody);

	$app->delete("/user/{email}",function($request,$response,$args){
		$email = $args["email"];
		$res = UserController::delete($email);
		if ($res) {
			$response = $response
				->withJson(["code"=>0, "message"=>"Deleted Successfully","resources"=>[]])
				->withHeader('Content-Type', 'application/json')
				->withStatus(200);
			return $response;
		}else{
			$response = $response
				->withJson(["code"=>1, "message"=>"Email doesn't exit","resources"=>[]])
				->withHeader('Content-Type', 'application/json')
				->withStatus(400);
			return $response;
		}
	});

	$app->get("/bookings", function($request, $response,$args){
		$res = BookingController::show();
		$response = $response
				->withHeader('Content-Type', 'application/json')
				->withJson(["code"=>0, "message"=>"Fetched Successfully","resources"=>$res])
				->withStatus(200);
			return $response;
	});

	$app->get("/bookings/{user_id}",function($request,$response,$args){
		$user_id = $args["user_id"];
		$res = BookingController::showUserBookings($user_id);

		$response = $response
				->withHeader('Content-Type', 'application/json')
				->withJson(["code"=>0, "message"=>"Fetched Successfully","resources"=>$res])
				->withStatus(200);
			return $response;
	});

	$app->post("/bookings/{user_id}",function($request,$response,$args){
		$parsedBody = $request->getParsedBody();

		$user_id = $args["user_id"];
		$table_no = $parsedBody["table_no"];
		$booking_name = $parsedBody["booking_name"];
		$booking_date = $parsedBody["booking_date"];
		$booking_time = $parsedBody["booking_time"];
		$booking_status = true;

		$res = BookingController::create($user_id,$booking_name,$booking_date,$booking_time,$booking_status,$table_no);
		if ($res) {
			$response = $response
				->withJson(["code"=>0, "message"=>"Booking Created Successfully","resources"=>$res])
				->withStatus(201);
			return $response;
		}else{
			$response = $response
				->withJson(["code"=>1, "message"=>"Something's wrong","resources"=>[]])
				->withHeader('Content-Type', 'application/json')
				->withStatus(400);
			return $response;
		}
	})->add($emptyBody);

	$app->get("/reviews",function($request,$response,$args){
		$res = ReviewsController::show();
		$response = $response
				->withHeader('Content-Type', 'application/json')
				->withJson(["code"=>0, "message"=>"Fetched Successfully","resources"=>$res])
				->withStatus(200);
			return $response;
	});

	$app->post("/reviews/{user_id}",function($request,$response,$args){
		$user_id = $args["user_id"];

		$parsedBody = $request->getParsedBody();
		$booking_id = $parsedBody["booking_id"];
		$review = $parsedBody["review"];

		$res = ReviewsController::create($user_id,$booking_id,$review);
		if ($res) {
			$response = $response
				->withJson(["code"=>0, "message"=>"Review Created Successfully","resources"=>$res])
				->withStatus(201);
			return $response;
		}else{
			$response = $response
				->withJson(["code"=>1, "message"=>"Something's wrong","resources"=>[]])
				->withHeader('Content-Type', 'application/json')
				->withStatus(400);
			return $response;
		}


	})->add($emptyBody);

	$app->post("/reviews/{user_id}/{review_id}",function($request,$response,$args){
		$user_id = $args["user_id"];
		$review_id = $args["review_id"];

		$parsedBody = $request->getParsedBody();
		$booking_id = $parsedBody["booking_id"];
		$review = $parsedBody["review"];

		$res = ReviewsController::update($review_id,$review);
		if ($res) {
			$response = $response
				->withJson(["code"=>0, "message"=>"Review Updated Successfully","resources"=>$res])
				->withStatus(201);
			return $response;
		}else{
			$response = $response
				->withJson(["code"=>1, "message"=>"Something's wrong","resources"=>[]])
				->withHeader('Content-Type', 'application/json')
				->withStatus(400);
			return $response;
		}

	})->add($emptyBody);

	$app->delete("/reviews/{user_id}/{review_id}",function($request,$response,$args){
		$user_id = $args["user_id"];
		$review_id = $args["review_id"];

		$res = ReviewsController::delete($review_id);
		if ($res) {
			$response = $response
				->withJson(["code"=>0, "message"=>"Deleted Successfully","resources"=>[]])
				->withHeader('Content-Type', 'application/json')
				->withStatus(200);
			return $response;
		}else{
			$response = $response
				->withJson(["code"=>1, "message"=>"Review doesn't exit","resources"=>[]])
				->withHeader('Content-Type', 'application/json')
				->withStatus(400);
			return $response;
		}

	});

 ?>