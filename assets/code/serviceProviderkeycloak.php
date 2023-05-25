<?php

namespace App\Providers;

[...]

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            \SocialiteProviders\Keycloak\KeycloakExtendSocialite::class.'@handle',
        ],
    ];

    [...]

}