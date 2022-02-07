<?php

namespace App\Repositories;

use App\Models\DocumentAssignment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DocumentAssignmentRepository
{
    public function create($data)
    {
        $ldate = date('Y-m-d H:i:s');

        $doc = new DocumentAssignment();
        $doc->full_name = $data['full_name'];
        $doc->identity_number = $data['identity_number'];
        $doc->phone = $data['phone'];
        $doc->email = $data['email'];
        $doc->address = $data['address'];
        $doc->password = Hash::make($data['password']);
        $doc->is_active = $data['is_active'];
        $doc->created_at = $ldate;
        $doc->created_by = @user_info('username');

        $doc->save();

        return $doc;
    }

    public function update($data, $id)
    {
        $ldate = date('Y-m-d H:i:s');

        $doc = DocumentAssignment::find($id);
        $doc->full_name = $data['full_name'];
        $doc->identity_number = $data['identity_number'];
        $doc->phone = $data['phone'];
        $doc->email = $data['email'];
        $doc->address = $data['address'];
        $doc->is_active = $data['is_active'];
        $doc->updated_at = $ldate;
        $doc->updated_by = @user_info('username');

        $doc->update();

        return $doc;
    }

    public function delete($id)
    {
        $doc = DocumentAssignment::find($id);
        $doc->delete();

        return $doc;
    }
}
