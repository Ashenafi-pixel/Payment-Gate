<?php

namespace App\Helpers;

/**
 * @var ITransactionTypes
 * @author Shaarif<m.shaarif@xintsolutions.com>
 */
interface ITransactionTypes
{

    const TOP_UP        = 'top_up';
    const UTILITY_BILLS = 'utility_bills';
    const MOBILE_BUNDLE = 'mobile_bundle';
    const SCHOOL_FEE    = 'school_fee';
    const BUS_TICKET    = 'bus_ticket';
    const AIR_TICKET    = 'air_ticket';
    const MONEY_TRANSFER = 'funds_transfer';
    const INVOICE = 'invoice_payment';
    const REFUND = 'invoice_refund';
}
