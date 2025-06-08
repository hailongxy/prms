<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/13
 * Time: 10:30
 */
$priKey = file_get_contents('./payPublicKey.pem');
$res = openssl_get_privatekey($priKey);
($res) or die('您使用的私钥格式错误，请检查RSA私钥配置234');
