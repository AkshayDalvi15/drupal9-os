<?php
/**
 * @file
 * Contains \Drupal\boom\Plugin\Field\FieldType\boomitem.
 */

namespace Drupal\boom\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'boom_item' field type.
 * 
 * @FieldType(
 *   id = "boom_item",
 *   label = @Translation("Boom Field Type"),
 *   description = @Translation("Description for Created boom field type"),
 *   category = @Translation("Text"),
 *   default_widget = "boom_widget",
 *   default_formatter = "boom_formatter",
 * )
 */

class Boomitem extends FieldItemBase {
  
  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition){
    return [
      'columns' => [
        'value' => [ 'type' => 'varchar', 'length' => '255',]
      ]
      ];
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultStorageSettings()
  {
    return [
      'length' => 255,
    ] + parent::defaultStorageSettings();  
  }

  /**
   * {@inheritdoc}
   */
  public function storageSettingsForm(array &$form, FormStateInterface $form_state, $has_data) {
    $element = [];
    $element['length'] = [
      '#type' => 'number',
      '#title' => t("Length of your text"),
      '#required' => TRUE,
      '#default_value' => $this->getSetting("Length"),
    ];
    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultFieldSettings() {
    return [
      'moreinfo' => "More info default value",
    ] + parent::defaultFieldSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function fieldSettingsForm(array $form, FormStateInterface $form_state) {
    $element = [];
    $element['moreinfo'] = [
      '#type' => 'textfield',
      '#title' => 'More information about this field',
      '#requirement' => TRUE,
      '#default_value' => $this->getSetting("moreinfo"),
    ];
    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition)
  {
    $properties['value'] = DataDefinition::create('string')->setLabel(t("Name"));
  }
}
