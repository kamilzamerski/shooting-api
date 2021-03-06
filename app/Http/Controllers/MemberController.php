<?php

namespace App\Http\Controllers;

use App\Models\MemberModel;
use App\Models\ShooterModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function all(Request $request)
    {
        $params = $request->query();
        //$page = !empty($params['page']) ? $params['page'] : 1;
        $size = !empty($params['size']) ? $params['size'] : 25;
        $data = MemberModel::paginate($size);

        return response()->json(['status' => true, 'data' => $data]);
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

        $member = MemberModel::find($id);
        if ($member) {
            return response()->json(['status' => true, 'data' => $member]);
        }
        return response()->json(['status' => false, 'msg' => 'Member not found'], Response::HTTP_NOT_FOUND);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function add(Request $request)
    {
        $this->validate($request, MemberModel::$rules);
        DB::beginTransaction();
        try {
            $shooter = ShooterModel::create($request->post('name'), $request->post('surname'), 1);
            $member = MemberModel::create($request->all(), $shooter->id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
        return response()->json(['status' => true, 'data' => $member], Response::HTTP_CREATED);
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
        $this->validate($request, MemberModel::$rules);
        $member = MemberModel::find($id);
        if ($member) {
            $member->fill($request->all())->save();
            return response()->json(['status' => true, 'data' => $member]);
        }
        return response()->json(['status' => false, 'msg' => 'Member not found'], 404);
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
        $member = MemberModel::find($id);
        if ($member) {
            $member->delete();
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false, 'msg' => 'Member not found'], 404);
    }
}
