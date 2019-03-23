<?php

session_start();

include('vendor/autoload.php');

$provider = new TheNetworg\OAuth2\Client\Provider\Azure([
    'clientId'          => '5b5c09b9-9d15-479c-b739-a18970609e8f',
    'clientSecret'      => ':_;|>|&-@(_{/G)r-g@2^=-/%?(/^%%/[:;4}o[;!^:',
    'redirectUri'       => 'http://localhost:8080/login.php'
]);

if (!isset($_GET['code'])) {

    // If we don't have an authorization code then get one
    $authUrl = $provider->getAuthorizationUrl();
    $_SESSION['oauth2state'] = $provider->getState();
    header('Location: '.$authUrl);
    exit;

// Check given state against previously stored one to mitigate CSRF attack
} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

    unset($_SESSION['oauth2state']);
    exit('Invalid state');

} else {

    // Try to get an access token (using the authorization code grant)
    $token = $provider->getAccessToken('authorization_code', [
        'code' => $_GET['code'],
        'resource' => 'https://graph.windows.net',
    ]);

    // Optional: Now you have a token you can look up a users profile data
    try {

        // We got an access token, let's now get the user's details
        $me = $provider->get("me", $token);

        // Store user information and token in session variables
        $_SESSION['displayName'] = $me['displayName'];
        $_SESSION['mail'] = $me['mail'];
        $_SESSION['token'] = $token;

        // printf('Hello %s!', $me['givenName']);

        // redirect logedin user to specific page
        header('Location: user.php');
        exit;

    } catch (Exception $e) {

        // Failed to get user details
        exit('Oh dear...');
    }

    // Use this to interact with an API on the users behalf
    // echo $token->getToken();
}

?>