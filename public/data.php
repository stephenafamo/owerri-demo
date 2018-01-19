<?php

function get_data($phoneNumber)
{
	if (!file_exists('../data/'.$phoneNumber)) {
		$file 			= fopen('../data/'.$phoneNumber, "w");
		fwrite($file, "{}");
		fclose($file);
	}
	
	$details 		= json_decode(file_get_contents("../data/".$phoneNumber), true);
	return $details;
}

function update_data($phoneNumber, $message)
{
	$file = fopen('../data/'.$phoneNumber, "w");
	fwrite($file, json_encode(['message' => $message]));
	fclose($file);
}