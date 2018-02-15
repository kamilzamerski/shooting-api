<?php

namespace App\Http\Controllers;

use App\Models\ClubModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ClubController extends Controller
{

    public function getAll(Request $request)
    {
        return response()->json(ClubModel::all());
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function getClub($id)
    {
        //Validation
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $club = ClubModel::find($id);
        if ($club) {
            return response()->json(['status' => true, 'data' => $club]);
        }
        return response()->json(['status' => false, 'msg' => 'Club not found'], Response::HTTP_NOT_FOUND);
    }

    /**
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function createClub(Request $request)
    {
        $this->validate($request, ClubModel::$rules);
        $club = ClubModel::create($request->all());
        return response()->json(['status' => true, 'data' => $club], Response::HTTP_CREATED);
    }

    public function updateClub(Request $request, $id)
    {
        //Validation
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $this->validate($request, ClubModel::$rules);
        $club = ClubModel::find($id);
        if ($club) {
            $club->fill($request->all());
            return response()->json(['status' => true, 'data' => $club]);
        }
        return response()->json(['status' => false, 'msg' => 'Club not found'], 404);
    }

    public function deleteClub($id)
    {
        //Validation
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $club = ClubModel::find($id);
        if ($club) {
            $club->delete();
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false, 'msg' => 'Club not found'], 404);
    }
}
