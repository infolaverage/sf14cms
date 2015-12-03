<?php

/**
 * SiteMenu filter form base class.
 *
 * @package    s14cms
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id$
 */
abstract class BaseSiteMenuFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'site_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Site'), 'add_empty' => true)),
      'parent_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ParentMenu'), 'add_empty' => true)),
      'type'            => new sfWidgetFormFilterInput(),
      'text'            => new sfWidgetFormFilterInput(),
      'icon'            => new sfWidgetFormFilterInput(),
      'url'             => new sfWidgetFormFilterInput(),
      'url_predefined'  => new sfWidgetFormFilterInput(),
      'html_title'      => new sfWidgetFormFilterInput(),
      'is_highlighted'  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_target_blank' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_active'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'position'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'site_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Site'), 'column' => 'id')),
      'parent_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ParentMenu'), 'column' => 'id')),
      'type'            => new sfValidatorPass(array('required' => false)),
      'text'            => new sfValidatorPass(array('required' => false)),
      'icon'            => new sfValidatorPass(array('required' => false)),
      'url'             => new sfValidatorPass(array('required' => false)),
      'url_predefined'  => new sfValidatorPass(array('required' => false)),
      'html_title'      => new sfValidatorPass(array('required' => false)),
      'is_highlighted'  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_target_blank' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_active'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'position'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('site_menu_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SiteMenu';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'site_id'         => 'ForeignKey',
      'parent_id'       => 'ForeignKey',
      'type'            => 'Text',
      'text'            => 'Text',
      'icon'            => 'Text',
      'url'             => 'Text',
      'url_predefined'  => 'Text',
      'html_title'      => 'Text',
      'is_highlighted'  => 'Boolean',
      'is_target_blank' => 'Boolean',
      'is_active'       => 'Boolean',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
      'position'        => 'Number',
    );
  }
}
