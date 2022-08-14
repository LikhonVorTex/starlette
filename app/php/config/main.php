<?php


include __DIR__."config/config.php";
include __DIR__."config/variables.php";
include __DIR__."functions/bot.php";
include __DIR__."functions/functions.php";
include __DIR__."functions/db.php";


date_default_timezone_set($config['timeZone']);


////Modules
//include __DIR__."/modules/admin.php";
//include __DIR__."/modules/skcheck.php";
//include __DIR__."/modules/binlookup.php";
//include __DIR__."/modules/iban.php";
//include __DIR__."/modules/stats.php";
//include __DIR__."/modules/me.php";
//include __DIR__."/modules/apikey.php";

//include __DIR__."modules/checker/ccn.php";
//include __DIR__."/modules/checker/ss.php";
//include __DIR__."/modules/checker/schk.php";
//include __DIR__."/modules/checker/sm.php";



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
        [
          ['text' => "Checker Commands", 'callback_data' => "cmds"]
        ],
        [
          ['text' => "Other Commands", 'callback_data' => "Other"]
        ],
      ], 'resize_keyboard' => true])
        
    ]);
  }
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
        ],'resize_keyboard'=>true])
    ]);
}
//////////////===[CMDS]===//////////////

if(strpos($message, "/cmds") === 0 || strpos($message, "!cmds") === 0 || ($data == "cmds")){

  if(!isBanned($userId) && !isMuted($userId)){
    bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"<b>Which commands would you like to check?</b>",
    'parse_mode'=>'html',
    'reply_to_message_id'=> $message_id,
    'reply_markup'=>json_encode(['inline_keyboard'=>[
    [['text'=>"CCN Checker Gates",'callback_data'=>"CCN"]],
    [['text'=>"CVV Checker Gates",'callback_data'=>"CVV"]],
    ],'resize_keyboard'=>true])
    ]);
  }
  
  }
  
  if($data == "back"){
    bot('editMessageText',[
    'chat_id'=>$callbackchatid,
    'message_id'=>$callbackmessageid,
    'text'=>"<b>Which other commands would you like to check?</b>",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode(['inline_keyboard'=>[
        [['text'=>"CC Checker registration",'callback_data'=>"regbeta"]],
        [['text'=>"Bot info",'callback_data'=>"botinfo"]],
    ],'resize_keyboard'=>true])
    ]);
  }
  
  if($data == "CVV" || $data == "CCN"){
    bot('editMessageText',[
    'chat_id'=>$callbackchatid,
    'message_id'=>$callbackmessageid,
    'text'=>"<b>$data Checker Gates</b>",
    'parse_mode'=>'html',
    'disable_web_page_preview'=>true,
    'reply_markup'=>json_encode(['inline_keyboard'=>[
        [['text'=>"Adyen",'callback_data'=>"Adyen"],['text'=>"Stripe",'callback_data'=>"Stripe"]],
        [['text'=>"Braintree Checker Gates",'callback_data'=>"Braintree"],['text'=>"Other",'callback_data'=>"othercmds"]],
  ],'resize_keyboard'=>true])
  ]);
  }
if($data == "Stripe" ){
    bot('editMessageText',[
        'chat_id'=>$callbackchatid,
        'message_id'=>$callbackmessageid,
        'text'=>"<b> Stripe Gates

* /ss - Gate1 Info:
* /sn - Gate2 Info:
* /st - Gate3 Info:
* /sd - Gate4 Info:
</b>",
        'parse_mode'=>'html',
        'disable_web_page_preview'=>true,
        'resize_keyboard'=>true]);
}
if($data == "Braintree" || $data == "Adyen" ){
    bot('editMessageText',[
        'chat_id'=>$callbackchatid,
        'message_id'=>$callbackmessageid,
        'text'=>"<b> $data Gates

Coming Soon...
</b>",
        'parse_mode'=>'html',
        'disable_web_page_preview'=>true,
        'resize_keyboard'=>true]);
}
  if($data == "othercmds"){
    bot('editMessageText',[
    'chat_id'=>$callbackchatid,
    'message_id'=>$callbackmessageid,
    'text'=>"<b>Other Commands━</b>
  
<b>/me | !me</b> - Your Info
<b>/stats | !stats</b> - Checker Stats
<b>/key | !key</b> - SK Key Checker
<b>/bin | !bin</b> - Bin Lookup
<b>/iban | !iban</b> - IBAN Checker",
    'parse_mode'=>'html',
    'disable_web_page_preview'=>true,
    'reply_markup'=>json_encode(['inline_keyboard'=>[
  [['text'=>"Return",'callback_data'=>"back"]]
  ],'resize_keyboard'=>true])
  ]);
  }

?>