<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Str;

class ProductRepository
{
    public function create($data)
    {
        $ldate = date('Y-m-d H:i:s');

        $product = new Product();
        $product->name = $data['name'];
        $product->category = $data['category'];
        $product->description = $data['description'];
        $product->is_active = $data['is_active'];
        $product->created_at = $ldate;
        $product->created_by = @user_info('username');

        $product->save();

        return $product;
    }

    public function update($data, $id)
    {
        $ldate = date('Y-m-d H:i:s');

        $product = Product::find($id);
        $product->name = $data['name'];
        $product->category = $data['category'];
        $product->is_active = $data['is_active'];
        $product->description = $data['description'];
        $product->updated_at = $ldate;
        $product->updated_by = @user_info('username');

        $product->update();

        return $product;
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();

        return $product;
    }
}
