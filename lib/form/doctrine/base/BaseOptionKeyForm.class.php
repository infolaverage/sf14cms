<?php

/**
 * OptionKey form base class.
 *
 * @method OptionKey getObject() Returns the current form's model object
 *
 * @package    s14cms
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
abstract class BaseOptionKeyForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'class_type'    => new sfWidgetFormInputText(),
      'type'          => new sfWidgetFormInputText(),
      'name'          => new sfWidgetFormInputText(),
      'label'         => new sfWidgetFormInputText(),
      'k_group'       => new sfWidgetFormInputText(),
      'is_required'   => new sfWidgetFormInputCheckbox(),
      'variable_type' => new sfWidgetFormInputText(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'class_type'    => new sfValidatorString(array('max_length' => 255)),
      'type'          => new sfValidatorString(array('max_length' => 255)),
      'name'          => new sfValidatorString(array('max_length' => 255)),
      'label'         => new sfValidatorString(array('max_length' => 255)),
      'k_group'       => new sfValidatorInteger(array('required' => false)),
      'is_required'   => new sfValidatorBoolean(array('required' => false)),
      'variable_type' => new sfValidatorString(array('max_length' => 63, 'required' => false)),
      'created_at'    => new sfValidatorDateTime(),
      'updated_at'    => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('option_key[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'OptionKey';
  }

}
