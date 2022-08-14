<?php

/*

///==[Stripe CC Checker Commands]==///

/ss creditcard - Checks the Credit Card

*/

$gateway = "Braintree Auth";
$check_type = "CVV";
$dir = dirname(__dir__,2);
include($dir."/config/config.php");
include($dir."/config/variables.php");
include_once($dir."/functions/bot.php");
include_once($dir."/functions/db.php");
include_once($dir."/functions/functions.php");
////////////====[MUTE]====////////////
$time_start = microtime(true);

if(strpos($message, "/az ") === 0 || strpos($message, "!az ") === 0 || strpos($message, ".az ") === 0){

//
//    $trans_completed = false;
//    $tries = 0;
//    $limit = 1;
//    while ($trans_completed == false && $tries < $limit) {
//        $tries = $tries + 1;
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
            $lista = substr($message, 3);


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
                $binlist = json_decode(fbankinfo($bin), true);
                $ccbank = $binlist['Bank'];
                $ccvendor = $binlist['Vendor'];
                $cctype = $binlist['Bank_Info'];
                $cc_country = $binlist['Country'];
                $abn = $binlist['Abn'];
                $cc_emoji = $binlist['emoji'];
                ###CHECKER PART###

                $Amount = 0.8;
                $str = substr(RandomString(), 0, 7);
                $cookie = RandomString();
                /////////////////////==========[Unavailable if empty]==========////////////////

                $req = file_get_contents("http://localhost/doc-bot/modules/checker/gapi/ap01.php?lista=$creditcard");
                $response = GetStr($req, "Response: '", "'");
                $dcode = GetStr($req, "Reason: '", "'");

                $time = number_format(microtime(true) - $time_start, 2);
                if (strpos($req, 'Approved')){
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
Response -» $response - $dcode
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

                } else {
                    addTotal();
                    addUserTotal($userId);
                    bot('editMessageText', [
                        'chat_id' => $chat_id,
                        'message_id' => $messageidtoedit,
                        'text' => "<b>Refused ❌
<b>Card -»</b> <code>$lista</code>
Response -» $response - $dcode
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

                    ]);
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

?>
