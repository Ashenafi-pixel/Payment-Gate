<?php

namespace App\Imports;

use App\Helpers\GeneralHelper;
use App\Models\MerchantCustomer;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class MerchantCustomerImport implements ToModel,WithStartRow,ShouldQueue,WithChunkReading,WithHeadingRow, WithValidation
{

    /**
     * @var $merchant_id
     */
    private $merchant_id;

    /**
     * @param $merchant_id
     */
    public function __construct($merchant_id)
    {
        $this->merchant_id = $merchant_id;
    }

    /**
    * @param array $row
    *
    * @return Model|null
    */
    public function model(array $row): Model|MerchantCustomer|null
    {
        return new MerchantCustomer([
            'user_id'        =>  $this->merchant_id,
            'name'           =>  $row['name'],
            'email'          =>  $row['email'],
            'mobile_number'  =>  $row['mobile_number'],
            'status'         =>  $row['status'],
        ]);
    }

    /**
     * @return int
     */
    public function chunkSize(): int
    {
        return 1000;
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return  [
          'name'    => 'required',
          'email'    => 'required',
          'mobile_number'    => 'required',
        ];
    }
}
