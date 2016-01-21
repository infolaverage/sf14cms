<?php

/**
 * QuoteTranslation filter form base class.
 *
 * @package    s14cms
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id$
 */
abstract class BaseQuoteTranslationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'            => new sfWidgetFormFilterInput(),
      'description'      => new sfWidgetFormFilterInput(),
      'content'          => new sfWidgetFormFilterInput(),
      'is_translated'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'author_name'      => new sfWidgetFormFilterInput(),
      'author_location'  => new sfWidgetFormFilterInput(),
      'author_url'       => new sfWidgetFormFilterInput(),
      'html_title'       => new sfWidgetFormFilterInput(),
      'meta_title'       => new sfWidgetFormFilterInput(),
      'meta_description' => new sfWidgetFormFilterInput(),
      'meta_keywords'    => new sfWidgetFormFilterInput(),
      'meta_robots'      => new sfWidgetFormFilterInput(),
      'slug'             => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'title'            => new sfValidatorPass(array('required' => false)),
      'description'      => new sfValidatorPass(array('required' => false)),
      'content'          => new sfValidatorPass(array('required' => false)),
      'is_translated'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'author_name'      => new sfValidatorPass(array('required' => false)),
      'author_location'  => new sfValidatorPass(array('required' => false)),
      'author_url'       => new sfValidatorPass(array('required' => false)),
      'html_title'       => new sfValidatorPass(array('required' => false)),
      'meta_title'       => new sfValidatorPass(array('required' => false)),
      'meta_description' => new sfValidatorPass(array('required' => false)),
      'meta_keywords'    => new sfValidatorPass(array('required' => false)),
      'meta_robots'      => new sfValidatorPass(array('required' => false)),
      'slug'             => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('quote_translation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'QuoteTranslation';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'title'            => 'Text',
      'description'      => 'Text',
      'content'          => 'Text',
      'is_translated'    => 'Boolean',
      'author_name'      => 'Text',
      'author_location'  => 'Text',
      'author_url'       => 'Text',
      'html_title'       => 'Text',
      'meta_title'       => 'Text',
      'meta_description' => 'Text',
      'meta_keywords'    => 'Text',
      'meta_robots'      => 'Text',
      'lang'             => 'Text',
      'slug'             => 'Text',
    );
  }
}
