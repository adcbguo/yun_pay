# thinkPHP 云账户SDK 组件

## 安装方式
```
composer require adcbguo/yun_pay
```

## 配置文件
```   
把配置文件 yun_pay\config.php 复制到项目的对应文件
```

## 使用方式
```
// 转账到银行卡
Order::make($config)->realtime(string $order_id, string $real_name, string $card_no, string $id_card, string $pay, string $phone_no = '', string $pay_remark = '');

// 转账到支付宝账户
Order::make($config)->alipay(string $order_id, string $real_name, string $id_card, string $card_no, string $pay, string $pay_remark = '');
    
// 发微信红包
Order::make($config)->wxpay(string $order_id, string $real_name, string $id_card, string $openid, string $pay, string $notes = '', string $pay_remark = '');

// 查询一条转账
Query::make($config)->one(string $order_id, string $channel = '银⾏卡');

// 查询云账户余额
Query::make($config)->accounts();
```