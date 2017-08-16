<?php

namespace solutionweb\gatekeeper\utils\commands;

use mako\gatekeeper\entities\user\UserEntityInterface;

/**
 * Command to create a user.
 *
 * @author Bert Peters <bert.ljpeters@gmail.com>
 */
class CreateUserCommand extends GatekeeperCommand
{
    protected $commandInformation = [
        "description" => "Create a new user.",
        "options" => [
            "noactivate" => [
                "optional" => true,
                "description" => "Do not activate the user by default.",
            ],
            "username" => [
                "optional" => true,
                "description" => "username to create. Will prompt if not present.",
            ],
            "email" => [
                "optional" => true,
                "description" => "email to use. Will prompt if not present.",
            ],
            "password" => [
                "optional" => true,
                "description" => "password to use. Will prompt if not present.",
            ],
        ],
    ];

    /**
     * Create a user.
     *
     * @param boolean|string $noactivate
     */
    public function execute($noactivate = false, $password = null, $username = null, $email = null)
    {
        if ($username == null) {
            $username = $this->question("Username");
        }
        if ($email == null) {
            $email = $this->question("Email");
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->error("Invalid email supplied.");
                return;
            }
        }
        if ($password == null) {
            $password = $this->secret("Password", null, false);

            if ($password != $this->secret("Repeat", null, true)) {
                $this->error("Passwords do not match.");
                return;
            }
        }


        /** @var UserEntityInterface $user */
        $user = $this->gatekeeper->createUser($email, $username, $password, !$noactivate);

        $this->write("User " . $user->getId() . " created.");
    }
}
