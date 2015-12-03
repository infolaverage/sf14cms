<?php

/**
 * Banner filter form base class.
 *
 * @package    s14cms
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id$
 */
abstract class BaseBannerFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'site_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Site'), 'add_empty' => true)),
      'display_type'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'url'             => new sfWidgetFormFilterInput(),
      'url_predefined'  => new sfWidgetFormFilterInput(),
      'filename'        => new sfWidgetFormFilterInput(),
      'html_alt'        => new sfWidgetFormFilterInput(),
      'html_title'      => new sfWidgetFormFilterInput(),
      'title'           => new sfWidgetFormFilterInput(),
      'head_title'      => new sfWidgetFormFilterInput(),
      'head_text'       => new sfWidgetFormFilterInput(),
      'head_icon'       => new sfWidgetFormFilterInput(),
      'description'     => new sfWidgetFormFilterInput(),
      'content'         => new sfWidgetFormFilterInput(),
      'template'        => new sfWidgetFormFilterInput(),
      'custom_code'     => new sfWidgetFormFilterInput(),
      'is_target_blank' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_active'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'show_title'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'position'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'site_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Site'), 'column' => 'id')),
      'display_type'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'url'             => new sfValidatorPass(array('required' => false)),
      'url_predefined'  => new sfValidatorPass(array('required' => false)),
      'filename'        => new sfValidatorPass(array('required' => false)),
      'html_alt'        => new sfValidatorPass(array('required' => false)),
      'html_title'      => new sfValidatorPass(array('required' => false)),
      'title'           => new sfValidatorPass(array('required' => false)),
      'head_title'      => new sfValidatorPass(array('required' => false)),
      'head_text'       => new sfValidatorPass(array('required' => false)),
      'head_icon'       => new sfValidatorPass(array('required' => false)),
      'description'     => new sfValidatorPass(array('required' => false)),
      'content'         => new sfValidatorPass(array('required' => false)),
      'template'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'custom_code'     => new sfValidatorPass(array('required' => false)),
      'is_target_blank' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_active'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'show_title'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'position'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('banner_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Banner';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'site_id'         => 'ForeignKey',
      'display_type'    => 'Number',
      'url'             => 'Text',
      'url_predefined'  => 'Text',
      'filename'        => 'Text',
      'html_alt'        => 'Text',
      'html_title'      => 'Text',
      'title'           => 'Text',
      'head_title'      => 'Text',
      'head_text'       => 'Text',
      'head_icon'       => 'Text',
      'description'     => 'Text',
      'content'         => 'Text',
      'template'        => 'Number',
      'custom_code'     => 'Text',
      'is_target_blank' => 'Boolean',
      'is_active'       => 'Boolean',
      'show_title'      => 'Boolean',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
      'position'        => 'Number',
    );
  }
}
