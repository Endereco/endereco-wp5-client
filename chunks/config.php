<?php
// Config file.
?>

<script>
    // Konfiguration und spezifische Anpassungen.
    if (undefined === window.EnderecoIntegrator) {
        window.EnderecoIntegrator = {};
    }
    if (!window.EnderecoIntegrator.onLoad) {
        window.EnderecoIntegrator.onLoad = [];
    }

    // Hilfsfunktion. Damit lässt sich initAMS aufrufen, auch wenn die funktion noch nicht initiert ist.
    // Bessere Art und Weise wäre ein Proxy Objekt.
    function enderecoInitAMS(prefix, config) {
        if (undefined !== window.EnderecoIntegrator.initAMS) {
            window.EnderecoIntegrator.initAMS(prefix, config);
        } else {
            window.EnderecoIntegrator.onLoad.push(function () {
                window.EnderecoIntegrator.initAMS(prefix, config);
            });
        }
    }

    function enderecoLoadAMSConfig() {
        window.EnderecoIntegrator.defaultCountry = 'DE';
        window.EnderecoIntegrator.themeName = '<?php echo get_option('stylesheet'); ?>';
        window.EnderecoIntegrator.defaultCountrySelect = false; // Feature "Preselect country"
        window.EnderecoIntegrator.config.agentName = '<?php echo ENDERECO_CLIENT_NAME .' v' . ENDERECO_CLIENT_VERSION; ?>';
        window.EnderecoIntegrator.config.apiUrl = '<?php echo plugin_dir_url(  dirname(__DIR__) . '/io.php' ) . 'io.php'; ?>';
        window.EnderecoIntegrator.config.apiKey = '<?php echo get_option('ewp5c_api_key'); ?>'; // Hier kommt Dein API Key.
        window.EnderecoIntegrator.config.showDebugInfo = !!('<?php echo get_option('ewp5c_show_debug'); ?>');
        window.EnderecoIntegrator.config.splitStreet = false;
        window.EnderecoIntegrator.config.remoteApiUrl = '<?php echo get_option('ewp5c_api_endpoint_url'); ?>';
        window.EnderecoIntegrator.config.trigger.onblur = !!('<?php echo get_option('ewp5c_trigger_on_blur'); ?>');
        window.EnderecoIntegrator.config.trigger.onsubmit = !!('<?php echo get_option('ewp5c_trigger_on_submit'); ?>');
        window.EnderecoIntegrator.config.ux.smartFill = !!('<?php echo get_option('ewp5c_allow_smart_autocomplete'); ?>');;
        window.EnderecoIntegrator.config.ux.checkExisting = false;
        window.EnderecoIntegrator.config.ux.resumeSubmit = !!('<?php echo get_option('ewp5c_resume_after_submit'); ?>');
        window.EnderecoIntegrator.config.ux.useStandardCss = !!('<?php echo get_option('ewp5c_use_standard_css'); ?>');
        window.EnderecoIntegrator.config.ux.showEmailStatus = !!('<?php echo get_option('ewp5c_show_es_statuses'); ?>');
        window.EnderecoIntegrator.config.ux.allowCloseModal = !!('<?php echo get_option('ewp5c_allow_close_modal'); ?>');
        window.EnderecoIntegrator.config.ux.confirmWithCheckbox = !!('<?php echo get_option('ewp5c_allow_demand_address_confirmation'); ?>');
        window.EnderecoIntegrator.config.ux.changeFieldsOrder = true;
        window.EnderecoIntegrator.countryMappingUrl = '';
        window.EnderecoIntegrator.config.templates.primaryButtonClasses = 'button alt';
        window.EnderecoIntegrator.config.templates.secondaryButtonClasses = 'button';
        window.EnderecoIntegrator.config.texts = {
            popUpHeadline: '<?php _e('Adresse prüfen', 'endereco-wp5-client'); ?>',
            popUpSubline: '<?php _e('Die von Ihnen eingegebene Adresse scheint nicht korrekt oder unvollständig zu sein. Bitte wählen Sie die korrekte Adresse aus.', 'endereco-wp5-client'); ?>',
            mistakeNoPredictionSubline: '<?php _e('Ihre Adresse konnte nicht verifiziert werden. Bitte prüfen Sie Ihre Eingabe und ändern oder bestätigen sie.', 'endereco-wp5-client'); ?>',
            notFoundSubline: '<?php _e('Ihre Adresse konnte nicht verifiziert werden. Bitte prüfen Sie Ihre Eingabe und ändern oder bestätigen sie.', 'endereco-wp5-client'); ?>',
            confirmMyAddressCheckbox: '<?php _e('Ich bestätige, dass meine Adresse korrekt und zustellbar ist.', 'endereco-wp5-client'); ?>',
            yourInput: '<?php _e('Ihre Eingabe:', 'endereco-wp5-client'); ?>',
            editYourInput: '<?php _e('(bearbeiten)', 'endereco-wp5-client'); ?>',
            ourSuggestions: '<?php _e('Unsere Vorschläge:', 'endereco-wp5-client'); ?>',
            useSelected: '<?php _e('Auswahl übernehmen', 'endereco-wp5-client'); ?>',
            confirmAddress: '<?php _e('Adresse bestätigen', 'endereco-wp5-client'); ?>',
            editAddress: '<?php _e('Adresse bearbeiten', 'endereco-wp5-client'); ?>',
            warningText: '<?php _e('Falsche Adressen können zu Problemen in der Zustellung führen und weitere Kosten verursachen.', 'endereco-wp5-client'); ?>',
            popupHeadlines: {
                general_address: '<?php _e('Adresse prüfen', 'endereco-wp5-client'); ?>',
                billing_address: '<?php _e('Rechnungsadresse prüfen', 'endereco-wp5-client'); ?>',
                shipping_address: '<?php _e('Lieferadresse prüfen', 'endereco-wp5-client'); ?>',
            },
            statuses: {
                email_not_correct: '<?php _e('Die E-Mail Adresse scheint nicht korrekt zu sein.', 'endereco-wp5-client'); ?>',
                email_cant_receive: '<?php _e('Das E-Mail Postfach ist nicht erreichbar.', 'endereco-wp5-client'); ?>',
                email_syntax_error: '<?php _e('Prüfen Sie die Schreibweise.', 'endereco-wp5-client'); ?>',
                email_no_mx: '<?php _e('Die E-Mail Adresse existiert nicht. Prüfen Sie die Schreibweise.', 'endereco-wp5-client'); ?>',
                building_number_is_missing: '<?php _e('Keine Hausnummer enthalten.', 'endereco-wp5-client'); ?>',
                building_number_not_found: '<?php _e('Diese Hausnummer wurde nicht gefunden.', 'endereco-wp5-client'); ?>',
                street_name_needs_correction: '<?php _e('Die Schreibweise der Straße ist fehlerhaft.', 'endereco-wp5-client'); ?>',
                locality_needs_correction: '<?php _e('Die Schreibweise des Ortes ist fehlerhaft.', 'endereco-wp5-client'); ?>',
                postal_code_needs_correction: '<?php _e('Die PLZ ist ungültig.', 'endereco-wp5-client'); ?>',
                country_code_needs_correction: '<?php _e('Die eingegebene Adresse wurde in einem anderen Land gefunden.', 'endereco-wp5-client'); ?>'
            }
        };
        window.EnderecoIntegrator.activeServices = {
            ams: !!('<?php echo get_option('ewp5c_activate_ams'); ?>'),
            emailService: !!('<?php echo get_option('ewp5c_activate_es'); ?>'),
            personService: !!('<?php echo get_option('ewp5c_activate_ps'); ?>')
        }

        // Country matching functions.
        EnderecoIntegrator.resolvers.countryCodeWrite = function (value) {
            return new Promise(function (resolve, reject) {
                resolve(value.toUpperCase());
            });
        }
        EnderecoIntegrator.resolvers.countryCodeRead = function (value) {
            return new Promise(function (resolve, reject) {
                resolve(value.toUpperCase());
            });
        }

        window.EnderecoIntegrator.ready = true;

        // Execute all function that have been called throughout the page.
        window.EnderecoIntegrator.onLoad.forEach(function (callback) {
            callback();
        });
    }
</script>

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

