<?php

namespace App\Http\Controllers;

use App\Models\ShooterModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ShooterController extends Controller
{

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function all(Request $request)
    {
        return response()->json(['status' => true, 'data' => ShooterModel::all()]);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function get($id)
    {
        //Validation
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $shooter = ShooterModel::find($id);
        if ($shooter) {
            return response()->json(['status' => true, 'data' => $shooter]);
        }
        return response()->json(['status' => false, 'msg' => 'Shooter not found'], Response::HTTP_NOT_FOUND);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function add(Request $request)
    {
        $this->validate($request, ShooterModel::$rules);
        $shooter = ShooterModel::create($request->post('name'), $request->post('surname'), $request->post('club_id'));
        return response()->json(['status' => true, 'data' => $shooter], Response::HTTP_CREATED);
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function put(Request $request, $id)
    {
        //Validation
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $this->validate($request, ShooterModel::$rules);
        $shooter = ShooterModel::find($id);
        if ($shooter) {
            $shooter->fill($request->all());
            return response()->json(['status' => true, 'data' => $shooter]);
        }
        return response()->json(['status' => false, 'msg' => 'Shooter not found'], 404);
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
        $shooter = ShooterModel::find($id);
        if ($shooter) {
            $shooter->delete();
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false, 'msg' => 'Shooter not found'], 404);
    }
}
