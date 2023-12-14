<?php
/**
 * @author Shaarif<m.shaarif@xintsolutions.com>
 */

return [
    'transaction_type' => [
        \App\Helpers\ITransactionTypes::TOP_UP          =>  'Mobile Top up',
        \App\Helpers\ITransactionTypes::UTILITY_BILLS   =>  'Utility Bills',
        \App\Helpers\ITransactionTypes::MOBILE_BUNDLE   =>  'Mobile Bundle',
        \App\Helpers\ITransactionTypes::SCHOOL_FEE      =>  'School Fee',
        \App\Helpers\ITransactionTypes::BUS_TICKET      =>  'Bus Ticket',
        \App\Helpers\ITransactionTypes::AIR_TICKET      =>  'Air ticket',
        \App\Helpers\ITransactionTypes::MONEY_TRANSFER  =>  'Money transfer',
        \App\Helpers\ITransactionTypes::INVOICE         =>  'Payment of invoice',
        \App\Helpers\ITransactionTypes::REFUND          =>  'Refund Payment of invoice',
    ]
];
