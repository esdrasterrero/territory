<?php
namespace Drupal\leaflet_easyprint\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\leaflet\Plugin\Field\FieldFormatter\LeafletDefaultFormatter;

/**
 * Plugin implementation of the 'leaflet_default' formatter.
 *
 * @FieldFormatter(
 *   id = "leaflet_formatter_easyprint",
 *   label = @Translation("Leaflet Map With EasyPrint"),
 *   field_types = {
 *     "geofield"
 *   }
 * )
 */

class EasyprintLeafletFormatter extends LeafletDefaultFormatter {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    $settings = parent::defaultSettings();
    $settings['easyprint_width'] = 100;
    $settings['easyprint_height'] = 100;
    $settings['easyprint_export'] = 0;

    return $settings;
  }

  /**
   * {@inheritDoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {

    $form['#tree'] = TRUE;
    $settings = $this->getSettings();
    $elements = parent::settingsForm($form, $form_state);

    $elements['easyprint_width'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Easyprint custom width'),
      '#description' => $this->t('Define a set width for the easyprint image'),
      '#default_value' => $settings['easyprint_width'],
    ];
    $elements['easyprint_height'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Easyprint custom height'),
      '#description' => $this->t('Define a set width for the easyprint image'),
      '#default_value' => $settings['easyprint_height'],
    ];
    $elements['easyprint_export'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Easyprint Export setting'),
      '#description' => $this->t('Enable export only mode. This downloads the map to a PNG file.'),
      '#default_value' => $settings['easyprint_export'],
    ];

    return $elements;
  }

  /**
   * {@inheritDoc}
   */
  public function settingsSummary() {
    $summary = parent::settingsSummary();
    $summary[] = $this->t('EasyPrint width: @width', ['@width' => $this->getSetting('easyprint_width')]);
    $summary[] = $this->t('EasyPrint height: @height', ['@height' => $this->getSetting('easyprint_height')]);
    $summary[] = $this->t('EasyPrint export only: @exportonly', ['@exportonly' => $this->getSetting('easyprint_export')]);

    return $summary;
  }

  /**
   * {@inheritdoc}
   *
   * This function is called from parent::view().
   */
  public function viewElements(FieldItemListInterface $items, $langcode): array {
    $element = parent::viewElements($items, $langcode);
    $element['#attached']['drupalSettings']['leaflet']['easyPrint']['easyprint_width'] = $this->getSetting('easyprint_width');
    $element['#attached']['drupalSettings']['leaflet']['easyPrint']['easyprint_height'] = $this->getSetting('easyprint_height');
    $element['#attached']['drupalSettings']['leaflet']['easyPrint']['easyprint_export'] = $this->getSetting('easyprint_export');

    return $element;
  }
}
