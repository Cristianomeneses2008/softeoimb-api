<?php

namespace Core\Models\Authenticator;

use Laravel\Passport\Passport;

class Token extends \Laravel\Passport\Token
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Authenticator.OauthAccessTokens';
}
