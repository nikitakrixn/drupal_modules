<?php


namespace Drupal\discount_code\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * An Info Page controller.
 */
class InfoController extends ControllerBase {

  /**
   * Returns a render-able array for a info page.
   */
  public function info() {
    $token = \Drupal::token();
    $message = $token->replace('Hello, your name is [current-user:account-name]. Your discount code is [discount_code:code].');
    $build = [
      '#markup' => $this->t($message),
    ];
    return $build;
  }

}
