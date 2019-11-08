# 云账户SDK组件

## 安装方式
```
composer require adcbguo/yun_pay
```

## 配置文件
```   
把配置文件 yun_pay\config.php 复制到项目的对应文件
```

## 使用方式(参数类型看注释)
```
// 转账到银行卡
Order::make($config)->realtime($order_id,$real_name,$card_no,$id_card,$pay,$phone_no,$pay_remark);

// 转账到支付宝账户
Order::make($config)->alipay($order_id,$real_name,$id_card,$card_no,$pay,$pay_remark);
    
// 发微信红包
Order::make($config)->wxpay($order_id,$real_name,$id_card,$openid,$pay,$notes,$pay_remark);

// 查询一条转账
Query::make($config)->one($order_id,$channel);

// 查询云账户余额
Query::make($config)->accounts();
```