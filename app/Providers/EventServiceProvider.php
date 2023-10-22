<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class EventServiceProvider extends ServiceProvider
{
  /**
   * The event to listener mappings for the application.
   *
   * @var array<class-string, array<int, class-string>>
   */
  protected $listen = [
    Registered::class => [
        SendEmailVerificationNotification::class,
    ],
  ];

  /**
   * Register any events for your application.
   */
  public function boot(): void
  {
    // Event::listen(BuildingMenu::class, function (BuildingMenu $event) {
    //   if (auth()->user()->isAdmin == 2) {
    //     $event->menu->remove('menu3_admin_only');
    //     $event->menu->remove('menu4_admin_only');
    //   }
    // });
    Event::listen(BuildingMenu::class, function (BuildingMenu $event) {
      $user = auth()->user();
      // ログインしているユーザーが「user(adminで無い)」の場合、下記のメニューを非表示。
      if ($user->roles->contains('id', 2)) {
        $event->menu->remove('items_create_admin_only');
        $event->menu->remove('items_index_admin_only');
        $event->menu->remove('prices_create_admin_only');
        $event->menu->remove('quotes_create_admin_only');
        $event->menu->remove('profile_index_admin_only');
      }
    });
  }

  /**
   * Determine if events and listeners should be automatically discovered.
   */
  public function shouldDiscoverEvents(): bool
  {
      return false;
  }
}
