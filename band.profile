<?php

/**
 * Implements hook_form_alter().
 *
 * Allows the profile to alter the site configuration form.
 */
function band_form_install_configure_form_alter(&$form, $form_state) {
  // Since any module can add a drupal_set_message, this can bug the user
  // when we display this page. For a better user experience,
  // remove all the messages.
  drupal_get_messages(NULL, TRUE);

  // Set a default name for the dev site and change title's label.
  $form['site_information']['site_name']['#title'] = 'Site name';
  $form['site_information']['site_mail']['#title'] = 'Site email address';
  $form['site_information']['site_name']['#default_value'] = t('Pushtape');

  // Set a default country so we can benefit from it on Address Fields.
  $form['server_settings']['site_default_country']['#default_value'] = 'DE';

  $form['admin_account']['#title'] = st('Site admin account');

  // Use "admin" as the default username.
  $form['admin_account']['account']['name']['#default_value'] = 'admin';
  $form['admin_account']['account']['name']['#disabled'] = TRUE;

  // Hide Update Notifications.
  $form['update_notifications']['#access'] = FALSE;


}


/**
 * Implements hook_init
 */
function band_init() {

}

/**
 * Implements hook_form_alter().
 *
 * Allows the profile to alter the site-configuration form. This is
 * called through custom invocation, so $form_state is not populated.
 */
function band_form_alter(&$form, $form_state, $form_id) {

}
