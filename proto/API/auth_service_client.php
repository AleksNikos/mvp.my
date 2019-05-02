<?php

require dirname(__FILE__).'/vendor/autoload.php';

@include_once dirname(__FILE__).'/Cul/AuthServiceClient.php';
@include_once dirname(__FILE__).'/Cul/GenerateTokenResponse.php';
@include_once dirname(__FILE__).'/Cul/GenerateTokenRequest.php';
@include_once dirname(__FILE__).'/Cul/ValidationRequest.php';
@include_once dirname(__FILE__).'/Cul/ValidationResult.php';
@include_once dirname(__FILE__).'/GPBMetadata/AuthService.php';

function createUser()
{
    // get key content
    $caCert     = file_get_contents('ca.crt');
    $clientCert = file_get_contents('client.crt');
    $clientKey  = file_get_contents('client.key');

    function updateAuthMetadataCallback($context)
    {
        $rootJson = file_get_contents('root.json');
        return ['authorization' => ['Bearer ' . $rootJson]];
    }

    $channel_credentials = Grpc\ChannelCredentials::createComposite(
        Grpc\ChannelCredentials::createSsl($caCert, $clientKey, $clientCert),
        Grpc\CallCredentials::createFromPlugin('updateAuthMetadataCallback')
    );
 
 
    $opts = [
        'credentials' => $channel_credentials
    ];

    // create client
    $client = new Cul\AuthServiceClient(
        'cul_api_service.com:50051',
        $opts
    );
    
    // create request
    $request = new Cul\GenerateTokenRequest();

    // fill request data
    $request->setLogin('username');
    $request->setEmail('user@email.com');
    $request->setRestrictionCodes([2, 3, 4]);
    $request->setCountry('RU');
    $request->setState('Moscow');
    $request->setLocation('Moscow');
    $request->setCompany('Company');

    // send message
    list($reply, $status) = $client->generate_token($request)->wait();

    // process response
    $token        = $reply->getToken();
    $serverRootCa = $reply->getServerRootCa();
    $clientKey    = $reply->getClientKey();
    $clientCert   = $reply->getClientCert();

    file_put_contents('new_certs/root_new.json', $token);
    file_put_contents('new_certs/ca_new.crt', $serverRootCa);
    file_put_contents('new_certs/client_new.key', $clientKey);
    file_put_contents('new_certs/client_new.crt', $clientCert);

    // return result
    return 'status: ' . print_r($status, true) . ' reply: ' . print_r($reply, true) . ' token from answer: ' .  $reply->getToken();
}

echo createUser()."\n";
