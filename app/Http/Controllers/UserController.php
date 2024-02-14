<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\MerchantDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
class UserController extends Controller
{
    public function registerUser(Request $request)
    {
        try{
            Log::info('Received request data: ' . json_encode($request->all()));

        // Extract user and merchant data
        $userData = $request->input('user');
        $merchantData = $request->input('merchant');

        // Log extracted user and merchant data
        Log::info('Extracted user data: ' . json_encode($userData));
        Log::info('Extracted merchant data: ' . json_encode($merchantData));
        Log::info('Extracted username: ' . $userData['username']);
            $passportFile = $merchantData['passport'];
            $decodedPassportImage = base64_decode($passportFile);
            $currentDateTime = Carbon::now()->format('YmdHisu');
            $randomNumber = mt_rand(0, 100);
            $result = $currentDateTime . '_' . $randomNumber;
            $passportFileName = date('YmdHis') .$result .'.jpg';
            //$decodedImage->move(public_path('image'), $passportFileName);
            $passport = 'images/' . $passportFileName;
            $licenseFile = $merchantData['license'];
            $decodedLicenseImage = base64_decode($licenseFile);
            $currentDateTime = Carbon::now()->format('YmdHisu');
            $randomNumber = mt_rand(0, 100);
            $result = $currentDateTime . '_' . $randomNumber;
            $licenseFileName = date('YmdHis')  .$result.'.jpg';
            //$decodedImage->move(public_path('image'), $licenseFileName);
            $license = 'images/' . $licenseFileName;


        // Create user
        $user = User::create([
            'name' => $userData['name'],
            'username' => $userData['username'], // Make sure username is included
            'email' => $userData['email'],
            'mobile_number' => $userData['mobile_number'],
            'password' => Hash::make($userData['password']),

            // Add other user fields as needed
        ]);
        DB::table('model_has_roles')->insert([
            'role_id'=>'2',
            'model_type'=>'App\Models\User',
            'model_id'=>$user->id]);
        // Create merchant details
        $merchant =MerchantDetail::create([
            'user_id' => $user->id,
            'company_name' => $merchantData['company_name'],
            'company_phone' => $merchantData['company_phone'],
            'company_email' => $merchantData['company_email'],
            'company_address'=>$merchantData['company_email'],
            'license'=>$license,
            'passport'=>$passport,
            'license_number'=>$merchantData['license_number'],
            // Add other merchant fields as needed
        ]);
        file_put_contents(public_path( $passport ), $decodedPassportImage);
        file_put_contents(public_path( $license  ), $decodedLicenseImage);
        return response()->json(['success' => 'Your registration is successfull and your Merchant ID is : ','merchant_id'=>$merchant->id]);
    }catch (QueryException $exception) {
        Log::error('Database error during registration: ' . $exception->getMessage());
        return response()->json(['error' => 'An error occurred during registration. Please try again.'], 500);
    } catch (\Exception $exception) {
        Log::error('Unexpected error during registration: ' . $exception->getMessage());
        return response()->json(['error' => 'An unexpected error occurred. Please contact support.'], 500);
    }
}
    public function showStatus(Request $request, $merchant_id)
    {
        try {
            $merchant = MerchantDetail::findOrFail($merchant_id);
            return response()->json(['status' => $merchant->status]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            $error = "We cannot find such merchant by this ID";
            return response()->json(['status' => $error], 404);
        }
    }
}
