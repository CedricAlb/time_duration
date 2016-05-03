<?php

/**
 * @file
 * Contains \Drupal\time_duration\Plugin\Field\FieldFormatter\TimeDurationFormatter.
 */

namespace Drupal\time_duration\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'time_duration' formatter.
 *
 * @FieldFormatter(
 *   id = "field_time_duration_formatter",
 *   module = "time_duration",
 *   label = @Translation("Simple text-based time duration formatter"),
 *   field_types = {
 *     "field_time_duration_time"
 *   }
 * )
 */
class TimeDurationFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = array();


    foreach ($items as $delta => $item) {
      $elements[$delta] = array(
        '#type' => 'html_tag',
        '#tag' => 'p',
//        '#attributes' => array(
//          'style' => 'color: red',
//        ),
        '#value' => $this->t('@time', array('@time' => $item->value)),
      );
    }

    return $elements;
  }

}
