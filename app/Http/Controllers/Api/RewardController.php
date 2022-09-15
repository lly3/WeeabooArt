<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RewardResource;
use App\Models\Reward;
use App\Models\RewardCode;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RewardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rewards = Reward::get();
        return RewardResource::collection($rewards);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reward = new Reward();
        $reward->name = $request->get('name');
        $reward->detail = $request->get('detail');
        $reward->point = $request->get('point');
        $reward->total_amount = $request->get('total_amount');
        $reward->balance = $request->get('balance');
        $reward->is_active = $request->get('is_active');
        if ($reward->save()) {
            for ($i = 0; $i < $reward->total_amount; $i++) {
                $rewardCode = new RewardCode();
                $rewardCode->code = fake()->lexify("?????");
                $reward->rewardCodes()->save($rewardCode);
            }

            return response()->json([
                'success' => true,
                'message' => 'Reward saved successfully with id ' . $reward->id,
                'reward_id' => $reward->id
            ], Response::HTTP_CREATED);
        }
        return response()->json([
            'success' => false,
            'message' => 'Reward saved failed'
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function show(Reward $reward)
    {
        $rewardCodes = $reward->rewardCodes;
        return new RewardResource($reward);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reward $reward)
    {
        if ($request->has('name')) $reward->name = $request->get('name');
        if ($request->has('detail')) $reward->detail = $request->get('detail');
        if ($request->has('point')) $reward->point = $request->get('point');
        if ($request->has('total_amount'))  $reward->total_amount = $request->get('total_amount');
        if ($request->has('balance'))  $reward->balance = $request->get('balance');
        if ($request->has('is_active'))  $reward->is_active = $request->get('is_active');
        if ($reward->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Reward updated successfully with id ' . $reward->id,
                'reward_id' => $reward->id
            ], Response::HTTP_OK);
        }
        return response()->json([
            'success' => false,
            'message' => 'Reward saved failed'
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reward $reward)
    {
        $name = $reward->name;
        if ($reward->delete()) {
            return response()->json([
                'success' => true,
                'message' => "Reward {$name} deleted successfully"
            ], Response::HTTP_OK);
        }
        return response()->json([
            'success' => false,
            'message' => "Reward {$name} deleted failed"
        ], Response::HTTP_BAD_REQUEST);
    }

    public function search(Request $request) {
        $q = $request->query('q');
        $rewards = Reward::where('name', 'LIKE', "%{$q}%")
                         ->orWhere('detail', 'LIKE', "%{$q}%")
                         ->get();
        return $rewards;
    }
}
