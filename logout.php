<?php

include('vendor/autoload.php');

$provider = new TheNetworg\OAuth2\Client\Provider\Azure([
    'clientId'          => '5b5c09b9-9d15-479c-b739-a18970609e8f',
    'clientSecret'      => ':_;|>|&-@(_{/G)r-g@2^=-/%?(/^%%/[:;4}o[;!^:',
    'redirectUri'       => 'http://localhost:8080/login.php'
]);

// post logout url (redirect after user logedout from Azure AD)
$post_logout_redirect_uri = 'http://localhost:8080/index.php';

$logoutUrl = $provider->getLogoutUrl($post_logout_redirect_uri);
header('Location: '.$logoutUrl);

?>