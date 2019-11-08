<?php

namespace yun\lib;

use Curl\Curl;
use yun\Order;
use yun\Query;

class Pay {

    /**
     * 对象
     * @var Query|Order
     */
    private static $in;

    /**
     * 配置参数
     * @var array
     */
    protected $config = [];

    /**
     * 请求
     * @param $url
     * @param array $data
     * @return mixed
     * @throws \ErrorException
     */
    protected function request(string $url, array $data) {
        $timestamp = time();
        $mess = uniqid();
        $data = Des::encrypt($data);
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
        return $curl->post($url, $request);
    }

    /**
     * 生成签名
     * @param string $data
     * @param $mess
     * @param int $timestamp
     * @param string $app_key
     * @return string
     */
    private function buildSign(string $data, $mess, int $timestamp, string $app_key) {
        return hash_hmac('sha256', "data={$data}&mess={$mess}&timestamp={$timestamp}&key={$app_key}", $app_key);
    }

    public function __construct(array $config) {
        $this->config = $config;
    }

    /**
     * 实例化对象
     * @param array $config
     * @return Pay
     */
    public static function make(array $config) {
        if (empty(self::$in)) {
            self::$in = new static($config);
        }
        return self::$in;
    }
}