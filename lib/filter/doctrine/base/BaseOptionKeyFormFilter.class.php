<?php

/**
 * OptionKey filter form base class.
 *
 * @package    s14cms
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id$
 */
abstract class BaseOptionKeyFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'class_type'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'type'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'name'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'label'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'k_group'       => new sfWidgetFormFilterInput(),
      'is_required'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'variable_type' => new sfWidgetFormFilterInput(),
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'class_type'    => new sfValidatorPass(array('required' => false)),
      'type'          => new sfValidatorPass(array('required' => false)),
      'name'          => new sfValidatorPass(array('required' => false)),
      'label'         => new sfValidatorPass(array('required' => false)),
      'k_group'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'is_required'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'variable_type' => new sfValidatorPass(array('required' => false)),
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('option_key_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'OptionKey';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'class_type'    => 'Text',
      'type'          => 'Text',
      'name'          => 'Text',
      'label'         => 'Text',
      'k_group'       => 'Number',
      'is_required'   => 'Boolean',
      'variable_type' => 'Text',
      'created_at'    => 'Date',
      'updated_at'    => 'Date',
    );
  }
}
