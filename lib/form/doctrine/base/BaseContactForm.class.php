<?php

/**
 * Contact form base class.
 *
 * @method Contact getObject() Returns the current form's model object
 *
 * @package    s14cms
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
abstract class BaseContactForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'site_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Site'), 'add_empty' => true)),
      'mail'        => new sfWidgetFormInputText(),
      'name'        => new sfWidgetFormInputText(),
      'phone'       => new sfWidgetFormInputText(),
      'message'     => new sfWidgetFormTextarea(),
      'attachment'  => new sfWidgetFormTextarea(),
      'ip_address'  => new sfWidgetFormInputText(),
      'sent_from'   => new sfWidgetFormInputText(),
      'client_info' => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'site_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Site'), 'column' => 'id', 'required' => false)),
      'mail'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'phone'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'message'     => new sfValidatorString(array('required' => false)),
      'attachment'  => new sfValidatorString(array('required' => false)),
      'ip_address'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'sent_from'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'client_info' => new sfValidatorPass(),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('contact[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Contact';
  }

}
