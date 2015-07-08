# Gatekeeper Utils
This package contains tools and commands for the [Mako framework](http://makoframework.com/) authentication plugin [Gatekeeper](http://makoframework.com/docs/4.5/security:authentication).

For now, the package contains some commands and a filter, but more will be added if needed. Feel free to fork to file an issue if there are missing features.

## Installation
Installation is done using [composer](https://getcomposer.org/). The package has a compatible Mako version specified so you don't have to worry about which version to use.

```
composer require solution-web/gatekeeper-utils:*
```

After that, you need to register the package to be loaded. This is specified in the `app/config/application.php` file.

```php
<?php
return [
    // The rest of your config
  'packages' => [
    "core" => [
      'solutionweb\gatekeeper\utils\GatekeeperUtilsPackage',
    ],
    "cli" => [],
    "web" => [],
  ],
  // The other rest of your config
];
```

I recommend that you register the package in the `core` packages, but if you only use the filters, or just the commands, you could register it in the `web` and `cli` packages respectively.

## Available commands
Currently, there are three supported commands. These commands are registe-red automatically when the plugin is loaded. All commands are prefixed with `gatekeeper::` to prevent naming collisions.
- `user.create` helps you create new users.
- `user.activate` (de)activates user accounts.
- `user.password` can set new passwords for users.

For more information about the workings and options, you can use the --help flag, like so:

```
$ php app/reactor gatekeeper::user.create --help                                                          [21:19:18]

Command:

php reactor gatekeeper::user.create

Description:

Create a new user.

Options:

----------------------------------------------------------------
| Name       | Description                          | Optional |
----------------------------------------------------------------
| noactivate | Do not activate the user by default. | true     |
----------------------------------------------------------------
```

## Available filters
Currently, there is only one filter available. The `LoginRequiredFilter` can be applied to routes like an admin panel, to force a login. It checks whether the user is logged in, and if not, returns a HTTP 401 authentication required.

Unfortunately, it is not possible to register filters from the package itself. The filters need to be registered manually, by adding it to `app/routes/filters.php`. The full class name is `solutionweb\gatekeeper\utils\filters\LoginRequiredFilter.php`.
