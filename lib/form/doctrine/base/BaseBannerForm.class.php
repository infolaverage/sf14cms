<?php

/**
 * Banner form base class.
 *
 * @method Banner getObject() Returns the current form's model object
 *
 * @package    s14cms
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
abstract class BaseBannerForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'site_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Site'), 'add_empty' => false)),
      'display_type'    => new sfWidgetFormInputText(),
      'url'             => new sfWidgetFormTextarea(),
      'url_predefined'  => new sfWidgetFormTextarea(),
      'filename'        => new sfWidgetFormInputText(),
      'html_alt'        => new sfWidgetFormInputText(),
      'html_title'      => new sfWidgetFormInputText(),
      'title'           => new sfWidgetFormInputText(),
      'head_title'      => new sfWidgetFormInputText(),
      'head_text'       => new sfWidgetFormTextarea(),
      'head_icon'       => new sfWidgetFormTextarea(),
      'description'     => new sfWidgetFormTextarea(),
      'content'         => new sfWidgetFormTextarea(),
      'template'        => new sfWidgetFormInputText(),
      'custom_code'     => new sfWidgetFormTextarea(),
      'is_target_blank' => new sfWidgetFormInputCheckbox(),
      'is_active'       => new sfWidgetFormInputCheckbox(),
      'show_title'      => new sfWidgetFormInputCheckbox(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
      'position'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'site_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Site'), 'column' => 'id')),
      'display_type'    => new sfValidatorInteger(array('required' => false)),
      'url'             => new sfValidatorString(array('required' => false)),
      'url_predefined'  => new sfValidatorString(array('required' => false)),
      'filename'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'html_alt'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'html_title'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'title'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'head_title'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'head_text'       => new sfValidatorString(array('required' => false)),
      'head_icon'       => new sfValidatorString(array('required' => false)),
      'description'     => new sfValidatorString(array('required' => false)),
      'content'         => new sfValidatorString(array('required' => false)),
      'template'        => new sfValidatorInteger(array('required' => false)),
      'custom_code'     => new sfValidatorString(array('required' => false)),
      'is_target_blank' => new sfValidatorBoolean(array('required' => false)),
      'is_active'       => new sfValidatorBoolean(array('required' => false)),
      'show_title'      => new sfValidatorBoolean(array('required' => false)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
      'position'        => new sfValidatorInteger(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Banner', 'column' => array('position', 'site_id', 'display_type')))
    );

    $this->widgetSchema->setNameFormat('banner[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Banner';
  }

}
