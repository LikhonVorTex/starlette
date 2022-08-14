<?php

/*

///==[Stripe SK Key Checker Commands]==///

/key sk_live - Checks the SK Key

*/


include __DIR__."/../config/config.php";
include __DIR__."/../config/variables.php";
include_once __DIR__."/../functions/bot.php";
include_once __DIR__."/../functions/db.php";
include_once __DIR__ . "/../functions/functions.php";


////////////====[MUTE]====////////////
if(strpos($message, "/tok ") === 0 || strpos($message, "!tok ") === 0 || strpos($message, ".tok ") === 0){
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
        $messageidtoedit1 = bot('sendmessage',[
          'chat_id'=>$chat_id,
          'text'=>"<b>Wait for Result...</b>",
          'parse_mode'=>'html',
          'reply_to_message_id'=> $message_id

        ]);

        $messageidtoedit = capture(json_encode($messageidtoedit1), '"message_id":', ',');
        $tok = substr($message, 4);
        
        if(preg_match_all("/ey[A-Za-z0-9]+/", $tok, $matches)) {
            $tok = $matches[0][0];
            $tokhidden = substr_replace($tok, '',12).preg_replace("/(?!^).(?!$)/", "*", substr($tok, 12));

            $extracted_data = base64_decode($tok);
//            header('Content-Type: application/json');
//            $json_ugly = $extracted_data;
//            $json_pretty = json_encode(json_decode($json_ugly), JSON_PRETTY_PRINT);
            $data = json_decode($extracted_data, true);
            $authorizationFingerprint = $data['authorizationFingerprint'];
            $_3Ds3x = ucfirst(json_encode($data['threeDSecureEnabled']));
            $merchantID = $data['merchantAccountId'];
             $challenges = substr(json_encode($data['challenges']),1,-1);
            $time = rand(10,30);
            if(isset($merchantID)) {
              bot('editMessageText',[
                'chat_id'=>$chat_id,
                'message_id'=>$messageidtoedit,
                'text'=>"<b>Merchant Info</b>
<b>Status</b> -» Live ✅
Merchant ID -» <b>$merchantID</b>
3DS Verification -» <b>$_3Ds3x</b>
Authorisation Challenge -» <b>$challenges</b>
Time -» <b>$time</b><b>s</b>

<b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>",
                'parse_mode'=>'html',
                'disable_web_page_preview'=>'true'
                
            ]);}
            else{
              bot('editMessageText',[
                'chat_id'=>$chat_id,
                'message_id'=>$messageidtoedit,
                'text'=>"<b>SK Key:</b> <code>$tokhidden</code>
<b>Status -» Failed ❌
Info -» Provided Client Token is Incorrect or the merchant account is restricted by the gateway.
>>>Please Try Again and make sure your provided token is correct.<<<
Time -» <b>$time</b><b>s</b></b>

<b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>",
                'parse_mode'=>'html',
                'disable_web_page_preview'=>'true'
                
            ]);}
          
        }else{
          bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"<b>Please provide an valid braintree client token.</b>",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            
        ]);

        }
    }
}


