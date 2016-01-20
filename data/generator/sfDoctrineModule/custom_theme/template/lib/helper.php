[?php

/**
* <?php echo $this->getModuleName() ?> module configuration.
*
* @package    ##PROJECT_NAME##
* @subpackage <?php echo $this->getModuleName()."\n" ?>
* @author     ##AUTHOR_NAME##
* @version    SVN: $Id: helper.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
*/
abstract class Base<?php echo ucfirst($this->getModuleName()) ?>GeneratorHelper extends sfModelGeneratorHelper {
    public function getUrlForAction($action) {
        return 'list' == $action ? '<?php echo $this->params['route_prefix'] ?>' : '<?php echo $this->params['route_prefix'] ?>_'.$action;
    }

    public function linkToNew($params) {
        return '<a class="btn green" href="'.url_for("@".$this->getUrlForAction('new')).'"><i class="fa fa-plus"></i> '.Translate::from("general:helper:btn:link_to_new:text",["default"=>"Add new"]).'</a>';
    }

    public function linkToEdit($object, $params) {
        return '<a class="btn blue-madison" href="'.url_for($this->getUrlForAction('edit'), $object).'"><i class="fa fa-pencil"></i> '.Translate::from("general:helper:btn:link_to_edit:text",["default"=>"Edit"]).'</a>';
    }

    public function linkToList($params) {
        return '<a class="btn black" href="'.url_for($this->getUrlForAction('list')).'"><i class="fa  fa-list"></i> '.Translate::from("general:helper:btn:link_to_list:text",["default"=>"Back to list"]).'</a>';
    }

    public function linkToShow($object, $params) {
        return '<a class="btn green-meadow" href="'.url_for($this->getUrlForAction('show'), $object).'"><i class="fa fa-eye"></i> '.Translate::from("general:helper:btn:link_to_show:text", ["default"=>"Show"]).'</a>';
        //return '<a class="btn green-meadow" target="_blank" href="'.url_for($this->getUrlForAction('show'), $object).'"><i class="fa fa-eye"></i> '.Translate::from("general:helper:btn:link_to_show:text").'</a>';
    }

    public function linkToSave($object, $params) {
        return '<button class="btn green-meadow btn-lg my-loading-btn" type="submit"><i class="fa fa-floppy-o"></i> '.Translate::from("general:helper:btn:link_to_save:text", ["default"=>"Save"]).'</button>';
    }

    public function linkToSaveFixed($object, $params) {
        return '<button class="btn green-meadow btn-lg form-submit-fixed form-submit-fixed-style-1 my-loading-btn" type="submit"><i class="fa fa-floppy-o"></i> '.Translate::from("general:helper:btn:link_to_save_fixed:text").'</button>';
    }

    public function linkToSaveAndAdd($object, $params) {
        if (!$object->isNew()){
            return '';
        }
        return '<button class="btn purple-plum btn-lg" name="_save_and_add" type="submit"><i class="fa fa-plus"></i> '.Translate::from("general:helper:btn:link_to_save_and_add:text",["default"=>"Save and add"]).'</button>';
    }

    public function linkToDelete($object, $params) {
        if ($object->isNew()){
            return '';
        }
        return ''.link_to("<i class=\"fa fa-trash-o\"></i> ".Translate::from("general:helper:btn:link_to_delete:text",["default"=>"Delete"]), $this->getUrlForAction('delete'), $object, array('method' => 'delete', 'class'=>'btn default btn-sm btn-object-remove', 'confirm' => !empty($params['confirm']) ? Translate::from("general:helper:btn:confirm:text") : $params['confirm'])).'';
        //return ''.link_to("<i class=\"fa fa-trash-o\"></i> ".__($params['label'], array(), 'sf_admin'), $this->getUrlForAction('delete', $object), array('method' => 'delete', 'class'=>'btn red btn-sm', 'confirm' => !empty($params['confirm']) ? __($params['confirm'], array(), 'sf_admin') : $params['confirm'])).'';
    }
}