<?php

namespace yun;

use yun\lib\Pay;

/**
 * 下单类
 * @package yun
 */
class Order extends Pay {

    /**
     * 银行卡下单
     * @param string $order_id 商户订单号，由商户保持唯⼀性(必填)，64个英⽂字符以内
     * @param string $real_name 姓名(必填)
     * @param string $card_no 银⾏开户卡号(必填)
     * @param string $id_card 银⾏开户身份证号(必填)
     * @param string $pay 打款⾦额(单位为元, 必填)
     * @param string $phone_no ⽤户或联系⼈⼿机号(选填)
     * @param string $pay_remark 打款备注(选填，最⼤20个字符，⼀个汉字占2个字符，不允许特殊字符：' " & | @ % * ( ) - : # ￥)
     * @return array
     * @throws \ErrorException
     */
    public function realtime(string $order_id, string $real_name, string $card_no, string $id_card, string $pay, string $phone_no = '', string $pay_remark = '') {
        $url = 'https://api-jiesuan.yunzhanghu.com/api/payment/v1/order-realtime';
        $data = [
            'order_id' => $order_id,
            'dealer_id' => $this->config['dealer_id'],
            'broker_id' => $this->config['broker_id'],
            'real_name' => $real_name,
            'card_no' => $card_no,
            'phone_no' => $phone_no,
            'id_card' => $id_card,
            'pay' => $pay,
            'pay_remark' => $pay_remark,
            'notify_url' => $this->config['notify_url']
        ];
        return $this->request($url, $data);
    }

    /**
     * 支付宝下单
     * @param string $order_id 商户订单号，由商户保持唯⼀性(必填)，64个英⽂字符以内
     * @param string $real_name 姓名(必填)
     * @param string $id_card 身份证(必填)
     * @param string $card_no 收款⼈⽀付宝账户(必填)
     * @param string $pay 打款⾦额（单位为元, 必填）
     * @param string $pay_remark 打款备注(选填，最⼤20个字符，⼀个汉字占2个字符，不允许特殊字符：' " & | @ % * ( ) - : # ￥)
     * @return array
     * @throws \ErrorException
     */
    public function alipay(string $order_id, string $real_name, string $id_card, string $card_no, string $pay, string $pay_remark = '') {
        $url = 'https://api-jiesuan.yunzhanghu.com/api/payment/v1/order-alipay';
        $data = [
            'order_id' => $order_id,
            'dealer_id' => $this->config['dealer_id'],
            'broker_id' => $this->config['broker_id'],
            'real_name' => $real_name,
            'id_card' => $id_card,
            'card_no' => $card_no,
            'pay' => $pay,
            'pay_remark' => $pay_remark,
            'check_name' => 'Check',
            'notify_url' => $this->config['notify_url']
        ];
        return $this->request($url, $data);
    }

    /**
     * 微信下单
     * @param string $order_id 商户订单号，由商户保持唯⼀性(必填)，64个英⽂字符以内
     * @param string $real_name 姓名(必填)
     * @param string $id_card 身份证(必填)
     * @param string $openid 商户AppID下，某⽤户的openid(必填)
     * @param string $pay 打款⾦额（单位为元）(必填)
     * @param string $notes 描述信息(选填)
     * @param string $pay_remark 打款备注(选填，最⼤20个字符，⼀个汉字占2个字符，不允许特殊字符：' " & | @ % * ( ) - : # ￥)
     * @return array
     * @throws \ErrorException
     */
    public function wxpay(string $order_id, string $real_name, string $id_card, string $openid, string $pay, string $notes = '', string $pay_remark = '') {
        $url = 'https://api-jiesuan.yunzhanghu.com/api/payment/v1/order-wxpay';
        $data = [
            'order_id' => $order_id,
            'dealer_id' => $this->config['dealer_id'],
            'broker_id' => $this->config['broker_id'],
            'real_name' => $real_name,
            'id_card' => $id_card,
            'openid' => $openid,
            'pay' => $pay,
            'notes' => $notes,
            'pay_remark' => $pay_remark,
            'notify_url' => $this->config['notify_url'],
            'wx_app_id' => $this->config['wx_app_id'],
            'wxpay_mode' => 'redpacket',
        ];
        return $this->request($url, $data);
    }
}