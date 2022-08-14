<?php

function getResponseMessage($responseCode)
{

$code_100 = array("Approved" , "First Data received no answer from auth network");
$code_200 = array("Suspected Fraud" , "Merchant advises they are reversing an Authorization transaction because Fraud is suspected in a non-Face-To-Face transaction environment. MasterCard Non Face to Face FULL Reversal Only");
$code_201 = array("Invalid CC Number" , "Bad check digit, length, or other credit card problem");
$code_202 = array("Bad Amount Nonnumeric Amount" , "Amount sent was zero, unreadable, over ceiling limit, or exceeds maximum allowable amount");
$code_203 = array("Zero Amount" , "Amount sent was zero");
$code_204 = array("Other Error" , "Unidentifiable error");
$code_205 = array("Bad Total Auth Amount" , "The sum of the authorization amount from extended data information does not equal detail record authorization Amount. Amount sent was zero, unreadable, over ceiling limit, or exceeds Maximum allowable amount");
$code_225 = array("Invalid Field Data" , "Data within transaction is incorrect");
$code_227 = array("Missing Companion Data" , "Specific and relevant data within transaction is absent");
$code_231 = array("Invalid Division Number" , "Division number incorrect");
$code_238 = array("Invalid Currency" , "Currency does not match First Data merchant setup for division");
$code_239 = array("Invalid MOP for Division" , "Method of payment is invalid for the division");
$code_241 = array("Illegal Action" , "Invalid action attempted");
$code_242 = array("Invalid Temporary Services Data" , "Data is inaccurate or missing");
$code_243 = array("Invalid Purchase Level 3" , "Data is inaccurate or missing, or the BIN is ineligible for P-card");
$code_244 = array("Invalid Encryption Format" , "Invalid encryption flag. Data is Inaccurate.");
$code_245 = array("Missing or Invalid Secure Payment Data", "Visa or MasterCard authentication data not in appropriate Base 64 encoding format or data provided on A non-e-Commerce transaction.");
$code_246 = array("Merchant not MasterCard Secure code Enabled" , "Division does not participate in MasterCard Secure Code. Contact your First Data Representative for information on getting setup for MasterCard SecureCode.");
$code_248 = array("Blanks not passed in reserved field" , "Blanks not passed in Reserved Field");
$code_249 = array("Invalid (MCC)" , "Invalid Merchant Category (MCC) sent");
$code_253 = array("Invalid Tran. Type" , "If an 'R' (Retail Indicator) is sent for a transaction with a MOTO Merchant Category Code (MCC)");
$code_254 = array("Reserved" , "Reserved. Note: If this response is received, please contact your First Data Representative");
$code_255 = array("Reserved" , "Reserved Note: If this response is received, please contact your First Data Representative");
$code_257 = array("Missing Cust Service Phone" , "Card was authorized, but AVS did not match. The 100 was overwritten with a 260 per the merchant’s request Note: Conditional deposits only");
$code_258 = array("Not Authorized to Send Record" , "Division does not participate in Soft Merchant Descriptor. Contact your First Data Representative for information on getting set up for Soft Merchant Descriptor.");
$code_262 = array("Authorization Code Response Date Invalid" , "Authorization code and/or response date are invalid. Note: MOP = array(MC, MD, VI only");
$code_263 = array("Partial Authorization Not Allowed or Partial Authorization Request Note Valid" , "Action code or division does not allow partial authorizations or partial authorization request is not valid.");
$code_272 = array("Invalid Purchase Level 2" , "Level II Purchase card data is inaccurate or missing, or not an appropriate card brand.");
$code_274 = array("Transaction Not Supported" , "The requested transaction type is blocked from being used with this card. Note:  This may be the result of either an association rule, or a merchant boarding option.");
$code_275 = array("Invalid Time" , "An invalid time was specified.");
$code_276 = array("Invalid Date" , "An invalid date was specified.");
$code_299 = array("Duplicate Transaction" , "The transaction is a duplicate of a previous transaction (either within this same batch file, or in any batch file submitted by the client in the last 7 days).");
$code_301 = array("Issuer unavailable" , "Authorization network could not reach the bank which issued the card");
$code_302 = array("Insufficient funds" , "Credit Floor");
$code_303 = array("Processor Decline" , "Generic decline – No other information is being provided by the Issuer");
$code_304 = array("Not On File" , "No card record, or invalid/nonexistent to account specified");
$code_305 = array("Already Reversed" , "Transaction previously reversed. Note: MOP = array(any Debit MOP, SV, MC, MD, VI only");
$code_306 = array("Amount Mismatch" , "Requested reversal amount does not match original approved authorization amount. Note: MOP = array(MC, MD, VI only");
$code_307 = array("Authorization Not Found" , "Transaction cannot be matched to an authorization that was stored in the database.  Note: MOP = array(MC, MD , MI, VI, TC and PY only");
$code_351 = array("TransArmor Service Unavailable" , "TransArmor Service temporarily unavailable.");
$code_353 = array("TransArmor Invalid Token or PAN" , "TransArmor Service encountered a problem converting the given Token or PAN with the given Token Type.");
$code_354 = array("TransArmor Invalid Result" , "TransArmor Service encountered a problem with the resulting Token/PAN.");
$code_401 = array("Call" , "Issuer wants voice contact with cardholder");
$code_402 = array("Default Call" , "Decline");
$code_420 = array("Unsupported Currency" , "A transaction has been attempted in an invalid currency, or one not supported by the endpoint.");
$code_430 = array("Prepaid Card Amount Over EU AMLD Limit" , "A transaction has been attempted in an invalid currency, or one not supported by the endpoint.");
$code_501 = array("Pickup" , "Card Issuer wants card returned");
$code_502 = array("Lost/Stolen" , "Card reported as lost/stolen Note: Does not apply to American Express");
$code_503 = array("Fraud/ Security Violation" , "CID did not match Note: Discover only");
$code_508 = array("Excessive PIN try" , "Allowable number of PIN tries exceeded");
$code_509 = array("Over the limit" , "Exceeds withdrawal or activity amount limit");
$code_510 = array("Over Limit Frequency" , "Exceeds withdrawal or activity count limit");
$code_521 = array("Insufficient funds" , "Insufficient funds/over credit limit");
$code_522 = array("Card is expired" , "Card has expired");
$code_530 = array("Do Not Honor" , "Generic Decline – No other information is being provided by the issuer. Issuer did not provide a specific reason for declining. Please have the cardholder contact their Issuer for additional information. Note: This is a hard decline for BML (will never pass with recycle attempts)");
$code_531 = array("CVV2/VAK Failure" , "Issuer has declined auth request because CVV2 or VAK failed");
$code_551 = array("Duplicate Transaction" , "Duplicate Transaction Detected");
$code_570 = array("Stop payment order one time recurring/ installment" , "Cardholder has requested this one recurring/installment payment be stopped.");
$code_571 = array("Revocation of Authorization for All Recurring / Installments" , "Cardholder has requested all recurring/installment payments be stopped");
$code_572 = array("Revocation of All Authorizations – Closed Account" , "Cardholder has requested that all authorizations be stopped for this account due to closed account. Note: Visa only");
$code_591 = array("Invalid CC Number" , "Bad check digit, length or other credit card problem. Issuer generated");
$code_592 = array("Bad Amount" , "Amount sent was zero or unreadable. Issuer generated");
$code_594 = array("Other Error" , "Unidentifiable error. Issuer generated");
$code_595 = array("New Card Issued" , "New Card Issued");
$code_596 = array("Suspected Fraud" , "Issuer has flagged account as suspected fraud");
$code_602 = array("Invalid Institution Code" , "Card is bad, but passes MOD 10 check digit routine, wrong BIN");	
$code_603 = array("Invalid Institution" , "Institution not valid (i.e. possible merger)");
$code_606 = array("Invalid Transaction Type" , "Issuer does not allow this type of transaction");
$code_607 = array("Invalid Amount" , "Amount not accepted by network. (This response is provided by the card issuer.)");
$code_610 = array("BIN Block" ,"Merchant has requested First Data not process credit cards with this BIN");
$code_611 = array("Refer New Acc " , "New account information available");
$code_612 = array("Retry With 3DS " , "Retry the transaction with 3DS data ");
$code_613 = array("Retry Later " , "Retry later");
$code_614 = array("Do Not Retry ", "Do not retry. A fraud may have happened with the transaction ");
$code_754 = array("Account Closed" , "Bank account has been closed For PayPal – the customer’s account was closed / restricted");
$code_802 = array("Positive ID" , "Issuer requires further information");
$code_806 = array("Restraint" , "Card has been restricted");
$code_811 = array("Invalid Security Code" , "American Express CID is incorrect");
$code_813 = array("Invalid PIN" , "PIN for online debit transactions is incorrect");
$code_818 = array("No Savings Account" , " ");
$code_825 = array("No Account" , "Account does not exist");
$code_833 = array("Invalid Merchant" , "Service Established (SE) number is incorrect, closed or Issuer does not allow this type of transaction");	
$code_834 = array("Unauthorized User" , "Method of payment is invalid for the division");
$code_902 = array("Process Unavailable" , "System error/malfunction with Issuer For Debit – The link is down or setup issue. contact your First Data Representative.");
$code_903 = array("Invalid Expiration" , "Invalid or expired expiration date");
$code_904 = array("Invalid Effective" , "Card not active");
$code_997 = array("Acquirer Error" , "Acquiring bank configuration problem. Contact your First Data representative.");
	
	$getMessage = $$responseCode;
	return $getMessage;
 
}
?>