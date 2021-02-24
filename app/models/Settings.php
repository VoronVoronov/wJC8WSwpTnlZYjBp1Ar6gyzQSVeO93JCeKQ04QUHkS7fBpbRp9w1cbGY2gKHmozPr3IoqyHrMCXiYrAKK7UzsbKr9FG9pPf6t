<?php

class SettingsModel extends Model
{
    public $table = "settings";

    public function getSettings()
    {
        /*return $this->where("settings_id", $id)
        ->select(DB::raw("*"))
        ->get();*/
        return $this->get();
    }


}