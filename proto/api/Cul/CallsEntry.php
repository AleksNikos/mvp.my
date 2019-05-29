<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: StatisticsService.proto

namespace Cul;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;
use Google\Protobuf\Internal\GPBWrapperUtils;

/**
 * Generated from protobuf message <code>cul.CallsEntry</code>
 */
class CallsEntry extends \Google\Protobuf\Internal\Message
{
    /**
     *Общее количество вызовов
     *
     * Generated from protobuf field <code>uint64 total = 1;</code>
     */
    private $total = 0;
    /**
     *Количество успешных вызовов
     *
     * Generated from protobuf field <code>uint64 success = 2;</code>
     */
    private $success = 0;
    /**
     *Количество вызовов с ошибкой
     *
     * Generated from protobuf field <code>uint64 errors = 3;</code>
     */
    private $errors = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int|string $total
     *          Общее количество вызовов
     *     @type int|string $success
     *          Количество успешных вызовов
     *     @type int|string $errors
     *          Количество вызовов с ошибкой
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\StatisticsService::initOnce();
        parent::__construct($data);
    }

    /**
     *Общее количество вызовов
     *
     * Generated from protobuf field <code>uint64 total = 1;</code>
     * @return int|string
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     *Общее количество вызовов
     *
     * Generated from protobuf field <code>uint64 total = 1;</code>
     * @param int|string $var
     * @return $this
     */
    public function setTotal($var)
    {
        GPBUtil::checkUint64($var);
        $this->total = $var;

        return $this;
    }

    /**
     *Количество успешных вызовов
     *
     * Generated from protobuf field <code>uint64 success = 2;</code>
     * @return int|string
     */
    public function getSuccess()
    {
        return $this->success;
    }

    /**
     *Количество успешных вызовов
     *
     * Generated from protobuf field <code>uint64 success = 2;</code>
     * @param int|string $var
     * @return $this
     */
    public function setSuccess($var)
    {
        GPBUtil::checkUint64($var);
        $this->success = $var;

        return $this;
    }

    /**
     *Количество вызовов с ошибкой
     *
     * Generated from protobuf field <code>uint64 errors = 3;</code>
     * @return int|string
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     *Количество вызовов с ошибкой
     *
     * Generated from protobuf field <code>uint64 errors = 3;</code>
     * @param int|string $var
     * @return $this
     */
    public function setErrors($var)
    {
        GPBUtil::checkUint64($var);
        $this->errors = $var;

        return $this;
    }

}

