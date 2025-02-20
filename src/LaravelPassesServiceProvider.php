<?php declare(strict_types=1);

namespace Chiiya\LaravelPasses;

use Chiiya\LaravelPasses\Google\GoogleClient;
use Chiiya\Passes\Apple\PassFactory;
use Chiiya\Passes\Google\Http\ClientInterface;
use Illuminate\Support\Facades\Http;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelPassesServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-passes')
            ->hasConfigFile();
    }

    public function packageRegistered(): void
    {
        $this->app->bind(ClientInterface::class, GoogleClient::class);
        $this->app->bind(PassFactory::class, fn () => new PassFactory([
            'temp_dir' => config('passes.apple.temp_dir'),
            'output' => config('passes.apple.temp_dir'),
            'certificate' => config('passes.apple.certificate'),
            'password' => config('passes.apple.password'),
            'wwdr' => config('passes.apple.wwdr'),
        ]));
    }

    public function bootingPackage(): void
    {
        Http::macro('isFaking', fn () => $this->recording);
    }
}
