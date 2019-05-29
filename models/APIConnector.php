<?php
/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 10.05.2019
 * Time: 3:49
 */


namespace app\models;

use function channel;
use function count;
use Cul\ApiKey;
use Cul\AuthServiceClient;
use Cul\CULApiStatisticsClient;
use Cul\GenerateTokenRequest;

use Cul\TokenInfo;
use Cul\Tokens;
use Cul\UpdateTokenRequest;
use Cul\UserInfo;
use const false;
use function file_exists;
use GPBMetadata\StatisticsService;
use function json_decode;
use function unlink;
use Yii;
use yii\base\Model;

class APIConnector extends Model
{
    private $caCert;
    private $clientCert;
    private $clientKey;
    private $rootJson;
    private $channel_credentials;
    private $opts;
    private $client;
    private $client2;

    /*
     * ���������� ��� �������� ����������� ��� ������ � API
     * */
    public function __construct(array $config = [])
    {
        parent::__construct();
        @include_once Yii::getAlias("@app/proto/api/Cul/AuthServiceClient.php");
        @include_once Yii::getAlias("@app/proto/api/Cul/GenerateTokenResponse.php");
        @include_once Yii::getAlias("@app/proto/api/Cul/GenerateTokenRequest.php");
        @include_once Yii::getAlias("@app/proto/api/Cul/UpdateTokenRequest.php");
        @include_once Yii::getAlias("@app/proto/api/Cul/TokenInfo.php");
        @include_once Yii::getAlias("@app/proto/api/Cul/UserInfo.php");
        @include_once Yii::getAlias("@app/proto/api/Cul/Tokens.php");
        @include_once Yii::getAlias("@app/proto/api/Cul/ValidationRequest.php");
        @include_once Yii::getAlias("@app/proto/api/Cul/ValidationResult.php");

        @include_once Yii::getAlias("@app/proto/api/Cul/ApiCallsCount.php");
        @include_once Yii::getAlias("@app/proto/api/Cul/ApiKeyCallsCount.php");
        @include_once Yii::getAlias("@app/proto/api/Cul/ApiKey.php");
        @include_once Yii::getAlias("@app/proto/api/Cul/ApiKeys.php");
        @include_once Yii::getAlias("@app/proto/api/Cul/ServiceInfo.php");
        @include_once Yii::getAlias("@app/proto/api/Cul/CULApiStatisticsClient.php");
        @include_once Yii::getAlias("@app/proto/api/Cul/CallsEntry.php");


        @include_once Yii::getAlias("@app/proto/api/GPBMetadata/AuthService.php");
        @include_once Yii::getAlias("@app/proto/api/GPBMetadata/StatisticsService.php");

        $this->caCert     = file_get_contents(Yii::getAlias("@app/proto/api").'/ca.crt');
        $this->clientCert  = file_get_contents(Yii::getAlias("@app/proto/api").'/client.crt');
        $this->clientKey  = file_get_contents(Yii::getAlias("@app/proto/api").'/client.key');

        @include_once Yii::getAlias("@app/proto/api/channel_credentials.php");

        $this->channel_credentials= channel($this->caCert, $this->clientKey, $this->clientCert);


        $this->opts = [
            'credentials' => $this->channel_credentials
        ];
//��� ����������� �������� ��� � ��������, ����������� emotionsdemo.com

        // create client
        $this->startClient($config["typeClient"]);

    }

    /*
     *
     *
     * @param int $typeRequest - ��� ������� 1 - ������ � ������ 2 - ��������� ����������.
     * */
    public function startClient($typeRequest){
        switch ($typeRequest){
            case 1:
                $this->client = new AuthServiceClient(
                    'emotionsdemo.com:50051',
                    $this->opts
                );
                break;

            case 2:
                $this->client = new CULApiStatisticsClient(
                    'emotionsdemo.com:50051',
                    $this->opts
                );
                break;
        }
    }

    /*
     *
     * @param int|string $key_id - id ����� �� ������� APIKeys
     * */
    public function keyInfo($key_id){
        $request = new ApiKey();
        $request->setKeyId($key_id);
        list($reply, $status) = $this->client->key_requests_count($request)->wait();
        $this->var_export($reply);
    }

    /*
     * ���������� ���������� � ������
     *
     * */
    public function keysInfo (array $arr=null){
        $request = new \Cul\ApiKeys();
        $arrayClassKeys = array();

        foreach ($arr as $kk){
            $key = new ApiKey();
            $key->setKeyId($kk);
            $arrayClassKeys [] = $key;
        }

        $request->setKeys($arrayClassKeys);
        list($reply, $status) = $this->client->keys_requests_count($request)->wait();
        return $reply;
    }


    public function service_info() {
        $request = new \Cul\ServiceInfo();
        $request->setServiceCode(0);
//        $this->var_export($request);
        list($reply, $status) = $this->client->service_calls($request)->wait();
//        $this->var_export($reply);
        return $reply;
    }

    /*
     * ���������� ���� ��� ����������� ������������
    */
    public function generateKey(User $user,array $tokenTypes) {
        $request = new GenerateTokenRequest();
        $request->setLogin($user->username);
        $request->setEmail($user->email);
        $request->setRestrictionCodes($tokenTypes);//��������� ����� Fd ��� Er
        $request->setCountry('RU');
        $request->setState('Moscow');
        $request->setLocation('Moscow');
        $request->setCompany($user->name_organization);

        list($reply, $status) = $this->client->generate_token($request)->wait();
//        $this->var_export($reply);
        $token        = $reply->getToken();
        $serverRootCa = $reply->getServerRootCa();
        $clientKey    = $reply->getClientKey();
        $clientCert   = $reply->getClientCert();

        //��������� ���������� ���� �������:
        $token_name = mb_strtolower(md5(Yii::$app->security->generateRandomString()));
        $path = Yii::getAlias("@app/proto/tokens");
        $currentToken = json_decode($token);


        //������� ����� ����� ������� � ��� � ����������.
        if(!UserAPIKeys::findOne(["uid"=>$currentToken->uid, "userID"=>$user->id])){
            $UA = new UserAPIKeys();
            $UA->userID = $user->id;
            $UA->uid = $currentToken->uid;
            $UA->save(false);
        }

        //����� ���������� ������ ������ � ������������� �������. ��� ����� ����� ������� � ������� API
        if($lastToken = $this->getLastToken($user)){
            $apiKyes = new APIKeys();
            $apiKyes->setParams($lastToken, $currentToken,$token_name);
            $apiKyes->save(false);//��� ��������� �����.
        }

        //���������� ������
        file_put_contents($path.'/root_'.$token_name.'.json', $token);
        file_put_contents($path.'/ca_'.$token_name.'.crt', $serverRootCa);
        file_put_contents($path.'/client_'.$token_name.'.key', $clientKey);
        file_put_contents($path.'/client_'.$token_name.'.crt', $clientCert);

        //���������� ���������� � ���� ������, ���������� � ������ Keys.
        return $token_name;
    }


    /*
     * ��������� ����
     *
     * @param $user - ������ �������� �����
     * @param $key - ���� ������������� � ������� Keys
     * */
    public function updateToken(User $user, Keys $key){
        /** @var APIKeys $token */
        $token = $key->apiToken;

        //��������� ���������� � ������� ������
       $currentToken = $this->getTokenInfo($token);

        //��������� ���������� � ����� ������
        $newToken = new GenerateTokenRequest();
        $newToken->setLogin($user->username);
        $newToken->setEmail($user->email);
        if($key->Fd){
            $tokenTypes[] = 2;
        }
        if($key->Er){
            $tokenTypes[] = 7;
        }
        if(count($tokenTypes)==0){
            return false;
        }
        $newToken->setRestrictionCodes($tokenTypes);//��������� ����� Fd ��� Er
        $newToken->setCountry('RU');
        $newToken->setState('Moscow');
        $newToken->setLocation('Moscow');
        $newToken->setCompany($user->name_organization);

        //���������
        $update = new UpdateTokenRequest();
        $update->setCurrentToken($currentToken);
        $update->setNewTokenInfo($newToken);

        list($reply, $status) = $this->client->update_token($update)->wait();
        $token        = $reply->getToken();
        $serverRootCa = $reply->getServerRootCa();
        $clientKey    = $reply->getClientKey();
        $clientCert   = $reply->getClientCert();

        //��������� ����� ������ �� ����.
        $token_name = $key->value;
        $currentToken = json_decode($token);

        //��������� ������ ������ � ������������� �������.
        if($lastToken = $this->getLastToken($user)){
            $apiKyes = APIKeys::findOne(["systemID"=>$key->value]); //���� ������ ������ � ��������� ��
            $apiKyes->setParams($lastToken, $currentToken,$token_name);
            $apiKyes->save(false);//��� ��������� �����.
        }

        $path = Yii::getAlias("@app/proto/tokens");
        //������� ������ ����� �������
        unlink($path.'/root_'.$token_name.'.json');
        unlink($path.'/ca_'.$token_name.'.crt');
        unlink($path.'/client_'.$token_name.'.key');
        unlink($path.'/client_'.$token_name.'.crt');

        //���������� ������
        file_put_contents($path.'/root_'.$token_name.'.json', $token);
        file_put_contents($path.'/ca_'.$token_name.'.crt', $serverRootCa);
        file_put_contents($path.'/client_'.$token_name.'.key', $clientKey);
        file_put_contents($path.'/client_'.$token_name.'.crt', $clientCert);



        //���������� ���������� � ���� ������, ���������� � ������ Keys.
        return $token_name;

    }

    /*
     * ��������� ����
     *
     *
     *
     * */
    public function stopToken(Keys $key){
        /** @var APIKeys $token */
        $token = $key->apiToken;

        //��������� ���������� � ������� ������
        $currentToken = $this->getTokenInfo($token);

        list($reply, $status) =$this->client->close_token($currentToken)->wait();
        if($status->code == 0){

            //��������� �������� �������
            $lastToken = $currentToken;
            $currentToken->setActive(false);
            $token_name = $key->value;
            $apiKyes = APIKeys::findOne(["systemID"=>$key->value]); //���� ������ ������ � ��������� ��
            $apiKyes->setParams($lastToken, $currentToken,$token_name);

            $path = Yii::getAlias("@app/proto/tokens");
            unlink($path.'/root_'.$token_name.'.json');
            unlink($path.'/ca_'.$token_name.'.crt');
            unlink($path.'/client_'.$token_name.'.key');
            unlink($path.'/client_'.$token_name.'.crt');

            return $apiKyes->save(false);//��� ��������� �����.


        }else{
            return false;
        }

    }

    /*�������� ��������� ���� ��� ����������� ������������*/
    public function getLastToken(User $user){
        $userInfo = new UserInfo();
        $userInfo->setEmail($user->email);
        $userInfo->setUserId($user->apiUser->uid);//��� ������.
        $userInfo->setLogin($user->username);

        list($reply, $status) = $this->client->user_tokens($userInfo)->wait();
        $tokens = $reply->getTokens();
        $count = count($tokens);
        if($count !=0 and $count!=1){
            return $tokens[$count-1];
        }else if ($count == 1){
            return $tokens[0];
        }else{
            return false;
        }

    }

    /*
     * ���������� ���������� �� ������������ ������
     *
     * $user - ������ USER
     * $tokenID - ID ����� ������� ���������� ������� �� API
     * return $token TokenInfo - ������ �����.
     * return boolean false - ���� ��� �����.
     * */
    public function getTokenById(User $user, $tokenID) {
        $userInfo = new UserInfo();
        $userInfo->setEmail($user->email);
        $userInfo->setUserId($user->apiUser->uid);
        $userInfo->setLogin($user->username);

        list($reply, $status) = $this->client->user_tokens($userInfo)->wait();
        $tokens = $reply->getTokens();
        $count = count($tokens);
        if ($count !=0){
            foreach ($tokens as $token){
                if($token->getTokenId() == $tokenID){
                    return $token;
                }
            }
        }
        return false;
    }

    /*���������� ��� ������*/
    public function getTokensByUserID(User $user){
        $userInfo = new UserInfo();
        $userInfo->setEmail($user->email);
        $userInfo->setUserId($user->apiUser->uid);
        $userInfo->setLogin($user->username);

        list($reply, $status) = $this->client->user_tokens($userInfo)->wait();
        $tokens = $reply->getTokens();
        $count = count($tokens);
        if ($count !=0){
            foreach ($tokens as $token){
                echo "<br>";
                echo $token->getTokenId()." ".$token->getActive();
            }
        }
        return false;
    }

    /*
     * ���������� ����������� ���������� � Token
     * */
    public function getTokenInfo($token){
        $currentToken = new TokenInfo();
        $currentToken->setTokenId($token->token_id);
        $currentToken->setKeyId($token->key_id);
        $currentToken->setExpired($token->expired);
        $currentToken->setActive($token->active);
        $currentToken->setKeyData($token->key_data);
        return $currentToken;
    }











}