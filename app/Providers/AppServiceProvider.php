<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator; // 追記

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('hiragana', function ($attribute, $value, $parameters, $validator) { //ひらがな
            return preg_match('/^[ぁ-ゞ]+$/u', $value);
        });

        Validator::extend('name_kana', function ($attribute, $value, $parameters, $validator) { //カナ
            return preg_match('/\A[ァ-ヴー]+\z/u', $value);
        });
    }
}
