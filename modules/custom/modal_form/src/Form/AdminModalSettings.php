<?php

namespace Drupal\modal_form\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Admin settings form of the module.
 */
class AdminModalSettings extends ConfigFormBase {

  /**
   * Config settings.
   *
   * @var string
   */
  const SETTINGS = 'modal_form.settings';

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
    return 'modal_form_settings_admin';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config(static::SETTINGS);

    $settings = $config->get();

    $form['width'] = [
      '#type' => 'number',
      '#title' => $this->t('The min-width of the modal window in pixels.'),
      '#min' => 100,
      '#max' => 1000,
      '#default_value' => $settings['width'],
      '#required' => TRUE,
    ];
    $form['height'] = [
      '#type' => 'number',
      '#title' => $this->t('The min-height of the modal window in pixels.'),
      '#min' => 50,
      '#max' => 1000,
      '#default_value' => $settings['height'],
      '#required' => TRUE,
    ];

    return parent::buildForm($form, $form_state);
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config(static::SETTINGS);
    $config->set('width', $form_state->getValue('width'))
      ->set('height', $form_state->getValue('height'))
      ->save();

    parent::submitForm($form,$form_state);
  }
}
