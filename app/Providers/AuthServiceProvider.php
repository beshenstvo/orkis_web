<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Gate::define('userHasRole', 'App\Http\Controllers\EmployeeController@index');

        Gate::define('agreementAvailable', function(?User $user){
            if(($user->name == 'Admin') || ($user->name == 'Agent') || ($user->name == 'Manager')){
                return Response::allow();
            }
            return Response::deny('У '.$user->name.' нет прав доступа к соглашениям' );
        });
        Gate::define('employeeAvailable', function (User $user){
            if($user->name == 'Admin' || $user->name == 'Manager'){
                return Response::allow();
            }
            return Response::deny('У '.$user->name.' нет прав доступа к сотрудникам' );
        });
        Gate::define('clientsAvailable', function (User $user){
            if($user->name == 'Admin' || $user->name == 'Agent' || $user->name == 'Manager'){
                return Response::allow();
            }
            return Response::deny('У '.$user->name.' нет прав доступа к клиентам' );
        });
    
        Gate::define('contractAvailable', function (User $user){
            if($user->name == 'Admin' || $user->name == 'Agent' || $user->name == 'Manager'){
                return Response::allow();
            }
            return Response::deny('У '.$user->name.' нет прав доступа к контрактам' );
        });
        Gate::define('paymentAvailable', function (User $user){
            if($user->name == 'Admin' || $user->name == 'Accountant'){
                return Response::allow();
            }
            return Response::deny('У '.$user->name.' нет прав доступа к платежам' );
        });
        Gate::define('voucherAvailable', function (User $user){
            //return ($user->name);
            if($user->name == 'Admin' || $user->name == 'Manager'){
                return Response::allow();
            }
            return Response::deny('У '.$user->name. ' нет прав доступа к ваучерам');
        });
        Gate::define('currencyAvailable', function (User $user){
            if(($user->name == 'Admin') || ($user->name == 'Accountant')){
                return Response::allow();
            }
            return Response::deny('У '.$user->name. ' нет прав доступа к валютам');
        });
        
    }
}
