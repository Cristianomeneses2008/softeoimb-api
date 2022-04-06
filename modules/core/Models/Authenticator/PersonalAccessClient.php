<?php

namespace Core\Models\Authenticator;


use Laravel\Passport\Passport;

class PersonalAccessClient extends \Laravel\Passport\PersonalAccessClient
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Authenticator.OauthPersonalAccessClients';

}
