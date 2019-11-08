<?php

namespace yun\lib;

/**
 * DES3加解密类
 * @package yun
 */
class Des {

    /**
     * 加密
     * @param string $key
     * @param array $data
     * @param string $method
     * @return string
     */
    public static function encrypt(string $key, array $data, $method = 'DES-EDE3-CBC') {
        $iv = substr($key, 0, 8);
        return openssl_encrypt(json_encode($data), $method, $key, 0, $iv);
    }

    /**
     * 解密
     * @param string $key
     * @param string $value
     * @param string $method
     * @return array
     */
    public static function decrypt(string $key, string $value, $method = 'DES-EDE3-CBC') {
        $iv = substr($key, 0, 8);
        return json_decode(openssl_decrypt($value, $method, $key, 0, $iv));
    }
}