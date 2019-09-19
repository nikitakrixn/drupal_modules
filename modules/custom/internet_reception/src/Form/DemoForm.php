<?php

namespace Drupal\internet_reception\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Displays the settings form.
 */
class DemoForm extends FormBase
{

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
  public function getFormId()
  {
    return 'demo_form';
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
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Your Name.'),
      '#maxlength' => 255,
      '#required' => TRUE,
    ];

    $form['year'] = [
      '#type' => 'number',
      '#title' => $this->t('Your Year.'),
      '#min' => 1,
      '#max' => 99,
      '#required' => TRUE,
    ];

    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Your email address.'),
      '#required' => TRUE,
    ];

    $form['subject'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Your subject.'),
      '#maxlength' => 255,
      '#required' => TRUE,
    ];

    $form['message'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Your message.'),
      '#required' => TRUE,
    ];

    $form['captcha'] = [
      '#type' => 'captcha',
      '#title' => $this->t('Captcha'),
      '#captcha_type' => 'captcha/Math',
    ];

    $form['actions'] = [
      '#type' => 'actions',
    ];

    $form['actions']['show'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

    /**
   * Form submission handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $name = $form_state->getValue('name');
    $years = $form_state->getValue('year');
    $subject = $form_state->getValue('subject');
    $email = $form_state->getValue('email');
    $message = $form_state->getValue('message');

    $mailManager = \Drupal::service('plugin.manager.mail');
    $messenger = \Drupal::messenger();
    $config = \Drupal::config('system.site');

    $module = 'internet_reception';

    $key = 'internet_reception_submit';

    $to = $config->get('mail');

    $params['name'] = $name;
    $params['years'] = $years;
    $params['subject'] = $subject;
    $params['message'] = $message;

    $langcode = \Drupal::languageManager()->getDefaultLanguage();

    $send = TRUE;

    $result = $mailManager->mail($module, $key, $to, $langcode, $params, $email, $send);

    if ($result['result'] !== true) {
      $messenger->addMessage($this->t('There was a problem sending your message'), 'error');
    }
    else {
      $messenger->addMessage($this->t('Your message subject ' . $subject . ', sent successfully!'));
      $messenger->addMessage($this->t('Expect an answer.'));
    }
  }
}
