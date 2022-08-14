<?php

$paywayErrorTable = array(
    '100' => 'Approved',
    '201' => 'Invalid Account Number',
    '202' => 'Bad amount',
    '203' => 'Bad amount',
    '204' => 'Other Error',
    '205' => 'Bad total amount',
    '223' => 'Does not match MOP',
    '253' => 'Invalid tran type',
    '302' => 'Insufficient Funds',
    '303' => 'Processor decline',
    '304' => 'Not on file',
    '305' => 'Already reversed',
    '401' => 'Decline',
    '402' => 'Default Call',
    '501' => 'Pickup',
    '502' => 'Lost/Stolen',
    '503' => 'Security violation',
    '505' => 'Negative file',
    '509' => 'Over the limit',
    '510' => 'Over limit frequency count',
    '521' => 'Insufficient funds',
    '522' => 'Card is expired',
    '530' => 'Do not honor',
    '531' => 'CVV2 failure',
    '550' => 'Closed account',
    '570' => 'Stop payment',
    '571' => 'Revocation',
    '591' => 'Bad account number',
    '594' => 'Other error',
    '596' => 'Suspected Fraud',
    '605' => 'Bad expiration date',
    '606' => 'Invalid Transaction type',
    '806' => 'Restraint',
    '825' => 'No account',
    '611' => 'Refer New Acc',
    '612' => 'Retry With 3DS',
    '613' => 'Retry Later',
    '614' => 'Do not Retry',
);


$paywayCodesTable = array(
    "5000"=>"PAYWAY_WS_SUCCESS",
    "5001"=>"PAYWAY_WS_USER_NOT_FOUND",
    "5002"=>"PAYWAY_WS_PASSWORD_EXPIRED",
    "5003"=>"PAYWAY_WS_INVALID_PASSWORD",
    "5004"=>"PAYWAY_WS_PROHIBITED",
    "5005"=>"PAYWAY_WS_NOT_LOGGED_ON",
    "5007"=>"PAYWAY_WS_USER_LOCKED_OUT",
    "5008"=>"PAYWAY_WS_USER_NOT_ACTIVATED",
    "5009"=>"PAYWAY_WS_INVALID_USER",
    "5010"=>"PAYWAY_WS_AMOUNT_EXCEEDS_USER_CREDIT_LIMIT",
    "5011"=>"PAYWAY_WS_CASHBOX_NOT_FOUND",
    "5012"=>"PAYWAY_WS_TRANSACTION_DECLINED",
    "5013"=>"PAYWAY_WS_PAYMENT_TYPE_NOT_ACCEPTED",
    "5014"=>"PAYWAY_WS_CARD_TYPE_NOT_ACCEPTED",
    "5015"=>"PAYWAY_WS_REVERSE_AUTH_FAILED",
    "5017"=>"PAYWAY_WS_PROCESSOR_ERROR",
    "5018"=>"PAYWAY_WS_NO_PROCESSOR_CONNECTION",
    "5019"=>"PAYWAY_WS_SOFT_DESCRIPTOR_NOT_AUTHORIZED",
    "5020"=>"PAYWAY_WS_DUPLICATE_TRANSACTION_NAME",
    "5022"=>"PAYWAY_WS_SOURCE_NOT_FOUND",
    "5023"=>"PAYWAY_WS_COMPANY_NOT_FOUND",
    "5024"=>"PAYWAY_WS_DIVISION_NOT_FOUND",
    "5025"=>"PAYWAY_WS_TRANSACTION_NOT_FOUND",
    "5026"=>"PAYWAY_WS_IN_PROGRESS_TRANSACTION",
    "5027"=>"PAYWAY_WS_TRANSITION_ERROR",
    "5028"=>"PAYWAY_WS_TOKEN_NOT_ALLOWED",
    "5029"=>"PAYWAY_WS_ACCOUNT_NOT_FOUND",
    "5030"=>"PAYWAY_WS_ACCOUNT_NOT_ACTIVE",
    "5031"=>"PAYWAY_WS_ACCOUNT_CLOSED",
    "5032"=>"PAYWAY_WS_INVALID_TRANSACTION_TYPE",
    "5033"=>"PAYWAY_WS_INVALID_TRANSACTION_STATE",
    "5034"=>"PAYWAY_WS_INVALID_TRANSACTION",
    "5035"=>"PAYWAY_WS_INVALID_ACCOUNT_NUMBER",
    "5036"=>"PAYWAY_WS_INVALID_ADDRESS",
    "5037"=>"PAYWAY_WS_INVALID_EXPIRATION_DATE",
    "5038"=>"PAYWAY_WS_INVALID_FRAUD_SECURITY_CODE",
    "5039"=>"PAYWAY_WS_INVALID_CARD_TYPE",
    "5040"=>"PAYWAY_WS_INVALID_CITY",
    "5041"=>"PAYWAY_WS_INVALID_FIRST_NAME",
    "5042"=>"PAYWAY_WS_INVALID_LAST_NAME",
    "5043"=>"PAYWAY_WS_INVALID_MIDDLE_NAME",
    "5044"=>"PAYWAY_WS_INVALID_STATE",
    "5045"=>"PAYWAY_WS_INVALID_ZIP",
    "5046"=>"PAYWAY_WS_INVALID_PHONE",
    "5047"=>"PAYWAY_WS_INVALID_EMAIL",
    "5048"=>"PAYWAY_WS_INVALID_TOKEN",
    "5049"=>"PAYWAY_WS_INVALID_AMOUNT",
    "5050"=>"PAYWAY_WS_INVALID_PAYMENT_TYPE",
    "5051"=>"PAYWAY_WS_INVALID_SALES_TAX",
    "5052"=>"PAYWAY_WS_INVALID_TRANSACTION_NAME",
    "5053"=>"PAYWAY_WS_INVALID_ACCOUNT_NOTES_1",
    "5054"=>"PAYWAY_WS_INVALID_ACCOUNT_NOTES_2",
    "5055"=>"PAYWAY_WS_INVALID_ACCOUNT_NOTES_3",
    "5056"=>"PAYWAY_WS_INVALID_ECI_TYPE",
    "5057"=>"PAYWAY_WS_INVALID_STATUS",
    "5060"=>"PAYWAY_WS_INVALID_ACCOUNT_TYPE",
    "5061"=>"PAYWAY_WS_INVALID_TRANSACTION_NOTES_1",
    "5062"=>"PAYWAY_WS_INVALID_TRANSACTION_NOTES_2",
    "5063"=>"PAYWAY_WS_INVALID_TRANSACTION_NOTES_3",
    "5064"=>"PAYWAY_WS_INVALID_AUTH_CODE",
    "5065"=>"PAYWAY_WS_INVALID_TRANSACTION_ID",
    "5066"=>"PAYWAY_WS_INVALID_ONLINE_PAYMENT_CRYPTOGRAM",
    "5067"=>"PAYWAY_WS_INVALID_REQUEST",
    "5068"=>"PAYWAY_WS_INVALID_INPUT_MODE",
    "5069"=>"PAYWAY_WS_INVALID_REQUEST_TYPE",
    "5071"=>"PAYWAY_WS_INVALID_REQUEST_ACCOUNT_MISSING",
    "5072"=>"PAYWAY_WS_INVALID_REQUEST_TRANSACTION_MISSING",
    "5073"=>"PAYWAY_WS_TRANSACTION_TOKEN_MISSING",
    "5074"=>"PAYWAY_WS_TRANSACTION_QUEUED_BY_OTHER_SESSION",
    "5076"=>"PAYWAY_WS_JSON_EXCEPTION",
    "5077"=>"PAYWAY_WS_APPLE_PAY_SERVER_IO_EXCEPTION",
    "5078"=>"PAYWAY_WS_APPLE_PAY_DECRYPTION_ERROR",
    "5079"=>"PAYWAY_WS_APPLE_PAY_INVALID_URL",
    "5080"=>"PAYWAY_WS_INVALID_JSON",
    "5081"=>"PAYWAY_WS_INVALID_MEDIA_TYPE",
    "5082"=>"PAYWAY_WS_INVALID_ROUTING_NUMBER",
    "5089"=>"PAYWAY_WS_INVALID_REPLY",
    "6000"=>"PAYWAY_WS_INTERNAL_ERROR"

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





