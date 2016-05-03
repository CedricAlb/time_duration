<?php

/**
 * @file
 * Contains \Drupal\time_duration\Plugin\Field\FieldWidget\TimeDurationWidget.
 */

namespace Drupal\time_duration\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Markup;

/**
 * Plugin implemetation for TimeDuration widget
 *
 * @FieldWidget(
 *   id = "field_time_duration_widget",
 *   label = @Translation("Time Duration Widget"),
 *   field_types = {
 *     "field_time_duration_time"
 *   }
 * )
 *
 */

class TimeDurationWidget extends WidgetBase { //implements WidgetInterface 
    
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
   
    $value = isset($items[$delta]->value) ? $items[$delta]->value : ''; 
// TODO more elegant like above... but for some reason not working as expected  
//  $spinners = new Markup();
//  $spinners->create('<input id="hours" name="value" value=0 size=3/>:<input id="minutes" name="value" value=0  size=2/>'); 
// error_log(print_r($spinners->jsonSerialize(),true));
     
   //error_log(print_r($element,true));

   $element += array(
      '#type' => 'textfield',
      '#id' => 'time_duration',
      '#allowed_tags' =>array('input'),
      //'#suffix' => \Drupal\Core\Render\Markup::create('<input id="hours" name="value" value=0 size=3/>:<input id="minutes" name="value" value=0  size=2/>'),
      '#suffix' => Markup::create('<input id="hours" name="value" value=0 size=3/>:<input id="minutes" name="value" value=0  size=2/>'),
      // '#suffix' => $spinners, 
       
      '#default_value' => $value,
      '#size' => 5,
      '#maxlength' => 5,
      '#element_validate' => array(
        array($this, 'validate'),
      ),
      '#attached' => array(
        'library' => array(
          'time_duration/spinners',
        ),
      ),
     '#attributes' => array(
        'id' => 'time_duration',
        'style' => 'display:none',
        'class' => array('edit-field-duration-time'),
     ), 
    );
    
    return array('value' => $element);
  }

  /**
   * Validate the timeduration text field.
   */
  public function validate($element, FormStateInterface $form_state) {
    $value = $element['#value'];
    if (strlen($value) == 0) {
      $form_state->setValueForElement($element, '');
      return;
    }
    if (!preg_match('/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/iD', strtolower($value))) {//TODO time duration longer ie 1 day 23 hours 59 min
      $form_state->setError($element, t("Time duration must be a time value (min:sec) ie 06:31"));
    }
  }

}

