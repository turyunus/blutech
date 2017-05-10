<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header('P3P: CP="CAO PSA OUR"'); 
header("Content-Type: application/json; charset=utf-8");

include 'DatabaseConnection.php';

if (isset($_GET['modelCode'])) {
		$modelCode=$_GET['modelCode'];
        $dbConnection = new DatabaseConnection();
		$conn=$dbConnection->connection();
		mysqli_set_charset($conn,'utf8');

		$sql= $conn->query("CALL getWarrantyLength('$modelCode');");
		$productModel= new \stdClass();
		while($rs = $sql->fetch_array(MYSQLI_ASSOC)) {
			$productModel->modelCode=$rs['code'];
			$productModel->typeName=$rs['name'];
			$productModel->warrantyLength=$rs['warranty_length'];
		}
		echo json_encode($productModel, JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE);
    }
    else{
        echo "wrong";
    }
?>