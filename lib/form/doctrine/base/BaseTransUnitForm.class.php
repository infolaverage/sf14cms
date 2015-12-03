<?php

/**
 * TransUnit form base class.
 *
 * @method TransUnit getObject() Returns the current form's model object
 *
 * @package    s14cms
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
abstract class BaseTransUnitForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'msg_id'        => new sfWidgetFormInputHidden(),
      'cat_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Catalogue'), 'add_empty' => true)),
      'source'        => new sfWidgetFormTextarea(),
      'target'        => new sfWidgetFormTextarea(),
      'comments'      => new sfWidgetFormInputText(),
      'date_added'    => new sfWidgetFormInputText(),
      'date_modified' => new sfWidgetFormInputText(),
      'author'        => new sfWidgetFormInputText(),
      'translated'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'msg_id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('msg_id')), 'empty_value' => $this->getObject()->get('msg_id'), 'required' => false)),
      'cat_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Catalogue'), 'column' => 'cat_id', 'required' => false)),
      'source'        => new sfValidatorString(array('required' => false)),
      'target'        => new sfValidatorString(array('required' => false)),
      'comments'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'date_added'    => new sfValidatorInteger(array('required' => false)),
      'date_modified' => new sfValidatorInteger(array('required' => false)),
      'author'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'translated'    => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('trans_unit[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TransUnit';
  }

}
