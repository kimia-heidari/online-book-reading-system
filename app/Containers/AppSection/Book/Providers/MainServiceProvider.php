<?php

namespace App\Containers\AppSection\Book\Providers;

use App\Containers\AppSection\Book\Models\BookPage;
use App\Containers\AppSection\Book\Observers\BookPageObserver;
use App\Containers\AppSection\Book\Models\Book;
use App\Containers\AppSection\Book\Observers\BookObserver;
use App\Ship\Parents\Providers\MainServiceProvider as ParentMainServiceProvider;

/**
 * The Main Service Provider of this container.
 * It will be automatically registered by the framework.
 */
class MainServiceProvider extends ParentMainServiceProvider
{
    public array $serviceProviders = [
        // InternalServiceProviderExample::class,
    ];

    public array $aliases = [
        // 'Foo' => Bar::class,
    ];

    public function boot(): void
    {
        parent::boot();
        BookPage::observe(BookPageObserver::class);
        Book::observe(BookObserver::class);
    }

    public function register(): void
    {
        parent::register();
    }
} 