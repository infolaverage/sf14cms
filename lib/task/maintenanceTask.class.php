<?php

class maintenanceTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'frontend'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace        = '';
    $this->name             = 'maintenance';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [maintenance|INFO] task does things.
Call it with:

  [php symfony maintenance|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

      sfContext::createInstance($this->configuration);

    $domains = [
        "@pixelkameleon.hu",
        //"@infolaveragé.hu",
        //"@infolaveragé,hu",
        //"@infolaveragé%hu",
    ];
    // add your code here
    $emails_base = [
        "tamasbarkaszi",
        "tamas.barkaszi",
        "tamas.barkaszi+comment",
        "tamas-barkaszi",
        "tamas_barkaszi",
        "tamas_barkÁszi",

        "tamßÄ\$¤s.barkaszi",


        "tamas.barkaszi%",
        "tamas.barkaszi:",
        "tamas.barkaszi;",
        #"tamas.barkaszi%",
        #"tamas.barkaszi%",
        #"tamas.barkaszi%",
        "tamas.barkaszi ",
        "tamás.barkaszi",
        "tamas.barkaszi@",
        "tamas.barkaszé",
        "tamas,barkaszi",
        "tamás,barkaszi",
        "tamás.barkaszi+comment",
        "tamas,barkaszi+comment",
        "tamás,barkaszi+comment",
        "tamas.barkaszi+commént",
        "tamás.barkaszi+commént",
        "tamas,barkaszi+commént",
        "tamás,barkaszi+commént",
        
    ];
    
    $emails = [];
    foreach($emails_base as $eb){
        foreach($domains as $domain){
            $emails[] = $eb.$domain;
        } 
    }
      $date = new DateTime();
      $date_formatted = $date->format("Y-m-d H:i:s");

    //$validator = new sfValidatorEmail();
    foreach($emails as $email){

       // $this->logSection("","");

        $is_valid = false;
        $v  = new sfValidatorEmail();
        $va = new myValidatorAdditionalEmail();
        $vv = new sfValidatorAnd([$v, $va]);

        try{
            $vv->clean($email);
            $is_valid = true;
        } catch (sfValidatorError $e){
            $is_valid = false;
        }

        if($is_valid){

            try{
                $this->logSection("  valid",$email,null,'SUCCESS');

                $subject =  "Sending test at: ".$date_formatted;
                $message = $this->getMailer()->compose(
                    array("tamas.barkaszi+teszt@infolaverage.hu" => "tamas.barkaszi+teszt@infolaverage.hu"),
                    $email,
                    $subject
                );
                $message->setBody($subject." to: ".$email, 'text/html');
                $this->getMailer()->send($message);
            } catch (Exception $e){
                $this->logSection("Send FAILURE", $email." ".$e, null, "ERROR");
            }

        } else {
            $this->logSection("invalid",$email,null,'ERROR');
        }

        
    }
  
    
  }
}
