<?php

namespace App\Orangebd;

class Encrypt
{
    private $secretKey = '2ED04EFDEACCA5146E125DEE7F74C8E9';

    public function encrypt($data){
        for(;;) {
            $encryption_key = base64_decode($this->secretKey);
            $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
            $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
            $enc = base64_encode($encrypted . '::' . $iv);
            if (strpos($enc, '+') === false)
                break;
        }
        return $enc;
    }

    public function decrypt($data) {
        try {
            $encryption_key = base64_decode($this->secretKey);
            list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
            return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
        }catch (\Exception $ex){
            return '';
        }
    }
}