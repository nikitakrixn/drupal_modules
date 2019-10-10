<?php


namespace Drupal\discount_code\Controller;

use Drupal\Core\Controller\ControllerBase;


class InfoController extends ControllerBase {

  public function info() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Next info page/'),
    ];
  }

}
