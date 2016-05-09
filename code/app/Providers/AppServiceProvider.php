<?php

namespace App\Providers;

use App\Account;
use App\Events\AccountCreated;
use App\Events\AccountDeleted;
use App\Events\AccountUpdated;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Account::created(function ($account) {
            event(new AccountCreated($account));
        });

        Account::updated(function ($account) {
            event(new AccountUpdated($account));
        });

        Account::deleted(function ($account) {
            event(new AccountDeleted($account));
        });

        Validator::extend('account_structure', function($attribute, $value, $parameters, $validator) {
            if (
                array_key_exists('first_name', $value) &&
                array_key_exists('last_name', $value) &&
                array_key_exists('email', $value) //&&
                //array_key_exists('password', $value)
            ) {
                return true;
            }

            return false;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
