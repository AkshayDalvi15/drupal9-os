<?php

namespace Drupal\boom\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'boom' field formatter.
 * 
 * @FieldFormatter(
 *   id = "boom_formatter",
 *   label = @Translation("Boom Formatter"),
 *   description = @Translation("Description for Created Boom Field Formatter"),
 *   field_types = {
 *     "boom_item" 
 *   }
 * )
 */

 class BoomFormatter extends FormatterBase {
  
  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      'concat' => 'Concat with',
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $form['concat'] = [
      '#type' => 'textfield',
      '#title' => 'Concatenate with',
      '#deafult_value' => $this->getSetting('concat'),
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    $summary[] = $this->t("concatenate with : @concat", ["@concat" => $this->getSetting('concat')]);
    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode)
  {
    $element = [];

    foreach ( $items as $delta => $item ) {
      $element[$delta] = [
        '#markup' => $this->getSetting('concat') . $item->value,
      ];
    }
    return $element;
  }
 }
