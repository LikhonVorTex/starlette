
   const adyenEncrypt = require('node-adyen-encrypt')(24);

     const adyenKey     =   "10001|A99FBA6B1448AD3C44DDFB9C4BD774381702BD37BA1FA8F707046424943EB6030C75FEEF67EE2B92D770F126227EF8F95A1FCC7B31406D62CBE7D76F6EAD1B3C6FF6EABCFE4685FBC6C06B95CF431C23B0A80D1A04D1F2FEC345AB32199628E499CDDE1D40A584F2D8471A0966B21ADD0C7E748DD231277B83DB3A20B7D07BE7F9AFC1F88401FF9BAD06C42A735B3DB917474239B20A9D0C8DFC3BF55AFF9D6C1DC186DC85AFB07A1361F02223577CBAFA82DB5AEA21CB172E2613FB475309AD37D84A73A3095F3E1F3C73669EBFA9E8416F2830A407F2B8D12A058FB493B572745783838A5931A9F036DD7ABA4FBCCF880C0102B9ACF4CC1AFFD819C8E32E2D";
     const options = {};
     const cardData = {
         number : '4145 8086 0895 0105',
         holderName : 'dsada dsadsa',
         expiryMonth : '08',
         expiryYear : '2022',
         generationtime : new Date().toISOString()
     };
     const cseInstance = adyenEncrypt.createEncryption(adyenKey, options);
     cseInstance.validate(cardData);
     const dataEncrypted = cseInstance.encrypt(cardData);




