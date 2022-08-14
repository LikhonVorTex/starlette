<?php

include __DIR__."/../config/config.php";
include_once __DIR__."/../functions/bot.php";
include("countries.php");
include("flag.php");
require __DIR__."/../vendor/autoload.php";

use DivineOmega\Countries\Countries;



function capture($string, $start, $end)
{
    $str = explode($start, $string);
    $str = explode($end, $str[1]);
    return $str[0];
}

function logsummary($summary){
    global $config;
    bot('sendmessage',[
        'chat_id'=>$config['logsID'],
        'text'=>$summary,
        'parse_mode'=>'html'

    ]);
}
function solveCaptcha($site,$siteKey,$clientKey){
    $createTask =  cURLc(
        "https://api.capmonster.cloud/createTask",
        $headers = [
            "Content-Type: application/json",
            "accept: application/json"
        ],
        '{"clientKey":"'.$clientKey.'","task":{"type":"NoCaptchaTaskProxyless","websiteURL":"'.$site.'","websiteKey":"'.$siteKey.'"}}',
        "POST"
    );
    $taskId = getstr(json_encode($createTask,true),'"taskId\":','}');
    $status = "processing";
    $gResponse = "";
    while ($status == "processing") {
        sleep(3);
        $getTaskResult =  cURLc(
            "https://api.capmonster.cloud/getTaskResult ",
            $headers = [
                "Content-Type: application/json",
                "accept: application/json"
            ],
            '{"clientKey":"'.$clientKey.'","taskId": '.$taskId.'}',
            "POST"
        );
        $status = getstr($getTaskResult,'"status":"','"');
        $gResponse = getstr($getTaskResult,'"gRecaptchaResponse":"','"');}
    return $getTaskResult ;
}
function GetStr($string, $start, $end){
    $str = explode($start, $string);
    $str = explode($end, $str[1]);
    return $str[0];
}

//function palaman($from_id, $chat_id, $target_chat_id){
//    global $config;
//    if($config['allowed_copy_logs'] == true){
//        bot('copyMessage',[
//            'chat_id'=>$from_id,
//            'from_chat_id'=>$chat_id,
//            'message_id'=>$target_chat_id]);
//        return "copy successful";
//    }else{
//        return "not allowed";
//    }
//}

function RandomString($length = 16)
{
    $characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString     = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function random_info(){
    // $randomShits = file_get_contents('https://namegenerator.in/assets/refresh.php?location=united-states');
    // $data = json_decode($randomShits, true);
    // $fname = explode(" ", $data['name'])[0];
    // $lname = explode(" ", $data['name'])[1];
    // $email = $data['email']['address'];
    // $street = $data['street1'];
    // $local = GetStr($randomShits, '"street2":', ',"phone"');
    // $city = GetStr($local, '"', ',');
    // $state = GetStr($local, ', ', ' ');
    // $phone = str_replace("-", "", $data['phone']);
    // $postcode = GetStr($local, "$state", '"');

     // $randomShits = file_get_contents('https://namegenerator.in/assets/refresh.php?location=united-states');
                // $data = json_decode($randomShits, true);
                $str = substr(randomString(), 0,7);
                $fname = $str ;
                $lname =  $str ;
                $email =  $str ."@gmail.com";
                $street =  $str ;
                $local =  $str ;
                $city = $str ;
                $state = "CA" ;
              //  $phone = str_replace("-", "", $data['phone']);
                $postcode = rand(91000,93000);
    $info = json_encode(array("fname" => "$fname", "lname" => "$lname", "email" => "$email", "street" => "$street", "city" => "$city", "state" => "$state", "phone" => "$phone", "postcode" => "$postcode"));
    return $info;
}

function fbanklist($ccbins)
{

    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => "https://lookup.binlist.net/$ccbins",
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_FOLLOWLOCATION => 1,
        CURLOPT_HEADER => 1,
        CURLOPT_HTTPHEADER => [
            'Host: lookup.binlist.net',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36',
            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
        ],
        CURLOPT_POSTFIELDS => ""
    ));
    $g_ccdets = curl_exec($ch);
    $cc_bname = GetStr($g_ccdets, '"bank":{"name":"', '"');
    $cc_country = GetStr($g_ccdets, '"name":"', '"');
    $abn = GetStr($g_ccdets, '"country":{"name":"', '"');
    $cc_vendor = GetStr($g_ccdets, '"scheme":"', '"');
    $cc_level = capture($g_ccdets, '"brand":"', '"');
    $cc_type = GetStr($g_ccdets, '"type":"', '"');
    $cc_emoji = GetStr($g_ccdets, '"emoji":"', '"');
    $cc_vendor = ucfirst("$cc_vendor");
    $cc_type = ucfirst("$cc_type");
    curl_close($ch);
    return json_encode(array("BIN" => "$ccbins", "Bank" => "$cc_bname", "Vendor" => "$cc_vendor", "Bank_Info" => "$cc_type - $cc_level", "Country" => "$cc_country", "Abn" => "$abn", "emoji" => "$cc_emoji"));

}

function fbankinfo($ccbins)
{
    $countries = new Countries;
    $emoji = new functions\flag\emo_flags;
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => 'https://app.bluedogpayments.com/api/lookup/bin',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{"type":"tokenizer","type_id":"b1c6da05-2810-4228-bbc2-0fb76c7251d3","bin":"'.$ccbins.'"}',
        CURLOPT_HTTPHEADER => array(
            'accept: application/json, text/plain, */*',
            'authorization: pub_1SL14yV4POKv2BkdtXEXlUPSHph',
            'content-type: application/json',
            'origin: https://app.bluedogpayments.com',
            'referer: https://app.bluedogpayments.com/api/tokenizer/pub_1SL14yV4POKv2BkdtXEXlUPSHph',
            'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.5005.63 Safari/537.36 Edg/102.0.1245.39',
        ),
    ));
    $g_ccdets = curl_exec($ch);

    $cc_bname = GetStr($g_ccdets, '"issuing_bank":"', '"');
    $abn = GetStr($g_ccdets, '"country":"', '"');
    $result = $countries->getByIsoCode($abn);
    $cc_country = json_decode(json_encode($result),true)['name'];
    $isoCodeAlpha2 = json_decode(json_encode($result),true)['isoCodeAlpha2'];
    $cc_emoji = $emoji::emojiFlag($isoCodeAlpha2);
    $cc_vendor = GetStr($g_ccdets, '"card_brand":"', '"');
    $cc_level = GetStr($g_ccdets, '"card_level_generic":"', '"');
    $cc_type = GetStr($g_ccdets, '"card_type":"', '"');
    $cc_vendor = ucfirst("$cc_vendor");
    $cc_type = ucfirst("$cc_type");
    return json_encode(array("BIN" => "$ccbins", "Bank" => "$cc_bname", "Vendor" => "$cc_vendor", "Bank_Info" => "$cc_type - $cc_level", "Country" => "$cc_country", "Abn" => "$abn", "emoji" => "$cc_emoji"));

}
//function fbankinfo($ccbins)
//{
//
//    $ch = curl_init();
//    curl_setopt_array($ch, array(
//        CURLOPT_URL => "https://binov.net/",
//        CURLOPT_RETURNTRANSFER => 1,
//        CURLOPT_FOLLOWLOCATION => 1,
//        CURLOPT_HEADER => 1,
//        CURLOPT_HTTPHEADER => [
//            'Connection: keep-alive',
//            'Pragma: no-cache',
//            'Cache-Control: no-cache',
//            'Upgrade-Insecure-Requests: 1',
//            'Origin: https://binov.net/',
//            'Content-Type: application/x-www-form-urlencoded',
//            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36',
//            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
//            'Referer: http://bins.su/',
//            'Accept-Language: en-US,en;q=0.9'
//        ],
//        CURLOPT_POSTFIELDS => "BIN=$ccbins&COUNTRY=1&BANK=1"
//    ));$g_ccdets = curl_exec($ch);
//
//    try {
//
//        $cc_vendor = GetStr($g_ccdets, "$ccbins</td><td>" , '</td>');
//        $cc_bname = GetStr($g_ccdets, "$cc_vendor</td><td>" , '</td>');
//        $cc_type = GetStr($g_ccdets, "$cc_bname</td><td>" , '</td>');
//        $cc_level = GetStr($g_ccdets, "$cc_type</td><td>" , '</td>');
//        $cc_country = GetStr($g_ccdets, "$cc_level</td><td>" , '</td>');
//        $getabn = new functions\countries\get_abn;
//        $abn = $getabn::get_cntry_abn($cc_country);
//        $emoji = new functions\flag\emo_flags;
//        $cc_emoji = $emoji::emojiFlag($abn);
//        curl_close($ch);
//        if (empty($cc_bname)) {
//            $cc_bname = "-------";
//        }
//        if (empty($cc_emoji)) {
//            $cc_emoji = "◻️";
//        }
//        return json_encode(array("BIN" => "$ccbins", "Bank" => "$cc_bname", "Vendor" => "$cc_vendor", "Bank_Info" => "$cc_type - $cc_level", "Country" => "$cc_country", "Abn" => "$abn", "emoji" => "$cc_emoji"));
//    }catch (exception $err){
//        // $cc_emoji = "◻️";
//        $binlist = json_decode(fbanklist($ccbins),true);
//        $cc_bname = $binlist['Bank'];
//        $cc_vendor = $binlist['Vendor'];
//        $cc_type = $binlist['Bank_Info'];
//        $cc_country = $binlist['Country'];
//        $abn = $binlist['Abn'];
//        $cc_emoji = $binlist['emoji'];
//        if (empty($cc_bname)) {
//            $cc_bname = "-------";
//        }
//        if (empty($cc_emoji)) {
//            $cc_emoji = "◻️";
//        }
//        return json_encode(array("BIN" => "$ccbins", "Bank" => "$cc_bname", "Vendor" => "$cc_vendor", "Bank_Info" => "$cc_type - $cc_level", "Country" => "$cc_country", "Abn" => "$abn", "emoji" => "$cc_emoji"));
//    }
//}

//
//function cURLc($url, $headers, $postfields, $customrequest) {
//
//    $ch = curl_init();
//    curl_setopt_array($ch, array(
//        CURLOPT_URL => $url,
//        CURLOPT_RETURNTRANSFER => 1,
//        CURLOPT_FOLLOWLOCATION => 1,
//        // CURLOPT_SSL_VERIFYPEER => 1,
//        // CURLOPT_SSL_VERIFYHOST => 1,
//        // CURLOPT_COOKIE => "itrack=$cookie",
//        CURLOPT_HEADER => 1,
//        CURLOPT_CUSTOMREQUEST => $customrequest,
//        CURLOPT_COOKIEFILE => getcwd() . "/cookies/$cookie.txt",
//        CURLOPT_COOKIEJAR => getcwd() . "/cookies/$cookie.txt",
//        CURLOPT_HTTPHEADER => $headers,
//        CURLOPT_POSTFIELDS => $postfields
//    ));
//    $response = curl_exec($ch);
//    curl_close($ch);
//
//    return $response;
//}

function cURL($url, $headers, $postfields, $customrequest, $_fls, $cookie) {

    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_FOLLOWLOCATION => $_fls,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_COOKIE => "itrack=$cookie",
        CURLOPT_HEADER => 0,
        CURLOPT_CUSTOMREQUEST => $customrequest,
        CURLOPT_COOKIEFILE => getcwd() . "/cookies/$cookie.txt",
        CURLOPT_COOKIEJAR => getcwd() . "/cookies/$cookie.txt",
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_POSTFIELDS => $postfields
    ));
    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}
//$ips = file_get_contents("https://magic.bins.ngrok.io/io.php/");
function cURL_ProxyOn($url, $headers, $postfields, $customrequest, $_fls, $cookie) {

    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_FOLLOWLOCATION => $_fls,
        // CURLOPT_PROXY => "http://scraperapi.session_number=$port.ultra_premium=true.country_code=uk:f73965b26e9d8457634c8b1597c0e6da@proxy-server.scraperapi.com:8001/",
      //  CURLOPT_PROXY => "$ips",
        CURLOPT_PROXY => "isp2.hydraproxy.com:9989",
        CURLOPT_PROXYUSERPWD => "grea31455bghb77263:aX7spy7kmrU5D53c",
        CURLOPT_HEADER => 1,
        CURLOPT_COOKIE => "itrack=$cookie",
        CURLOPT_CUSTOMREQUEST => $customrequest,
        CURLOPT_COOKIEFILE => getcwd() . "/cookies/$cookie.txt",
        CURLOPT_COOKIEJAR => getcwd() . "/cookies/$cookie.txt",
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_POSTFIELDS => $postfields
    ));
    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}
function add_days($timestamp,$days){
    $future = $timestamp + (60*60*24*str_replace('d','',$days));
    return $future;
}

function add_minutes($timestamp,$minutes){
    $future = $timestamp + (60*str_replace('m','',$minutes));
    return $future;
}

function multiexplode($delimiters, $string){
    $one = str_replace($delimiters, $delimiters[0], $string);
    $two = explode($delimiters[0], $one);
    return $two;
}

function array_in_string($str, array $arr) {
    foreach($arr as $arr_value) {
        if (stripos($str,$arr_value) !== false) return true;
    }
    return false;
}
function clearCookie($xcookie){
    unlink(getcwd() . "/cookies/$xcookie.txt");
}

?>