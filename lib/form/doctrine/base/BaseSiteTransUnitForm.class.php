<?php

/**
 * SiteTransUnit form base class.
 *
 * @method SiteTransUnit getObject() Returns the current form's model object
 *
 * @package    s14cms
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
abstract class BaseSiteTransUnitForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'msg_id'     => new sfWidgetFormInputHidden(),
      'site_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Site'), 'add_empty' => false)),
      'cat_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Catalogue'), 'add_empty' => false)),
      'source'     => new sfWidgetFormTextarea(),
      'target'     => new sfWidgetFormTextarea(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'msg_id'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('msg_id')), 'empty_value' => $this->getObject()->get('msg_id'), 'required' => false)),
      'site_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Site'), 'column' => 'id')),
      'cat_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Catalogue'), 'column' => 'cat_id')),
      'source'     => new sfValidatorString(array('required' => false)),
      'target'     => new sfValidatorString(array('required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('site_trans_unit[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SiteTransUnit';
  }

}
