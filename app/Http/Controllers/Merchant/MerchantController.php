<?php

namespace App\Http\Controllers\Merchant;
use App\Models\MerchantBank;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use App\Models\Banks;
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

class MerchantController extends Controller
{
    public function showLinkBankForm()
    {
        $banks = Banks::all();
        return view('backend.merchant.link_bank', compact('banks'));
    }

    public function linkBank(Request $request)
{
    try {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Unauthorized');
        }

        $userId = Auth::id(); // Get the authenticated user's ID
        $merchant = MerchantDetail::where('user_id', $userId)->firstOrFail();

        $bank = Banks::findOrFail($request->input('bank_id'));

        $pivotData = [
            'balance' => 0,
            'account_number' => Str::random(10) // Generate a random account number
        ];

        $merchantBank = new MerchantBank();
        $merchantBank->merchant_id = $merchant->id;
        $merchantBank->bank_id = $bank->id;
        $merchantBank->balance = $pivotData['balance'];
        $merchantBank->account_number = $pivotData['account_number'];
        $merchantBank->save();

        return redirect()->back()->with('success', 'Bank linked successfully!');
    } catch (QueryException $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'Database error occurred');
    } catch (\Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred');
    }
}
}
