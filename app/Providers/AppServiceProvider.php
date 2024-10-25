<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Services\Contracts\FlavorServiceInterface;//Adicionando esta linha pelo arquivo criado ajustando com Solid
use App\Services\FlavorService; //Adicionando esta linha pelo arquivo criado ajustando com Solid
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

//Agora foi feito uma injeção de dependência e se eu precisar usar o SErvice Falvor em algum outro lugar, apenas injeto FlavorServiceInterface

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Registro da interface com a implementação
        $this->app->bind(FlavorServiceInterface::class, FlavorService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Passport::tokensExpireIn(Carbon::now()->addMinutes(60));

        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));

        Passport::personalAccessTokensExpireIn(Carbon::now()->addMinutes(120));
    }
}
