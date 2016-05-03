<?php

/**
 * @file
 * Contains Drupal\time_duration\Plugin\Field\FieldType\timeItem.
 */

namespace Drupal\time_duration\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'field_time_duration_time' field type.
 *
 * @FieldType(
 *   id = "field_time_duration_time",
 *   label = @Translation("Time Duration"),
 *   module = "time_duration",
 *   description = @Translation("Field composed of time duration."),
 *   default_widget = "field_time_duration_widget",
 *   default_formatter = "field_time_duration_formatter"
 * )
 */
class timeItem extends FieldItemBase {
  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return array(
      'columns' => array(
        'value' => array(
          'type' => 'text',
          'size' => 'tiny',
          'not null' => FALSE,
        ),
      ),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('value')->getValue();
    return $value === NULL || $value === '';
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['value'] = DataDefinition::create('string')
      ->setLabel(t('Duration value'));

    return $properties;
  }

}
