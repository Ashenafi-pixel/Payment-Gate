<?php

namespace App\Http\Services;

use App\Helpers\GeneralHelper;
use App\Helpers\IMediaType;
use App\Http\Contracts\IGatewayServiceContract;
use App\Http\Repositories\GatewayRepo;
use App\Http\Repositories\MerchantGatewayRepo;
use App\Http\Repositories\UserRepo;

/**
 * @var GatewayService
 * @author farhan.akram@xintsolutions.com>
 */
class GatewayService implements IGatewayServiceContract
{
    /**
     * @var GatewayRepo
     */
    private GatewayRepo $_gatewayRepo;

    /**
     * @var UserRepo $_userRepo
     */
    private UserRepo $_userRepo;

    /**
     * @param GatewayRepo $_gatewayRepo
     */
    public function __construct(
        GatewayRepo $_gatewayRepo,
        UserRepo    $_userRepo
    )
    {
        $this->_gatewayRepo = $_gatewayRepo;
        $this->_userRepo = $_userRepo;
    }

    /**
     * @return mixed
     */
    public function getAllGateways(): mixed
    {
        return $this->_gatewayRepo->all();
    }

    /**
     * @param $gateway_id
     * @return object
     */
    public function getGateway($gateway_id): object
    {
        return $this->_gatewayRepo->find(decrypt($gateway_id));
    }

    /**
     * @param $request
     * @param $gateway_id
     * @return mixed
     */
    public function updateGateway($request, $gateway_id): mixed
    {
        if ($request->has('gateway_logo')) {
            $image = GeneralHelper::UPLOAD_FILE($request->gateway_logo, 'uploads/admin/gateway-logo');
            if ($image) {
                $this->_gatewayRepo->update($gateway_id, $this->_filterUpdateGatewayRequest($request->all()));
                $gateway = $this->_gatewayRepo->find($gateway_id);
                return $gateway->image()->update([
                    'url' => $image,
                    'type' => IMediaType::IMAGE,
                ]);
            }
        } else
            return $this->_gatewayRepo->update($gateway_id, $this->_filterUpdateGatewayRequest($request->all()));
    }

    /**
     * @param $request
     * @return array
     */
    private function _filterUpdateGatewayRequest($request): array
    {
        return [
            'name' => $request['name'],
            'currency_name' => $request['currency_name'],
            'status' => $request['status'],
        ];
    }

    /**
     * @param $request
     * @return mixed
     */
    public function installMerchantGateway($request): mixed
    {
        return $this->_userRepo->findById(auth()->id())->merchantGateway()->updateOrCreate([
            'user_id' => auth()->id(),
            'gateway_id' => $request['gateway_id'],
        ], [
            'status' => $request['status'],
        ]);
    }

    /**
     * @param $merchant
     * @return mixed
     */
    public function getMerchantsGateways($merchant = null): mixed
    {
        $user = $merchant ?? auth()->user();
        return $user->merchantGateways;
    }
}
