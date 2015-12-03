<?php

    /**
     * Class TraitBackendFormImageManager
     *
     * Help to format image type fields (by $image_manager_config in a class) in a form.
     */
    trait TraitBackendFormImageManager
    {
        /**
         * Help to format image type fields (by $image_manager_config in a class) in a form.
         */
        protected function manageImageFields() {
            $image_manager_configs  = self::$image_manager_configs;
            $obj_array              = $this->getObject()->toArray();

            foreach ($image_manager_configs as $image_manager_config) {
                $has_image = $obj_array[$image_manager_config["image_field"]];
                #$lang = $obj_array["lang"];
                $lang = null;

                $image_widget_params = array(
                    "file_src"      => !$this->isNew() ? $this->getImageLink($lang) : "",
                    "is_image"      => true,
                    "edit_mode"     => $has_image,
                    "template"      => "<div>%input%</div>",
                    "delete_label"  => "remove"
                );

                if ($has_image) {
                    $image_widget_params['template'] =
                        '<div class="file-control">' .
                        '<div class="file">%file%</div>' .
                        '%input%' .
                        '<div class="delete-control">%delete% %delete_label%</div>' .
                        '</div>';
                }

                $this->widgetSchema[$image_manager_config['image_field']] = new sfWidgetFormInputFileEditable($image_widget_params);

                $this->validatorSchema[$image_manager_config["image_field"]] = new sfValidatorFile(
                    array(
                        'required'             => false,
                        'path'                 => AssetImageHelper::getAssetImagePath(
                            $image_manager_config["asset_image_type"],
                            true
                        ),
                        'mime_types'           => 'web_images',
                        'validated_file_class' => $image_manager_config["image_validated_class"]
                    ));

                $this->validatorSchema[$image_manager_config["image_field"] . "_delete"] = new sfValidatorPass();
            }
        }//end manageImageFields()
    }

?>