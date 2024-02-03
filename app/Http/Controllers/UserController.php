<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\MerchantDetail;

class UserController extends Controller
{
    public function registerUser(Request $request)
    {
        Log::info('Received request data: ' . json_encode($request->all()));

        // Extract user and merchant data
        $userData = $request->input('user');
        $merchantData = $request->input('merchant');

        // Log extracted user and merchant data
        Log::info('Extracted user data: ' . json_encode($userData));
        Log::info('Extracted merchant data: ' . json_encode($merchantData));
        Log::info('Extracted username: ' . $userData['username']);


        $disk = 'public/images';

        // Save the image to the specified disk

            $passportFile = $merchantData['passport'];
            $decodedImagePassport = base64_decode($passportFile);
            $passportFileName = date('YmdHis').'.jpg';
            //$decodedImage->move(public_path('image'), $passportFileName);
            $passport = 'images/' . $passportFileName;
            
            $licenseFile = $merchantData['license'];
            $decodedImageLicense = base64_decode($licenseFile);
            $licenseFileName = date('YmdHis') .'.jpg';
            //$decodedImage->move(public_path('image'), $licenseFileName);

            $license = 'images/' . $licenseFileName;
            

        // Create user
        $user = User::create([
            'name' => $userData['name'],
            'username' => $userData['username'], // Make sure username is included
            'email' => $userData['email'],
            'mobile_number' => $userData['mobile_number'],
            'password' => bcrypt($userData['password']),
           
            // Add other user fields as needed
        ]);

        // Create merchant details
        MerchantDetail::create([
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
        file_put_contents(public_path( $passport ), $decodedImagePassport);
        file_put_contents(public_path( $license  ), $decodedImagePassport);


        return response()->json(['success' => true]);
    }

}
