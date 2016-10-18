<?php

namespace Authist\Traits;

use Illuminate\Http\Request;

trait Throttle
{
    /**
     * Determine if the user has too many failed login attempts.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function hasTooManyLoginAttempts(Request $request)
    {
        $max = empty($this->maxAttempts) ? 5 : $this->maxAttempts;
        $decay = empty($this->decayMinutes) ? 1 : $this->decayMinutes;

        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request), $max, $decay
        );
    }
}
