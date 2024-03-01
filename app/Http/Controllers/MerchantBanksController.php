<?php

namespace App\Http\Controllers;

use App\Models\MerchantBanks;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMerchantBanksRequest;
use App\Http\Requests\UpdateMerchantBanksRequest;
use App\Models\Banks;

class MerchantBanksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banks = Banks::all();
        return  view('backend.merchant.bank.index', compact('banks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Banks $bank)
    {
        $bankServices = $bank->bankServices;
        dd($bankServices);
        return  view('backend.merchant.bank.create', compact('bankServices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMerchantBanksRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMerchantBanksRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MerchantBanks  $merchantBanks
     * @return \Illuminate\Http\Response
     */
    public function show(MerchantBanks $merchantBanks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MerchantBanks  $merchantBanks
     * @return \Illuminate\Http\Response
     */
    public function edit(MerchantBanks $merchantBanks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMerchantBanksRequest  $request
     * @param  \App\Models\MerchantBanks  $merchantBanks
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMerchantBanksRequest $request, MerchantBanks $merchantBanks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MerchantBanks  $merchantBanks
     * @return \Illuminate\Http\Response
     */
    public function destroy(MerchantBanks $merchantBanks)
    {
        //
    }
}
