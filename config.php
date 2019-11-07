<?php


return [

    //云账户key(云账户提供)
    'app_key' => '',

    //DES加密串(云账户提供)
    'des3_key' => '',

    //商户代码(云账户提供)
    'dealer_id' => '',

    //代征主体(云账户提供)
    'broker_id' => '',

    //回调地址
    'notify_url' => '',

    //微信红包
    'wx_app_id' => '',

    //请求服务器
    'host' => 'https://api-jiesuan.yunzhanghu.com',

    //云账户接口地址
    'url' => [

        //转账到银行卡
        'card' => '',

        //转账到支付宝
        'alipay' => '',

        //转账到微信
        'wxpay' => '/api/payment/v1/order-wxpay',

        //查询订单
        'query' => '/api/payment/v1/query-realtime-order',

        //查询云账户余额
        'accounts' => '/api/payment/v1/query-accounts',
    ],
];