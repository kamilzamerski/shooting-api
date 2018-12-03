<?php

namespace App\Http\Controllers;

use App\Models\LicenseModel;
use App\Models\ShooterModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class LicenseController extends Controller
{

    /**
     * @param Request $request
     * @param int $shooter
     * @return JsonResponse
     */
    public function all(Request $request, $shooter)
    {
        $params = $request->query();
        //Validation
        $validator = Validator::make(['id' => $shooter], [
            'id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        //$page = !empty($params['page']) ? $params['page'] : 1;
        $size = !empty($params['size']) ? $params['size'] : 25;
        $data = LicenseModel::where('shooter_id', $shooter)->paginate($size);

        return response()->json(['status' => true, 'data' => $data]);
    }

    /**
     * @param $shooter
     * @param $id
     * @return JsonResponse
     */
    public function get($shooter, $id)
    {
        //Validation
        $validator = Validator::make(['id' => $id, 'shooter' => $shooter], [
            'shooter' => 'required|integer',
            'id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $license = LicenseModel::where(['id' => $id, 'shooter_id' => $shooter])->first();
        if ($license) {
            return response()->json(['status' => true, 'data' => $license]);
        }
        return response()->json(['status' => false, 'msg' => 'License not found'], Response::HTTP_NOT_FOUND);
    }

    /**
     * @param Request $request
     * @param int $shooter
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function add(Request $request, $shooter)
    {
        //Validation
        $validator = Validator::make(['id' => $shooter], [
            'id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $this->validate($request, LicenseModel::$rules);
        $license = LicenseModel::create($request->post('number'), $request->post('year'), $shooter);
        return response()->json(['status' => true, 'data' => $license], Response::HTTP_CREATED);
    }

    /**
     * @param Request $request
     * @param $shooter
     * @param $id
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function put(Request $request, $shooter, $id)
    {
        //Validation
        $validator = Validator::make(['id' => $id, 'shooter' => $shooter], [
            'shooter' => 'required|integer',
            'id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $this->validate($request, LicenseModel::$rules);
        $license = LicenseModel::where(['id' => $id, 'shooter_id' => $shooter])->first();
        if ($license) {
            $license->fill($request->all())->save();
            return response()->json(['status' => true, 'data' => $license]);
        }
        return response()->json(['status' => false, 'msg' => 'License not found'], 404);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function remove($id)
    {
        //Validation
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $license = LicenseModel::find($id);
        if ($license) {
            $license->delete();
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false, 'msg' => 'License not found'], 404);
    }
}
