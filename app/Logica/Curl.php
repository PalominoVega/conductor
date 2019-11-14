<?php
namespace App\Logica;

class Curl {

    public static function get($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Accept: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $resultA = curl_exec($ch);
        curl_close($ch);
        return json_decode($resultA,true);
    }
}
