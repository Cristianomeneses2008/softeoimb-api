<?php

namespace Core\Models\Authenticator;

use Laravel\Passport\Passport;

class AuthCode extends \Laravel\Passport\AuthCode
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Authenticator.OauthAuthCodes';
}
