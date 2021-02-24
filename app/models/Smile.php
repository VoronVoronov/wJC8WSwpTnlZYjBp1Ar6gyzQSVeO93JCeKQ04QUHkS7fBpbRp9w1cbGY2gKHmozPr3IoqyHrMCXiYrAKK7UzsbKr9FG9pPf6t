<?php

class SmileModel extends Model
{
    public function addSmile($platform, $data = [])
    {
        if($platform == "twitch") {
            Builder::table("twitch_smiles")->insert($data);
        } else {
            Builder::table("hitbox_smiles")->insert($data);
        }
    }

    public function getUserSmiles($user_id)
    {
        $smiles_twitch = Builder::table("twitch_smiles")->where("user_id", $user_id)->orWhere("user_id", 0)->get();
        $smiles_hitbox = Builder::table("hitbox_smiles")->where("user_id", $user_id)->get();

        return array_merge($smiles_twitch, $smiles_hitbox);
    }

    public function getUserSmilesTwitch($user_id)
    {
        $smiles = Builder::table("twitch_smiles")->where("user_id", $user_id)->orWhere("user_id", 0)->get();
        $emotes = [];

        foreach ($smiles as $key => $data)
        {
            $emotes[$key] = $data['smile_image_id'];
        }

        return $emotes;
    }

    public function getUserSmilesHitbox($user_id)
    {
        $smiles = Builder::table("hitbox_smiles")->where("user_id", $user_id)->get();
        $emotes = [];

        foreach ($smiles as $key => $data)
        {
            $emotes[$key] = $data['smile_image'];
        }

        return $emotes;
    }

    public function getSmile($platform, $id)
    {
        if($platform == "twitch") {
            return Builder::table("twitch_smiles")->where("smile_id", $id)->first();
        } else {
            return Builder::table("hitbox_smiles")->where("smile_id", $id)->first();
        }
    }
}