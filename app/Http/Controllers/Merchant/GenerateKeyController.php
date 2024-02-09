<?php

namespace App\Http\Controllers\Merchant;

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
use Illuminate\Support\Facades\Http;

class GenerateKeyController extends Controller
{
    public function generateNewKeys()
{
    // Get the logged-in user's ID (you might have your own way to get the user ID)
    $userId = auth()->id();
    // //

    // Request new keys from Go API
    $response = Http::get("http://192.168.100.35:4051/generate-keys/{$userId}");

    if ($response->successful()) {
        return back()->with('success', 'New keys generated successfully.');
    } else {
        return back()->with('error', 'Error generating new keys from Go API.');
    }
}

public function displayKeys()
{
    // Get the logged-in user's ID (you might have your own way to get the user ID)
    $userId = auth()->id();

    // Request keys from Go API
    $response = Http::get("http://192.168.100.84:8080/generate-keys/{$userId}");

    if ($response->successful()) {
        $apiResponse = $response->json();

        // Assume you have a User model with private_key, public_key, and api_token fields
        $user = auth()->user();
        $user->private_key = $apiResponse['private_key'];
        $user->public_key = $apiResponse['public_key'];
        $user->api_token = $apiResponse['api_token'];
        $user->save();

        return view('backend.merchant.key', $apiResponse);
    } else {
        return response("Error retrieving keys from Go API", $response->status());
    }
}
}
