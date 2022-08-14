<?php

include(dirname(__dir__,3)."/functions/functions.php");
//include(dirname(__dir__,3)."/functions/countries.php");
//include(dirname(__dir__,3)."/functions/flag.php");
//include(dirname(__dir__,3)."/functions/countries.php");
//$ee = new functions;

//$flag = new functions\flag\emo_flags();

//echo $emoji = $ee::emojiFlag("US");


//echo functions::fbankinfo('513513');
//foreach($cntry as $value)
//{
//
//    echo $value;
//

//try {
//
//
$binlist = json_decode(fbankinfo("424094"),true);
echo$ccbank = $binlist['Bank'];
echo$ccvendor = $binlist['Vendor'];
echo$cctype = $binlist['Bank_Info'];
echo$cc_country = $binlist['Country'];
echo$abn = $binlist['Abn'];
echo$cc_emoji = $binlist['emoji'];

//
//$emoji = new functions\flag\emo_flags;
//ECHO $cc_emoji = $emoji::emojiFlag("BE");