<?php
/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 10.05.2019
 * Time: 10:46
 */
function channel($caCert, $clientKey, $clientCert)
{
    function updateAuthMetadataCallback($context)
    {
        $rootJson = file_get_contents(Yii::getAlias("@app/proto/api") . '/root.json');
        return ['authorization' => ['Bearer ' . $rootJson]];
    }

    $channel_credentials = Grpc\ChannelCredentials::createComposite(
        Grpc\ChannelCredentials::createSsl($caCert, $clientKey, $clientCert),
        Grpc\CallCredentials::createFromPlugin('updateAuthMetadataCallback')
    );
    return $channel_credentials;
}