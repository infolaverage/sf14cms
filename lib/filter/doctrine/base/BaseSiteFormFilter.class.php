<?php

/**
 * Site filter form base class.
 *
 * @package    s14cms
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id$
 */
abstract class BaseSiteFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'             => new sfWidgetFormFilterInput(),
      'domain'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'domain_alias'     => new sfWidgetFormFilterInput(),
      'domain_dev'       => new sfWidgetFormFilterInput(),
      'domain_dev_alias' => new sfWidgetFormFilterInput(),
      'is_active'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_demo'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'name'             => new sfValidatorPass(array('required' => false)),
      'domain'           => new sfValidatorPass(array('required' => false)),
      'domain_alias'     => new sfValidatorPass(array('required' => false)),
      'domain_dev'       => new sfValidatorPass(array('required' => false)),
      'domain_dev_alias' => new sfValidatorPass(array('required' => false)),
      'is_active'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_demo'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('site_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Site';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'name'             => 'Text',
      'domain'           => 'Text',
      'domain_alias'     => 'Text',
      'domain_dev'       => 'Text',
      'domain_dev_alias' => 'Text',
      'is_active'        => 'Boolean',
      'is_demo'          => 'Boolean',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
    );
  }
}
