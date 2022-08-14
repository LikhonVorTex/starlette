<?php


include __DIR__."/config/config.php";
include __DIR__."/config/variables.php";
include __DIR__."/functions/bot.php";
include __DIR__."/functions/functions.php";
include __DIR__."/functions/db.php";


date_default_timezone_set($config['timeZone']);


////Modules
include __DIR__."/modules/admin.php";
include __DIR__."/modules/skcheck.php";
include __DIR__."/modules/binlookup.php";
include __DIR__."/modules/iban.php";
include __DIR__."/modules/stats.php";
include __DIR__."/modules/me.php";
include __DIR__."/modules/apikey.php";

//include __DIR__."/modules/checker/as.php";

//include __DIR__."/modules/checker/asx.php";
//include __DIR__."/modules/checker/cn.php";
//include __DIR__."/modules/checker/aa.php";
//include __DIR__."/modules/checker/ccn.php";
//include __DIR__."/modules/checker/ad.php";
include __DIR__."/modules/checker/sn.php";
include __DIR__."/modules/checker/ss.php";
//include __DIR__."/modules/checker/sd.php";
include __DIR__."/modules/checker/st.php";
//include __DIR__."/modules/checker/az.php";
//include __DIR__."/modules/checker/gen.php";
//include __DIR__."/modules/checker/asx.php";
//include __DIR__."/modules/checker/es.php";
//include __DIR__."/modules/checker/aw.php";
//include __DIR__."/modules/checker/chn.php";
//include __DIR__."/modules/checker/chk.php";
//include __DIR__."/modules/checker/ch.php";
//include __DIR__."/modules/checker/encypt.php";
//include __DIR__."/modules/checker/crypto.php";
//include __DIR__."/modules/checker/schk.php";
//include __DIR__."/modules/checker/sm.php";
include __DIR__."/modules/checker/vbv.php";
//include __DIR__."/modules/b3-merch-lookup.php";


//////////////===[START]===//////////////




if(strpos($message, "/start") === 0){
    if(!isBanned($userId) && !isMuted($userId)){

        if($userId == $config['adminID']){
            $messagesec = "<b>Type /admin to know admin commands</b>";
        }

        addUser($userId);
        bot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"<b>Hello @$username,

Select the commands you want to know</b>

$messagesec",
            'parse_mode'=>'html',
            'reply_to_message_id'=> $message_id,
            'reply_markup'=>json_encode(['inline_keyboard' => [
                [['text' => "Checker Commands", 'callback_data' => "Ccs"]],
                [['text' => "Other Commands", 'callback_data' => "Other"]],
            ], 'resize_keyboard' => true])

        ]);
    }
}

//////////////===[CMDS]===//////////////

if($data == "Ccs"){
        bot('editMessageText',[
            'chat_id'=>$callbackchatid,
            'message_id'=>$callbackmessageid,
            'text'=>"<b>Which commands would you like to check?</b>
$messagesec",
            'parse_mode'=>'html',
            'reply_markup'=>json_encode(['inline_keyboard'=>[
                [['text'=>"CCN Checker Gates",'callback_data'=>"CCN"]],
                [['text'=>"CVV Checker Gates",'callback_data'=>"CVV"]],
                [['text'=>"Return",'callback_data'=>"back"]],
            ],'resize_keyboard'=>true])
        ]);
}



if($data == "CVV" || $data == "CCN"){
    bot('editMessageText',[
        'chat_id'=>$callbackchatid,
        'message_id'=>$callbackmessageid,
        'text'=>"<b>$data Checker Gates</b>
$messagesec",
        'parse_mode'=>'html',
        'reply_markup'=>json_encode(['inline_keyboard'=>[
            [['text'=>"Adyen",'callback_data'=>"Adyen"],['text'=>"Stripe",'callback_data'=>"Stripe"]],
            [['text'=>"Braintree",'callback_data'=>"Braintree"],['text'=>"Other",'callback_data'=>"othergates"]],
            [['text'=>"Return",'callback_data'=>"back"]],
        ],'resize_keyboard'=>true])
    ]);
}
if($data == "Stripe" ){
    bot('editMessageText',[
        'chat_id'=>$callbackchatid,
        'message_id'=>$callbackmessageid,
        'text'=>"<b> Stripe Gates

* /ss - Gate1 Info: CVV ✅
* /sn - Gate2 Info: CCN ✅
* /st - Gate3 Info: CVV ✅
* /sd - Gate4 Info: CVV ❌ 
</b>
$messagesec",
        'parse_mode'=>'html',
        'reply_markup'=>json_encode(['inline_keyboard'=>[
            [['text'=>"Return",'callback_data'=>"backs"]]
        ],'resize_keyboard'=>true])
    ]);
}
if($data == "Braintree" || $data == "Adyen" || $data == "othergates" ){
    bot('editMessageText',[
        'chat_id'=>$callbackchatid,
        'message_id'=>$callbackmessageid,
        'text'=>"<b> $data Gates

Coming Soon...
</b>
$messagesec",
        'parse_mode'=>'html',
        'reply_markup'=>json_encode(['inline_keyboard'=>[
            [['text'=>"Return",'callback_data'=>"backs"]]
        ],'resize_keyboard'=>true])
    ]);
}

if($data == "othercmds"){
    bot('editMessageText',[
        'chat_id'=>$callbackchatid,
        'message_id'=>$callbackmessageid,
        'text'=>"<b>Other Commands</b>
  
<b>/me  | !me</b> - Your Info
<b>/vbv | !vbv</b> - 3D Lookup
<b>/key | !key</b> - SK Key Checker
<b>/bin | !bin</b> - Bin Lookup",
        'parse_mode'=>'html',
        'reply_markup'=>json_encode(['inline_keyboard'=>[
            [['text'=>"Return",'callback_data'=>"back"]]
        ],'resize_keyboard'=>true])
    ]);
}
if($data == "backs"){
    bot('editMessageText',[
        'chat_id'=>$callbackchatid,
        'message_id'=>$callbackmessageid,
        'text'=>"<b>Which commands would you like to check?</b>
$messagesec",
        'parse_mode'=>'html',
        'reply_markup'=>json_encode(['inline_keyboard'=>[
            [['text'=>"CCN Checker Gates",'callback_data'=>"CCN"]],
            [['text'=>"CVV Checker Gates",'callback_data'=>"CVV"]],
        ],'resize_keyboard'=>true])
    ]);
}
if($data == "back"){
    bot('editMessageText',[
        'chat_id'=>$callbackchatid,
        'message_id'=>$callbackmessageid,
        'text'=>"<b>Which other commands would you like to check?</b>
$messagesec",
        'parse_mode'=>'html',
        'reply_markup'=>json_encode(['inline_keyboard'=>[
            [['text' => "Checker Commands", 'callback_data' => "Ccs"]],
            [['text' => "Other Commands", 'callback_data' => "Other"]],
        ],'resize_keyboard'=>true])
    ]);
}

if($data == "Other"){
    bot('editMessageText',[
        'chat_id'=>$callbackchatid,
        'message_id'=>$callbackmessageid,
        'text'=>"<b>Which other commands would you like to check?</b>",
        'parse_mode'=>'html',
        'reply_markup'=>json_encode(['inline_keyboard'=>[
            [['text'=>"CC Checker registration",'callback_data'=>"regbeta"]],
            [['text'=>"Bot info",'callback_data'=>"botinfo"]],
            [['text'=>"Return",'callback_data'=>"back"]]
        ],'resize_keyboard'=>true])
    ]);
}
//////////////===[CMDS]===//////////////
if($data == "regbeta"){
    bot('editMessageText',[
        'chat_id'=>$callbackchatid,
        'message_id'=>$callbackmessageid,
        'text'=>"<b>Do you want to register account as a software beta tester?

you can use this account until prior notice.</b>",
        'parse_mode'=>'html',
        'reply_to_message_id'=> $message_id,
        'reply_markup'=>json_encode(['inline_keyboard'=>[
            [['text'=>"✅ I agree",'callback_data'=>"agree"]],[['text'=>"❌ Disagree",'callback_data'=>"disagree"]],
        ],'resize_keyboard'=>true])
    ]);
}
if(strpos($message, "/regbeta") === 0 || strpos($message, "!regbeta" ) === 0){
    bot('sendmessage',[
        'chat_id'=>$chat_id,
        'text'=>"<b>Do you want to register account as a software beta tester?

you can use this account until prior notice.</b>",
        'parse_mode'=>'html',
        'reply_to_message_id'=> $message_id,
        'reply_markup'=>json_encode(['inline_keyboard'=>[
            [['text'=>"✅ I agree",'callback_data'=>"agree"]],[['text'=>"❌ Disagree",'callback_data'=>"disagree"]],
        ],'resize_keyboard'=>true])
    ]);
}
if($data == "disagree"){
    bot('editMessageText',[
        'chat_id'=>$callbackchatid,
        'message_id'=>$callbackmessageid,
        'text'=>"<b>I respect your decisiun.
thank for your time here and have a good day !</b>",
        'parse_mode'=>'html',
       'resize_keyboard'=>true]);
}

if($data == "agree"){
    $pass = RandomString(12);
    $isalreadyreg = fetchcredentials($callbackchatid);
    if ($isalreadyreg !== false){
        $mtxt = "You already beta test registered !";
        $pass = $isalreadyreg["passwd"];
    } else {
        $mtxt = "You are now registered to beta test user!";

    }
    $postreg = regbeta($callbackchatid,$pass);
    if ($postreg == true){
    bot('editMessageText', [
        'chat_id' => $callbackchatid,
        'message_id' => $callbackmessageid,
        'text' => "<b>$mtxt 
username: $callbackchatid
password: $pass</b>
$messagesec",
        'parse_mode' => 'html',
        'reply_markup'=>json_encode(['inline_keyboard'=>[
            [['text' => "Checker Link", 'URL' => "https://docugs.ngrok.io/productions/beta_cc/index.php"]],
        ],'resize_keyboard'=>true])
    ]);
    }else{
        bot('editMessageText', [
            'chat_id' => $callbackchatid,
            'message_id' => $callbackmessageid,
            'text' => "<b>ERROR WHILE REGISTERING... YOU CAN TRY AGAIN,,,</b>",
            'parse_mode' => 'html',
            'resize_keyboard' => true]);
    }
}


?>