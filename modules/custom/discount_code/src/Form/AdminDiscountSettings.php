<?php

namespace Drupal\discount_code\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Admin settings form of the module.
 */
class AdminDiscountSettings extends ConfigFormBase {

  /**
   * Config settings.
   *
   * @var string
   */
  const SETTINGS = 'discount_code.settings';

  /**
   * Gets the configuration names that will be editable.
   *
   * @return array
   *   An array of configuration object names that are editable if called in
   *   conjunction with the trait's config() method.
   */
  protected function getEditableConfigNames() {
    return [
      static::SETTINGS,
    ];
  }

  /**
   * Returns a unique string identifying the form.
   *
   * The returned ID should be a unique string that can be a valid PHP function
   * name, since it's used in hook implementation names such as
   * hook_form_FORM_ID_alter().
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'discount_code_settings_form';
  }

  /**
   * Form constructor.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return array
   *   The form structure.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config(static::SETTINGS);

    $settings = $config->get();

    $form['message'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Welcome message'),
      '#description' => $this->t('For show username use %username and for discount code use %discount_code.'),
      '#default_value' => $settings['message'],
      '#size' => 20,
      '#maxlength' => 350,
      '#required' => TRUE,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * Form submission handler.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config(static::SETTINGS);
    $config->set('message', $form_state->getValue('message'))
      ->save();

    parent::submitForm($form,$form_state);
  }
}
