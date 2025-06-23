<?php

header("Content-Type: text/html; charset=utf-8");

$filename = dirname(__FILE__)."/payPublicKey.pem";//生成的公钥或私钥文件

@chmod($filename, 0777);
@unlink($filename);

$devPubKey = "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA07Wmpi4tqOWM+1NO2+Kk6RQIj/tP9Lfenrupdp48CmK616pgkKD8h8/vFWag+c60LO9x95iC2duKNG2dF8alqpvQjoVKlhjQOR7PtULXyb2setzM2PDbTie5qc8rq9oXpk0a8DnauP2Cp9FFvcONKLQj9JknyyXu1QM9olMjv/+DfyZKUze12HYty5PL1H/yur/UwGZwR0pBtakUMVuE7jGzV3yvNbtPpVu6qaUP6GBvs3V3B/2FhJ+eiTFszmsHuk42DXWCZC4WqVYJjJLiPb2+JKETYDsLYZQ3r7YxwxrdftwaiMAAg93BUO2UnOdBRSbphiUDfB0FxkrptNE5JQIDAQAB";//公钥或私钥


$begin_public_key = "-----BEGIN RSA PRIVATE KEY-----\r\n";  //-----BEGIN PRIVATE KEY-----
$end_public_key = "-----END RSA PRIVATE KEY-----\r\n";  //-----END PRIVATE KEY-----

$fp = fopen($filename,'ab');
fwrite($fp,$begin_public_key,strlen($begin_public_key));
$raw = strlen($devPubKey)/64;
$index = 0;
while($index <= $raw ) {
    $line = substr($devPubKey,$index*64,64)."\r\n";
    if(strlen(trim($line)) > 0)
        fwrite($fp,$line,strlen($line));
    $index++;
}
fwrite($fp,$end_public_key,strlen($end_public_key));
fclose($fp);
?>