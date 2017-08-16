# Gatekeeper Utils
This package contains tools and commands for the [Mako framework](http://makoframework.com/) authentication plugin [Gatekeeper](http://makoframework.com/docs/4.5/security:authentication).

For now, the package contains some commands and a filter, but more will be added if needed. Feel free to fork to file an issue if there are missing features.

## Installation
Installation is done using [composer](https://getcomposer.org/). The package has a compatible Mako version specified so you don't have to worry about which version to use.

```
composer require bertptrs/gatekeeper-utils:*
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
Currently, there are three supported commands. These commands are registered automatically when the plugin is loaded. All commands are prefixed with `gatekeeper::` to prevent naming collisions.
- `user.create` helps you create new users.
- `user.activate` (de)activates user accounts.
- `user.password` can set new passwords for users.
- `group.create` creates new groups.
- `group.member` can add and remove members in groups.
- `group.delete` deletes groups.

For more information about the workings and options, you can use the --help flag, like so:

```
$ php app/reactor gatekeeper::user.create --help

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
