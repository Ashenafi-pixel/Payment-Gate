<?php

namespace App\Http\Services;

use App\Http\Contracts\IBankContract;
use App\Http\Repositories\BankRepo;

/**
* @var BankService
* @author Shaarif <m.shaarif@xintsolutions.com>
*/
class BankService implements IBankContract
{

    /**
     * @var BankRepo
     */
    private BankRepo $_bankRepo;

    /**
     * @param BankRepo $_bankRepo
     */
    public function __construct(BankRepo $_bankRepo)
    {
        $this->_bankRepo = $_bankRepo;
    }

    /**
     * @return mixed
     */
    public function getAllBanks():mixed
    {
        return $this->_bankRepo->all();
    }

}
