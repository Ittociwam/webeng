


<?php

try{
	$user = "root";
	$password = "";
	$db = new PDO("mysql:host=127.0.0.1;dbname=bible", $user, $password);

	// foreach($db->query("select * from scriptures") as $row){
	// 		echo "<b>".$row["book"]." ". $row["chapter"].":".$row["verse"]."</b> ".$row["content"]."<br/>";
	// }

		$book = $_POST['booksearch'];
		$query = "select * from scriptures WHERE book = '" . $book."'";
		foreach($db->query($query) as $row){
			echo "<b>".$row["book"]." ". $row["chapter"].":".$row["verse"]."</b> ".$row["content"]."<br/>";
	}
}

catch (PDOException $ex)
{
   echo "Error: ". $ex->getMessage();
   die();
}

echo "Success!";

