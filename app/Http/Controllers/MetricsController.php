<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMetricsRequest;
use App\Http\Requests\UpdateMetricsRequest;
use App\Models\Metrics;

class MetricsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreMetricsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Metrics $metrics)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Metrics $metrics)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMetricsRequest $request, Metrics $metrics)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Metrics $metrics)
    {
        //
    }
}
