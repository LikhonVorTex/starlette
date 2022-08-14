<?php



/*

///==[Stripe CC Checker Commands]==///

/ss creditcard - Checks the Credit Card

*/

$gateway = "Coingecko";
$check_type = "Crypto Tools";
$dir = dirname(__dir__,2);
include __DIR__."/../config/config.php";
include __DIR__."/../config/variables.php";
include_once __DIR__."/../functions/bot.php";
include_once __DIR__."/../functions/db.php";
include_once __DIR__."/../functions/functions.php";
include("payway_error_codes.php");
$time_start = microtime(true);
use Codenixsv\CoinGeckoApi\CoinGeckoClient;
////////////====[MUTE]====////////////
if(strpos($message, "/price") === 0 || strpos($message, "!price") === 0){
    $antispam = antispamCheck($userId);
    addUser($userId);

    if($antispam != False){
        bot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"[<u>ANTI SPAM</u>] Try again after <b>$antispam</b>s.",
            'parse_mode'=>'html',
            'reply_to_message_id'=> $message_id
        ]);
        return;

    }else{
        $messageidtoedit1 = bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => "<b>Wait for result...</b>",
            'parse_mode' => 'html',
            'reply_to_message_id' => $message_id

        ]);

        $messageidtoedit = capture(json_encode($messageidtoedit1), '"message_id":', ',');

        $lista = substr($message, 6);
        $currValue1 = multiexplode(array(":", "|",  " "), $lista)[0];
        $curr1 = multiexplode(array(":", "|", " "), $lista)[1];
        $curr2 = multiexplode(array(":", "|", " "), $lista)[2];

        $client = new CoinGeckoClient();
        $data = $client->simple()->getPrice('0x,bitcoin', $curr2);
        $result = GetStr(json_encode($data,true),"Array (",")");

        bot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"≡ <b>Crypto Price</b>
- <ins>$result</ins>

Source: Coingecko",
            'parse_mode'=>'html',
            'reply_to_message_id'=> $message_id

        ]);

    }

}