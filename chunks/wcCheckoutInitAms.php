<?php
    // Custom integration of ams services.
?>

<script>
    if (!window.EnderecoIntegrator.onLoad) {
        window.EnderecoIntegrator.onLoad = [];
    }

    window.EnderecoIntegrator.onLoad.push( function() {
        var $autocompleteFields, $addressFields;

        if (EnderecoIntegrator.activeServices.ams) {
            window.EnderecoObserverRegistry = {};
            $addressFields = [
                {
                    groupName: "shipping_address",
                    addressType: "shipping_address",
                    relevantFields: {
                        countryCode: '[name="shipping_country"]',
                        subdivisionCode: '[name="shipping_state"]',
                        postalCode: '[name="shipping_postcode"]',
                        locality: '[name="shipping_city"]',
                        streetFull: '',
                        streetName: '[name="shipping_street_name"]',
                        buildingNumber: '[name="shipping_house_number"]',
                        additionalInfo: '[name="shipping_address_2"]'
                    }
                },
                {
                    groupName: "billing_address",
                    addressType: "billing_address",
                    relevantFields: {
                        countryCode: '[name="billing_country"]',
                        subdivisionCode: '[name="billing_state"]',
                        postalCode: '[name="billing_postcode"]',
                        locality: '[name="billing_city"]',
                        streetFull: '',
                        streetName: '[name="billing_street_name"]',
                        buildingNumber: '[name="billing_house_number"]',
                        additionalInfo: '[name="billing_address_2"]'
                    }
                }
            ];

            $autocompleteFields = [
                "postalCode",
                "locality",
                "streetFull",
                "streetName"
            ];

            $addressFields.forEach( function(addressFieldSet) {
                var $fields;
                var EAO = EnderecoIntegrator.initAMS({
                    countryCode: '',
                    subdivisionCode: '',
                    postalCode: '',
                    locality: '',
                    streetFull: '',
                    streetName: '',
                    buildingNumber: '',
                    additionalInfo: '',
                    addressStatus: '',
                    addressTimestamp: '',
                    addressPredictions: '',
                }, {
                    name: addressFieldSet.groupName,
                    addressType: addressFieldSet.addressType,
                    config: {
                        splitStreet: true,
                        trigger: {
                            onblur: false
                        }
                    }
                });
                $fields = addressFieldSet.relevantFields;
                EnderecoIntegrator.changeFieldsOrder($fields)

                // Write custom fields observer.
                window.EnderecoObserverRegistry[addressFieldSet.groupName] = {};
                var Registry = window.EnderecoObserverRegistry[addressFieldSet.groupName];
                Object.keys($fields).forEach( function(keyName) {
                    if ('' !== $fields[keyName]) {
                        Registry[keyName] = {
                            selector: $fields[keyName],
                            name: keyName,
                            lastKnownValue: undefined,
                            observerInterval: undefined,
                            eaoRef: EAO,
                            stopObserver: function() {
                                clearInterval(this.observerInterval);
                                this.observerInterval = undefined;
                            },
                            startObserver: function() {
                                var $self = this;
                                if (undefined === this.observerInterval) {
                                    this.observerInterval = setInterval( function() {
                                        var subscriber;
                                        var field = document.querySelector($self.selector);
                                        // Check if subscriber is added
                                        if (!!field && !field.hasAttribute('endereco-attached-subscriber-for-'+$self.name)) {
                                            // Add subscriber if not.
                                            var fieldSubscriberOptions = {};
                                            if (!!window.EnderecoIntegrator.resolvers[$self.name+'Write']) {
                                                fieldSubscriberOptions['writeFilterCb'] = function(value) {
                                                    return window.EnderecoIntegrator.resolvers[$self.name+'Write'](value);
                                                }
                                            }
                                            if (!!window.EnderecoIntegrator.resolvers[$self.name+'Read']) {
                                                fieldSubscriberOptions['readFilterCb'] = function(value) {
                                                    return window.EnderecoIntegrator.resolvers[$self.name+'Read'](value);
                                                }
                                            }
                                            if (!!window.EnderecoIntegrator.resolvers[$self.name+'SetValue']) {
                                                fieldSubscriberOptions['customSetValue'] = function(subscriber, value) {
                                                    return window.EnderecoIntegrator.resolvers[$self.name+'SetValue'](subscriber, value);
                                                }
                                            }
                                            if ($autocompleteFields.includes($self.name)) {
                                                fieldSubscriberOptions['displayAutocompleteDropdown'] = true;
                                            }

                                            subscriber = new window.EnderecoIntegrator.constructors.EnderecoSubscriber(
                                                $self.name,
                                                field,
                                                fieldSubscriberOptions
                                            )
                                            $self.eaoRef.addSubscriber(subscriber);

                                            field.setAttribute('endereco-attached-subscriber-for-'+$self.name, true);
                                        }
                                    }, 1);
                                }
                            }
                        };
                        Registry[keyName].startObserver();
                    }
                });

                // Add address check trigger.
                var submitButton;
                setInterval(function() {
                    var countryCode = document.querySelector($fields['countryCode']);
                    if (!countryCode || !countryCode.form) {
                        return;
                    }
                    submitButton = countryCode.form.querySelector('[type=submit]');
                    if (!!submitButton && !submitButton.hasAttribute('endereco-attached-click-listener-for-'+addressFieldSet.groupName)) {
                        submitButton.addEventListener('click', function(e) {
                            var billToDifferentAddress = false;
                            var addresType = EAO.addressType;
                            if (!document.querySelector('[name="bill_to_different_address"]:checked')) {
                                EAO.addressType = 'general_address';
                                addresType = 'general_address';
                                billToDifferentAddress = false;
                            } else {
                                billToDifferentAddress = 'different_from_shipping' === document.querySelector('[name="bill_to_different_address"]:checked').value
                            }

                            if ('billing_address' === addresType
                                && billToDifferentAddress
                            ) {
                                if (EAO.util.shouldBeChecked()) {
                                    EAO.util.checkAddress();
                                    e.preventDefault();
                                    return false;
                                }
                            } else if ('shipping_address' === addresType) {
                                if (EAO.util.shouldBeChecked()) {
                                    EAO.util.checkAddress();
                                    e.preventDefault();
                                    return false;
                                }
                            } else if ('general_address' === addresType) {
                                if (EAO.util.shouldBeChecked()) {
                                    EAO.util.checkAddress();
                                    e.preventDefault();
                                    return false;
                                }
                            }
                        });
                        submitButton.setAttribute('endereco-attached-click-listener-for-'+addressFieldSet.groupName, '');
                    }
                }, 1);
            });
        }
    });

</script>

<script>
    enderecoInitPhoneServices({
        phone: '[name="shipping_phone"]'
    }, {
        name: 'shipping'
    });
</script>

<script>
    enderecoInitPhoneServices({
        phone: '[name="billing_phone"]'
    }, {
        name: 'billing'
    });
</script>