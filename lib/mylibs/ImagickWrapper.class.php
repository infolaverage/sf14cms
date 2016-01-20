<?php

/**
 * Class ImagickWrapper
 */
class ImagickWrapper {
    var $mogrify;
    var $convert;
    var $composite;
    var $identify;

    var $src;
    var $watermark_path;
    var $watermark_empty_path;

    /**
     * @param $src
     * @throws Exception
     */
    public function __construct($src) {
        if (!is_file($src)) {
            throw new \Exception('Construct exception check function : ImagickWrapper::__construct src='.$src);
        }

        $this -> convert = "/usr/bin/convert ";
        $this -> composite = "/usr/bin/composite ";
        $this -> identify = "/usr/bin/identify ";
        $this -> mogrify = "/usr/bin/mogrify ";
        $this -> src = $src;
    }//end __construct()

    // INFOS :  identify -verbose /var/www/ttt/site/data/images/17.nature-best-photography-of-200713.jpg
    // RESIZE : convert -resize 50% -quality 80 input.jpg output.jpg
    // WATERMARKING : composite -dissolve 60 -tile watermark.png src.jpg dst.jpg

    /**
     * Generate thumbnail from $source to $target for given resizing parameter
     * @param unknown_type $target
     * @param unknown_type $resize
     * @param bool $shrink
     * @throws Exception
     * @internal param \unknown_type $source
     */
    public function generateThumbnail($target, $resize, $shrink = true, $watermark = null) {
        if (!$resize or !$target) {
            throw new \Exception('Read function declaration : ImagickWrapper::generateThumbnail');
        }

        $cmd = $this->generateThumbnailCommand($target, $resize, $shrink, $watermark);

        exec($cmd);
    }//end generateThumbnail()

    /**
     * @param $target
     * @param $resize
     * @param bool $shrink
     * @return string
     * @throws Exception
     */
    public function generateThumbnailCommand($target, $resize, $shrink = true, $watermark = null) {
        if (!$resize or !$target) {
            throw new \Exception('Read function declaration : ImagickWrapper::generateThumbnail');
        }

        $origresize = $resize;
        if($shrink){
            $resize = $resize.'\>';
        }


        if(!is_null($watermark))
        {
            //
            $cmd_0 = $this->convert . ' "'.$this->src.'" -resize '.$resize.' -quality 75 "'.$target.'"';
            $cmd_1 = $this->convert . ' "'.$watermark.'" -resize '.$resize.' -quality 75 "watermark_'.$origresize.'.png"';
            $cmd_2 = $this->composite . ' -gravity South "watermark_'.$origresize.'.png" "'.$target.'" "'.$target.'"';
            exec($cmd_0);
            exec($cmd_1);
            exec($cmd_2);
            return "echo 1";
        }
        else
        {
            $cmd =
                $this -> convert
                .' "'.$this->src.'"'
                .' -resize ' . $resize .''
                .' -quality 75'
                .' "' .$target. '"';
        }



        if(!is_null($watermark))
        {

            /*
                $size_temp_array = explode('x', strtolower($resize));
                $width = (count($size_temp_array) == 2)?$size_temp_array[0]:300;
                $fontsize = $width / 15;
                $cmd = $cmd
                .' -font "'. sfConfig::get("app_generalProductImage_productWatermarkFont") .'"'
                .' -pointsize '.$fontsize
                .' -draw "gravity center fill black text 0,12 \''.$watermark.'\' fill white text 1,11 \''.$watermark.'\'"';*/
        }

        //$cmd .= ' "' .$target. '"';
        return $cmd;
    }//end generateThumbnailCommand()

    /**
     * Crop an image for given best scaled size, gravity automatic centered, and write out for $target
     * @param integer $width
     * @param integer $height
     * @param string $target - the target of the new image
     */
    public function cropImage($width, $height , $target) {
        // load an image
        $i = new Imagick($this->src);
        // get the current image dimensions
        $geo = $i -> getImageGeometry();

        // crop the image
        if (($geo['width'] / $width) < ($geo['height'] / $height)) {
            $i -> cropImage($geo['width'], floor($height * $geo['width'] / $width), 0, (($geo['height'] - ($height * $geo['width'] / $width)) / 2));
        } else {
            $i -> cropImage(ceil($width * $geo['height'] / $height), $geo['height'], (($geo['width'] - ($width * $geo['height'] / $height)) / 2), 0);
        }

        // save or show or whatever the image
        $i -> setImageFormat("jpeg");
        $i -> writeImage($target);


        $wrapper2 = new ImagickWrapper($target);
        $wrapper2 -> generateThumbnail($target,$width."x".$height);
    }//end cropImage()

    /**
     * @param $width
     * @param $height
     * @param $x
     * @param $y
     * @param $target
     * @param $new_thumbnail_size
     * @param string $colorize
     */
    public function cropImageParametherized($width,$height,$x,$y, $target ,$new_thumbnail_size, $colorize = "clean"){
        $target_hash = md5($width.$height.$x.$y.$new_thumbnail_size.$this->src);
        $cache_path = dirname($target)."/".$target_hash.".jpg";

        if(  !file_exists($cache_path) ){
            $picture = new Imagick($this->src);
            $picture->cropImage($width, $height, $x, $y);

            $picture -> setImageFormat("jpeg");
            $picture -> writeImage($cache_path);

            $cmd = ("/bin/bash ".sfConfig::get("sf_root_dir")."/bin/denoise -f 2 -n 2 -u 2 \"".$cache_path."\" \"".$cache_path."\"");
            exec($cmd);

            $cmd = "convert $cache_path -resize $new_thumbnail_size -quality 100 $cache_path";
            exec($cmd);
        }

        if($colorize == "clean"){
            copy($cache_path, $target);
        }else{
            $cmd =  ("/bin/bash ".sfConfig::get("sf_root_dir")."/bin/colorbalance -c $colorize  -a 15 \"".$cache_path."\" \"".$target."\"");
            exec($cmd);
        }
    }//end cropImageParametherized()

    /**
     * @param $final_location
     */
    public function copyTo($final_location) {
        $cmd = 'cp "' . $this -> src . '" "' . $final_location . '"';
        exec($cmd);
    }//end copyTo()

    /**
     * @return mixed
     */
    public function getWidth() {
        list($width, $height, $type, $attr) = getimagesize($this -> src);
        return $width;
    }//end getWidth()

    /**
     * @return mixed
     */
    public function getHeight() {
        list($width, $height, $type, $attr) = getimagesize($this -> src);
        return $height;
    }//end getHeight()

    /**
     * @return string
     */
    public function getLandscape() {
        $size = getimagesize($this -> src);
        $width = $size[0];
        $height = $size[1];
        $aspect = $height / $width;

        if ($aspect >= 1)
            $mode = "vertical";
        else
            $mode = "horizontal";

        return $mode;
    }//end getLandscape()

    /**
     * @param $src
     * @return bool
     */
    public static function isValidJpeg($src) {
        exec("identify -verbose '{$src}' >&1 2>&1", $res);

        if (strpos($res[count($res) - 1], "Corrupt")) {
            return false;
        } else {
            return true;
        }
    }//end isValidJpeg()

    /**
     * @param $src
     * @return bool
     */
    public static function isValidResolution($src) {
        list($width, $height, $type, $attr) = getimagesize($src);

        $aspect = $height / $width;
        if ($aspect >= 1  )
        {
            if( $width >= 600){
                return true;
            }else{
                return false;
            }
        }
        else
        {
            if( $height >= 400){
                return true;
            }else{
                return false;
            }
        }
    }//end isValidResolution()

    /**
     * @param $path
     */
    public static function optimizeQuality($path){
        $cms = "/usr/bin/convert $path -quality 77 $path";
        exec($cms);
    }//end optimizeQuality()

    /**
     * @param $path
     * @param $size
     */
    public static function optimizeSize($path, $size){
        $cms = "/usr/bin/convert $path -resize ".$size."! $path";
        exec($cms);
    }//end optimizeSize()
}
