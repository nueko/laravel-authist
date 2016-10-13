<?php

namespace Authist\Traits;

use Illuminate\Http\Request;

trait AuthenticatorKeys
{
    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $user = $request->get($this->username());

        $method = 'username';

        $usernames = [
            'email' => function ($user) {
                return filter_var($user, FILTER_VALIDATE_EMAIL);
            },
        ];

        if (! empty($this->usernames)) {
            $usernames = array_merge($usernames, (array)$this->usernames);
        }

        foreach ($usernames as $key => $pattern) {
            if (is_callable($pattern)) {
                if (call_user_func($pattern, $user)) {
                    $method = $key;
                    break;
                }
            } elseif (preg_match($pattern, $user)) {
                $method = $key;
                break;
            }
        }

        return [
            $method => $user,
            'password' => $request->get('password'),
        ];
    }

    /**
     * Get the user key to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return empty($this->userKey) ? 'email' : $this->userKey;
    }

}
