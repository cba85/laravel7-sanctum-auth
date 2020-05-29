<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Laravel\Sanctum\PersonalAccessToken;

class ApiTokenPolicy
{
    use HandlesAuthorization;

    public function can($ability, USer $user, PersonalAccessToken $token)
    {
        return $user->tokenCan($ability);
    }

    public function __call($ability, $args)
    {
        return $this->can($ability, ...$args);
    }
}
