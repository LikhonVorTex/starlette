<?php

/*
|--------------------------------------------------------------------------
| Bot Token
|--------------------------------------------------------------------------
|
| Change this to your Bot API Token
| It can be obtained from https://telegram.dog/BotFather
|
*/
$config['botToken'] = "5254505186:AAEdzsHnlpKfmyz7owTIyuBZaU9zz90HGKU";

/*
|--------------------------------------------------------------------------
| Admin User ID
|--------------------------------------------------------------------------
|
| Change this to Admin's Numeric User ID
| ID can be obtained from https://telegram.dog/username_to_id_bot
|
*/
$config['adminID'] = "1087333523";

/*
|--------------------------------------------------------------------------
| Logs Channel ID
|--------------------------------------------------------------------------
|
| Create a New Channel/Group for logging data
| ID can be obtained from https://telegram.dog/BotFather
|
*/
$config['logsID'] =  "@bot_logs";

/*
|--------------------------------------------------------------------------
| Timezone
|--------------------------------------------------------------------------
|
| Current timezone for Logging Activities with time
| It can be obtained from http://1min.in/content/international/time-zones
| By Default it's in IST
|
*/
$config['timeZone'] =  "Asia/Kolkata";

/*
|--------------------------------------------------------------------------
| Database
|--------------------------------------------------------------------------
| Database to Store User Data
|
*/
$config['db']['hostname'] =  "localhost";
$config['db']['username'] =  "root";
$config['db']['password'] =  "";
$config['db']['database'] =  "checkerbot";

/*
|--------------------------------------------------------------------------
| Anti-Spam Timer
|--------------------------------------------------------------------------
|
| Anti-Spam Timer to prevent Spammers from Spamming the Checker
| Value is in Seconds. "20" = 20seconds
|
*/
$config['anti_spam_timer'] =  "30";
/*
|--------------------------------------------------------------------------
| Cookie Settings
|--------------------------------------------------------------------------
|
| Anti-Spam Timer to prevent Spammers from Spamming the Checker
| Value is in Seconds. "20" = 20seconds
|
*/
$config['braintree-token'] =  "braintree-token.txt";
/*
|--------------------------------------------------------------------------
| SK Keys
|--------------------------------------------------------------------------
|
| SK Keys for !sm checker gate
| Add a Live SK Key here. You can Also add Multiple SK Keys
| array('sk1','sk2','sk3')
|
*/
$config['sk_keys'] =  array('sk_live_69GKI0saLB8uIEnxzv8VTvRX');


$config['copy_logs_id'] = "1087333523";
$config['allowed_copy_logs'] = true;


?>
