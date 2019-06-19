<?php

namespace Drupal\giphy_formatter\Plugin\Field\FieldFormatter;

use Drupal\Component\Utility\Html;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Serialization\Json;

/**
 * Plugin implementation of the 'giphy_field_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "giphy_field_formatter",
 *   label = @Translation("Giphy Formatter"),
 *   field_types = {
 *     "text"
 *   }
 * )
 */
class GiphyFieldFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      // Implement default settings.
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    return [
      // Implement settings form.
    ] + parent::settingsForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    // Implement settings summary.

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];

    foreach ($items as $delta => $item) {
	  $data = file_get_contents('https://api.giphy.com/v1/gifs/random?api_key=czHkbEHDAKaLFTHLKlNPizuULzF1nKQ7&tag=&rating=G');
	  $decoded = json_decode($data, TRUE);
	  $giphy_link = $decoded['data']['images']['fixed_width']['url'];
      $elements[$delta] = [
        '#theme' => 'image',
        '#uri' => $giphy_link,
      ];
    }
	
	

    return $elements;
  }

  /**
   * Generate the output appropriate for one field item.
   *
   * @param \Drupal\Core\Field\FieldItemInterface $item
   *   One field item.
   *
   * @return string
   *   The textual output generated.
   */
  protected function viewValue(FieldItemInterface $item) {
    // The text value has no text format assigned to it, so the user input
    // should equal the output, including newlines.
    return nl2br(Html::escape($item->value));
  }

}
