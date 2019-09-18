<?php
/**
 * @file
 * Contains \Drupal\internet_reception\Form\DemoForm.
 */

namespace Drupal\internet_reception\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;


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
    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Your Name.'),
      '#maxlength' => 255,
      '#required' => TRUE,
    );

    $form['year'] = array(
      '#type' => 'number',
      '#title' => $this->t('Your Year.'),
      '#min' => 1,
      '#max' => 99,
      '#required' => TRUE,
    );

    $form['email'] = array(
      '#type' => 'email',
      '#title' => $this->t('Your email address.'),
      '#required' => TRUE,
    );

    $form['subject'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Your subject.'),
      '#maxlength' => 255,
      '#required' => TRUE,
    );

    $form['message'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Your message.'),
      '#required' => TRUE,
    );

    $form['captcha'] = array(
      '#type' => 'captcha',
      '#title' => $this->t('Captcha'),
      '#captcha_type' => 'captcha/Math',
    );

    $form['actions'] = [
      '#type' => 'actions',
    ];

    $form['actions']['show'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    );

    return $form;
  }

  /**
   * @param array $form
   * @param FormStateInterface $form_state
   */
  public function validateForm(array &$form, FormStateInterface $form_state)
  {
    parent::validateForm($form, $form_state);

    $name = $form_state->getValue('name');
    $years = $form_state->getValue('year');
    $subject = $form_state->getValue('subject');
    $message = $form_state->getValue('message');

    if(strlen($name) < 3) {
      $form_state->setErrorByName('name', $this->t('The name must be at least 3 characters long.'));
    }
    if (empty($years)) {
      $form_state->setErrorByName('year', $this->t('Your must be enter.'));
    }
    if (strlen($subject) < 10) {
      $form_state->setErrorByName('subject', $this->t('The subject must be at least 10 characters long.'));
    }
    if (strlen($message) < 3) {
      $form_state->setErrorByName('message', $this->t('The message must be at least 3 characters long.'));
    }
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
      drupal_set_message($this->t('There was a problem sending your message'), 'error');
    }
    else {
      $messenger->addMessage('Ваша тема сообщения: '.$form_state->getValue('subject').', успешно отправлена!');
      $messenger->addMessage('Ожидайте ответа.');
    }
  }
}
