<?php

/**
 * SiteSetting filter form base class.
 *
 * @package    s14cms
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id$
 */
abstract class BaseSiteSettingFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'site_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Site'), 'add_empty' => true)),
      'option_key_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('OptionKey'), 'add_empty' => true)),
      's_value'       => new sfWidgetFormFilterInput(),
      'lang'          => new sfWidgetFormFilterInput(),
      'is_active'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'priority'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_read_only'  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'site_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Site'), 'column' => 'id')),
      'option_key_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('OptionKey'), 'column' => 'id')),
      's_value'       => new sfValidatorPass(array('required' => false)),
      'lang'          => new sfValidatorPass(array('required' => false)),
      'is_active'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'priority'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'is_read_only'  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('site_setting_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SiteSetting';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'site_id'       => 'ForeignKey',
      'option_key_id' => 'ForeignKey',
      's_value'       => 'Text',
      'lang'          => 'Text',
      'is_active'     => 'Boolean',
      'priority'      => 'Number',
      'is_read_only'  => 'Boolean',
      'created_at'    => 'Date',
      'updated_at'    => 'Date',
    );
  }
}
