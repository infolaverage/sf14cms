<?php

/**
 * Class TraitMyValidatedImageBase
 *
 * Core Trait functions for Image validation and upload.
 */
trait TraitMyValidatedImageBase
{
    /**
     * Generates a custom filename for an uploaded item.
     *
     * @return string Custom filename
     */
    public function generateCustomFilename() {
        $image_content = file_get_contents($this->tempName);

        $to_hash_parts = array(
            $this->getOriginalName(),
            rand(11111, 99999),
            microtime(),
            sha1($image_content)
        );

        $generated_filename = implode("", $to_hash_parts);
        $hashed_filename = sha1($generated_filename);
//            Project::prePrint($hashed_filename,0, "HASHED:");
//            Project::prePrint($this->getExtension(),0, "EXT:");
//            Project::prePrint($this->getOriginalName(),0, "ONAME:");
//
//            exit;
        return $hashed_filename.$this->getExtension();
    }//end generateCustomFilename()

    /**
     * Save the uploaded file.
     *
     * @param null $file
     * @param int $fileMode
     * @param bool $create
     * @param int $dirMode
     *
     * @return mixed The saved image path.
     */
    public function save($file = null, $fileMode = 0666, $create = true, $dirMode = 0777) {
        $filename = $this->generateCustomFilename();
        $full_path = AssetImageHelper::getFullPath(self::$asset_image_type, $filename);

        if(self::$with_debug){
            Project::prePrint($filename);
            Project::prePrint($full_path);
            exit;
        }


        parent::save($full_path, $fileMode, $create, $dirMode);

        $exploded           = explode(DIRECTORY_SEPARATOR, $this->savedName);
        #Project::prePrint($filename,1);
        $this->savedName    = end($exploded);
        #Project::prePrint($this->savedName); exit;

        return $this->savedName;
    }//end save()
}

?>