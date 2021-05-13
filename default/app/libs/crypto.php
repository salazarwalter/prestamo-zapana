<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Crypto
 *
 * @author salazarwalter
 */
class Crypto {
    private static $myKey = '9ozx#Wc%7rZ6jb20.125';
    private static $myIV = 'A2@u+467asl(';
    private static $encrypt_method = 'AES-256-CBC';    
    
    public static function e($string=false) {
        $output = false;
        $secret_key = hash('sha256',Crypto::$myKey);
        $secret_iv = substr(hash('sha256',Crypto::$myIV),0,16);
        if ( $string )
        {
            $string = trim(strval($string));
            $output = openssl_encrypt($string, Crypto::$encrypt_method, $secret_key, 0, $secret_iv);
            $output = str_replace("/", "-", $output);
        }
        return base64_encode($output);
    }
    public static function eBase64($data) {
        $ret = base64_encode($data);
        
        return $ret;
    }
    
    public static function d($string=false) {
        $output = false;
        
        $secret_key = hash('sha256', Crypto::$myKey);
        $secret_iv = substr(hash('sha256',Crypto::$myIV),0,16);

        if ($string )
        {   $string = base64_decode($string);
            $string = trim(strval($string));
            $string = str_replace("-", "/", $string);
            $output = openssl_decrypt($string, Crypto::$encrypt_method, $secret_key, 0, $secret_iv);
        };
    return $output;
    }
    
    public static function dBase64($data) {
        $ret = base64_decode($data);
        return $ret;
    }
    /************************************************************************************/
    
public static $permitted_chars = 'Yz0123456Mm78abcdefghijklnopqrstuvwxzABCDEFGHIJKLN9OPQRSTUVWXZ';
 
public static function generate_string( $strength = 16) {
    $input_length = strlen(Crypto::$permitted_chars);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = Crypto::$permitted_chars[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
    return $random_string;
}    
}
