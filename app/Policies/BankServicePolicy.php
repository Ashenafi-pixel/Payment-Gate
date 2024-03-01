<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\BankService;
use App\Models\User;

class BankServicePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BankService  $bankService
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, BankService $bankService)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BankService  $bankService
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, BankService $bankService)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BankService  $bankService
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, BankService $bankService)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BankService  $bankService
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, BankService $bankService)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BankService  $bankService
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, BankService $bankService)
    {
        //
    }
}
