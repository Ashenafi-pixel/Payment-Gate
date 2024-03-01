<?php

namespace App\Http\Controllers;

use App\Models\BankService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBankServiceRequest;
use App\Http\Requests\UpdateBankServiceRequest;
use App\Models\Banks;
use Illuminate\Http\Request;

class BankServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Banks $bank)
    {
        return view('backend.admin.bank_service.index', compact('bank'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Banks $bank)
    {
        return view('backend.admin.bank_service.create', compact('bank'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBankServiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Banks $bank)
    {
        $name = $request->get('name');
        BankService::create(['banks_id'=>$bank->id, 'name'=>$name]);
        return redirect()->route('admin.bank-service.index', ['bank'=>$bank])->with('success', 'Servce successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BankService  $bankService
     * @return \Illuminate\Http\Response
     */
    public function show(BankService $bankService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BankService  $bankService
     * @return \Illuminate\Http\Response
     */
    public function edit(Banks $bank, BankService $bankService)
    {
        return view('backend.admin.bank_service.edit', compact('bankService', 'bank'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBankServiceRequest  $request
     * @param  \App\Models\BankService  $bankService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Banks $bank, BankService $bankService)
    {
        $name = $request->get('name');

        $bankService->update(['name'=>$name]);

        return redirect()->route('admin.bank-service.index', ['bank' => $bank])->withSuccess("The service has been updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankService  $bankService
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankService $bankService)
    {
        //
    }
}
