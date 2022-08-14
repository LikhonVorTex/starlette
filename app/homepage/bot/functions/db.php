<?php


include_once __DIR__."/../functions/bot.php";
include __DIR__."/../config/variables.php";
include __DIR__."/../config/config.php";

///////////==[DB Connection]==///////////
$conn = mysqli_connect($config['db']['hostname'],$config['db']['username'],$config['db']['password'],$config['db']['database']);

if(!$conn){
    bot('sendmessage',[
        'chat_id'=>$config['adminID'],
        'text'=>"<b>🛑 DB connection Failed!
        
        ".json_encode($config['db'])."</b>",
        'parse_mode'=>'html'
        
    ]);

    logsummary("<b>🛑 DB connection Failed!\n\n".json_encode($config['db'])."</b>");
}

////////////////////////////////////////////

function fetchUser($userID){
    global $conn;
    $dataf = mysqli_query($conn,"SELECT * FROM users WHERE userid='$userID'");

    if(mysqli_num_rows($dataf) == 0){
        return False;
    }

    $userData = $dataf->fetch_assoc();
    
    return $userData;

}
function fetchcredentials($userID){
    global $conn;
    $dataf = mysqli_query($conn,"SELECT * FROM credentials WHERE userid='$userID'");

    if(mysqli_num_rows($dataf) == 0){
        return False;
    }

    $userData = $dataf->fetch_assoc();

    return $userData;

}
function isBanned($userID){
    global $chat_id;
    global $message_id;
    $userData = fetchUser($userID);

    if($userData['is_banned'] == "True"){
        bot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"<b>Hehe Boi! Suck your Mum</b>",
        'parse_mode'=>'html',
        'reply_to_message_id'=> $message_id
        ]);
        return True;
    }else{
        return False;
    }

}

function isMuted($userID){
    global $chat_id;
    global $message_id;
    global $conn;
    $userData = fetchUser($userID);

    if($userData['is_muted'] == "True"){
        $muted_for = $userData['mute_timer']-time();

        if($muted_for >= 0){
        bot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"<b>🛑You are Muted!
            
Try Again after <code>".date("F j, Y, g:i a",$userData['mute_timer'])."</code></b>",
        'parse_mode'=>'html',
        'reply_to_message_id'=> $message_id
        ]);
        return True;
        }else{
            mysqli_query($conn,"UPDATE users SET is_muted = 'False',mute_timer = '0' WHERE userid = '$userID'");
            return False;
        }
    }else{
        return False;
    }

}

function addUser($userID){
    global $conn;
    global $username;
    $userData = fetchUser($userID);

    if(!$userData){
        $addtodb = mysqli_query($conn,"INSERT INTO users (userid,registered_on,is_banned,is_muted,mute_timer,xname,total_checked,total_cvv,total_ccn,isPremium) VALUES ('$userID','".time()."','False','False','0','$username','0','0','0','no')");
        logsummary("<b>🛑 [LOG] New User - $userID</b>");
        return True;
    }else{
        return False;
    }

}

function regbeta($userID, $pass){
    global $conn;
    $userData = fetchcredentials($userID);

    if(!$userData){
        $addtodb = mysqli_query($conn,"INSERT INTO credentials (cuserid,userid,passwd,status) VALUES ('','$userID','$pass','1')");
        logsummary("<b>🛑 [LOG] New Beta User Registered - $userID</b>");
        return True;
    }else{
        return False;
    }

}
//function addSubsUser($userID,$time){
//    global $conn;
//    $userData = fetchUser($userID);
//
//    if(!$userData){
//        return "Uhmm, This user isn't in my db!";
//    }else{
//        $addtodb = mysqli_query($conn,"INSERT INTO premium (userid,subs_date,userid,prem_timer) VALUES ('','".time()."','$userID','$time')");
//        logsummary("<b>🛑 [LOG] Subscribe $userID +</b>");
//        return "Successfully Muted <code>$userID</code> until <code>".date("F j, Y, g:i a",$time)."</code>";
//    }
//
//}

function muteUser($userID,$time){
    global $conn;
    $userData = fetchUser($userID);

    if(!$userData){
        return "Uhmm, This user isn't in my db!";
    }else{
        $muteuser = mysqli_query($conn,"UPDATE users SET is_muted = 'True',mute_timer = '$time' WHERE userid = '$userID'");
        logsummary("<b>🛑 [LOG] Muted $userID</b>");
        return "Successfully Muted <code>$userID</code> until <code>".date("F j, Y, g:i a",$time)."</code>";
    }

}

function unmuteUser($userID){
    global $conn;
    $userData = fetchUser($userID);

    if(!$userData){
        return "Uhmm, This user isn't in my db!";
    }else{
        $muteuser = mysqli_query($conn,"UPDATE users SET is_muted = 'False',mute_timer = '0' WHERE userid = '$userID'");
        logsummary("<b>🛑 [LOG] Unmuted $userID</b>");
        return "Successfully Unmuted $userID";
    }

}

function banUser($userID){
    global $conn;
    $userData = fetchUser($userID);

    if(!$userData){
        return "Uhmm, This user isn't in my db!";
    }else{
        $muteuser = mysqli_query($conn,"UPDATE users SET is_banned = 'True' WHERE userid = '$userID'");
        logsummary("<b>🛑 [LOG] Banned $userID</b>");
        return "Successfully Banned <code>$userID</code>";
    }

}

function unbanUser($userID){
    global $conn;
    $userData = fetchUser($userID);

    if(!$userData){
        return "Uhmm, This user isn't in my db!";
    }else{
        $muteuser = mysqli_query($conn,"UPDATE users SET is_banned = 'False' WHERE userid = '$userID'");
        
        logsummary("<b>🛑 [LOG] Unbanned $userID</b>");

        return "Successfully Unbanned <code>$userID</code>";

        
    }

}

function fetchMutelist(){
    global $conn;

    $data = mysqli_query($conn,"SELECT userid FROM users WHERE is_muted = 'True'");
    if(mysqli_num_rows($data) == 0){
        return False;
    }

    $data = $data->fetch_assoc();
    return $data;
}

function fetchMuteTimer($userID){
    global $conn;

    $data = mysqli_query($conn,"SELECT mute_timer FROM users WHERE userid = '$userID'");
    if(mysqli_num_rows($data) == 0){
        return False;
    }

    $data = $data->fetch_assoc();
    return $data;
}

function fetchBanlist(){
    global $conn;

    $data = mysqli_query($conn,"SELECT userid FROM users WHERE is_banned = 'True'");
    if(mysqli_num_rows($data) == 0){
        return False;
    }

    $data = $data->fetch_assoc();
    return $data;
}


function totalBanned(){
    global $conn;

    $data = mysqli_query($conn,"SELECT * FROM users WHERE (is_banned = 'True')");
    return mysqli_num_rows($data);

}
function totalPremUser(){
    global $conn;

    $data = mysqli_query($conn,"SELECT * FROM users WHERE (isPremium = 'yes')");
    return mysqli_num_rows($data);

}

function totalMuted(){
    global $conn;

    $data = mysqli_query($conn,"SELECT * FROM users WHERE (is_muted = 'True')");
    return mysqli_num_rows($data);

}
####### premium #######
//function isUserPrem($userID){
//    global $conn;
//    $data = mysqli_query($conn,"SELECT prems_id)DATE_ADD(max(prem_timer), INTERVAL $interval DAY) AS  future_date FROM premium WHERE (userid = '$userID')");
//    if(mysqli_num_rows($data) == 0){
//        $datas = add_days(time(),$add_time);
//        return $datas;
//    }
//
//}
function get_prem_info($userID){
    global $conn;
    $userData = mysqli_query($conn,"SELECT max(prem_timer) as curr_prems from premium where userid ='$userID'");

    if(mysqli_num_rows($userData) == 0){
        return false;
    }
    $userData = $userData->fetch_assoc();

    return $userData['curr_prems'];

}
function regUserAsPremium($userID,$currtime,$add_time){
    global $conn;
    $time = str_replace('d','',$add_time);
         mysqli_query($conn,"INSERT INTO premium (prems_id,subs_date,userid,prem_timer,add_time) VALUES ('','".time()."','$userID','$currtime','$add_time')");
        logsummary("<b>[ღBotLogsღ]     Premium is Added $time Days! <code>$userID</code></b>");
        return "Premium Added $time days to <code>$userID</code> | Valid: ".date("M j Y",$currtime);

}
///////===[ANTI-SPAM]===///////

function existsLastChecked($userID){
    global $conn;
    $dataf = mysqli_query($conn,"SELECT * FROM antispam WHERE userid='$userID'");

    if(mysqli_num_rows($dataf) == 0){
        return False;
    }

    $userData = $dataf->fetch_assoc();
    
    return $userData['last_checked_on'];

}

function antispamCheck($userID){
    global $conn;
    global $config;

    $antiSpamGey = existsLastChecked($userID);
    
    if($userID == $config['adminID']){
        return False;
    }
    if($antiSpamGey == False){
        $addtodb = mysqli_query($conn,"INSERT INTO antispam (userid,last_checked_on) VALUES ('$userID','".time()."')");
        return False;
    }else{
        if(time() - $antiSpamGey > $config['anti_spam_timer']){
            $addtodb = mysqli_query($conn,"UPDATE antispam set last_checked_on = '".time()."' WHERE userid = '$userID'");
            return False;
        }else{
            return $config['anti_spam_timer'] - (time() - $antiSpamGey);
        }
        
    }

}

///////===[CHECKER STATS]===///////

function fetchGlobalStats(){
    global $conn;
    $stats = mysqli_query($conn,"SELECT * FROM global_checker_stats");
    $stats = $stats->fetch_assoc();
    return $stats;

}

function addTotal(){
    global $conn;
    mysqli_query($conn,"UPDATE global_checker_stats SET total_checked = total_checked + 1");

}

function addCVV(){
    global $conn;
    mysqli_query($conn,"UPDATE global_checker_stats SET total_cvv = total_cvv + 1");

}

function addCCN(){
    global $conn;
    mysqli_query($conn,"UPDATE global_checker_stats SET total_ccn = total_ccn + 1");

}


function fetchUserStats($userID){
    global $conn;
    $stats = mysqli_query($conn,"SELECT total_checked,total_cvv,total_ccn FROM users WHERE userid = '$userID'");
    $stats = $stats->fetch_assoc();
    return $stats;

}

function addUserTotal($userID){
    global $conn;
    mysqli_query($conn,"UPDATE users SET total_checked = total_checked + 1 WHERE userid = '$userID'");

}

function addUserCVV($userID){
    global $conn;
    mysqli_query($conn,"UPDATE users SET total_cvv = total_cvv + 1 WHERE userid = '$userID'");

}

function addUserCCN($userID){
    global $conn;
    mysqli_query($conn,"UPDATE users SET total_ccn = total_ccn + 1 WHERE userid = '$userID'");

}

///////===[API KEY]===///////

function fetchAPIKey($userID){
    global $conn;
    $key = mysqli_query($conn,"SELECT xname FROM users WHERE userid = '$userID'");
    $key = $key->fetch_assoc();
    return $key['sk_key'];

}

function updateAPIKey($userID,$apikey){
    global $conn;
    mysqli_query($conn,"UPDATE users SET xname = '$apikey' WHERE userid = '$userID'");

}

?>