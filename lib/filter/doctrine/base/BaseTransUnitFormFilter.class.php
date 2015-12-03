<?php

/**
 * TransUnit filter form base class.
 *
 * @package    s14cms
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id$
 */
abstract class BaseTransUnitFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'cat_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Catalogue'), 'add_empty' => true)),
      'source'        => new sfWidgetFormFilterInput(),
      'target'        => new sfWidgetFormFilterInput(),
      'comments'      => new sfWidgetFormFilterInput(),
      'date_added'    => new sfWidgetFormFilterInput(),
      'date_modified' => new sfWidgetFormFilterInput(),
      'author'        => new sfWidgetFormFilterInput(),
      'translated'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'cat_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Catalogue'), 'column' => 'cat_id')),
      'source'        => new sfValidatorPass(array('required' => false)),
      'target'        => new sfValidatorPass(array('required' => false)),
      'comments'      => new sfValidatorPass(array('required' => false)),
      'date_added'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'date_modified' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'author'        => new sfValidatorPass(array('required' => false)),
      'translated'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('trans_unit_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TransUnit';
  }

  public function getFields()
  {
    return array(
      'msg_id'        => 'Number',
      'cat_id'        => 'ForeignKey',
      'source'        => 'Text',
      'target'        => 'Text',
      'comments'      => 'Text',
      'date_added'    => 'Number',
      'date_modified' => 'Number',
      'author'        => 'Text',
      'translated'    => 'Number',
    );
  }
}
