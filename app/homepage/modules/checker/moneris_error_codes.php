<?php

$monerisErrorTable = array(
    '408' => 'No Credit Account',
    '475' => 'Invalid expiration date',
    '476' => 'Invalid transaction',
    '477' => 'Card Not Found',
    '478' => 'Pick up card',
    '479' => 'Decline',
    '480' => 'Decline',
    '481' => 'Insufficient Balance',
    '482' => 'Expired Card',
    '483' => 'Invalid CVV - Acceptable Card',
    '484' => 'Expired card',
    '485' => 'Not authorized',
    '486' => 'CVV Cryptographic error',
    '487' => 'Invalid CVV',
    '489' => 'Invalid CVV',
    '490' => 'Invalid CVV',
    '416' => 'Declined Use Updated card',
    '421' => 'Card Declined Do not retry',
    '898' => 'Bad Card',
    '050' => 'Suspected Fraud',
    '074' => 'Unable to Authorize. Please try again',
    '073' => 'Invalid Route of Service',
);



//
//function getmsgdata($paywaycode,$code):string{
//
//    foreach (array_values($paywayErrorTable) as $item => $value){
//        if ($item == $code){
//          $proc = $value;
//    }   }
//    foreach (array_values($paywayCodesTable) as $item => $value){
//        if ($item == $paywaycode) {
//            $message = $value;
//        }
//    }
//
//    return '{"message":"'.$paywayCodesTable[$message].'","process_message":"'.$paywayErrorTable[$proc]."}";
//}





