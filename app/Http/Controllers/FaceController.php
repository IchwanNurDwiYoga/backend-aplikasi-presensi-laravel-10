<?php

namespace App\Http\Controllers;

use App\Models\Face;
use App\Http\Requests\StoreFaceRequest;
use App\Http\Requests\UpdateFaceRequest;
use Illuminate\Http\Request as Request;

class FaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Face::all();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $face = $request->face;
        $data = ['face'=>$face];
        $simpan = Face::create($data);
        return response()->json($simpan);
    }

    /**
     * Display the specified resource.
     */
    public function show(Face $face)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Face $face)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFaceRequest $request, Face $face)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Face $face)
    {
        //
    }
}
