<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WarehouseController extends Controller
{
    //validators

    function validateCreateAndUpdate()
    {
        return Validator::make(request()->all(), [
            "warehouse_name" => "required | string | min:8"

        ]);
    }

    //calls
    function getAllWarehouses(Warehouse $warehouse)
    {
        return $warehouse->with('allEmployees')->get();
    }

    function getWarehouseById(Warehouse $warehouse, $id)
    {
        return $warehouse->with('allEmployees')->where('id', '=', $id)->get();
    }

    function deleteWarehouse(Warehouse $warehouse, $id)
    {
        if (!$warehouse->where('id', '=', $id)) {
            return [
                'status' => 'failed',
                'message' => "warehouse doesn't exist"
            ];
        } else {
            $warehouse->destroy($id);
            return [
                'status' => 'successful',
                'message' => 'deleted successfully'
            ];
        }
    }

    function createWarehouse(Warehouse $warehouse, Request $req)
    {
        
        $checkForErrors = $this->validateCreateAndUpdate();
        if ($checkForErrors->fails()) {
            return $checkForErrors->errors();
        }
        Warehouse::create(array_merge([
            "warehouse_name" => $req->warehouse_name,
        ]));

        return $req;
    }

    function updateWarehouse(Warehouse $product, Request $req, $id)
    {
        
        $checkForErrors = $this->validateCreateAndUpdate();
        if ($checkForErrors->fails()) {
            return $checkForErrors->errors();
        }
        Warehouse::where('id', '=', $id)->update(array_merge([
            "warehouse_name" => $req->warehouse_name,
        ]));

        return $req;
    }
}
