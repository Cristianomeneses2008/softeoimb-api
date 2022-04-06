<?php

namespace Core\Models\Authenticator;

use Laravel\Passport\Passport;

class Client extends \Laravel\Passport\Client
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Authenticator.OauthClients';
}
