<?php
require '../core/init.php';
$general->logged_out_protect();

$id = $_GET['id'];

$execute = $users->delete($id);
if ($execute === true) {

	$success = "Delete Successful";
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}
?>