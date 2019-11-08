<?php

namespace yun;

use yun\lib\Pay;

/**
 * 查询类
 * @package yun
 */
class Query extends Pay {

    /**
     * 查询订单
     * @param string $order_id
     * @param string $channel
     * @return array|false
     * @throws \ErrorException
     */
    public function one(string $order_id, string $channel = '银⾏卡') {
        $url = 'https://api-jiesuan.yunzhanghu.com/api/payment/v1/query-realtime-order';
        $data = [
            'order_id' => $order_id,
            'channel' => $channel,
            'data_type' => 'encryption'
        ];
        return $this->request($url, $data, 'GET');
    }

    /**
     * 查询账户余额
     * @return array|false
     * @throws \ErrorException
     */
    public function accounts() {
        $url = 'https://api-jiesuan.yunzhanghu.com/api/payment/v1/query-accounts';
        $data = ['dealer_id' => $this->config['dealer_id']];
        return $this->request($url, $data, 'GET');
    }
}