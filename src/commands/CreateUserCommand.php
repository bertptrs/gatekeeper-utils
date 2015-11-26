<?php

namespace solutionweb\gatekeeper\utils\commands;

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
        ],
    ];

    /**
     * Create a user.
     *
     * @param boolean|string $noactivate
     */
    public function execute($noactivate = false)
    {
        $username = $this->question("Username");
        $email = $this->question("Email");
        $password = $this->secret("Password", null, false);

        if ($password != $this->secret("Repeat", null, true)) {
            $this->error("Passwords do not match.");
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error("Invalid email supplied.");
            return;
        }

        $user = $this->gatekeeper->createUser($email, $username, $password, !$noactivate);

        $this->write("User " . $user->getId() . " created.");
    }
}
