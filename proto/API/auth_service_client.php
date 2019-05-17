<?php

//require dirname(__FILE__).'/vendor/autoload.php';

use Cul\GenerateTokenRequest;
use Cul\TokenInfo;
use Cul\UpdateTokenRequest;
use Cul\UserInfo;

@include_once dirname(__FILE__).'/Cul/AuthServiceClient.php';
@include_once dirname(__FILE__).'/Cul/GenerateTokenResponse.php';
@include_once dirname(__FILE__).'/Cul/GenerateTokenRequest.php';
@include_once dirname(__FILE__).'/Cul/UpdateTokenRequest.php';
@include_once dirname(__FILE__).'/Cul/TokenInfo.php';
@include_once dirname(__FILE__).'/Cul/UserInfo.php';
@include_once dirname(__FILE__).'/Cul/Tokens.php';
@include_once dirname(__FILE__).'/Cul/ValidationRequest.php';
@include_once dirname(__FILE__).'/Cul/ValidationResult.php';
@include_once dirname(__FILE__).'/GPBMetadata/AuthService.php';

function createUser()
{
    // get key content
    $caCert     = file_get_contents(Yii::getAlias("@app/proto/api").'/ca.crt');
    $clientCert = file_get_contents(Yii::getAlias("@app/proto/api").'/client.crt');
    $clientKey  = file_get_contents(Yii::getAlias("@app/proto/api").'/client.key');

    function updateAuthMetadataCallback($context)
    {
        $rootJson = file_get_contents(Yii::getAlias("@app/proto/api").'/root.json');
        return ['authorization' => ['Bearer ' . $rootJson]];
    }

    $channel_credentials = Grpc\ChannelCredentials::createComposite(
        Grpc\ChannelCredentials::createSsl($caCert, $clientKey, $clientCert),
        Grpc\CallCredentials::createFromPlugin('updateAuthMetadataCallback')
    );
 
 
    $opts = [
        'credentials' => $channel_credentials
    ];
//Вам понадобится доменное имя в скриптах, используйте emotionsdemo.com

    // create client
    $client = new Cul\AuthServiceClient(
//        'cul_api_service.com:50051',
        'emotionsdemo.com:50051',
        $opts
    );
    echo "<pre>";
    $request2 = new UserInfo();
    $request2->setLogin("vitaly74RU");
    $request2->setUserId("7");
    $request2->setEmail("cheltend@mail.ru");

    list($reply, $status) = $client->user_tokens($request2)->wait();
//    $tokens = $reply->getTokens();
//    $count = count($tokens);
//    var_export($tokens[$count-1]);
    foreach ($reply->getTokens() as $token){

        if($token->getTokenId()==49){
            var_export($token);
        }
//        echo $token->getTokenId(). ' '. $token->getActive();
        echo "<br>";
    }die;


//    $request3 = new TokenInfo();
//    $request3->setKeyData("3bdbg837a084b42550f1a3cada1bf8a6ae99d992e360792e8996gce28b7fc14aca365edf2015273gd6977cg40gfe1e1c1ff0b081fe4c3e29f8cd939dg3073dggg8636ee5ebb6f694053d73g82dg581362bbada4gadca9522f1d2361655f4a29a71faa871aa8c5a568e4bc0gf8f263537c115374667fa52c0g7ce6ae6536bc460");
//    $request3->setActive("true");
//    $request3->setExpired("2020-May-09");
//    $request3->setKeyId("50");
//    $request3->setTokenId("49");
//
//
//
//    list($reply, $status) = $client->close_token($request3)->wait();
//    var_export($reply);die;





    // create request
    $request = new Cul\GenerateTokenRequest();

    // fill request data
    $request->setLogin('vitaly74RU');
    $request->setEmail('cheltend@mail.ru');
    $request->setRestrictionCodes([2,]);//параметры ключа Fd или Er
    $request->setCountry('RU');
    $request->setState('Moscow');
    $request->setLocation('Moscow');
    $request->setCompany('Company');

    // send message
    list($reply, $status) = $client->generate_token($request)->wait();
    echo "<pre>";
    var_export($reply);die;
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
