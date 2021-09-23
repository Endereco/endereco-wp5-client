<?php
// Config file.
?>

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
    }, {
        name: 'billing_address',
        addressType: 'billing_address'
    });
</script>

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
    }, {
        name: 'shipping_address',
        addressType: 'shipping_address'
    });
</script>

