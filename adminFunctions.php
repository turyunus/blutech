<?php
include 'admin.php';
//include 'DatabaseConnection.php';
	class adminFunctions{
		function insertAdmin(admin $newAdmin){
			$dbConnection = new DatabaseConnection();
			$conn=$dbConnection->connection();
			mysqli_set_charset($conn,'utf8');

			$userName = $newAdmin->userName;
			$password = $newAdmin->password;
			
			
			$result = $conn->query("CALL `insertAdmin`('$userName', '$password');");
		}
		function selectAdminLogin($userName,$password){
			$dbConnection = new DatabaseConnection();
			$conn=$dbConnection->connection();
			mysqli_set_charset($conn,'utf8');
			
			$sql= $conn->query("CALL `selectAdminLogin`('$userName', '$password');");
			
			while($rs = $sql->fetch_array(MYSQLI_ASSOC)) {
				$newAdmin = new admin();
				$newAdmin->id=$rs['id'];
				$newAdmin->userName=$rs['userName'];
				$newAdmin->password=$rs['password'];
				$admins[]=$newAdmin;
			}
			$conn->close();
			return json_encode($admins,JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE);
			
			
		}
	}
	
?>