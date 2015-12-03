<?php
    class sfWidgetFormPlain extends sfWidgetForm
    {

        protected function configure($options = array(), $attributes = array())
        {
            $this->addOption('value');
        }

        /**
         * @param  string $name        The element name
         * @param  string $value       The value displayed in this widget
         * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
         * @param  array  $errors      An array of errors for the field
         *
         * @return string An HTML tag string
         *
         * @see sfWidgetForm
         */
        public function render($name, $value = null, $attributes = array(), $errors = array())
        {
            $attributes = array_merge(array('class'=>'form-control-plain'), $attributes);
            if(isset($attributes['class'])){
                $attributes['class'] = $attributes['class'].' form-control-plain';
            }
            return $this->renderContentTag('div', $this->getOption('value'), $attributes);
        }
    }
?>