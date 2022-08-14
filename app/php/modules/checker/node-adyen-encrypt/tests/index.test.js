const adyenKey ="10001|BC1AE9F480F13826C9ACD232FCB0F3593C03BFBFCC7498040151950F564519B040E93BE15943903FD7074376F78E3B5DBA0ECF94BB656ACA4D99561A11C95A04D10ECC7405CD7D0EDB06517A1C4DCE4CD33908BA00084AF370EA914358235C1FE3A517AED09A12DF2CC65507ADA76342DD5D85EEE2AA1E3E15781D3AAC3B6D7E89852588819B7E8CAC616F8B87204B91E3F62E9D4B15C3C4929C00F6BFC9477F38D3D2F467DC9C7C2F8DD684E13E8324A2074696850016B852CD1F6B0D5BC3D8809F8B7B3F5C1B0700B81093C36ADBBE80D2EE05995535080A64DEDBED3838B8161FD13A1CCA873AF66E564AAC07651656DA3A3AD8FA3F151BF299DC5D896EBD";

const cardData = {
    number: "5369 6587 0410 7605",
    holderName: "Bob Dylan",
    expiryMonth: "12",
    expiryYear: "2022",
    generationtime: "2020-11-30T14:38:25.124Z",
};

const validationResponse = {
    valid: true,
    number: true,
    luhn: true,
    holderName: true,
    month: true,
    expiryMonth: true,
    year: true,
    expiryYear: true,
    generationtime: true,
};

describe("app()", () => {
    it("should works with v18", () => {
        const adyenEncrypt = require("../index")(18);
        
        // apparently those weren't supported on v18?
        delete cardData.generationtime;
        delete validationResponse.generationtime;

        const cseInstance = adyenEncrypt.createEncryption(adyenKey, {});
        const validation = cseInstance.validate(cardData);

        expect(validation).toEqual(validationResponse);
    });

    it("should works with v22", () => {
        const adyenEncrypt = require("../index")(22);

        const cseInstance = adyenEncrypt.createEncryption(adyenKey, {});
        const validation = cseInstance.validate(cardData);

        expect(validation).toEqual(validationResponse);
    });

    it("should works with v23", () => {
        const adyenEncrypt = require("../index")(23);

        const cseInstance = adyenEncrypt.createEncryption(adyenKey, {});
        const validation = cseInstance.validate(cardData);

        expect(validation).toEqual(validationResponse);
    });

    it("should works with v24", () => {
        const adyenEncrypt = require("../index")(24);

        const cseInstance = adyenEncrypt.createEncryption(adyenKey, {});
        const validation = cseInstance.validate(cardData);

        expect(validation).toEqual(validationResponse);
    });

    it("should works with v25", () => {
        const adyenEncrypt = require("../index")(25);

        const cseInstance = adyenEncrypt.createEncryption(adyenKey, {});
        const validation = cseInstance.validate(cardData);

        expect(validation).toEqual(validationResponse);
    });
});
