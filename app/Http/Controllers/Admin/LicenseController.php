<?php

namespace App\Http\Controllers\Admin;
use App\Helpers\GeneralHelper;
use App\Helpers\IUserRole;
use App\Http\Contracts\IMerchantDetailServiceContract;
use App\Http\Contracts\IUserServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Repositories\UserRepo;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use  App\Models\User;
use  App\Models\MerchantDetail;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
class LicenseController extends Controller
{

    public function check($license_number)
    {

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-auth-token' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJlbWFpbCI6ImZpdHN1bWdldHU4OEBnbWFpbC5jb20iLCJpYXQiOjE2OTU0NjA3MjEsImp0aSI6InVuaXF1ZV90b2tlbl9pZCJ9.mg9kG7SA7QeOoySIE-g0ggzd9KBoWWdlvFwvNnrQmMg',
        ])->post("https://party.qa.addissystems.et/CheckLicenseNotExist/{$license_number}");

        $data = $response->json();

        return view('backend.admin.li', ['licenseExists' => $licenseExists]);
    }


    public function checkLicense(Request $request)
    {

        //$encodedData = $request->input('encodedData');
        $encodedData = urlencode($request->input('encodedData'));

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-auth-token' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJlbWFpbCI6ImZpdHN1bWdldHU4OEBnbWFpbC5jb20iLCJpYXQiOjE2OTU0NjA3MjEsImp0aSI6InVuaXF1ZV90b2tlbl9pZCJ9.mg9kG7SA7QeOoySIE-g0ggzd9KBoWWdlvFwvNnrQmMg',
        ])->post("https://party.qa.addissystems.et/CheckLicenseNotExist/{$encodedData}");

        $data = $response->json();
        return view('backend.admin.display')->with('data', $data);
    }
}
