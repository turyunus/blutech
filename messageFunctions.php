<?php
include 'message.php';
//include 'DatabaseConnection.php';
	class messageFunctions{
		function insertMessage(message $newMessage){
			$dbConnection = new DatabaseConnection();
			$conn=$dbConnection->connection();
			mysqli_set_charset($conn,'utf8');

			$senderName = $newMessage->senderName;
			$email = $newMessage->email;
			$subject = $newMessage->subject;
			$content = $newMessage->content;
			
			
			$result = $conn->query("CALL `insertMessage`('$senderName', '$email', '$subject', '$content');");
		}
		function selectMessage(){
			$dbConnection = new DatabaseConnection();
			$conn=$dbConnection->connection();
			mysqli_set_charset($conn,'utf8');
			
			$sql= $conn->query("CALL `selectMessage`();");
			
			while($rs = $sql->fetch_array(MYSQLI_ASSOC)) {
				$newMessage = new message();
				$newMessage->id=$rs['id'];
				$newMessage->senderName=$rs['senderName'];
				$newMessage->email=$rs['email'];
				$newMessage->subject=$rs['subject'];
				$newMessage->content=$rs['content'];
				$messages[]=$newMessage;
			}
			$conn->close();
			return json_encode($messages,JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE);
			
			
		}
	}
	
?>