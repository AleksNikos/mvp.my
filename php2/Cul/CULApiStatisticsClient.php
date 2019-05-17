<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Cul;

/**
 */
class CULApiStatisticsClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \Cul\EmptyMessage $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function self_requests_count(\Cul\EmptyMessage $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/cul.CULApiStatistics/self_requests_count',
        $argument,
        ['\Cul\ApiCallsCount', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Cul\ServiceInfo $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function self_service_requests_count(\Cul\ServiceInfo $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/cul.CULApiStatistics/self_service_requests_count',
        $argument,
        ['\Cul\ApiCallsCount', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Cul\ApiKey $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function key_requests_count(\Cul\ApiKey $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/cul.CULApiStatistics/key_requests_count',
        $argument,
        ['\Cul\ApiCallsCount', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Cul\ApiKeys $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function keys_requests_count(\Cul\ApiKeys $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/cul.CULApiStatistics/keys_requests_count',
        $argument,
        ['\Cul\ApiKeyCallsCount', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Cul\ServiceInfo $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function service_calls(\Cul\ServiceInfo $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/cul.CULApiStatistics/service_calls',
        $argument,
        ['\Cul\ApiCallsCount', 'decode'],
        $metadata, $options);
    }

}
