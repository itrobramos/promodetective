<?php

namespace App\Providers;


use App\Models\ShoppingCar;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class EventServiceProvider extends ServiceProvider
{
    
    /**
     * The event listener mappings for the application.
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
     *
     * @return void
     */
    public function boot()
    {

        Event::listen(BuildingMenu::class, function (BuildingMenu $event){

            if(Auth::user() == null){
                return view('auth/login');
            }

            $user = User::where('id', Auth::user()->id)->first();

            if($user->user_type_id == 1){
            
                $event->menu->add([
                    'text' => 'Inicio',
                    'url' => 'home',
                    'icon' => 'fas fa-fw fa-home'
                ]);

                $event->menu->add([
                    'text' => 'Catálogo',
                    'url'  => 'catalog',
                    'icon' => 'fas fa-fw fa-map',
                ]);
            
                $event->menu->add([
                    'text' => 'Clientes',
                    'url' => 'clients',
                    'icon' => 'fas fa-fw fa-handshake'
                ]);

                $event->menu->add([
                    'text' => 'Marcas',
                    'url' => 'brands',
                    'icon' => 'fas fa-fw fa-tag'
                ]);

                $event->menu->add([
                    'text' => 'Productos',
                    'url' => 'products',
                    'icon' => 'fas fa-fw fa-box'
                ]);

                $event->menu->add([
                    'text' => 'Usuarios',
                    'url' => 'users',
                    'icon' => 'fas fa-fw fa-user'
                ]);
            }
   
            else if ($user->user_type_id == 2){
                //Vendedor
                $event->menu->add([
                    'text' => 'Inicio',
                    'url' => 'home',
                    'icon' => 'fas fa-fw fa-home'
                ]);

                $event->menu->add([
                    'text' => 'Catálogo',
                    'url'  => 'catalog',
                    'icon' => 'fas fa-fw fa-box',
                ]);

                $event->menu->add([
                    'text' => 'Clientes',
                    'url' => 'clients',
                    'icon' => 'fas fa-fw fa-handshake'
                ]);

            }
            else if($user->user_type_id == 3){
                //Cliente
                $itemsCount = ShoppingCar::where('user_id', Auth::user()->id )->count();

                if($itemsCount > 0)
                {
                    $event->menu->add([
                        'text' => 'Carrito de Compras',
                        'url' => 'shoppingcar',
                        'icon' => 'fas fa-fw fa-cart-shopping',
                        'label'       => $itemsCount,
                        'label_color' => 'primary'
                    ]);    
                }


                $event->menu->add([
                    'text' => 'Catálogo',
                    'url'  => 'catalog',
                    'icon' => 'fas fa-fw fa-box',
                ]);


                $event->menu->add([
                    'text' => 'Direcciones de Entrega',
                    'url'  => 'addresses',
                    'icon' => 'fas fa-fw fa-truck',
                ]);

            }


        });
        // $user = Auth::user();

        // if($user != null){

        //     $items = ShoppingCar::where('user_id', Auth::user()->id )->get();

        //     Event::listen(BuildingMenu::class, function (BuildingMenu $event) use($items) {
                
        //         $event->menu->add();
    
        //         $items =  [
        //                 'text' => 'Carrito de Compras' . $items,
        //                 'url' => 'car',
        //                 'icon' => 'fas fa-fw fa-map'
        //             ];
        //         ;
    
        //         $event->menu->add($items);
        //     });

        // }

    }
}
