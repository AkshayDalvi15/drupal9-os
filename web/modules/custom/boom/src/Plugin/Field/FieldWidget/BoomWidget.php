<?php

namespace Drupal\boom\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'boom' field widget.
 * 
 * @FieldWidget(
 *   id = "boom_widget",
 *   label = @Translation("Boom Widget"),
 *   description = @Translation("Description for Created boom field widget"),
 *   field_types = {
 *     "boom_item" 
 *   }
 * )
 */

class BoomWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state)
  {
    $value = isset($items[$delta]->value) ? $items[$delta] : "";
    $element = $element + [
      '#type' => 'textfield',
      '#suffix' => "<span>" . $this->getFieldSetting("moreinfo") . "</span>",
      '#default_value' => $value,
      '#attributes' => [
        'placeholder' => $this->getSetting('placeholder'),
      ]
    ];
    return ['value' => $element];
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      'placeholder' => 'default',
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state)
  {
    $element['placeholder'] = [
      '#type' => 'textfield',
      '#title' => 'Placeholder text',
      '#default_value' => $this->getSetting('placeholder'),
    ];
    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary()
  {
    $summary = [];
    $summary[] = $this->t("placeholder text: @placeholder", array("@placeholder" => $this->getSetting("placeholder")));
    return $summary;
  }

}
