<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\GeneralHelper;
use Illuminate\Support\Facades\Http;
use App\Helpers\IUserRole;
use App\Http\Controllers\Admin\Redirect;
use App\Http\Controllers\Controller;
use App\Http\Services\BankService;
use App\Models\Banks;
use App\Models\BankService as ModelsBankService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;


/**
 * @var BanksController
 * @author Shaarif<shaarifsabah5299@gmail.com>
 */
class BanksController extends Controller
{


    const GATEWAY_INDEX_VIEW = 'backend.admin.banks.index';
    const GATEWAY_INDEX_ROUTE = IUserRole::ADMIN_ROLE . '.banks.index';

    /**
     * @var BankService $_bankService
     */
    private BankService $_bankService;
    protected $authToken;

    /**
     * @param BankService $_bankService
     */
    public function __construct(BankService $_bankService)
    {
        parent::__construct();
        $this->_bankService = $_bankService;
        $this->authToken = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJlbWFpbCI6ImZpdHN1bWdldHU4OEBnbWFpbC5jb20iLCJpYXQiOjE3MDE2ODU3OTQsImp0aSI6InVuaXF1ZV90b2tlbl9pZCJ9.zCboQ1gV73ucrM4FTbULQlildzbNkuw6iGxoYGjZ9iM';

    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $banks = $this->_bankService->getAllBanks();
        return view(
            'backend.admin.banks.index',
            compact(
                'banks',
            )
        );
    }

    public function edit(Banks $bank)
    {
        return view('backend.admin.banks.edit', compact('bank'));
    }

    public function create()
    {
        return view('backend.admin.banks.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'swift_code' => 'required|string|max:255',
        ]);

        // Create a new bank record in the database
        $bank = new Banks();
        $bank->name = $request->name;
        $bank->swift_code = $request->swift_code;
        $bank->save();

        // Create tenant in Pulsar with the name of the bank
        $tenantName = $request->name;
        $this->createTenant($tenantName);

        $message = "Bank Added successfully";
        return redirect()->route('admin.banks.index')->with('message', $message);
    }

    public function createTenant($tenantName)
    {
        $apiEndpoint = 'https://product.qa.addissystems.et/pulsar/create-tenant';
        $headers = [
            'x-auth-token' => $this->authToken,
            'Content-Type' => 'application/json',
        ];
        $requestBody = [
            'tenantName' => $tenantName,
        ];

        try {
            $response = Http::withHeaders($headers)->post($apiEndpoint, $requestBody);
            return $response->json();
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
                'response' => $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null,
            ];
        }
    }


    public function destroy(Banks $bank)
    {
        $bank->delete();

        return redirect()->back()->with('success', 'Bank deleted successfully');
    }

    public function update(Banks $bank, Request $request)
    {
        $name = $request->get('name');
        $swift_code = $request->get('swift_code');

        $bank->update(['name' => $name, 'swift_code' => $swift_code]);

        return redirect()->back()->with('success', 'Bank edited successfully');
    }

    public function updateServiceStatus(Request $request)
    {
        $serviceId = $request->input('service_id');
        $isChecked = $request->input('is_checked') == 1 ? true : false;

        $service = ModelsBankService::find($serviceId);

        $service->update(['status' => $isChecked]);

        return response()->json(['success' => true]);
    }
}