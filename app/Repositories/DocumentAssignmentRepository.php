<?php

namespace App\Repositories;

use App\Models\DocumentAssignment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DocumentAssignmentRepository
{


    public function update($data)
    {
        $ldate = date('Y-m-d H:i:s');
        // dd($data['status'] == 1);
        $id = $data['id'];
        $doc = DocumentAssignment::find($id);
        $doc->status = $data['status'] == 1 ? "APPROVE" : "REJECT";
        $doc->reject_reason = @$data['notes'];

        $doc->update();

        return $doc;
    }
}
