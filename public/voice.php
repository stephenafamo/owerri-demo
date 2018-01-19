<?php
include 'data.php';

$isActive  = $_POST['isActive'];

if ($isActive == 1)  {
    // Read in the caller's number. The format will contain the + in the beginning
    $phoneNumber = $_POST['callerNumber'];

    $user_data      = get_data($phoneNumber);
    $message        = $user_data['message'] ?? "You have currently have no message";

    // Compose the response
    $response  = '<?xml version="1.0" encoding="UTF-8"?>';
    $response .= '<Response>';
    $response .= '<Say>Your message is</Say>';
    $response .= '<Say>'.$message.'</Say>';
    $response .= '</Response>';

    // Print the response onto the page so that our gateway can read it
    header('Content-type: text/plain');
    echo $response;
} 