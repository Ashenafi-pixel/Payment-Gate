<?php

namespace App\Http\Controllers\Merchant;
use Carbon\Carbon;
use App\Http\Services\PulsarService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use App\Models\MerchantBank;
use App\Models\UserBankAccount;
use Illuminate\Support\Facades\Log;
use App\Models\Service;
use App\Models\User;
use App\Models\ApiKey;
use App\Models\MerchantDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Helpers\IUserRole;
use App\Helpers\GeneralHelper;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use App\Imports\MerchantCustomerImport;
use App\Http\Contracts\ICustomerServiceContract;
use Illuminate\Contracts\Foundation\Application;
use App\Http\Requests\Merchant\Customer\ImportCustomerRequest;
use App\Http\Requests\Merchant\Customer\CreateCustomerRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
class MerchantServicesController extends Controller
{



    public function index()
    {
            $userId=auth()->user()->id;
            $user = User::findOrFail($userId);
            $services = $user->services;
        return view('backend.merchant.service.index', compact('user', 'services'));
    }
    public function editUserServices()
    {
        $user = Auth::user();
        $services = Service::all();

        return view('backend.merchant.service.index', compact('user', 'services'));
    }

    public function updateUserServices(Request $request)
    {
        $user = Auth::user();

        // Sync selected services with the user
        $user->services()->sync($request->input('services', []));

        return redirect()->back()->with('success', 'Services updated successfully.');
    }
    public function edit(User $user)
    {
        $services = Service::all();
        return view('backend.merchant.service.index', compact('user', 'services'));
    }

    public function update(Request $request, User $user)
    {
        $user->services()->sync($request->input('services', []));

        return redirect()->route(\App\Helpers\IUserRole::MERCHANT_ROLE .'user.edit-services', $user)->with('success', 'Services updated successfully.');
    }
    public function apiKeyService(Request $request)
    {
        try
        {
        $userId=auth()->id();
        $merchant=auth()->user()->merchantDetail()->first();
        $authToken = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJlbWFpbCI6ImZpdHN1bWdldHU4OEBnbWFpbC5jb20iLCJpYXQiOjE3MDE2ODU3OTQsImp0aSI6InVuaXF1ZV90b2tlbl9pZCJ9.zCboQ1gV73ucrM4FTbULQlildzbNkuw6iGxoYGjZ9iM";
        $pulsarService = new PulsarService($authToken);
        $list=$pulsarService->listTenants();
        $dataArray = $list['data'];
        $targetTenant = $merchant->company_name;
        $targetTenant=str_replace(' ', '', trim($targetTenant));
        if (in_array($merchant->id, $dataArray)) {
            echo "The tenant '$merchant->id' exists.";
        }
         else {
        $responseData = $pulsarService->createTenant($merchant->id);
         }
        $ser=Service::where('id',$request->input('services'))->first();
        $filtered_service= str_replace(' ', '', trim($ser->name));
        $names=$pulsarService->createNamespace($merchant->id, $filtered_service);
        //dd($names);
        $api_key=$request['api_key'];
        $api_key_id=ApiKey::where('api_key',$api_key)->first();
        $service=$request->input('services', []);
        $expiryDate = $request->input('expiry_date');
        $merchantId=$merchant->id;
        if($request->input('action')==="generate"){
            $response = Http::get("http://192.168.100.35:4051//generate-keys/{$merchant->id}");
            if ($response->successful()) {
                $responseArray = json_decode($response, true);
                $privateKey = $responseArray['private_key'];
                $publicKey = $responseArray['public_key'];
                $apiToken = $responseArray['api_token'];
                $apiKey=ApiKey::where('api_key',$apiToken.'_'.$merchant->id)->first();
                    if($apiKey){
                        $apiKey->service=$service;
                        $apiKey->expiry_date=$expiryDate;
                    }
                $apiKey->save();
                return back()->with('success', 'New keys generated successfully.');
            } else {
                return back()->with('error', 'Error generating new keys from Go API.');
            }
        return redirect()->route(\App\Helpers\IUserRole::MERCHANT_ROLE .'user.edit-services')->with('success', 'Services updated successfully.');
        }
        else
        {
            $apiKey=ApiKey::where('api_key',$api_key)->first();
            $existingServices = $apiKey->service ?? [];
            $newServices =$service;
            $mergedServices = array_merge($existingServices, $newServices);
            $uniqueServices = array_unique($mergedServices);
            $apiKey->service = $uniqueServices;
            $apiKey->expiry_date=$expiryDate;
            $apiKey->save();
            return back()->with('success', 'keys Updated successfully.');
        }
}
    catch (\Exception $e) {
        // Log the exception
        Log::error('Error creating API key: ' . $e->getMessage());
        // You can customize the response based on the error
        return back()->with('error', 'An error occurred while creating the API key.');
    }
}
public function getTransaction(){
    $merchant=auth()->user()->merchantDetail()->first();
    $url = 'http://localhost:8085/calculate-total-amount?merchant_id='.$merchant->id;
    $response = Http::get($url);
    $responseData = $response->json();
    $merchantID = $responseData['merchant_id'];
    $count = $responseData['total'];
    dd($count);
    return response()->json($responseData);
}
}
