<?php

/**
 * Reference form base class.
 *
 * @method Reference getObject() Returns the current form's model object
 *
 * @package    s14cms
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
abstract class BaseReferenceForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'site_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Site'), 'add_empty' => true)),
      'title_general'    => new sfWidgetFormInputText(),
      'title'            => new sfWidgetFormInputText(),
      'filename'         => new sfWidgetFormInputText(),
      'video'            => new sfWidgetFormTextarea(),
      'description'      => new sfWidgetFormTextarea(),
      'content'          => new sfWidgetFormTextarea(),
      'is_active'        => new sfWidgetFormInputCheckbox(),
      'html_title'       => new sfWidgetFormTextarea(),
      'meta_title'       => new sfWidgetFormTextarea(),
      'meta_description' => new sfWidgetFormTextarea(),
      'meta_keywords'    => new sfWidgetFormTextarea(),
      'meta_robots'      => new sfWidgetFormInputText(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
      'slug'             => new sfWidgetFormInputText(),
      'position'         => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'site_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Site'), 'column' => 'id', 'required' => false)),
      'title_general'    => new sfValidatorString(array('max_length' => 255)),
      'title'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'filename'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'video'            => new sfValidatorString(array('max_length' => 511, 'required' => false)),
      'description'      => new sfValidatorString(array('required' => false)),
      'content'          => new sfValidatorString(array('required' => false)),
      'is_active'        => new sfValidatorBoolean(array('required' => false)),
      'html_title'       => new sfValidatorString(array('max_length' => 1023, 'required' => false)),
      'meta_title'       => new sfValidatorString(array('max_length' => 1023, 'required' => false)),
      'meta_description' => new sfValidatorString(array('required' => false)),
      'meta_keywords'    => new sfValidatorString(array('required' => false)),
      'meta_robots'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
      'slug'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'position'         => new sfValidatorInteger(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Reference', 'column' => array('position', 'site_id')))
    );

    $this->widgetSchema->setNameFormat('reference[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Reference';
  }

}
