<?php

namespace App\Repositories;

use App\Models\Letter;
use App\Models\MasterVerbGroup;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use GuzzleHttp\Client;

class MasterVerbGroupRepository
{
    public function create($data)
    {

        $groups = new MasterVerbGroup();
        $groups->code = Str::random(10);
        $groups->name = $data['name'];
        $groups->master_verb_level_id = $data['master_verb_level_id'];
        $groups->is_active = 1;
        $groups->save();

        return $groups;
    }

    public function update($data, $id)
    {
        $groups = MasterVerbGroup::find($id);
        $groups->name = $data['name'];
        $groups->master_verb_level_id = $data['master_verb_level_id'];
        $groups->is_active = $data['is_active'];
        $groups->update();

        return $groups;
    }
}
