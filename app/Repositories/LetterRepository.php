<?php

namespace App\Repositories;

use App\Models\Letter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use GuzzleHttp\Client;

class LetterRepository
{
    public function createNew($data)
    {
        $client = new Client([
            'base_uri' => env('CLOUD_S3_UPLOAD'),
            // default timeout 5 detik
            'timeout'  => 5,
        ]);

        $image = base64_encode(file_get_contents($data['image_url']));

        $response = $client->request('POST', '/api/v1/cdn', [
            'json' => [
                'bucket' => 'room1',
                'image' => $image
            ]
        ]);

        $body = $response->getBody();
        $body_array = json_decode($body);

        dd($body_array);
        if (@$data['image_url']) {
            $uploadImage = upload_file($data['image_url'], 'uploads/letter-img/');
            $storagePath = Storage::disk('s3')->put($uploadImage['original'], file_get_contents($uploadImage['original']), 'public');
            $imgLocation = $uploadImage['original'];

            //delete local
            // delete_file($uploadImage['original']);
        } else {
            $imgLocation = null;
        }

        if (@$data['color_image_url']) {
            $uploadImageColor = upload_file($data['color_image_url'], 'uploads/letter-img-color/');
            $storagePath = Storage::disk('s3')->put($uploadImage['original'], file_get_contents($uploadImage['original']), 'public');
            $imgLocationColor = $uploadImageColor['original'];

            //delete local
            // delete_file($uploadImageColor['original']);
        } else {
            $imgLocationColor = null;
        }



        // dd($data);
        $letter = new Letter;
        $letter->code = Str::random(10);
        $letter->letter = $data['letter'];
        $letter->romanji = $data['romanji'];
        $letter->image_url = $imgLocation;
        $letter->color_image_url = $imgLocationColor;
        $letter->letter_category_id = $data['category'];
        $letter->is_active = 1;
        $letter->save();

        return $letter;
    }

    public function updateLetter($data, $id)
    {
        $letter = Letter::find($id);
        $letter->letter = $data['letter'];
        $letter->romanji = $data['romanji'];
        $letter->image_url = $data['image_url'];
        $letter->color_image_url = $data['color_image_url'];
        $letter->letter_category_id = $data['category'];
        $letter->is_active = $data['is_active'];
        $letter->update();

        return $letter;
    }
}
