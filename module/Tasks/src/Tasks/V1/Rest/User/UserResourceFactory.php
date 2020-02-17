<?php
namespace Tasks\V1\Rest\User;

use Lift\Repository\UserRegistrationRepository;
use Lift\Repository\UserRepository;

class UserResourceFactory
{
    public function __invoke($services)
    {
        $userRepo = $services->get(UserRepository::class);
        $userRegistrationRepo = $services->get(UserRegistrationRepository::class);
        return new UserResource($userRepo, $userRegistrationRepo);
    }
}
