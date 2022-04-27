<?php
// Config file.
?>
<!-- general -->
<script>

</script>

<!-- billing -->
<script>
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
