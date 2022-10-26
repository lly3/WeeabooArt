<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommissionResource;
use App\Models\Commission;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class CommissionController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commissions = Commission::get();
        return CommissionResource::collection($commissions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $commission = new Commission();
        $commission->title = $request->get('title');
        $commission->description = $request->get('description') ?? "ไม่ระบุรายละเอียดเพิ่มเติม";
        $commission->user_id = auth()->user()->id;

        if (! $commission->save()) {
            return response()->json([
                'success' => false,
                'message' => 'Commission saved failed'
            ], Response::HTTP_BAD_REQUEST);
        }

        $imagesID = json_decode($request->get('imagesID'));
        foreach (Image::find($imagesID)->all() as $image) {
           $commission->images()->save($image); 
        }

        return response()->json([
            'success' => true,
            'message' => 'Commission saved successfully with id ' . $commission->id,
            'commission_id' => $commission->id
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $commission = Commission::find($id);
        return new CommissionResource($commission);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function edit(Commission $commission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commission $commission)
    {
        if ($request->has('title')) $commission->title = $request->get('title');
        if ($request->has('description')) $commission->description = $request->get('description');
        if ($commission->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Commission saved successfully with id ' . $commission->id,
                'commission_id' => $commission->id
            ], Response::HTTP_CREATED);
        }
        return response()->json([
            'success' => false,
            'message' => 'Commission saved failed'
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commission $commission)
    {
        $commission_title = $commission->title;
        if ($commission->delete()) {
            return response()->json([
                'success' => true,
                'message' => "Commission {$commission_title} deleted successfully"
            ], Response::HTTP_OK);
        }
        return response()->json([
            'success' => false,
            'message' => "Commission {$commission_title} deleted failed"
        ], Response::HTTP_BAD_REQUEST);
    }
}
