<?php

namespace Drupal\event_registration\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;

class RegistrationForm extends FormBase {

  public function getFormId() {
    return 'event_registration_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Your Name'),
      '#required' => TRUE,
    ];

    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Your Email'),
      '#required' => TRUE,
    ];

    $form['event'] = [
      '#type' => 'entity_autocomplete',
      '#title' => $this->t('Select Event'),
      '#target_type' => 'node',
      '#selection_handler' => 'default',
      '#selection_settings' => ['target_bundles' => ['event']],
      '#required' => TRUE,
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Register'),
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    $event = Node::load($values['event']);

    if ($event) {
      // Save the registration (could use custom entities for scalability).
      \Drupal::messenger()->addMessage($this->t('You have registered for %event.', ['%event' => $event->getTitle()]));
    }
  }
}
