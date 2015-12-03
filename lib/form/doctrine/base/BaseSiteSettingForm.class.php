<?php

/**
 * SiteSetting form base class.
 *
 * @method SiteSetting getObject() Returns the current form's model object
 *
 * @package    s14cms
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
abstract class BaseSiteSettingForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'site_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Site'), 'add_empty' => true)),
      'option_key_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('OptionKey'), 'add_empty' => false)),
      's_value'       => new sfWidgetFormTextarea(),
      'lang'          => new sfWidgetFormInputText(),
      'is_active'     => new sfWidgetFormInputCheckbox(),
      'priority'      => new sfWidgetFormInputText(),
      'is_read_only'  => new sfWidgetFormInputCheckbox(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'site_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Site'), 'column' => 'id', 'required' => false)),
      'option_key_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('OptionKey'), 'column' => 'id')),
      's_value'       => new sfValidatorString(array('required' => false)),
      'lang'          => new sfValidatorString(array('max_length' => 2, 'required' => false)),
      'is_active'     => new sfValidatorBoolean(array('required' => false)),
      'priority'      => new sfValidatorInteger(array('required' => false)),
      'is_read_only'  => new sfValidatorBoolean(array('required' => false)),
      'created_at'    => new sfValidatorDateTime(),
      'updated_at'    => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('site_setting[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SiteSetting';
  }

}
