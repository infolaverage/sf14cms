<?php

/**
 * SiteMenu form base class.
 *
 * @method SiteMenu getObject() Returns the current form's model object
 *
 * @package    s14cms
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
abstract class BaseSiteMenuForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'site_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Site'), 'add_empty' => false)),
      'parent_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ParentMenu'), 'add_empty' => true)),
      'type'            => new sfWidgetFormInputText(),
      'text'            => new sfWidgetFormInputText(),
      'icon'            => new sfWidgetFormTextarea(),
      'url'             => new sfWidgetFormTextarea(),
      'url_predefined'  => new sfWidgetFormTextarea(),
      'html_title'      => new sfWidgetFormTextarea(),
      'is_highlighted'  => new sfWidgetFormInputCheckbox(),
      'is_target_blank' => new sfWidgetFormInputCheckbox(),
      'is_active'       => new sfWidgetFormInputCheckbox(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
      'position'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'site_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Site'), 'column' => 'id')),
      'parent_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ParentMenu'), 'column' => 'id', 'required' => false)),
      'type'            => new sfValidatorString(array('max_length' => 63, 'required' => false)),
      'text'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'icon'            => new sfValidatorString(array('required' => false)),
      'url'             => new sfValidatorString(array('max_length' => 1023, 'required' => false)),
      'url_predefined'  => new sfValidatorString(array('required' => false)),
      'html_title'      => new sfValidatorString(array('max_length' => 1023, 'required' => false)),
      'is_highlighted'  => new sfValidatorBoolean(array('required' => false)),
      'is_target_blank' => new sfValidatorBoolean(array('required' => false)),
      'is_active'       => new sfValidatorBoolean(array('required' => false)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
      'position'        => new sfValidatorInteger(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'SiteMenu', 'column' => array('position', 'parent_id')))
    );

    $this->widgetSchema->setNameFormat('site_menu[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SiteMenu';
  }

}
