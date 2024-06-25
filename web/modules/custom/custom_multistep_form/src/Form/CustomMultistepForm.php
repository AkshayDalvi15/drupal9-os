<?php

namespace Drupal\custom_multistep_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class CustomMultistepForm extends FormBase {


  public function getFormId() {
    return 'custom_multistep_form';
  }

  //  first page
  public function buildForm(array $form, FormStateInterface $form_state) {

    if($form_state->has("cpage") && $form_state->get("cpage") == 2) {
      return $this->secondForm($form, $form_state);
    }

    if($form_state->has("cpage") && $form_state->get("cpage") == 3) {
      return $this->thirdForm($form, $form_state);
    }

    $form_state->set("cpage", 1);

    $form['firstname'] = [
      '#type' => 'textfield',
      '#title' => 'First Name',
      '#default_value' => $form_state->getValue("firstname"),
    ];

    $form['lastname'] = [
      '#type' => 'textfield',
      '#title' => 'Last Name',
      '#default_value' => $form_state->getValue("lastname"),
    ];

    $form['firstnext'] = [
      '#type' => 'submit',
      '#value' => 'Next',
      '#submit' => ['::firstNext'],
    ];

    return $form;
  }

  public function firstNext(array $form, FormStateInterface $form_state) {

    $form_state->set("cpage", 2);
    $form_state->set("data", [
      'firstname' => $form_state->getValue("firstname"),
      'lastname' => $form_state->getValue("lastname"),
    ]);
    $form_state->setRebuild(TRUE);

  }

  //  Second page
  public function secondForm(array $form, FormStateInterface $form_state) {
    
    $form['mobilenumber'] = [
      '#type' => 'textfield',
      '#title' => 'Mobile Number',
      '#default_value' => $form_state->getValue("mobilenumber"),
    ];
    
    $form['email'] = [
      '#type' => 'textfield',
      '#title' => 'Email ID',
      '#default_value' => $form_state->getValue("email"),
    ];

    $form['secondnext'] = [
      '#type' => 'submit',
      '#value' => 'Next',
      '#submit' => ['::secondNext'],
    ];

    $form['secondback'] = [
      '#type' => 'submit',
      '#value' => 'Back',
      '#submit' => ['::secondBack'],
    ];

    return $form;
  }

  public function secondBack(array $form, FormStateInterface $form_state) {
    $form_state->setValues($form_state->get("data"));
    $form_state->set("cpage", 1);
    $form_state->setRebuild(TRUE);

  }

  public function secondNext(array $form, FormStateInterface $form_state) {
    $values = $form_state->get("data");

    $form_state->set("cpage", 3);
    $form_state->set("data", [
      'firstname' => $values['firstname'],
      'lastname' => $values['lastname'],
      'mobilenumber' => $form_state->getValue("mobilenumber"),
      'email' => $form_state->getValue("email"),
    ]);
    $form_state->setRebuild(TRUE);

  }


  //  Third page
  public function thirdForm(array $form, FormStateInterface $form_state) {
    $form['aadharnumber'] = [
      '#type' => 'textfield',
      '#title' => 'AAdhar Number',
    ];
    
    $form['pancard'] = [
      '#type' => 'textfield',
      '#title' => 'Pancard Number',
    ];

    $form['thirdback'] = [
      '#type' => 'submit',
      '#value' => 'Back',
      '#submit' => ['::thirdBack'],
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => 'Submit',
    ];

    return $form;
  }

  public function thirdBack(array $form, FormStateInterface $form_state) {
    $form_state->setValues($form_state->get("data"));
    $form_state->set("cpage", 2);
    $form_state->setRebuild(TRUE);

  }  

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $aadhar = $form_state->getValue("aadharnumber");
    $pancard = $form_state->getValue("pancard");
    $values = $form_state->get("data");
    $firstname = $values['firstname'];
    $lastname = $values['lastname'];
    $mobile = $values['mobilenumber'];
    $email = $values['email'];
    $this->messenger()->addMessage($this->t("The Form submitted successfullly with Name: @first @last, Mobile No: @mobile Email: @email Aadhar Card No: @aadhar Pancard No: @pancard", [
      '@first'=>$firstname, '@last'=>$lastname, '@mobile'=>$mobile, '@email'=>$email, '@aadhar'=>$aadhar, '@pancard'=>$pancard
    ]));
  }
  
}
