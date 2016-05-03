<?php

/**
 * @file
 * Contains \Drupal\time_duration\Controller\TimeDurationController.
 */

namespace Drupal\time_duration\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for dblog routes.
 */
class TimeDurationController extends ControllerBase {

  /**
   * A simple page to explain to the developer what to do.
   */
  public function description() {
    return array(
      '#markup' => t(
        "The Field Duration provides a field composed of an time value, like 06:31. To use it, add the field to a content type."),
    );
  }

}
