<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AgreementsController
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    // public function agreementAvailable(?User $user){
    //     exit('sdfsdfsdfsdf');
    //     if(($user->name == 'Admin') || ($user->name == 'Agent') || ($user->name == 'Manager')){
    //         return Response::allow();
    //     }
    //     return Response::deny('У '.$user->name.' нет прав доступа к соглашениям' );
    // }
}
