<?php


namespace VendorName\Skeleton\Tests\Stubs;

use Orchestra\Testbench\Http\Middleware\RedirectIfAuthenticated;
use Seatplus\Web\Http\Middleware\Authenticate;

class Kernel extends \Orchestra\Testbench\Http\Kernel
{
    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => Authenticate::class,
        'guest' => RedirectIfAuthenticated::class,
    ];
}
