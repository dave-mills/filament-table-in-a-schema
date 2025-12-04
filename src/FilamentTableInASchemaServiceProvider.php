<?php

namespace DaveMills\FilamentTableInASchema;

use Livewire\Livewire;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentTableInASchemaServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-table-in-a-schema';

    public static string $viewNamespace = 'filament-table-in-a-schema';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasViews();
    }

    public function packageRegistered(): void {}

    public function packageBooted(): void
    {
        Livewire::component('filament-table-in-a-schema', FilamentTableInASchema::class);
    }
}
