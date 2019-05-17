<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: AuthService.proto

namespace Cul;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;
use Google\Protobuf\Internal\GPBWrapperUtils;

/**
 * Generated from protobuf message <code>cul.GenerateTokenRequest</code>
 */
class GenerateTokenRequest extends \Google\Protobuf\Internal\Message
{
    /**
     *Некий логин для пользователя
     *
     * Generated from protobuf field <code>string login = 2;</code>
     */
    private $login = '';
    /**
     *email, с ним связываются ключи (некая сущзьность для группирования ключей)
     *
     * Generated from protobuf field <code>string email = 3;</code>
     */
    private $email = '';
    /**
     *Числовые кода сервисов, для которых запрашиватеся доступ
     *
     * Generated from protobuf field <code>repeated uint64 restriction_codes = 4;</code>
     */
    private $restriction_codes;
    /**
     *набор полей для генерации ключей.
     *
     * Generated from protobuf field <code>string country = 5;</code>
     */
    private $country = '';
    /**
     * Generated from protobuf field <code>string state = 6;</code>
     */
    private $state = '';
    /**
     * Generated from protobuf field <code>string location = 7;</code>
     */
    private $location = '';
    /**
     * Generated from protobuf field <code>string company = 8;</code>
     */
    private $company = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $login
     *          Некий логин для пользователя
     *     @type string $email
     *          email, с ним связываются ключи (некая сущзьность для группирования ключей)
     *     @type int[]|string[]|\Google\Protobuf\Internal\RepeatedField $restriction_codes
     *          Числовые кода сервисов, для которых запрашиватеся доступ
     *     @type string $country
     *          набор полей для генерации ключей.
     *     @type string $state
     *     @type string $location
     *     @type string $company
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\AuthService::initOnce();
        parent::__construct($data);
    }

    /**
     *Некий логин для пользователя
     *
     * Generated from protobuf field <code>string login = 2;</code>
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     *Некий логин для пользователя
     *
     * Generated from protobuf field <code>string login = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setLogin($var)
    {
        GPBUtil::checkString($var, True);
        $this->login = $var;

        return $this;
    }

    /**
     *email, с ним связываются ключи (некая сущзьность для группирования ключей)
     *
     * Generated from protobuf field <code>string email = 3;</code>
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     *email, с ним связываются ключи (некая сущзьность для группирования ключей)
     *
     * Generated from protobuf field <code>string email = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setEmail($var)
    {
        GPBUtil::checkString($var, True);
        $this->email = $var;

        return $this;
    }

    /**
     *Числовые кода сервисов, для которых запрашиватеся доступ
     *
     * Generated from protobuf field <code>repeated uint64 restriction_codes = 4;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getRestrictionCodes()
    {
        return $this->restriction_codes;
    }

    /**
     *Числовые кода сервисов, для которых запрашиватеся доступ
     *
     * Generated from protobuf field <code>repeated uint64 restriction_codes = 4;</code>
     * @param int[]|string[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setRestrictionCodes($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::UINT64);
        $this->restriction_codes = $arr;

        return $this;
    }

    /**
     *набор полей для генерации ключей.
     *
     * Generated from protobuf field <code>string country = 5;</code>
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     *набор полей для генерации ключей.
     *
     * Generated from protobuf field <code>string country = 5;</code>
     * @param string $var
     * @return $this
     */
    public function setCountry($var)
    {
        GPBUtil::checkString($var, True);
        $this->country = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string state = 6;</code>
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Generated from protobuf field <code>string state = 6;</code>
     * @param string $var
     * @return $this
     */
    public function setState($var)
    {
        GPBUtil::checkString($var, True);
        $this->state = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string location = 7;</code>
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Generated from protobuf field <code>string location = 7;</code>
     * @param string $var
     * @return $this
     */
    public function setLocation($var)
    {
        GPBUtil::checkString($var, True);
        $this->location = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string company = 8;</code>
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Generated from protobuf field <code>string company = 8;</code>
     * @param string $var
     * @return $this
     */
    public function setCompany($var)
    {
        GPBUtil::checkString($var, True);
        $this->company = $var;

        return $this;
    }

}

