<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: StatisticsService.proto

namespace Cul;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;
use Google\Protobuf\Internal\GPBWrapperUtils;

/**
 * Generated from protobuf message <code>cul.ApiKey</code>
 */
class ApiKey extends \Google\Protobuf\Internal\Message
{
    /**
     *id ключа
     *
     * Generated from protobuf field <code>uint64 key_id = 1;</code>
     */
    private $key_id = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int|string $key_id
     *          id ключа
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\StatisticsService::initOnce();
        parent::__construct($data);
    }

    /**
     *id ключа
     *
     * Generated from protobuf field <code>uint64 key_id = 1;</code>
     * @return int|string
     */
    public function getKeyId()
    {
        return $this->key_id;
    }

    /**
     *id ключа
     *
     * Generated from protobuf field <code>uint64 key_id = 1;</code>
     * @param int|string $var
     * @return $this
     */
    public function setKeyId($var)
    {
        GPBUtil::checkUint64($var);
        $this->key_id = $var;

        return $this;
    }

}
