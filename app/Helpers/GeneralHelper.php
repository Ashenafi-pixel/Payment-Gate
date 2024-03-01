<?php

namespace App\Helpers;

use App\Http\Services\CustomerService;
use App\Http\Services\UserService;
use App\Mail\MailsHandler;
use App\Models\CustomerDetail;
use App\Models\TransactionType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

abstract class GeneralHelper
{

    private const ERROR_MESSAGE = 'Something went wrong.';

    /**
     * @param $date
     * @param int|string $days
     * @return string
     */
    public static function FORMAT_DATE(string $date, int|string $days = ""): string
    {
        return Carbon::parse($date)->addDays($days)->format('d M Y');
    }

    /**
     * Remove Existing File
     *
     * @param string $filepath
     *
     * @return bool
     */
    public static function REMOVE_FILE(string $filepath): bool
    {
        return @unlink(public_path($filepath) ?? '');
    }

    /**
     * Create New Directory
     *
     * @param string $name
     *
     * @return bool
     */
    public static function MAKE_DIR(string $name): bool
    {
        if (!Storage::disk('public')->exists($name)) {
            Storage::disk('public')->makeDirectory($name);
        }

        return true;
    }

    /**
     * @param int $length
     * @return string
     */
    public static function STR_RANDOM(int $length): string
    {
        return Str::random($length);
    }

    /**
     * Upload Given File
     *
     * @param object $file
     * @param string $path
     * @param bool $rename
     * @param bool $unlink
     * @param string|null $oldPath
     *
     * @return bool|string
     */
    public static function UPLOAD_FILE(object $file, string $path, $rename = true, bool $unlink = false, string $oldPath = null)
    {
        $name = $rename ? self::STR_RANDOM(10) . '-' . time() . '.' . $file->getClientOriginalExtension() : $file->getClientOriginalName();
        if (self::MAKE_DIR($path)) {

            Storage::disk('public')->putFileAs($path, $file, $name);
            $full_image_name = '/storage/' . $path . '/' . $name;
            !$unlink ?: self::REMOVE_FILE($oldPath);
            return $full_image_name;
        }

        return false;
    }

    /**
     * @param object|null $user
     * @return string
     */
    public static function WHO_AM_I(object $user = null): string
    {
        return self::GET_ROLE($user ?? auth()->user());
    }

    /**
     * @param object $user
     * @return string
     */
    public static function GET_ROLE(object $user): string
    {
        if ($user->hasRole(IUserRole::ADMIN_ROLE))
            return IUserRole::ADMIN_ROLE;

        if ($user->hasRole(IUserRole::MERCHANT_ROLE))
            return IUserRole::MERCHANT_ROLE;

        if ($user->hasRole(IUserRole::CUSTOMER_ROLE))
            return IUserRole::CUSTOMER_ROLE;

        if ($user->getRoleNames() != NULL && $user->hasRole($user->getRoleNames()[0]))
            return $user->getRoleNames()[0];

        return 'undefined';
    }

    /**
     * Redirection Rules
     *
     * @return string|null
     */
    public static function REDIRECT_TO(): ?string
    {
        $route = null;
        if (self::IS_AUTHENTICATED())
            return sprintf("%s.index", self::WHO_AM_I());

        return back();
    }

    /**
     * Check For Authentication
     *
     * @return bool
     */
    public static function IS_AUTHENTICATED(): bool
    {
        return Auth::check();
    }

    /**
     *
     * SUCCESS RESPONSE
     * @param mixed $data
     * @param string $route
     * @param string|null $sucMsg
     * @return RedirectResponse
     */
    public static function SUCCESS(mixed $data, string $route, string $sucMsg = null): RedirectResponse
    {
        $data = [
            'message' => $sucMsg ?? '',
            'alert_type' => 'success',
            'data' => $data
        ];

        return $route
            ? redirect()->route($route)->with($data)
            : redirect()->back()->with($data['alert_type'], $data['message']);
    }

    /**
     *
     * ERROR RESPONSE
     * @param mixed $data
     * @param string $route
     * @param string|null $errMsg
     * @return RedirectResponse
     */
    public static function ERROR(mixed $data, string $route, string $errMsg = null): RedirectResponse
    {
        $data = [
            'message' => $errMsg ?? self::ERROR_MESSAGE,
            'alert_type' => 'error',
            'data' => $data
        ];

        return $route
            ? redirect()->route($route)->with($data['alert_type'], $data['message'])
            : redirect()->back()->with($data['alert_type'], $data['message']);
    }

    /**
     * User Request Response
     *
     * @param Request $request
     * @param         $data
     * @param string|null $sucMsg
     * @param string|null $route
     * @param string|null $errMsg
     * @param int $totals
     *
     * @return JsonResponse|RedirectResponse
     */
    public static function SEND_RESPONSE(Request $request, $data, string $route = null, string $sucMsg = null, string $errMsg = null, int $totals = 0): JsonResponse|RedirectResponse
    {

        // Send Api Response
        if ($request->ajax()) {
            return $data
                ? response()->json([
                    'message' => $sucMsg,
                    'status' => true,
                    'alert_type' => 'success',
                    'data' => $data,
                    'total' => $totals ?? 0,
                    'url' => $route ? route($route) : null
                ])
                : response()->json([
                    'message' => $errMsg ?? 'Something went wrong.',
                    'status' => false,
                    'alert_type' => 'error',
                    'data' => $data,
                    'url' => $route ? route($route) : null
                ]);
        }

        // Send Web Response
        return $data
            ? self::SUCCESS($data, $route ?? null, $sucMsg)
            : self::ERROR($data, $route ?? null, $errMsg);
    }

    /**
     * @param Request $request
     * @param $data
     * @param string|null $sucMsg
     * @param string|null $errMsg
     * @return JsonResponse|Redirector|RedirectResponse
     */
    public static function SEND_RESPONSE_API(Request $request, $data, string $sucMsg = null, string $errMsg = null)
    {
        // Send Api Response
        if ($request->ajax()) {
            if ($data) {
                return response()->json([
                    'message' => $sucMsg,
                    'status' => true,
                    'alert_type' => 'success',
                    'data' => $data,
                ], 200);
            } else
                return response()->json([
                    'message' => $errMsg ?? 'Something went wrong.',
                    'status' => false,
                    'alert_type' => 'error',
                    'data' => $data,
                ], 200);
        }
    }

    /**
     * Dispatch Mail Job
     *
     * @param $data
     *
     * @return bool|mixed
     */
    public static function DISPATCH_MAIL($data)
    {
        return Mail::to($data['to'])->queue(new MailsHandler($data));
    }

    /**
     * @param int $length
     * @return string
     */
    public static function RANDOM_NO(int $length = 4): string
    {
        
     $characters = '123456789';
     $charactersLength = strlen($characters);
     $randomString = '';
     for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * Get Current User
     *
     * @param mixed ...$key
     *
     * @return Authenticatable|string|null
     */
    public static function USER(...$key)
    {
        $user = auth()->user();

        if (count($key) > 0) {
            $bind = [];
            foreach ($key as $item)
                array_push($bind, $user->{$item} ?? null);
            return implode(' ', $bind);
        }
        return $user;
    }

    /**
     * @param string $status
     * @return string
     */
    public static function USER_STATUS_CLASS(string $status): string
    {
        switch (str_replace(' ', '_', strtoupper($status))) {
            case IUserStatuses::USER_ACTIVE:
                return 'badge-success';
            case IUserStatuses::USER_NON_ACTIVE:
                return 'badge-danger';
            default:
                return 'badge-primary';
        }
    }

    /**
     * @param string $status
     * @return string
     */
    public static function USER_DOCUMENT_STATUS_CLASS(string $status): string
    {
        switch (strtoupper($status)) {
            case IStatuses::PENDING:
                return 'badge-warning';
            case IStatuses::APPROVED:
                return 'badge-success';
            default:
                return 'badge-danger';
        }
    }

    public static function MERCHANT_USER_STATUS_CLASS(string $status): string
    {
        switch ($status) {
            case IUserStatuses::IS_SCHOOL:
                return 'badge-success';
            default:
                return 'badge-danger';
        }
    }

    /**
     * @param int $length
     * @return string
     */
    public static function EMPTY_DASHES(int $length = 8): string
    {
        $dash = '';
        for ($i = 0; $i < $length; $i++) {
            $dash .= '-';
        }
        return $dash;
    }

    /**
     * @param Request $request
     * @param $data
     *
     * @return false|JsonResponse
     */
    public static function VALIDATION_ERROR_RESPONSE(Request $request, $data): bool|JsonResponse
    {
        # Send Api Response
        if ($request->ajax()) {
            return response()->json([
                'message' => $data->first(),
                'status' => false,
                'alert_type' => 'error',
                'error' => self::ERROR_ARRAY($data->toArray()),
            ], 200);
        }
        return false;
    }

    /**
     * @param $errors
     * @return array
     */
    private static function ERROR_ARRAY($errors): array
    {
        $error_array = [];
        foreach ($errors as $key => $error) {
            $error_array[] = $error[0];
        }
        return $error_array;
    }

    /**
     * Select Field Setup
     *
     * @param $data
     * @param string $key
     * @param mixed ...$value
     *
     * @return array
     */
    public static function SELECT_FIELD($data, string $key, ...$value)
    {
        $collection = [];
        if (is_object($data) || is_array($data))
            foreach ($data as $index => $item) {
                $valueString = [];
                foreach ($value as $item2)
                    array_push($valueString, $item->{$item2});

                $collection[$item->{$key}] = implode(' | ', $valueString);
            }
        return $collection;
    }

    /**
     * @param $request
     * @return bool
     */
    public static function REQUEST_FROM_API($request): bool
    {
        $http_header = $request->header('X-Requested-With');
        $api_header = 'XMLHttpRequest';
        return $http_header == $api_header;
    }

    /**
     * Check For Admin
     *
     * @param null $user
     *
     * @return bool
     */
    public static function IS_ADMIN($user = null): bool
    {
        if ($user) {
            $role = IUserRole::ADMIN_ROLE;
        } else {
            $user = auth()->user();
            $role = IUserRole::ADMIN_ROLE;
        }

        return $user !== null ? $user->hasRole($role) : false;
    }

    /**
     * Check For Merchant
     *
     * @param null $user
     *
     * @return bool
     */
    public static function IS_MERCHANT($user = null): bool
    {
        if ($user) {
            $role = IUserRole::MERCHANT_ROLE;
        } else {
            $user = auth()->user();
            $role = IUserRole::MERCHANT_ROLE;
        }

        return $user !== null ? $user->hasRole($role) : false;
    }

    /**
     * Check For Customer
     *
     * @param null $user
     *
     * @return bool
     */
    public static function IS_CUSTOMER($user = null): bool
    {
        if ($user) {
            $role = IUserRole::CUSTOMER_ROLE;
        } else {
            $user = auth()->user();
            $role = IUserRole::CUSTOMER_ROLE;
        }

        return $user !== null ? $user->hasRole($role) : false;
    }

    /**
     * @param $user
     * @return Authenticatable|mixed|string|null
     */
    public static function IS_SCHOOL($user = null): mixed
    {
        if ($user)
            return $user->is_school;
        else
            return GeneralHelper::USER('is_school');
    }


    /**
     * @param bool $status
     * @return string
     */
    public static function INVOICE_STATUS_CLASS(bool $status): string
    {
        return $status ? 'badge-success' : 'badge-danger';
    }

    /**
     * @param bool $status
     * @return string
     */
    public static function INVOICE_STATUS(bool $status): string
    {
        return $status ? 'Active' : 'InActive';
    }

    /**
     * @param string $status
     * @return string
     */
    public static function STATUS_CASING(string $status): string
    {
        return ucfirst(strtolower(str_replace('_', ' ', $status)));
    }

    /**
     * @param $amount
     * @return mixed
     */
    public static function CUSTOMER_REMAINING_BALANCE($amount): mixed
    {
        return (GeneralHelper::USER()->customerDetail->balance) - $amount;
    }

    /**
     * @param object|null $user
     * @param int $amount
     * @return mixed
     */
    public static function CUSTOMER_BALANCE_UPDATE(int $amount, object $user = null): mixed
    {
        $customer_user = $user ?? \auth()->user();
        $current_balance = $customer_user->customerDetail->balance;
        return $customer_user->customerDetail()->update([
            'balance' => $current_balance - $amount
        ]);
    }

    /**
     * @param $clause
     * @return mixed
     */
    public static function USER_VERIFY($clause):mixed
    {
        $user = User::where($clause)->first();
        return $user;
    }

    /**
     * @return string
     * @throws BindingResolutionException
     */
    public static function SEND_OTP_FOR_API(): string
    {
        $user = GeneralHelper::USER('id');
        $otp  =  GeneralHelper::RANDOM_NO();
        app()->make(UserService::class)->update($user,[
           'email_otp' => $otp
        ]);
        return $otp;
    }

    /**
     * @param $received_otp
     * @return bool
     */
    public static function VERIFY_OTP_FOR_API($received_otp): bool
    {
        $otp = GeneralHelper::USER('email_otp');
        return $otp == $received_otp;
    }

    /**
     * @param $status
     * @return string
     */
    public static function TRANSACTION_TYPE($status):string
    {
        switch ($status) {
            case IStatuses::WITHDRAW:
                return 'Withdraw';
            default:
                return 'Deposit';
        }
    }

    /**
     * @param string $status
     * @return string
     */
    public static function TRANSACTION_STATUS(string $status):string
    {
        switch ($status) {
            case IStatuses::TRANSACTION_SUCCESS:
                return 'badge-success';
            case IStatuses::TRANSACTION_DECLINED:
                return 'badge-danger';
            default:
                return 'badge-warning';
        }
    }

    /**
     * User Request Response
     *
     * @param         $data
     * @param string|null $view
     * @param null $errMsg
     *
     * @return JsonResponse|RedirectResponse|Redirector
     */
    public static function VIEW_RESPONSE($data, string $view = null, $errMsg = null)
    {
        return $data
            ? response()->json([
                'status'     => true,
                'alert_type' => 'success',
                'data'       => $data,
                'view'       => $view ?? null
            ])
            : response()->json([
                'message'    => $errMsg ?? 'Something went wrong.',
                'status'     => false,
                'alert_type' => 'error',
                'data'       => $data,
                'view'       => sprintf("<span class='no-record'>%s</span>", __('No Record Found'))
            ]);
    }

}
