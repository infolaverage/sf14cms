<?php

/**
 * QuoteTranslation form base class.
 *
 * @method QuoteTranslation getObject() Returns the current form's model object
 *
 * @package    s14cms
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
abstract class BaseQuoteTranslationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'title'            => new sfWidgetFormInputText(),
      'description'      => new sfWidgetFormTextarea(),
      'content'          => new sfWidgetFormTextarea(),
      'is_translated'    => new sfWidgetFormInputCheckbox(),
      'author_name'      => new sfWidgetFormInputText(),
      'author_location'  => new sfWidgetFormTextarea(),
      'author_url'       => new sfWidgetFormTextarea(),
      'html_title'       => new sfWidgetFormTextarea(),
      'meta_title'       => new sfWidgetFormTextarea(),
      'meta_description' => new sfWidgetFormTextarea(),
      'meta_keywords'    => new sfWidgetFormTextarea(),
      'meta_robots'      => new sfWidgetFormInputText(),
      'lang'             => new sfWidgetFormInputHidden(),
      'slug'             => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'title'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'description'      => new sfValidatorString(array('required' => false)),
      'content'          => new sfValidatorString(array('required' => false)),
      'is_translated'    => new sfValidatorBoolean(array('required' => false)),
      'author_name'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'author_location'  => new sfValidatorString(array('max_length' => 511, 'required' => false)),
      'author_url'       => new sfValidatorString(array('max_length' => 511, 'required' => false)),
      'html_title'       => new sfValidatorString(array('max_length' => 1023, 'required' => false)),
      'meta_title'       => new sfValidatorString(array('max_length' => 1023, 'required' => false)),
      'meta_description' => new sfValidatorString(array('required' => false)),
      'meta_keywords'    => new sfValidatorString(array('required' => false)),
      'meta_robots'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'lang'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('lang')), 'empty_value' => $this->getObject()->get('lang'), 'required' => false)),
      'slug'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('quote_translation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'QuoteTranslation';
  }

}
