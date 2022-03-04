<?php

return [
    'apple' => [
        /*
        |--------------------------------------------------------------------------
        | Certificate Path
        |--------------------------------------------------------------------------
        | Path to the .p12 Apple pass type certificate.
        | Example: storage_path('app/credentials/certificate.p12').
        | See https://github.com/chiiya/passes/documentation/requirements.md
        */
        'certificate' => env('PASSES_APPLE_CERT'),

        /*
        |--------------------------------------------------------------------------
        | WWDR Path
        |--------------------------------------------------------------------------
        | Path to the WWDR intermediate certificate.
        | Example: storage_path('app/credentials/wwdr.pem').
        | See https://www.apple.com/certificateauthority/
        */
        'wwdr' => env('PASSES_APPLE_WWDR'),

        /*
        |--------------------------------------------------------------------------
        | Certificate Password
        |--------------------------------------------------------------------------
        | Password for the .p12 Apple pass type certificate.
        | See https://github.com/chiiya/passes/documentation/requirements.md
        */
        'password' => env('PASSES_APPLE_PASSWORD'),

        /*
        |--------------------------------------------------------------------------
        | Storage Disk
        |--------------------------------------------------------------------------
        | Password for the .p12 Apple pass type certificate.
        | See https://github.com/chiiya/passes/documentation/requirements.md
        */
        'disk' => env('MEDIA_DISK', 'public'),

        /*
        |--------------------------------------------------------------------------
        | Location of a temporary directory
        |--------------------------------------------------------------------------
        | The directory specified must be writeable by the webserver process.
        | The temporary directory is required to build the pass bundle.
        */
        'temp_dir' => sys_get_temp_dir(),
    ],

    'google' => [
        /*
        |--------------------------------------------------------------------------
        | Service Credentials Path
        |--------------------------------------------------------------------------
        | Path to the service account credentials JSON file.
        | See https://github.com/chiiya/passes/documentation/requirements.md
        */
        'credentials' => env('PASSES_GOOGLE_CREDENTIALS'),

        /*
        |--------------------------------------------------------------------------
        | Origins
        |--------------------------------------------------------------------------
        | Valid domains for the Save to Wallet button.
        */
        'origins' => [env('PASSES_GOOGLE_ORIGINS', env('APP_URL'))],
    ],
];
