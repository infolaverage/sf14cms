<?php

class frontendConfiguration extends sfApplicationConfiguration
{
  public function configure()
  {
      sfValidatorBase::setDefaultMessage("required", "required");
      sfValidatorBase::setDefaultMessage("invalid", "invalid");
  }
}
