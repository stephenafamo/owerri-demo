<?php
include __DIR__.'/../vendor/autoload.php';
include 'data.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

print_r(handle());

function handle()
{
	$phoneNumber 	= $_POST['phoneNumber'];

	if (empty($_POST['text'])) {
		return base();
	}

	$input 		= explode("*", $_POST['text']);
	$message 	= end($input);

	update_data($phoneNumber, $message);
	send_sms();

	$response 	 = "END Your message is now \"{$message}\".\n";
	$response 	.= "You will receive an SMS shortly.";

	return $response;
}

function base()
{
	$phoneNumber 	= $_POST['phoneNumber'];

	$response 	= "CON ";
	$user_data 	= get_data($phoneNumber);

	if($user_data['message']) {
		$response 	.= "Your current message is \"{$user_data['message']}\".\n";
	}

	$response 	.= "Enter a new message";
	return $response;
}

function send_sms()
{
	$phoneNumber = $_POST['phoneNumber'];

	$client = new Client([
		'base_uri' 	=> $_ENV['API_URL'],
		'headers' 	=> [
			'apikey' 		=> $_ENV['API_KEY'],
			'Content-Type' 	=> 'application/x-www-form-urlencoded',
			'Accept' 		=> 'application/json'
		]
	]);

	$data 		= [
		'username'			=> $_ENV['API_USERNAME'],
		'to'				=> $phoneNumber,
		'message'			=> get_data($phoneNumber)['message']."\nDail +23417006125 to listen to your message."
	];


	$response 			= $client->post('messaging', ['form_params' => $data ] );
}