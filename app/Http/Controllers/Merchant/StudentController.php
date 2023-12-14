<?php

namespace App\Http\Controllers\Merchant;

use App\Helpers\GeneralHelper;
use App\Helpers\IUserRole;
use App\Http\Contracts\ICustomerServiceContract;
use App\Http\Contracts\IImportServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Merchant\Student\CreateStudentRequest;
use App\Http\Requests\Merchant\Student\ImportStudentRequest;
use App\Imports\MerchantStudentImport;
use App\Models\MerchantStudent;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    /**
     * @author Farhan <farhan.akram@xintsolutions.com>
     */

    # Constants
    const STUDENT_INDEX_VIEW  = 'backend.merchant.students.index';
    const STUDENT_CREATE_VIEW  = 'backend.merchant.students.student';
    const STUDENT_INDEX_ROUTE  =   IUserRole::MERCHANT_ROLE.'.students.index';

    /**
     * @var ICustomerServiceContract
     */
    private ICustomerServiceContract $_customerService;

    /**
     * @param ICustomerServiceContract $_customerService
     */
    public function __construct(ICustomerServiceContract $_customerService)
    {
        parent::__construct();
        $this->_customerService = $_customerService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $students = $this->_customerService->getAllStudents();
        return view(self::STUDENT_INDEX_VIEW,get_defined_vars());
    }

    /**
     * @return Application|Factory|View
     */
    public function createStudentForm()
    {
        return view(self::STUDENT_CREATE_VIEW);
    }

    /**
     * @param CreateStudentRequest $request
     * @return JsonResponse|RedirectResponse
     */
    public function saveStudent(CreateStudentRequest $request)
    {
        $student_request = $this->_customerService->saveStudent($this->_filterCreateStudentRequest($request->all())) ;
        return $student_request ? GeneralHelper::SEND_RESPONSE($request,$student_request,self::STUDENT_INDEX_ROUTE,config('constants.generalMessages.student_create_success')) :
            GeneralHelper::SEND_RESPONSE($request,false,null,null,config('constants.generalMessages.student_create_error'));
    }

    /**
     * @param $student_id
     * @return Application|Factory|View
     */
    public function editStudentForm($student_id)
    {
        $student = $this->_customerService->getStudent($student_id);
        return view(self::STUDENT_CREATE_VIEW, get_defined_vars());
    }

    /**
     * @param CreateStudentRequest $request
     * @param $student_id
     * @return JsonResponse|RedirectResponse
     */
    public function updateStudentForm(CreateStudentRequest $request, $student_id)
    {
        $student_request = $this->_customerService->updateStudent($this->_filterCreateStudentRequest($request->all()),decrypt($student_id)) ;
        return $student_request ? GeneralHelper::SEND_RESPONSE($request,$student_request,self::STUDENT_INDEX_ROUTE,config('constants.generalMessages.student_update_success')) :
            GeneralHelper::SEND_RESPONSE($request,false,null,null,config('constants.generalMessages.student_update_error'));
    }

    /**
     * @param $request
     * @return array
     */
    private function _filterCreateStudentRequest($request)
    {
        return [
            'user_id'       =>  auth()->id(),
            'name'          =>  $request['name'],
            'email'         =>  $request['email'],
            'mobile_number' =>  $request['mobile_number'],
            'address'       =>  $request['address'],
            'father_name'   =>  $request['father_name'],
            'class'         =>  $request['class'],
            'section'       =>  $request['section'],
            'status'        =>  $request['status'],
        ];
    }

    /**
     * @param ImportStudentRequest $request
     * @return JsonResponse|RedirectResponse|void
     */
    public function importStudents(ImportStudentRequest $request)
    {
        if ($request->hasFile('import_file')){
            $bulk_import = Excel::queueImport(new MerchantStudentImport(auth()->id()), request()->file('import_file'),'');
            if (!empty($bulk_import))
                return GeneralHelper::SEND_RESPONSE($request,$bulk_import,null,config('constants.generalMessages.import_success'));
            else
                return GeneralHelper::SEND_RESPONSE($request,false,null,null,config('constants.generalMessages.import_error'));
        }
    }
}
