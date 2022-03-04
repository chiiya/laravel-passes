<?php

namespace Chiiya\LaravelPasses\Domains;

use Chiiya\Passes\Apple\Passes\Pass;
use Chiiya\Passes\Apple\PassFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AppleDomain
{
    public function __construct(
        protected PassFactory $factory
    ) {
    }

    /**
     * Determine if the given pass file already exists in storage.
     */
    public function exists(string $path): bool
    {
        $path = Str::finish($path, PassFactory::PASS_EXTENSION);

        return Storage::disk(config('passes.apple.disk'))->exists($path);
    }

    /**
     * If the given pass file exists, returns storage path. Otherwise
     * returns null.
     */
    public function location(string $path): ?string
    {
        $path = Str::finish($path, PassFactory::PASS_EXTENSION);

        if (! $this->exists($path)) {
            return null;
        }

        return $path;
    }

    /**
     * Create new pass file and store it in the configured storage.
     * Returns storage path including file extension.
     */
    public function create(Pass $pass, ?string $path = null): string
    {
        $path = Str::finish($path ?? $pass->serialNumber, PassFactory::PASS_EXTENSION);
        $file = $this->factory->create($pass, basename($path, PassFactory::PASS_EXTENSION));

        // Move file to storage disk
        $handle = fopen($file->getRealPath(), 'rb');
        Storage::disk(config('passes.apple.disk'))->writeStream($path, $handle);
        fclose($handle);
        unlink($file->getRealPath());

        return $path;
    }
}
