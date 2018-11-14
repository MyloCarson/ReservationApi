<?php 
	$emptyBody = function($request,$response,$next){
		$parsedBody = $request->getParsedBody();
		$x = (array)$parsedBody;
		if (empty($x)) {
			$body = json_encode(["code"=>1, "message"=>"empty request body"]);
			$response->write($body);
			$response->withStatus(204);
			return $response;
		 // 	// $response->withHeader('Content-Type', 'application/json');
			// 	$response->withJson(["code"=>1, "message"=>"empty request body"]);
			// 	$response->withStatus(204);
			// return $response;
		}
		$response = $next($request, $response);
		return $response;
	};
	
	$app->add(function($request, $response,$next){

		$route = $request->getAttribute('route');

	    // return NotFound for non existent route
	    if (empty($route)) {
	        throw new NotFoundException($request, $response);
	    }
		// $route = $request->getAttribute('route');
	    $this->logger->info($request->getMethod() . ' ' . $route->getPattern(), ["Arguments" =>$route->getArguments(),"Body"=>$request->getParsedBody()]);
	    $response = $next($request, $response);
	    $this->logger->info($response->getStatusCode() . ' ' . $response->getReasonPhrase(), [(string)$response->getBody()]);
		return $response;
	});


	$app->add(function ($req, $res, $next) {
	    $response = $next($req, $res);
	    return $response
	            ->withHeader('Access-Control-Allow-Origin', '*')
	            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
	            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
	});


 ?>