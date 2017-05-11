<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header('P3P: CP="CAO PSA OUR"'); 
header("Content-Type: application/json; charset=utf-8");
include 'DatabaseConnection.php';
include 'messageFunctions.php';
include 'productInServiceFunctions.php';
include 'adminFunctions.php';

	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata,TRUE);
	
	
	$entity = $request["entity"];
	if($entity=="message")
	{
		$messageFunctionsC = new messageFunctions();
		$process=$request["process"];
		if($process=="select")
		{			
			$output = $messageFunctionsC->selectMessage();
			echo "$output";
		}
		else if($process=="insert")
		{
			$newMessage = new message();
			$newMessage->senderName=$request["senderName"];
			$newMessage->email=$request["email"];
			$newMessage->subject=$request["subject"];
			$newMessage->content=$request["content"];
			$output = $messageFunctionsC->insertMessage($newMessage);
		}
	}
	else if($entity=="productInService")
	{
		$productInServiceFunctionsC = new productInServiceFunctions();
		$process=$request["process"];
		if($process=="select")
		{			
			$output = $productInServiceFunctionsC->selectProductInService();
			echo "$output";
		}
		else if($process=="insert")
		{
			$newProductInService = new productInService();
			$newProductInService->serialNo=$request['serialNo'];
			$newProductInService->status=$request['status'];
			$newProductInService->modelCode=$request['modelCode'];
			$newProductInService->ownerAddress=$request['ownerAddress'];
			$newProductInService->ownerEmail=$request['ownerEmail'];
			$newProductInService->ownerPhone=$request['ownerPhone'];
			$output = $productInServiceFunctionsC->insertProductInService($newProductInService);
		}
		else if($process=="update")
		{
			$newProductInService = new productInService();
			$newProductInService->serialNo=$request['serialNo'];
			$newProductInService->status=$request['status'];
			$newProductInService->ownerAddress=$request['ownerAddress'];
			$newProductInService->ownerEmail=$request['ownerEmail'];
			$newProductInService->ownerPhone=$request['ownerPhone'];
			$newProductInService->dateOfReturn=$request['dateOfReturn'];
			$output = $productInServiceFunctionsC->updateProductInService($newProductInService);
		}
		else if($process=="search")
		{
			$serialNo=$request["serialNo"];
			$output = $productInServiceFunctionsC->searchProductInService($serialNo);
		}
	}
	if($entity=="admin")
	{
		$adminFunctionsC = new adminFunctions();
		$process=$request["process"];
		if($process=="login")
		{	
			$userName=$request["userName"];	
			$password=$request["password"];	
			$output = $adminFunctionsC->selectAdminLogin($userName,$password);
			echo "$output";
		}
		else if($process=="insert")
		{
			$newAdmin = new admin();
			$newAdmin->userName=$request["userName"];
			$newAdmin->password=$request["password"];
			$output = $adminFunctionsC->insertAdmin($newAdmin);
		}
	}
?>