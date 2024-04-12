<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PlanStoreRequest;
use App\Models\Plan;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PlanController extends Controller
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
    public function store(PlanStoreRequest $request)
    {
        // $url = env("APP_URL");
        // preg_match('/^(?:https?:\/\/)?(?:www\.)?([^\/]+)/i', $url, $matches);
        // $domain_path = isset($matches[1]) ? $matches[1] : '';


        $user_id = Auth::user()->id;
        $plan = $request->plan;
        $company = $request->company;
        $domain = $request->domain;

        $tenant = Tenant::create();
        $tenant->domains()->create(['domain'=>$domain]);

        $plan = Plan::create([
            'user' => $user_id,
            'plan' => $plan,
            'company' => $company,
            'domain' => $domain,
        ]);


        return response()->json([
            'status' => 'Success',
            "tentent_id" => $tenant->id,
            'data' => $plan
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $plan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan $plan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        //
    }
}
