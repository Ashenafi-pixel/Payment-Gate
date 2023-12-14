<?php

namespace App\Http\Controllers\Merchant;

use App\Helpers\GeneralHelper;
use App\Helpers\IUserRole;
use App\Http\Contracts\IGatewayServiceContract;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * @var MerchantGatewayController
 * @author Shaarif<m.shaarif@xintsolutions.com>
 */
class MerchantGatewayController extends Controller
{
    # Gateway Index View
    const GATEWAY_INDEX_VIEW = 'backend.merchant.gateways.index';

    /**
     * @var IGatewayServiceContract $_gatewayService
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
        return view(self::GATEWAY_INDEX_VIEW,compact('gateways'));
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function installGatewayForm($id)
    {
        $gateway = $this->_gatewayService->getGateway($id);
        return view('backend.merchant.gateways.gateway',compact('gateway'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function installGateway($id,Request $request)
    {
        $install_gateway = $this->_gatewayService->installMerchantGateway($this->_filterMerchantInstallGatewayRequest($id,$request->all()));
        return $install_gateway ? GeneralHelper::SEND_RESPONSE($request,$install_gateway,IUserRole::MERCHANT_ROLE.'.gateway.index','Gateway Installed Successfully!') :
                GeneralHelper::SEND_RESPONSE($request,false,'','','Gateway Not Installed!');
    }

    /**
     * @param $id
     * @param $request
     * @return array
     */
    private function _filterMerchantInstallGatewayRequest($id,$request)
    {
        return [
          'gateway_id'  =>  decrypt($id),
          'status'      =>  $request['status']
        ];
    }

}
