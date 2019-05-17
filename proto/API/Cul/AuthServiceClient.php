<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Cul;

/**
 */
class AuthServiceClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \Cul\ValidationRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function validate_token(\Cul\ValidationRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/cul.AuthService/validate_token',
        $argument,
        ['\Cul\ValidationResult', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Cul\GenerateTokenRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function generate_token(\Cul\GenerateTokenRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/cul.AuthService/generate_token',
        $argument,
        ['\Cul\GenerateTokenResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Cul\TokenInfo $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function close_token(\Cul\TokenInfo $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/cul.AuthService/close_token',
        $argument,
        ['\Cul\TokenInfo', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Cul\UpdateTokenRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function update_token(\Cul\UpdateTokenRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/cul.AuthService/update_token',
        $argument,
        ['\Cul\GenerateTokenResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Cul\UserInfo $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function user_tokens(\Cul\UserInfo $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/cul.AuthService/user_tokens',
        $argument,
        ['\Cul\Tokens', 'decode'],
        $metadata, $options);
    }


}
