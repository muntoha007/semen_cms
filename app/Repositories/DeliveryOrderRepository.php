<?php

namespace App\Repositories;

use App\Models\Assignment;
use App\Models\DeliveryOrder;
use App\Models\DeliveryOrderDetail;
use App\Models\DriverVehicle;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\Assign;

class DeliveryOrderRepository
{
    public function create($data)
    {

        $pathLocation = null;
        if(@$data['do_file']){
            $pathLocation = $this->uploadFile($data);
        }

        $ldate = date('Y-m-d H:i:s');
        $datebook =  date("Y-m-d H:i:s", strtotime($data['booking_date']));
        $dateexp =  date("Y-m-d H:i:s", strtotime($data['expired_date']));

        $do = new DeliveryOrder();
        $do->booking_code = $data['booking_code'];
        $do->number_reference = $data['number_reference'];
        $do->do_file = isset($data['do_file']);
        $do->distributor = $data['distributor'];
        $do->store = $data['store'];
        $do->notes = $data['notes'];
        $do->status = $data['status'];
        $do->booking_date = $datebook;
        $do->expired_date = $dateexp;
        $do->created_at = $ldate;
        $do->created_by = @user_info('username');

        $do->save();

        $doid = $do->id;

        foreach ($data['products'] as $value) {
            $detail = new DeliveryOrderDetail();
            $detail->delivery_order_id = $doid;
            $detail->product_id = $value["product_id"];
            $detail->quantity = $value["quantity"];
            $detail->weight = $value["weight"];
            $detail->notes = $value["notes"];
            $detail->created_by = @user_info('username');
            $detail->save();
        }

        return $do;
    }

    public function sendUploadFFile($payload){
        $pathLocation = null;
        $client = new \GuzzleHttp\Client();
        $url = env('API_CMS_BASE_URL')."/upload-file";
        $response = $client->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'json' => $payload
        ]);
        $jsonData = $response->getBody()->getContents();
        $arraydata = (array)json_decode($jsonData);
        if($arraydata['status_message'] == 'Success'){
            $pathLocation = $arraydata['data']->file_name;
        }

        return $pathLocation;
    }

    public function uploadFile($data){
        $fileExt = $data['do_file']->getClientOriginalExtension();
        $file = base64_encode(file_get_contents($data['do_file']));
        $payload = [];
        $payload['file_type'] = $fileExt;
        $payload['file'] = $file;

        return $this->sendUploadFFile($payload);
    }

    public function update($data, $id)
    {
        $ldate = date('Y-m-d H:i:s');
        $datebook =  date("Y-m-d H:i:s", strtotime($data['booking_date']));
        $dateexp =  date("Y-m-d H:i:s", strtotime($data['expired_date']));

        $do = DeliveryOrder::find($id);
        $do->booking_code = $data['booking_code'];
        $do->number_reference = $data['number_reference'];
        $do->do_file = isset($data['do_file']);
        $do->distributor = $data['distributor'];
        $do->store = $data['store'];
        $do->notes = $data['notes'];
        $do->status = $data['status'];
        $do->booking_date = $datebook;
        $do->expired_date = $dateexp;
        $do->updated_at = $ldate;
        $do->updated_by = @user_info('username');

        $do->update();

        $h_array = array();
        foreach ($data['products'] as $key => $value) {
            array_push($h_array, @$value['id']);
        }

        // chceking delete old inexists data
        $ex = DeliveryOrderDetail::where('delivery_order_id', $id)
            ->whereNotIn('id', $h_array)->delete();

        foreach ($data['products'] as $value) {
            if (@$value['id'] != null) {
                $detail = DeliveryOrderDetail::find($value["id"]);
                $detail->product_id = $value["product_id"];
                $detail->quantity = $value["quantity"];
                $detail->weight = $value["weight"];
                $detail->notes = $value["notes"];
                $detail->updated_by = @user_info('username');

                $detail->update();
            } else {
                $detail = new DeliveryOrderDetail();
                $detail->delivery_order_id = $id;
                $detail->product_id = $value["product_id"];
                $detail->quantity = $value["quantity"];
                $detail->weight = $value["weight"];
                $detail->notes = $value["notes"];
                $detail->created_by = @user_info('username');
                $detail->save();
            }
        }

        return $do;
    }

    public function delete($id)
    {
        $do = DeliveryOrder::find($id);
        if ($do->status == "CREATED") {
            $do->delete();
            return $do;
        } else {
            return false;
        }
    }

    // Assig Driver
    public function assign($data){

        $do = DeliveryOrder::find($data['delivery_id']);
        $do->driver_id = $data['driver_id'];
        $do->status = "ASSIGNED";

        $do->update();

        if ($do) {
            $random = randomString(5);
            $vehicleid = DriverVehicle::select('vehicle_id')->where('driver_id', $data['driver_id'])->first();

            $assign = new Assignment();
            $assign->driver_id = $data['driver_id'];
            $assign->vehicle_id = $vehicleid;
            $assign->delivery_order_id = $data['delivery_id'];
            $assign->status_id = 1;
            $assign->status_document = "PENDING";
            $assign->created_by = @user_info('username');
            $assign->ticket_number = "TICKET-" +create_date_from_format()+"-"+$random;

            $assign->save();
        }

        return $do;
    }
}
