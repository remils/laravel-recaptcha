# Laravel reCaptcha

## Install

```ssh
composer require remils/laravel-recaptcha
```

```ssh
php artisan vendor:publish --force --provider="Remils\LaravelRecaptcha\RecapthaProvider" --tag="config"
```

Add provider to file /config/app.php

```php
return [
    ...
    'providers' => [
        ...
        Remils\LaravelRecaptcha\RecapthaProvider::class,
    ],
    ...
];
```

Customize settings to file /.env

```
...
RECAPTCHA_SITE_KEY=
RECAPTCHA_SECRET_KEY=
RECAPTCHA_MIN_SCORE=0.5
```

## Use Middleware

```php
use Illuminate\Support\Facades\Route;

Route::middleware('recaptcha:grecaptcha')->post('example', 'ExampleController@form');
```

## Use Facade

```php
use Remils\LaravelRecaptcha\Facades\Recaptha;

Recaptcha::verify($request->input('grecaptcha'), $request->ip()); // return: true|false
```

## Example Frontend

_Replace reCAPTCHA_site_key with your site key_

```html
<html>
  <head>
    <title>Example</title>
    <script src="https://www.google.com/recaptcha/api.js?render=reCAPTCHA_site_key"></script>
  </head>
  <body>
    <form id="example">
      <input type="text" name="phone" />
      <button type="submit">Submit</button>
    </form>
    <script>
      function onSubmit(e) {
        e.preventDefault();
        grecaptcha.ready(function () {
          grecaptcha
            .execute("reCAPTCHA_site_key", { action: "submit" })
            .then(async function (token) {
              const formData = new FormData(e.target);

              formData.set("grecaptcha", token);

              await fetch("/example", {
                method: "POST",
                body: formData,
                headers: {
                  accept: "application/json",
                },
              });
            });
        });
      }

      document.getElementById("example").addEventListener("submit", onSubmit);
    </script>
  </body>
</html>
```

## License

Copyright (c) Zatulivetrov Sergey. Distributed under the MIT.
