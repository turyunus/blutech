<?php
include 'productInService.php';
//include 'DatabaseConnection.php';
	class productInServiceFunctions{
		function insertProductInService(productInService $newProductInService){
			$dbConnection = new DatabaseConnection();
			$conn=$dbConnection->connection();
			mysqli_set_charset($conn,'utf8');

			$serialNo = $newProductInService->serialNo;
			$modelCode = $newProductInService->modelCode;
			$status = $newProductInService->status;
			$ownerAddress = $newProductInService->ownerEmail;
			$ownerEmail = $newProductInService->ownerEmail;
			$ownerPhone = $newProductInService->ownerPhone;
			
			
			$result = $conn->query("CALL `insertProductInService`('$serialNo', '$modelCode', '$status', '$ownerAddress', '$ownerEmail', '$ownerPhone');");
		}
		function updateProductInService(productInService $newProductInService){
			$dbConnection = new DatabaseConnection();
			$conn=$dbConnection->connection();
			mysqli_set_charset($conn,'utf8');

			$serialNo = $newProductInService->serialNo;
			$status = $newProductInService->status;
			$ownerAddress = $newProductInService->ownerAddress;
			$ownerEmail = $newProductInService->ownerEmail;
			$ownerPhone = $newProductInService->ownerPhone;
			$dateOfReturn=$newProductInService->dateOfReturn;
			
			$result = $conn->query("CALL `updateProductInService`('$serialNo', '$status', '$dateOfReturn', '$ownerAddress', '$ownerEmail', '$ownerPhone');");
		}
		function selectProductInService(){
			$dbConnection = new DatabaseConnection();
			$conn=$dbConnection->connection();
			mysqli_set_charset($conn,'utf8');
			
			$sql= $conn->query("CALL `selectProductInService`();");
			
			while($rs = $sql->fetch_array(MYSQLI_ASSOC)) {
				$newProductInService = new productInService();
				$newProductInService->id=$rs['id'];
				$newProductInService->serialNo=$rs['serial_no'];
				$newProductInService->status=$rs['status'];
				$newProductInService->modelCode=$rs['model_code'];
				$newProductInService->dateOfArrival=$rs['date_of_arrival'];
				$newProductInService->dateOfReturn=$rs['date_of_return'];
				$newProductInService->ownerAddress=$rs['owner_address'];
				$newProductInService->ownerEmail=$rs['owner_email'];
				$newProductInService->ownerPhone=$rs['owner_phone'];
				$productsInService[]=$newProductInService;
			}
			$conn->close();
			return json_encode($productsInService,JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE);
			
			
		}
		function searchProductInService($serialNo){
		$dbConnection = new DatabaseConnection();
			$conn=$dbConnection->connection();
			mysqli_set_charset($conn,'utf8');
			
			$sql= $conn->query("CALL `searchProductInService`('$serialNo');");
			
			while($rs = $sql->fetch_array(MYSQLI_ASSOC)) {
				$newProductInService = new productInService();
				$newProductInService->id=$rs['id'];
				$newProductInService->serialNo=$rs['serial_no'];
				$newProductInService->status=$rs['status'];
				$newProductInService->modelCode=$rs['model_code'];
				$newProductInService->dateOfArrival=$rs['date_of_arrival'];
				$newProductInService->dateOfReturn=$rs['date_of_return'];
				$newProductInService->ownerAddress=$rs['owner_address'];
				$newProductInService->ownerEmail=$rs['owner_email'];
				$newProductInService->ownerPhone=$rs['owner_phone'];
				$productsInService[]=$newProductInService;
			}
			$conn->close();
			echo json_encode($productsInService,JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE);
			
			
		}
	}
	
	
?>