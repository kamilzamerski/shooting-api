<?php

namespace App\Http\Controllers;

use App\Models\LicenseModel;
use App\Models\SettlementsModel;
use App\Models\ShooterModel;
use Hamcrest\Core\Set;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class SettlementsController extends Controller
{

    /**
     * @param Request $request
     * @param int|null $member
     * @return JsonResponse
     */
    public function all(Request $request, $member = null)
    {
        $params = $request->query();
        //Validation
        $validator = Validator::make(['id' => $member], [
            'id' => 'integer'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        //$page = !empty($params['page']) ? $params['page'] : 1;
        $size = !empty($params['size']) ? $params['size'] : 25;
        if($member) {
            $data = SettlementsModel::where('member_id', $member)->paginate($size);
        } else {
            $data = SettlementsModel::paginate($size);
        }

        return response()->json(['status' => true, 'data' => $data]);
    }

    /**
     * @param int $member
     * @param int $id
     * @return JsonResponse
     */
    public function get(int $member, int $id)
    {
        //Validation
        $validator = Validator::make(['id' => $id, 'member' => $member], [
            'member' => 'required|integer',
            'id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $settlement = SettlementsModel::where(['id' => $id, 'member_id' => $member])->first();
        if ($settlement) {
            return response()->json(['status' => true, 'data' => $settlement]);
        }
        return response()->json(['status' => false, 'msg' => 'Settlement not found'], Response::HTTP_NOT_FOUND);
    }

    /**
     * @param Request $request
     * @param int $member
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function add(Request $request, $member)
    {
        //Validation
        $validator = Validator::make(['id' => $member], [
            'id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $this->validate($request, SettlementsModel::$rules);
        $settlement = SettlementsModel::create((int) $member, (int) $request->post('year'), $request->post('description'), (float) $request->post('amount'));
        return response()->json(['status' => true, 'data' => $settlement], Response::HTTP_CREATED);
    }

    /**
     * @param Request $request
     * @param $member
     * @param $id
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function put(Request $request, $member, $id)
    {
        //Validation
        $validator = Validator::make(['id' => $id, 'member' => $member], [
            'member' => 'required|integer',
            'id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $this->validate($request, SettlementsModel::$rules);
        $settlement = SettlementsModel::where(['id' => $id, 'member_id' => $member])->first();
        if ($settlement) {
            $settlement->fill($request->all())->save();
            return response()->json(['status' => true, 'data' => $settlement]);
        }
        return response()->json(['status' => false, 'msg' => 'Settlement not found'], 404);
    }

    /**
     * @param $member
     * @param $id
     * @return JsonResponse
     */
    public function remove($member, $id)
    {
        //Validation
        $validator = Validator::make(['id' => $id, 'member' => $member], [
            'id' => 'required|integer',
            'member' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $settlement = SettlementsModel::where(['id' => $id, 'member_id' => $member])->first();
        if ($settlement) {
            $settlement->delete();
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false, 'msg' => 'Settlement not found'], 404);
    }
}
