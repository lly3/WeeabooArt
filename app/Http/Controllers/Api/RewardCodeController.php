<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RewardCodeResource;
use App\Models\RewardCode;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RewardCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rewardCodes = RewardCode::with('reward')->paginate(5);
        return RewardCodeResource::collection($rewardCodes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RewardCode  $rewardCode
     * @return \Illuminate\Http\Response
     */
    public function show(RewardCode $rewardCode)
    {
        $reward = $rewardCode->reward;
        return new RewardCodeResource($rewardCode);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RewardCode  $rewardCode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RewardCode $rewardCode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RewardCode  $rewardCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(RewardCode $rewardCode)
    {
        $code = $rewardCode->code;
        if ($rewardCode->delete()) {
            return response()->json([
                'success' => true,
                'message' => "Reward Code {$code} deleted successfully"
            ], Response::HTTP_OK);
        }
        return response()->json([
            'success' => false,
            'message' => "Reward Code {$code} deleted failed"
        ], Response::HTTP_BAD_REQUEST);
    }

    public function search(Request $request) {
        $q = $request->query('q');
        $rewardCodes = RewardCode::where('code', 'LIKE', "%{$q}%")
            ->paginate(3)->withQueryString();
        return RewardCodeResource::collection($rewardCodes);
    }
}
