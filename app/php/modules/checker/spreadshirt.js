const querystring = require('querystring');
const data = querystring.parse( process.argv[2] || '', '+' )
var adyenVersion = 24
var adyenKey = "10001|BC1AE9F480F13826C9ACD232FCB0F3593C03BFBFCC7498040151950F564519B040E93BE15943903FD7074376F78E3B5DBA0ECF94BB656ACA4D99561A11C95A04D10ECC7405CD7D0EDB06517A1C4DCE4CD33908BA00084AF370EA914358235C1FE3A517AED09A12DF2CC65507ADA76342DD5D85EEE2AA1E3E15781D3AAC3B6D7E89852588819B7E8CAC616F8B87204B91E3F62E9D4B15C3C4929C00F6BFC9477F38D3D2F467DC9C7C2F8DD684E13E8324A2074696850016B852CD1F6B0D5BC3D8809F8B7B3F5C1B0700B81093C36ADBBE80D2EE05995535080A64DEDBED3838B8161FD13A1CCA873AF66E564AAC07651656DA3A3AD8FA3F151BF299DC5D896EBD"

const adyenEncrypt = require('node-adyen-encrypt')(adyenVersion)
var options = {};
const cardData = {
    number : data.cc,
    holderName : data.fname+ " " +data.lname,
    expiryMonth : data.mm,
    expiryYear : data.yy,
    expiryYear : data.yy,
    cvc: data.cvv,
    generationtime : new Date().toISOString()
};

var cseInstance = adyenEncrypt.createEncryption(adyenKey, options)
cseInstance.validate(cardData);
var encryptCardData = cseInstance.encrypt(cardData)
var ecc = cseInstance.encrypt(cardData);
var emm = cseInstance.encrypt(cardData);
var eyy = cseInstance.encrypt(cardData);
var ecvc = cseInstance.encrypt(cardData);

var encrypted = '{"encryptedCardData":"' + encryptCardData + '","encryptedCardNumber":"' + ecc + '","encryptedExpiryMonth":"' + emm + '","encryptedExpiryYear":"' + eyy + '","encryptedSecurityCode":"' + ecvc + '","holderName":"'+ cardData.holderName +'"}'

console.log(encrypted);