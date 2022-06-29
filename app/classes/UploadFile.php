<?php

namespace App\Classes;

class UploadFile  
{
    protected $filename;
    protected $max_filesize = 2097152;
    protected $extension;
    protected $path;

    /**
     * get the filename
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->filename;
    }

    /**
     * set filename
     *
     * @param [type] $file
     * @param string $name
     * @return void
     */
    protected function setName($file, $name="")
    {
        if($name === ""){
            $name = pathinfo($name, PATHINFO_FILENAME);
        }

        $name = strtoLower(str_replace(['-', ' '], '-', $name));
        $hash = md5(microtime());
        $ext = $this->fileExtention($file);
        $this->filename = "{$name}-{$hash}.{$ext}";
    }

    /**
     * check file extension
     *
     * @param [type] $file
     * @return mixed
     */
    protected function fileExtention($file)
    {
        return $this->extension= pathinfo($file, PATHINFO_EXTENSION);
    }

    /**
     * check if the uploaded filesize is grater than the system max filesize
     *
     * @param [type] $file
     * @return bool
     */
    public static function fileSize($file)
    {
        $fileobj = new static; 
        return $file > $fileobj->max_filesize ? true: false;
    }


    /**
     * validate file upload
     *
     * @param [type] $file
     * @return boolean
     */
    public static function isImage($file)
    {
        $fileobj = new static; 
        $ext = $fileobj->fileExtention($file);
        $validExt = array('jpg', 'jpeg', 'png', 'gif');

        if(!in_array(strtolower($ext), $validExt)){
            return false;
        }

        return true;
    }

    /**
     * get the path where the file was uploaded to
     *
     * @return void
     */
    public function path()
    {
        return $this->path;
    }

    /**
     * move the uploaded file to the public folder 
     *
     * @param [type] $temp_path
     * @param [type] $folder
     * @param [type] $file
     * @param [type] $new_filename
     * @return object|null
     */
    public static function move($temp_path, $folder, $file, $new_filename='')
    {
        $fileobj = new static;
        $ds = DIRECTORY_SEPARATOR;

        $fileobj->setName($file, $new_filename);
        $file_name = $fileobj->getName();

        if(!is_dir($folder)){
            mkdir($folder, 0777, true);
        }

        $fileobj->path = "{$folder}{$ds}{$file_name}";
        $absolute_path = BASE_PATH."{$ds}public{$ds}$fileobj->path";

        if(move_uploaded_file($temp_path, $absolute_path)){
            return $fileobj;
        }
        return null;
    }
}