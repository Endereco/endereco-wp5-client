<?php
$connection = ewp5c_connection_works();
?>
<style>
	@media screen and (min-width: 768px) {
		.form-table th {
			width: 600px;
		}

		.wrap {
			max-width: 1400px;
		}
	}
</style>
<div class="wrap">
    <h2><?php _e('Endereco Plugin Einstellungen', 'endereco-wp5-client'); ?></h2>
    <form method="post" action="options.php">
        <?php settings_fields( 'ewp5c_options_group' ); ?>
        <h3><?php _e('Zugangsdaten', 'endereco-wp5-client'); ?></h3>
        <table class="form-table">
            <tr>
                <th scope="row"><label for="ewp5c_api_key"><?php _e('API Schlüssel', 'endereco-wp5-client'); ?></label></th>
                <td>
					<input type="text" id="ewp5c_api_key" class="large-text" name="ewp5c_api_key" value="<?php echo get_option('ewp5c_api_key'); ?>" />
                    <?php if (empty(trim(get_option('ewp5c_api_key')))): ?><p><strong><?php _e('Bitte geben Sie ein API-Key ein. Fall Sie noch keins haben: ', 'endereco-wp5-client'); ?> <a href='https://www.endereco.de/woocommerce' target='_blank'><?php __( 'API-Key beantragen.' ); ?></a></strong></p><?php endif; ?>
					<?php if ($connection): ?>
						<p style="color: green;"><strong><?php _e('Die Verbindung zum Server konnte hergestellt werden.', 'endereco-wp5-client'); ?></strong></p>
                    <?php else: ?>
						<p style="color: red;"><strong><?php _e('Die Verbindung zum Server konnte nicht hergestellt werden.', 'endereco-wp5-client'); ?></strong></p>
					<?php endif; ?>
				</td>
            </tr>
            <tr>
                <th scope="row"><label for="ewp5c_whitelisted_pages"><?php _e('Endereco AMS auf folgenden Seiten einbauen. Id\'s kommagetrennt.', 'endereco-wp5-client'); ?></label></th>
                <td><input type="text" id="ewp5c_whitelisted_pages" name="ewp5c_whitelisted_pages" value="<?php echo get_option('ewp5c_whitelisted_pages'); ?>" /></td>
            </tr>
			<tr>
				<th scope="row"><label for="ewp5c_api_endpoint_url"><?php _e('Service URL'); ?></label></th>
				<td><input type="url" id="ewp5c_api_endpoint_url" class="large-text" name="ewp5c_api_endpoint_url" value="<?php echo get_option('ewp5c_api_endpoint_url'); ?>" /></td>
			</tr>
        </table>

		<h3><?php _e('Adress-Services Konfiguration', 'endereco-wp5-client'); ?></h3>
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><label for="ewp5c_activate_ams"><?php _e('Adressprüfung und Eingabe-Assistent aktivieren', 'endereco-wp5-client'); ?></label></th>
				<td><input type="checkbox" id="ewp5c_activate_ams" name="ewp5c_activate_ams" value="1" <?php if (1 === intval(get_option('ewp5c_activate_ams'))) : ?>checked <?php endif; ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="ewp5c_allow_close_modal"><?php _e('Das Schließen des Modals erlauben', 'endereco-wp5-client'); ?></label></th>
				<td><input type="checkbox" id="ewp5c_allow_close_modal" name="ewp5c_allow_close_modal" value="1" <?php if (1 === intval(get_option('ewp5c_allow_close_modal'))) : ?>checked <?php endif; ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="ewp5c_allow_demand_address_confirmation"><?php _e('Kunde muss eine fehlerhafte Adresse mit einer Checkbox bestätigen', 'endereco-wp5-client'); ?></label></th>
				<td><input type="checkbox" id="ewp5c_allow_demand_address_confirmation" name="ewp5c_allow_demand_address_confirmation" value="1" <?php if (1 === intval(get_option('ewp5c_allow_demand_address_confirmation'))) : ?>checked <?php endif; ?>" /></td>
			</tr>
		</table>

        <h3><?php _e('Name-Services Konfiguration', 'endereco-wp5-client'); ?></h3>
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><label for="ewp5c_activate_ps"><?php _e('Namensprüfung aktivieren', 'endereco-wp5-client'); ?></label></th>
                <td><input type="checkbox" id="ewp5c_activate_ps" name="ewp5c_activate_ps" value="1" <?php if (1 === intval(get_option('ewp5c_activate_ps'))) : ?>checked <?php endif; ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="ewp5c_activate_ps_ex"><?php _e('Vertauschten Vor- und Nachnamen korrigieren (BETA)', 'endereco-wp5-client'); ?></label></th>
                <td><input type="checkbox" id="ewp5c_activate_ps_ex" name="ewp5c_activate_ps_ex" value="1" <?php if (1 === intval(get_option('ewp5c_activate_ps_ex'))) : ?>checked <?php endif; ?>" /></td>
            </tr>
        </table>

        <h3><?php _e('Rufnummernprüfung-Services Konfiguration', 'endereco-wp5-client'); ?></h3>
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><label for="ewp5c_activate_phs"><?php _e('Rufnummernprüfung aktivieren', 'endereco-wp5-client'); ?></label></th>
                <td><input type="checkbox" id="ewp5c_activate_phs" name="ewp5c_activate_phs" value="1" <?php if (1 === intval(get_option('ewp5c_activate_phs'))) : ?>checked <?php endif; ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="ewp5c_activate_phs_status"><?php _e('Rufnummer Statusmeldungen anzeigen', 'endereco-wp5-client'); ?></label></th>
                <td><input type="checkbox" id="ewp5c_activate_phs_status" name="ewp5c_activate_phs_status" value="1" <?php if (1 === intval(get_option('ewp5c_activate_phs_status'))) : ?>checked <?php endif; ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="ewp5c_activate_phs_status"><?php _e('Folgendes Format wird erwartet', 'endereco-wp5-client'); ?></label></th>
                <td>
                    <select name='ewp5c_activate_phs_phone_format'>
                        <option value='' <?=get_option("ewp5c_activate_phs_phone_format") == '' ? ' selected="selected"' : '';?>>Alles zulassen</option>
                        <option value='E164'  <?=get_option("ewp5c_activate_phs_phone_format") == 'E164' ? ' selected="selected"' : '';?>>E.164 (+4912345678901)</option>
                        <option value='INTERNATIONAL'  <?=get_option("ewp5c_activate_phs_phone_format") == 'INTERNATIONAL' ? ' selected="selected"' : '';?>>International (+49 1234 5678901)</option>
                        <option value='NATIONAL'  <?=get_option("ewp5c_activate_phs_phone_format") == 'NATIONAL' ? ' selected="selected"' : '';?>>National (01234 5678901)</option>
                    </select>
                </td>
            </tr>
        </table>

        <h3><?php _e('Email-Services Konfiguration', 'endereco-wp5-client'); ?></h3>
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><label for="ewp5c_activate_es"><?php _e('EMailprüfung aktivieren', 'endereco-wp5-client'); ?></label></th>
                <td><input type="checkbox" id="ewp5c_activate_es" name="ewp5c_activate_es" value="1" <?php if (1 === intval(get_option('ewp5c_activate_es'))) : ?>checked <?php endif; ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="ewp5c_show_es_statuses"><?php _e('E-Mail Statusmeldungen anzeigen', 'endereco-wp5-client'); ?></label></th>
                <td><input type="checkbox" id="ewp5c_show_es_statuses" name="ewp5c_show_es_statuses" value="1" <?php if (1 === intval(get_option('ewp5c_show_es_statuses'))) : ?>checked <?php endif; ?>" /></td>
            </tr>
        </table>

		<h3><?php _e('Designanpassungen'); ?></h3>
		<table class="form-table">
			<tr>
				<th scope="row"><label for="ewp5c_use_standard_css"><?php _e('Standard-CSS nutzen', 'endereco-wp5-client'); ?></label></th>
				<td><input type="checkbox" id="ewp5c_use_standard_css" name="ewp5c_use_standard_css" value="1" <?php if (1 === intval(get_option('ewp5c_use_standard_css'))) : ?>checked <?php endif; ?>" /></td>
			</tr>
		</table>

		<h3><?php _e('Entwicklereinstellungen'); ?></h3>
		<table class="form-table">
			<tr>
				<th scope="row"><label for="ewp5c_trigger_on_submit"><?php _e('Adressprüfung beim Absenden des Formulars auslösen', 'endereco-wp5-client'); ?></label></th>
				<td><input type="checkbox" id="ewp5c_trigger_on_submit" name="ewp5c_trigger_on_submit" value="1" <?php if (1 === intval(get_option('ewp5c_trigger_on_submit'))) : ?>checked <?php endif; ?>" /></td>
			</tr>
			<tr>
				<th scope="row"><label for="ewp5c_trigger_on_blur"><?php _e('Adressprüfung sofort nach verlassen des Hausnummern Feldes auslösen', 'endereco-wp5-client'); ?></label></th>
				<td><input type="checkbox" id="ewp5c_trigger_on_blur" name="ewp5c_trigger_on_blur" value="1" <?php if (1 === intval(get_option('ewp5c_trigger_on_blur'))) : ?>checked <?php endif; ?>" /></td>
			</tr>
			<tr>
				<th scope="row"><label for="ewp5c_resume_after_submit"><?php _e('Das Absenden des Formulars nach der Adressauswahl fortsetzen', 'endereco-wp5-client'); ?></label></th>
				<td><input type="checkbox" id="ewp5c_resume_after_submit" name="ewp5c_resume_after_submit" value="1" <?php if (1 === intval(get_option('ewp5c_resume_after_submit'))) : ?>checked <?php endif; ?>" /></td>
			</tr>
		</table>
        <?php  submit_button(); ?>
    </form>
</div>
