<?php

namespace Code\Auth\Services\Auth;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;

class JwtGuard implements Guard
{
    private $eloquentUserProvider;
    private $user;

    public function __construct($userProvider)
    {
        $this->eloquentUserProvider = $userProvider;
    }

    /**
     * Determine if the current user is authenticated.
     *
     * @return bool
     */
    public function check()
    {
        // TODO: Implement check() method.
    }

    /**
     * Determine if the current user is a guest.
     *
     * @return bool
     */
    public function guest()
    {
        // TODO: Implement guest() method.
    }

    /**
     * Get the currently authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        // TODO: Implement user() method.
        return $this->user;
    }

    /**
     * Get the ID for the currently authenticated user.
     *
     * @return int|null
     */
    public function id()
    {
        // TODO: Implement id() method.
        return $this->user->id ?? null;
    }

    /**
     * Validate a user's credentials.
     *
     * @param  array $credentials
     * @return bool
     */
    public function validate(array $credentials = [])
    {
        $user = $this->eloquentUserProvider->getModel()::where('email', $credentials['email'])->first();
        if (is_null($user)){
            return false;
        }
        if (password_verify($credentials['password'], $user->password)){
            return true;
        }
        return false;
    }

    /**
     * Set the current user.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @return void
     */
    public function setUser(Authenticatable $user)
    {
        // TODO: Implement setUser() method.
        $this->user = $user;

    }

    public function usingId(int $id){
        $user = $this->eloquentUserProvider->getModel()::find($id);
        $this->setUser($user);
    }
}