<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/junaidzx90/wp-smp/issues
 * @since      1.0.0
 *
 * @package    Wp_Smp
 * @subpackage Wp_Smp/admin/partials
 */

echo '<form action="options.php" method="post" id="wpsmp_settings">';
echo '<h1>📓 School Manager Settings</h1><hr>';
settings_fields( 'wpsmp_settings_section' );
do_settings_fields( 'wpsmp_settings', 'wpsmp_settings_section' );
submit_button();
echo '</form>';