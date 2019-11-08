<?php

namespace yun\lib;

use Curl\Curl;
use yun\Order;
use yun\Query;

class Pay {

    /**
     * 配置参数
     * @var array
     */
    protected $config = [];

    /**
     * 请求
     * @param $url
     * @param array $data
     * @return \stdClass|false
     * @throws \ErrorException
     */
    protected function request(string $url, array $data, string $method = 'POST') {
        $timestamp = time();
        $mess = uniqid();
        $data = Des::encrypt($this->config['des3_key'], $data);
        $request = [
            'data' => $data,
            'mess' => $mess,
            'timestamp' => $timestamp,
            'sign' => $this->buildSign($data, $mess, $timestamp, $this->config['app_key']),
            'sign_type' => 'sha256'
        ];
        $curl = new Curl();
        $curl->setHeaders([
            'dealer-id' => $this->config['dealer_id'],
            'request-id' => $mess,
        ]);
        if (strtoupper($method) == 'POST') {
            $curl->post($url, $request);
        } else {
            $curl->get($url, $request);
        }
        if ($curl->httpStatusCode == 200) {
            return json_decode($curl->getRawResponse(), true);
        } else {
            return false;
        }
    }

    /**
     * 生成签名
     * @param string $data
     * @param $mess
     * @param int $timestamp
     * @param string $app_key
     * @return string
     */
    public function buildSign(string $data, $mess, int $timestamp, string $app_key) {
        return hash_hmac('sha256', "data={$data}&mess={$mess}&timestamp={$timestamp}&key={$app_key}", $app_key);
    }

    public function __construct(array $config) {
        $this->config = $config;
    }

    /**
     * 实例化对象
     * @param array $config
     * @return Query|Order|Pay
     */
    public static function make(array $config) {
        return new static($config);
    }
}