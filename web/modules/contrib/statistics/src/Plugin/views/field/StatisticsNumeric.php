<?php

namespace Drupal\statistics\Plugin\views\field;

use Drupal\Core\Session\AccountInterface;
use Drupal\views\Attribute\ViewsField;
use Drupal\views\Plugin\views\field\NumericField;

/**
 * Field handler to display numeric values from the statistics module.
 *
 * @ingroup views_field_handlers
 */
#[ViewsField("statistics_numeric")]
class StatisticsNumeric extends NumericField {

  /**
   * {@inheritdoc}
   */
  public function access(AccountInterface $account) {
    return $account->hasPermission('view post access counter');
  }

}
