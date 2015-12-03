<?php

/**
 * Site form base class.
 *
 * @method Site getObject() Returns the current form's model object
 *
 * @package    s14cms
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
abstract class BaseSiteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'name'             => new sfWidgetFormInputText(),
      'domain'           => new sfWidgetFormInputText(),
      'domain_alias'     => new sfWidgetFormTextarea(),
      'domain_dev'       => new sfWidgetFormInputText(),
      'domain_dev_alias' => new sfWidgetFormTextarea(),
      'is_active'        => new sfWidgetFormInputCheckbox(),
      'is_demo'          => new sfWidgetFormInputCheckbox(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'domain'           => new sfValidatorString(array('max_length' => 255)),
      'domain_alias'     => new sfValidatorString(array('required' => false)),
      'domain_dev'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'domain_dev_alias' => new sfValidatorString(array('required' => false)),
      'is_active'        => new sfValidatorBoolean(array('required' => false)),
      'is_demo'          => new sfValidatorBoolean(array('required' => false)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('site[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Site';
  }

}
