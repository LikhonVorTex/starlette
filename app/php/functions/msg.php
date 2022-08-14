<?php


$dir = dirname(__dir__);
include($dir."/config/config.php");
include($dir."/config/variables.php");
include_once($dir."/functions/bot.php");
include_once($dir."/functions/db.php");
include_once($dir."/functions/functions.php");



class messages
{
public static function live_check($bin,$gate,$checktype,$lista,$respo,$dcode,$time,$chat_id,$messageid,$userid,$username){
    $binlist = json_decode(fbankinfo($bin), true);
    $ccbank = $binlist['Bank'];
    $ccvendor = $binlist['Vendor'];
    $cctype = $binlist['Bank_Info'];
    $cc_country = $binlist['Country'];
    $abn = $binlist['Abn'];
    $cc_emoji = $binlist['emoji'];
    addTotal();
    addUserTotal($userId);
    addCVV();
    addUserCVV($userId);
    addCCN();
    addUserCCN($userId);
    bot('editMessageText', [
        'chat_id' => $chat_id,
        'message_id' => $messageid,
        'text' => "<b>APPROVED ✅
<b>Card -»</b> <code>$lista</code>
Response -» $respo [Auth Code: $dcode]
Type -» $checktype 
Gateway -» $gate
Time -» <b>$time</b><b>s</b>
------- Bin Info -------</b>
<b>Bank -»</b> $ccbank
<b>Brand -»</b> $ccvendor
<b>Type -»</b> $cctype
<b>Country -»</b> $cc_country($abn) $cc_emoji 
<b>----------------------------</b>

<b>Checked By <a href='tg://user?id=$userid'>$username</a></b>",
        'parse_mode' => 'html',
        'disable_web_page_preview' => 'true']);
    return "Success";
//    copyLogs("@payamansoyccn",$chat_id,$messageid);
}


    public static function dead_check($bin,$gate,$checktype,$lista,$respo,$dcode,$time,$chat_id,$messageid,$userid,$username){
        $binlist = json_decode(fbankinfo($bin), true);
        $ccbank = $binlist['Bank'];
        $ccvendor = $binlist['Vendor'];
        $cctype = $binlist['Bank_Info'];
        $cc_country = $binlist['Country'];
        $abn = $binlist['Abn'];
        $cc_emoji = $binlist['emoji'];
        addTotal();
        addUserTotal($userId);
        addCVV();
        addUserCVV($userId);
        addCCN();
        addUserCCN($userId);
        bot('editMessageText', [
            'chat_id' => $chat_id,
            'message_id' => $messageid,
            'text' => "<b>DECLINED ❌
<b>Card -»</b> <code>$lista</code>
Response -» $respo ($dcode)
Type -» $checktype 
Gateway -» $gate
Time -» <b>$time</b><b>s</b>
------- Bin Info -------</b>
<b>Bank -»</b> $ccbank
<b>Brand -»</b> $ccvendor
<b>Type -»</b> $cctype
<b>Country -»</b> $cc_country($abn) $cc_emoji 
<b>----------------------------</b>

<b>Checked By <a href='tg://user?id=$userid'>$username</a></b>",
            'parse_mode' => 'html',
            'disable_web_page_preview' => 'true']);

        return "Success";

    }
    public static  function error_check($gate,$lista,$respo,$time,$chat_id,$messageid,$userid,$username){
        addTotal();
        addUserTotal($userId);
        addCVV();
        addUserCVV($userId);
        addCCN();
        addUserCCN($userId);
        bot('editMessageText', [
            'chat_id' => $chat_id,
            'message_id' => $messageid,
            'text' => "<b>ERROR ❌
<b>Card -»</b> <code>$lista</code>
Response -» $respo 
Gateway -» $gate
Time -» <b>$time</b><b>s</b>
<b>----------------------------</b>

<b>Checked By <a href='tg://user?id=$userid'>$username</a></b>",
            'parse_mode' => 'html',
            'disable_web_page_preview' => 'true']);

        return "Success";

    }

}