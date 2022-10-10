<?php 
try {
	$baglanti=new PDO("mysql:host=localhost;dbname=blog;charset=utf8","root","");
} catch (PDOException $e) {
	echo $e->getMessage();
}
?>  