<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
  /**
   * The model to policy mappings for the application.
   *
   * @var array<class-string, class-string>
   */
  protected $policies = [
    Price::class => PricePolicy::class,
    Quote::class => QuotePolicy::class,
    Order::class => OrderPolicy::class,
  ];

  /**
   * Register any authentication / authorization services.
   */
  public function boot(): void
  {
    Gate::define('admin', function ($user) {
      foreach ($user->roles as $role) {
        if ($role->name == 'admin') {
          return true;
        }
      }
      return false;
    });
  }
}
