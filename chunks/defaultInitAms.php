<?php
// Config file.
?>

<!-- billing -->
<script>

    function waitForElementToDisplay(selector, callback, checkFrequencyInMs, timeoutInMs) {
        var startTimeInMs = Date.now();
        (function loopSearch() {
            if (document.querySelector(selector) != null) {
                callback();
                return;
            }
            else {
                setTimeout(function () {
                    if (timeoutInMs && Date.now() - startTimeInMs > timeoutInMs)
                        return;
                    loopSearch();
                }, checkFrequencyInMs);
            }
        })();
    }

    waitForElementToDisplay("#billing_street_name",function(){
        if (!document.getElementById('billing_street_name').parentElement.parentElement.classList.contains('cfw-hidden')) {
            enderecoInitAMS({
                countryCode: '[name="billing_country"]',
                postalCode: '[name="billing_postcode"]',
                locality: '[name="billing_city"]',
                streetFull: '',
                streetName: '[name="billing_street_name"]',
                buildingNumber: '[name="billing_house_number"]',
                additionalInfo: '[name="billing_address_2"]',
                addressStatus: '',
                addressTimestamp: '',
                addressPredictions: '',
                subdivisionCode: '[name="billing_state"]',
            }, {
                name: 'billing_address',
                addressType: 'billing_address'
            });
        }
    },100,9000);

    waitForElementToDisplay("#billing_address_1",function(){
        if (!document.getElementById('billing_address_1').parentElement.parentElement.classList.contains('cfw-hidden')) {
            enderecoInitAMS({
                countryCode: '[name="billing_country"]',
                postalCode: '[name="billing_postcode"]',
                locality: '[name="billing_city"]',
                streetFull: '[name="billing_address_1"]',
                streetName: '',
                buildingNumber: '',
                additionalInfo: '[name="billing_address_2"]',
                addressStatus: '',
                addressTimestamp: '',
                addressPredictions: '',
                subdivisionCode: '[name="billing_state"]',
            }, {
                name: 'billing_address',
                addressType: 'billing_address'
            });
        }
    },100,9000);

    enderecoInitPersonServces({
        salutation: '',
        firstName: '[name="billing_first_name"]',
        lastName: '[name="billing_last_name"]',
        title: ''
    }, {
        name: 'billing'
    });

    enderecoInitEmailServices(
        'billing_email'
        , {
            name: 'billing'
        });

    enderecoInitPhoneServices({
        phone: '[name="billing_phone"]'
    }, {
        name: 'billing'
    });
</script>

<!-- shipping -->
<script>

    waitForElementToDisplay("#shipping_street_name",function(){
        if (!document.getElementById('shipping_street_name').parentElement.parentElement.classList.contains('cfw-hidden')) {
            enderecoInitAMS({
                countryCode: '[name="shipping_country"]',
                postalCode: '[name="shipping_postcode"]',
                locality: '[name="shipping_city"]',
                streetFull: '',
                streetName: '[name="shipping_street_name"]',
                buildingNumber: '[name="shipping_house_number"]',
                additionalInfo: '[name="shipping_address_2"]',
                addressStatus: '',
                addressTimestamp: '',
                addressPredictions: '',
                subdivisionCode: '[name="shipping_state"]',
            }, {
                name: 'shipping_address',
                addressType: 'shipping_address'
            });
        }
    },100,9000);

    waitForElementToDisplay("#shipping_address_1",function(){
        if (!document.getElementById('shipping_address_1').parentElement.parentElement.classList.contains('cfw-hidden')) {
            enderecoInitAMS({
                countryCode: '[name="shipping_country"]',
                postalCode: '[name="shipping_postcode"]',
                locality: '[name="shipping_city"]',
                streetFull: '[name="shipping_address_1"]',
                streetName: '',
                buildingNumber: '',
                additionalInfo: '[name="shipping_address_2"]',
                addressStatus: '',
                addressTimestamp: '',
                addressPredictions: '',
                subdivisionCode: '[name="shipping_state"]',
            }, {
                name: 'shipping_address',
                addressType: 'shipping_address'
            });
        }
    },100,9000);

    enderecoInitPersonServces({
        salutation: '',
        firstName: '[name="shipping_first_name"]',
        lastName: '[name="shipping_last_name"]',
        title: ''
    }, {
        name: 'shipping'
    });

    enderecoInitEmailServices(
        'shipping_email'
    , {
        name: 'shipping'
    });

    enderecoInitPhoneServices({
        phone: '[name="shipping_phone"]'
    }, {
        name: 'shipping'
    });
</script>
