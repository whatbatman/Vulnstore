<?php
session_start();
$user=$_SESSION['user'];

$target_dir = "pic/$user";
$target_file = $target_dir . basename($_FILES['uploaded']['name]);

	if(!move_uploaded_file($_FILES['uploaded']['tmp_name'], $target_file)){
		$html .= '<pre>';
		$html .= 'Your image was not uploaded :(';
		$html .= '</pre>';
	} else {
		$html .= '<pre>';
		$html .= $target_file . ' successful uploaded :)';
		$html .= '</pre>';
	}
?>
