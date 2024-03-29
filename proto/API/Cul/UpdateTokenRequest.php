<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: AuthService.proto

namespace Cul;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;
use Google\Protobuf\Internal\GPBWrapperUtils;

/**
 * Generated from protobuf message <code>cul.UpdateTokenRequest</code>
 */
class UpdateTokenRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.cul.TokenInfo current_token = 1;</code>
     */
    private $current_token = null;
    /**
     * Generated from protobuf field <code>.cul.GenerateTokenRequest new_token_info = 2;</code>
     */
    private $new_token_info = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Cul\TokenInfo $current_token
     *     @type \Cul\GenerateTokenRequest $new_token_info
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\AuthService::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>.cul.TokenInfo current_token = 1;</code>
     * @return \Cul\TokenInfo
     */
    public function getCurrentToken()
    {
        return $this->current_token;
    }

    /**
     * Generated from protobuf field <code>.cul.TokenInfo current_token = 1;</code>
     * @param \Cul\TokenInfo $var
     * @return $this
     */
    public function setCurrentToken($var)
    {
        GPBUtil::checkMessage($var, \Cul\TokenInfo::class);
        $this->current_token = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.cul.GenerateTokenRequest new_token_info = 2;</code>
     * @return \Cul\GenerateTokenRequest
     */
    public function getNewTokenInfo()
    {
        return $this->new_token_info;
    }

    /**
     * Generated from protobuf field <code>.cul.GenerateTokenRequest new_token_info = 2;</code>
     * @param \Cul\GenerateTokenRequest $var
     * @return $this
     */
    public function setNewTokenInfo($var)
    {
        GPBUtil::checkMessage($var, \Cul\GenerateTokenRequest::class);
        $this->new_token_info = $var;

        return $this;
    }

}

