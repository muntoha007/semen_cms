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

        // for image
        $image = base64_encode(file_get_contents($data['image_url']));
        $response_img = $client->request('POST', '/api/v1/cdn', [
            'json' => [
                'bucket' => 'room1',
                'image' => $image
            ]
        ]);

        $body_img = $response_img->getBody();
        $img_url = json_decode($body_img);

        // for image color
        $image_color = base64_encode(file_get_contents($data['color_image_url']));
        $response_img_color = $client->request('POST', '/api/v1/cdn', [
            'json' => [
                'bucket' => 'room1',
                'image' => $image_color
            ]
        ]);

        $body_img_color = $response_img_color->getBody();
        $color_img_url = json_decode($body_img_color);

        $letter = new Letter;
        $letter->code = Str::random(10);
        $letter->letter = $data['letter'];
        $letter->romanji = $data['romanji'];
        $letter->image_url = $img_url->data->path;
        $letter->color_image_url = $color_img_url->data->path;
        $letter->letter_category_id = $data['category'];
        $letter->is_active = 1;
        $letter->save();

        return $letter;
    }

    public function updateLetter($data, $id)
    {


        $client = new Client([
            'base_uri' => env('CLOUD_S3_UPLOAD'),
            // default timeout 5 detik
            'timeout'  => 5,
        ]);

        $letter = Letter::find($id);

        if (isset($data['image_url'])) {
            $response_img_del = $client->request('DELETE', '/api/v1/cdn/' . $letter->image_url);

            // for image
            $image = base64_encode(file_get_contents($data['image_url']));
            $response_img = $client->request('POST', '/api/v1/cdn', [
                'json' => [
                    'bucket' => 'room1',
                    'image' => $image
                ]
            ]);
            $body_img = $response_img->getBody();
            $img_url = json_decode($body_img);
            $letter->image_url = $img_url->data->path;
        }

        if (isset($data['color_image_url'])) {
            $response_img_col = $client->request('DELETE', '/api/v1/cdn/' . $letter->color_image_url);

            // for image color
            $image_color = base64_encode(file_get_contents($data['color_image_url']));
            $response_img_color = $client->request('POST', '/api/v1/cdn', [
                'json' => [
                    'bucket' => 'room1',
                    'image' => $image_color
                ]
            ]);

            $body_img_color = $response_img_color->getBody();
            $color_img_url = json_decode($body_img_color);
            $letter->color_image_url = $color_img_url->data->path;
        }


        $letter->letter = $data['letter'];
        $letter->romanji = $data['romanji'];
        $letter->letter_category_id = $data['category'];
        $letter->is_active = $data['is_active'];
        $letter->update();

        return $letter;
    }
}