<?php

class TaskMethods
{
    public static $instance = null;

    /**
     * @return bool
     */
    public static function getInstance() {
        if(!is_null(self::$instance)) {
            return self::$instance;
        }
        return false;
    }

    /**
     * Prevent multiple task run
     */
    public static function preventMultipleRunning(){
        $PREVENT_MULTIPLE_CRON_TASK_OUTPUT = null;
        exec("ps ax | grep 'php.*symfony ".self::getInstance()->getName()."' | grep -v grep ", $PREVENT_MULTIPLE_CRON_TASK_OUTPUT);
        if (count($PREVENT_MULTIPLE_CRON_TASK_OUTPUT) > 2) {  exit; }
    }

    public static function myOnStart(){
        /** @var sfBaseTask $task_instance */
        $task_instance = self::getInstance();
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        self::log("===================", "====================================================================");
        $name = $task_instance->getName();
        $namespace = $task_instance->getNamespace();

        self::log("Running Task ".($namespace ? $namespace.':': '').$name, "");
        $task_started_date  = date("Y-m-d H:i:s");
        $task_started_at    = microtime(true); #date("Y-m-d H:i:s");
        self::log("~ STARTED AT", $task_started_date);
        self::log("===================", "====================================================================");
        return $task_started_at;
        //
    }

    public static function myOnEnd($task_started_at){
        $task_instance = self::getInstance();
        self::log("===================", "=======================================================================");
        $task_ended_date    = date("Y-m-d H:i:s");
        $task_ended_at      = microtime(true);
        $task_duration      = $task_ended_at - $task_started_at;
        self::log("~ ENDED AT", $task_ended_date);
        self::log("~ DURATION", number_format($task_duration,2,'.','')." seconds");
        self::log("===================", "=======================================================================");
        self::$instance     = null;
    }

    public static function log($msg_first = null, $msg_second = null ) {
        if(self::getInstance() && !is_null($msg_first)) {
            self::getInstance()->logSection($msg_first,$msg_second);
        }
    }

}
