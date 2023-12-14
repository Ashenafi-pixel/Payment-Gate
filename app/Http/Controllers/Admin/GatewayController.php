<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\GeneralHelper;
use App\Helpers\IUserRole;
use App\Http\Contracts\IGatewayServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Gateway\CreateGatewayRequest;
use App\Models\Gateway;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GatewayController extends Controller
{
    /**
     * @author Farhan <farhan.akram@xintsolutions.com>
     */

    # Constants
    const GATEWAY_INDEX_VIEW  = 'backend.admin.gateways.index';
    const GATEWAY_CREATE_VIEW  = 'backend.admin.gateways.gateway';
    const GATEWAY_INDEX_ROUTE  =   IUserRole::ADMIN_ROLE.'.gateways.index';

    /**
     * @var IGatewayServiceContract
     */
    private IGatewayServiceContract $_gatewayService;

    /**
     * @param IGatewayServiceContract $_gatewayService
     */
    public function __construct(IGatewayServiceContract $_gatewayService)
    {
        parent::__construct();
        $this->_gatewayService = $_gatewayService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $gateways = $this->_gatewayService->getAllGateways();
        return view(self::GATEWAY_INDEX_VIEW,get_defined_vars());
    }

    /**
     * @param $gateway_id
     * @return Application|Factory|View
     */
    public function editGatewayForm($gateway_id)
    {
        $gateway = $this->_gatewayService->getGateway($gateway_id);
        return view(self::GATEWAY_CREATE_VIEW, get_defined_vars());
    }

    /**
     * @param CreateGatewayRequest $request
     * @param $gateway_id
     * @return JsonResponse|RedirectResponse
     */
    public function updateGatewayForm(CreateGatewayRequest $request, $gateway_id)
    {
        $gateway_request = $this->_gatewayService->updateGateway($request,decrypt($gateway_id)) ;
        return $gateway_request ? GeneralHelper::SEND_RESPONSE($request,$gateway_request,self::GATEWAY_INDEX_ROUTE,config('constants.generalMessages.gateway_update_success')) :
            GeneralHelper::SEND_RESPONSE($request,false,null,null,config('constants.generalMessages.gateway_update_error'));
    }
}
