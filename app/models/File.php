<?php

/**
 * Created by PhpStorm.
 * User: Максим
 * Date: 10.02.2017
 * Time: 19:29
 */
class FileModel extends Model
{
    public $table = "files";

    public function saveFile($filename, $size, $type, $url)
    {
        return $this->create([
            'file_name' => $filename,
            'file_size' => $size,
            'file_type' => $type,
            'file_url' => $url,
            'user_id' => session("user_id"),
        ]);
    }

    public function getFiles($user_id = 0)
    {
        return $this->where("user_id", $user_id)->get();
    }

    public function getSizeFiles($user_id = 0)
    {
        return $this->where("user_id", $user_id)->sum("file_size");
    }
}