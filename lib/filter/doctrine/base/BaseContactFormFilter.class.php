<?php

/**
 * Contact filter form base class.
 *
 * @package    s14cms
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id$
 */
abstract class BaseContactFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'site_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Site'), 'add_empty' => true)),
      'mail'        => new sfWidgetFormFilterInput(),
      'name'        => new sfWidgetFormFilterInput(),
      'phone'       => new sfWidgetFormFilterInput(),
      'message'     => new sfWidgetFormFilterInput(),
      'attachment'  => new sfWidgetFormFilterInput(),
      'ip_address'  => new sfWidgetFormFilterInput(),
      'sent_from'   => new sfWidgetFormFilterInput(),
      'client_info' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'site_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Site'), 'column' => 'id')),
      'mail'        => new sfValidatorPass(array('required' => false)),
      'name'        => new sfValidatorPass(array('required' => false)),
      'phone'       => new sfValidatorPass(array('required' => false)),
      'message'     => new sfValidatorPass(array('required' => false)),
      'attachment'  => new sfValidatorPass(array('required' => false)),
      'ip_address'  => new sfValidatorPass(array('required' => false)),
      'sent_from'   => new sfValidatorPass(array('required' => false)),
      'client_info' => new sfValidatorPass(array('required' => false)),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('contact_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Contact';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'site_id'     => 'ForeignKey',
      'mail'        => 'Text',
      'name'        => 'Text',
      'phone'       => 'Text',
      'message'     => 'Text',
      'attachment'  => 'Text',
      'ip_address'  => 'Text',
      'sent_from'   => 'Text',
      'client_info' => 'Text',
      'created_at'  => 'Date',
      'updated_at'  => 'Date',
    );
  }
}
