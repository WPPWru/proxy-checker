<?php

declare( strict_types = 1 );

use App\Orchid\Screens\Examples\ExampleActionsScreen;
use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;
use App\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Orchid\Screens\Examples\ExampleGridScreen;
use App\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Portbilet\Order\OrderDetailScreen;
use App\Orchid\Screens\Portbilet\Order\OrdersListScreen;
use App\Orchid\Screens\Portbilet\Order\Passenger\PassengerScreen;
use App\Orchid\Screens\Portbilet\Person\PersonAddScreen;
use App\Orchid\Screens\Portbilet\Person\PersonDetailScreen;
use App\Orchid\Screens\Portbilet\Person\PersonListScreen;
use App\Orchid\Screens\Portbilet\Person\ProfilesAddScreen;
use App\Orchid\Screens\Portbilet\Person\ProfilesDetailScreen;
use App\Orchid\Screens\Portbilet\Person\ProfilesListScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/


// Portbilet Order -------------------------------------------- //

Route::screen( 'portbilet/order', OrdersListScreen::class )
    ->name( 'platform.portbilet.orders' )
    ->breadcrumbs( fn( Trail $trail ) => $trail
        ->parent( 'platform.index' )
        ->push( __( 'Orders' ), route( 'platform.portbilet.orders' ) ) );

Route::screen( 'portbilet/order/{order?}', OrderDetailScreen::class )
    ->name( 'platform.portbilet.order' )
    ->breadcrumbs( fn( Trail $trail ) => $trail
        ->parent( 'platform.portbilet.orders' )
        ->push( __( 'Order' ), ) );

Route::screen( 'portbilet/order/{order}/airticket/{airticket}/passenger/{passenger}', PassengerScreen::class )
    ->name( 'platform.portbilet.order.airticket.passenger' )
    ->breadcrumbs( fn( Trail $trail ) => $trail
        ->parent( 'platform.portbilet.order' )
        ->push( __( 'Passenger' ), ) );


// Portbilet Person -------------------------------------------- //

Route::screen( 'portbilet/persons', PersonListScreen::class )
    ->name( 'platform.portbilet.persons' )
    ->breadcrumbs( fn( Trail $trail ) => $trail
        ->parent( 'platform.index' )
        ->push( __( 'Persons' ), route( 'platform.portbilet.persons' ) ) );

Route::screen( 'portbilet/person_add', PersonAddScreen::class )
    ->name( 'platform.portbilet.person_add' )
    ->breadcrumbs( fn( Trail $trail ) => $trail
        ->parent( 'platform.portbilet.persons' )
        ->push( __( 'New' ), ) );

Route::screen( 'portbilet/person/{person?}', PersonDetailScreen::class )
    ->name( 'platform.portbilet.person' )
    ->breadcrumbs( fn( Trail $trail ) => $trail
        ->parent( 'platform.portbilet.persons' )
        ->push( __( 'Person' ), ) );

Route::screen( 'portbilet/profiles/{person?}', ProfilesListScreen::class )
    ->name( 'platform.portbilet.profiles' )
    ->breadcrumbs( fn( Trail $trail ) => $trail
        ->parent( 'platform.portbilet.persons' )
        ->push( __( 'profiles' ), ) );

Route::screen( 'portbilet/profile/{profile?}', ProfilesDetailScreen::class )
    ->name( 'platform.portbilet.profile' )
    ->breadcrumbs( fn( Trail $trail ) => $trail
        ->parent( 'platform.portbilet.profiles' )
        ->push( __( 'profile' ), ) );

Route::screen( 'portbilet/profile/add/{person}', ProfilesAddScreen::class )
    ->name( 'platform.portbilet.profile.add' )
    ->breadcrumbs( fn( Trail $trail ) => $trail
        ->parent( 'platform.portbilet.person' )
        ->push( __( 'profile' ), ) );


// Default -------------------------------------------- //

// Main
Route::screen( '/main', PlatformScreen::class )
    ->name( 'platform.main' );

// Platform > Profile
Route::screen( 'profile', UserProfileScreen::class )
    ->name( 'platform.profile' )
    ->breadcrumbs( fn( Trail $trail ) => $trail
        ->parent( 'platform.index' )
        ->push( __( 'Profile' ), route( 'platform.profile' ) ) );


// Platform > System > Users > User
Route::screen( 'users/{user}/edit', UserEditScreen::class )
    ->name( 'platform.systems.users.edit' )
    ->breadcrumbs( fn( Trail $trail, $user ) => $trail
        ->parent( 'platform.systems.users' )
        ->push( $user->name, route( 'platform.systems.users.edit', $user ) ) );

// Platform > System > Users > Create
Route::screen( 'users/create', UserEditScreen::class )
    ->name( 'platform.systems.users.create' )
    ->breadcrumbs( fn( Trail $trail ) => $trail
        ->parent( 'platform.systems.users' )
        ->push( __( 'Create' ), route( 'platform.systems.users.create' ) ) );

// Platform > System > Users
Route::screen( 'users', UserListScreen::class )
    ->name( 'platform.systems.users' )
    ->breadcrumbs( fn( Trail $trail ) => $trail
        ->parent( 'platform.index' )
        ->push( __( 'Users' ), route( 'platform.systems.users' ) ) );

// Platform > System > Roles > Role
Route::screen( 'roles/{role}/edit', RoleEditScreen::class )
    ->name( 'platform.systems.roles.edit' )
    ->breadcrumbs( fn( Trail $trail, $role ) => $trail
        ->parent( 'platform.systems.roles' )
        ->push( $role->name, route( 'platform.systems.roles.edit', $role ) ) );

// Platform > System > Roles > Create
Route::screen( 'roles/create', RoleEditScreen::class )
    ->name( 'platform.systems.roles.create' )
    ->breadcrumbs( fn( Trail $trail ) => $trail
        ->parent( 'platform.systems.roles' )
        ->push( __( 'Create' ), route( 'platform.systems.roles.create' ) ) );

// Platform > System > Roles
Route::screen( 'roles', RoleListScreen::class )
    ->name( 'platform.systems.roles' )
    ->breadcrumbs( fn( Trail $trail ) => $trail
        ->parent( 'platform.index' )
        ->push( __( 'Roles' ), route( 'platform.systems.roles' ) ) );

// Example...
Route::screen( 'example', ExampleScreen::class )
    ->name( 'platform.example' )
    ->breadcrumbs( fn( Trail $trail ) => $trail
        ->parent( 'platform.index' )
        ->push( 'Example Screen' ) );

Route::screen( '/examples/form/fields', ExampleFieldsScreen::class )->name( 'platform.example.fields' );
Route::screen( '/examples/form/advanced', ExampleFieldsAdvancedScreen::class )->name( 'platform.example.advanced' );
Route::screen( '/examples/form/editors', ExampleTextEditorsScreen::class )->name( 'platform.example.editors' );
Route::screen( '/examples/form/actions', ExampleActionsScreen::class )->name( 'platform.example.actions' );

Route::screen( '/examples/layouts', ExampleLayoutsScreen::class )->name( 'platform.example.layouts' );
Route::screen( '/examples/grid', ExampleGridScreen::class )->name( 'platform.example.grid' );
Route::screen( '/examples/charts', ExampleChartsScreen::class )->name( 'platform.example.charts' );
Route::screen( '/examples/cards', ExampleCardsScreen::class )->name( 'platform.example.cards' );

//Route::screen('idea', Idea::class, 'platform.screens.idea');
