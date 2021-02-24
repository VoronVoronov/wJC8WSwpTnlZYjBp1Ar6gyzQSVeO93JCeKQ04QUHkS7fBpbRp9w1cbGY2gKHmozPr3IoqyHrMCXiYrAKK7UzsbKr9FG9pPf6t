<?php

/**
 * Created by PhpStorm.
 * User: Максим
 * Date: 10.02.2017
 * Time: 19:14
 */
class MediaGalleryController extends Controller
{
    public function uploadFile()
    {
        model("File");

        $image_types = [
            "image/gif",
            "image/png",
            "image/jpg",
            "image/jpeg",
        ];

        $audio_types = [
            "audio/mp3",
            "audio/ogg",
            "audio/wav",
        ];

        if((Request::file("file")->getSize() + $this->FileModel->getSizeFiles(session("user_id"))) <= 62914560) {

            if (in_array(Request::file("file")->getMimeType(), $image_types)) {
                $name = time() . "." . Request::file("file")->getExtension();
                if (Request::file("file")->move("./assets/files/", $name)) {
                    if ($this->FileModel->saveFile(
                            Request::file("file")->getOriginalName(),
                            Request::file("file")->getSize(),
                            "1",
                            "/assets/files/" . $name
                        )
                    ) {
                        $result = ['status' => 'success', 'success' => lang('media.file_load_success')];
                    }
                } else {
                    $result = ['status' => 'error', 'error' => lang('media.file_load_error')];
                }
            } else {
                if (in_array(Request::file("file")->getMimeType(), $audio_types)) {
                    $name = time() . "." . Request::file("file")->getExtension();
                    if (Request::file("file")->move("./assets/files/audio/", $name)) {
                        if ($this->FileModel->saveFile(
                            Request::file("file")->getOriginalName(),
                            Request::file("file")->getSize(),
                            "2",
                            "/assets/files/audio/" . $name
                        )
                        ) {
                            $result = ['status' => 'success', 'success' => lang('media.file_load_success')];
                        }
                    } else {
                        $result = ['status' => 'error', 'error' => lang('media.file_load_error')];
                    }
                } else {
                    $result = ['status' => 'error', 'error' => lang('media.file_incorrect_type')];
                }
            }
        } else {
            $result = ['status' => 'error', 'error' => lang('media.file_storage_limit_error')];
        }

        return json_encode($result);
    }

    public function getGalleryFiles()
    {
        model("File");
        $files = $this->FileModel->getFiles();

        return json_encode($files);
    }

    public function getOwnFiles()
    {
        model("File");
        $files = $this->FileModel->getFiles(session("user_id"));

        return json_encode($files);
    }

    public function getSizeFiles()
    {
        model("File");
        $result['size'] = format_fsize($this->FileModel->getSizeFiles(session("user_id")));

        return json_encode($result);
    }
}