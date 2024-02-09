<?php

namespace App\Http\Controllers\Merchant;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use App\Models\MerchantBank;
use App\Models\UserBankAccount;
use Illuminate\Support\Facades\Log;
use App\Models\Banks;
use App\Models\User;
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
        return view('backend.merchant.banks.banks', compact('banks'));
    }
    public function merchantBank()
    {
        try {
            $userId = Auth::id();

            // Use join to retrieve bank information along with user information
            $banks = UserBankAccount::where('user_id', $userId)
                ->join('banks', 'user_bank_accounts.bank_id', '=', 'banks.id')
                ->join('users', 'user_bank_accounts.user_id', '=', 'users.id')
                ->select('user_bank_accounts.*', 'banks.name as bank_name', 'users.name as user_name')
                ->get();

            if ($banks->isEmpty()) {
                // Handle the case where no bank accounts are found
                return view('backend.merchant.banks.bank_list')->with('error', 'No bank accounts found.');
            }

            return view('backend.merchant.banks.bank_list', compact('banks'));
        } catch (\Exception $e) {
            Log::error('Unexpected error in merchantBank method: ' . $e->getMessage());
            dd($e); // Dump the exception details for debugging
            return view('backend.merchant.banks.bank_list')->with('error', 'An unexpected error occurred.');
        }
    }


    public function linkBank(Request $request)
{
    try {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Unauthorized');
        }

        $userId = Auth::id(); // Get the authenticated user's ID
        //$merchant = UserBankAccount::where('user_id', $userId)->firstOrFail();

        $bank = Banks::findOrFail($request->input('bank_id'));

        $pivotData = [
            'account_number' => $request->input('account_number') // Generate a random account number
        ];

        $merchantBank = new UserBankAccount();
        $merchantBank->user_id = $userId;
        $merchantBank->bank_id = $bank->id;
        $merchantBank->account_no = $pivotData['account_number'];
        $merchantBank->save();
        Session::flash('success','Bank linked successfully!');
        return redirect()->back();
        //return redirect()->back()->with('success', 'Bank linked successfully!');
    } catch (QueryException $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'Database error occurred');
    } catch (\Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred');
    }
}
}
