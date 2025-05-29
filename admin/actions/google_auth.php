<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

require_once '../../vendor/autoload.php';
require_once 'conn.php';

use Google\Service\Oauth2 as Google_Service_Oauth2;

$client = new Google_Client();
$client->setClientId('45409457152-qccl165icvqlgo5srpfcml1ausbg6123.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/nit/admin/actions/google_auth.php');
$client->addScope("email");
$client->addScope("profile");

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    if (!isset($token["error"])) {
        $client->setAccessToken($token['access_token']);

        $oauth2 = new Google_Service_Oauth2($client);
        $userInfo = $oauth2->userinfo->get();

        $google_id = $conn->real_escape_string($userInfo->id);
        $name = $conn->real_escape_string($userInfo->name);
        $email = $conn->real_escape_string($userInfo->email);
        $picture = $conn->real_escape_string($userInfo->picture);

        // Check if user exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE google_id = ?");
        $stmt->bind_param("s", $google_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 0) {
            // Insert new user
            $insert = $conn->prepare("INSERT INTO users (google_id, first_name, email, picture) VALUES (?, ?, ?, ?)");
            $insert->bind_param("ssss", $google_id, $name, $email, $picture);
            $insert->execute();
        }

        $_SESSION['user'] = [
            'name' => $name,
            'email' => $email,
            'picture' => $picture
        ];

        header("Location: ../../index.html");
        exit();
    } else {
        echo "Error fetching token: " . $token["error"];
    }
} else {
    echo "No Google auth code received.";
}
