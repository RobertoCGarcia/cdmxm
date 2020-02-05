<?php

/**
 * @file
 * Form override for theme settings.
 */

/**
 * Impelements hook_form_system_theme_settings_alter().
 */
function basic_form_system_theme_settings_alter(&$form, $form_state) {
  $form['options_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Theme Specific Settings'),
    '#collapsible' => FALSE,
    '#collapsed' => FALSE,
  );
  $form['options_settings']['basic_tabs'] = array(
    '#type' => 'checkbox',
    '#title' => t('Use the ZEN tabs'),
    '#description' => t('Check this if you wish to replace the default tabs by the ZEN tabs'),
    '#default_value' => theme_get_setting('basic_tabs'),
  );
  $form['options_settings']['basic_breadcrumb'] = array(
    '#type' => 'fieldset',
    '#title' => t('Breadcrumb settings'),
    '#attributes' => array('id' => 'basic-breadcrumb'),
  );
  $form['options_settings']['basic_breadcrumb']['basic_breadcrumb'] = array(
    '#type' => 'select',
    '#title' => t('Display breadcrumb'),
    '#default_value' => theme_get_setting('basic_breadcrumb'),
    '#options' => array(
      'yes' => t('Yes'),
      'admin' => t('Only in admin section'),
      'no' => t('No'),
    ),
  );
  $form['options_settings']['basic_breadcrumb']['basic_breadcrumb_separator'] = array(
    '#type' => 'textfield',
    '#title' => t('Breadcrumb separator'),
    '#description' => t('Text only. Don’t forget to include spaces.'),
    '#default_value' => theme_get_setting('basic_breadcrumb_separator'),
    '#size' => 5,
    '#maxlength' => 10,
    // Jquery hook to show/hide optional widgets.
    '#prefix' => '<div id="div-basic-breadcrumb-collapse">',
  );
  $form['options_settings']['basic_breadcrumb']['basic_breadcrumb_home'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show home page link in breadcrumb'),
    '#default_value' => theme_get_setting('basic_breadcrumb_home'),
  );
  $form['options_settings']['basic_breadcrumb']['basic_breadcrumb_trailing'] = array(
    '#type' => 'checkbox',
    '#title' => t('Append a separator to the end of the breadcrumb'),
    '#default_value' => theme_get_setting('basic_breadcrumb_trailing'),
    '#description' => t('Useful when the breadcrumb is placed just before the title.'),
  );
  $form['options_settings']['basic_breadcrumb']['basic_breadcrumb_title'] = array(
    '#type' => 'checkbox',
    '#title' => t('Append the content title to the end of the breadcrumb'),
    '#default_value' => theme_get_setting('basic_breadcrumb_title'),
    '#description' => t('Useful when the breadcrumb is not placed just before the title.'),
    '#suffix' => '</div>',
  );

  // IE specific settings.
  $form['options_settings']['basic_ie'] = array(
    '#type' => 'fieldset',
    '#title' => t('Internet Explorer Stylesheets'),
    '#attributes' => array('id' => 'basic-ie'),
  );
  $form['options_settings']['basic_ie']['basic_ie_enabled'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable Internet Explorer stylesheets in theme'),
    '#default_value' => theme_get_setting('basic_ie_enabled'),
    '#description' => t('If you check this box you can choose which IE stylesheets in theme get rendered on display.'),
  );
  $form['options_settings']['basic_ie']['basic_ie_enabled_css'] = array(
    '#type' => 'fieldset',
    '#title' => t('Check which IE versions you want to enable additional .css stylesheets for.'),
    '#states' => array(
      'visible' => array(
        ':input[name="basic_ie_enabled"]' => array('checked' => TRUE),
      ),
    ),
  );
  $form['options_settings']['basic_ie']['basic_ie_enabled_css']['basic_ie_enabled_versions'] = array(
    '#type' => 'checkboxes',
    '#options' => array(
      'ie8' => t('Internet Explorer 8'),
      'ie9' => t('Internet Explorer 9'),
    ),
    '#default_value' => theme_get_setting('basic_ie_enabled_versions'),
  );
  $form['options_settings']['clear_registry'] = array(
    '#type' => 'checkbox',
    '#title' => t('Rebuild theme registry on every page.'),
    '#description' => t('During theme development, it can be very useful to continuously <a href="@url">rebuild the theme registry</a>. WARNING: this is a huge performance penalty and must be turned off on production websites.', array('@url' => 'http://drupal.org/node/173880#theme-registry')),
    '#default_value' => theme_get_setting('clear_registry'),
  );

  //Pruebas de desarrollo
  //Pro Drupal 7 Development
  $form['styles'] = array(
       '#type' => 'fieldset',
       '#title' => t('Style settings'),
       '#collapsible' => FALSE,
       '#collapsed' => FALSE,
  );

  $form['styles']['font'] = array(
        '#type' => 'fieldset',
        '#title' => t('Font settings'),
        '#collapsible' => TRUE,
        '#collapsed' => TRUE,
  );


  $form['styles']['font']['font_family'] = array(
        '#type' => 'select',
        '#title' => t('Font family'),
        '#default_value' => theme_get_setting('font_family'),
        '#options' => array(
        'ff-sss' => t('Helvetica Nueue, Trebuchet MS, Arial, Nimbus Sans L, FreeSans, sans-serif'),
          'ff-ssl' => t('Verdana, Geneva, Arial, Helvetica, sans-serif'),
          'ff-a'   => t('Arial, Helvetica, sans-serif'),
          'ff-ss'  => t('Garamond, Perpetua, Nimbus Roman No9 L, Times New Roman, serif'),
          'ff-sl'  => t('Baskerville, Georgia, Palatino, Palatino Linotype, Book Antiqua, URW Palladio L, serif'),
          'ff-m'   => t('Myriad Pro, Myriad, Arial, Helvetica, sans-serif'),
          'ff-l'   => t('Lucida Sans, Lucida Grande, Lucida Sans Unicode, Verdana, Geneva, sans-serif'),
         ),
  );

  $form['styles']['font']['font_size'] = array(
        '#type' => 'select',
        '#title' => t('Font size'),
        '#default_value' => theme_get_setting('font_size'),
        '#description' => t('Font sizes are always set in relative units - the sizes shown are the pixel value equivalent.'),
        '#options' => array(
           'fs-10' => t('10px'),
           'fs-11' => t('11px'),
           'fs-12' => t('12px'),
           'fs-13' => t('13px'),
           'fs-14' => t('14px'),
           'fs-15' => t('15px'),
           'fs-16' => t('16px'),
        ),
  );




}
