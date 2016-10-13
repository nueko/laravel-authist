# laravel-authist
Laravel Authentication Extras

* Allow Login by username, email and any others

```php
// add and override few AuthenticatesUsers Trait
use AuthenticatesUsers, AuthenticatorKeys {
        AuthenticatorKeys::username insteadof AuthenticatesUsers;
        AuthenticatorKeys::credentials insteadof AuthenticatesUsers;
    }

// by default it'll check the username then email, 
// if any others check needed, add usernames property to the controller like this: 
protected $usernames = [
  'pin' => '/^[0-9]+$/' // it'll be passed to preg_match function
]

// if You need to change the form name AuthenticatorKeys brings it back the property method but with different name

protected $userKey = 'username';
````

* Allow ThrottlesLogins to be configured
```php
use AuthenticatesUsers, AuthenticatorKeys, ThrottleAttempts {
        AuthenticatorKeys::username insteadof AuthenticatesUsers;
        AuthenticatorKeys::credentials insteadof AuthenticatesUsers;
        ThrottleAttempts::hasTooManyLoginAttempts insteadof AuthenticatesUsers;
    }
    
protected $maxAttempts = 3;
protected $decayMinutes = 30;
```
