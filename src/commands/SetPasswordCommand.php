<?php

namespace solutionweb\gatekeeper\utils\commands;

/**
 * Command to set the password for a specific user.
 *
 * @author Bert Peters <bert@solution-web.nl>
 */
class SetPasswordCommand extends GatekeeperCommand
{
    protected $commandInformation = [
        "description" => "Set the password for a specific user.",
        "arguments" => [
            "user" => [
                "description" => "The user identifier to change the password for. Can be an email, username or id.",
                "optional" => false,
            ],
        ],
    ];

    /**
     * Set the password for a specific user.
     *
     * @param string $arg2 The identifier for the user.
     */
    public function execute($arg2)
    {
        $user = $this->getUserByAnything($arg2);

        if ($user === false) {
            $this->error("No such user.");
            return;
        }

        $password = $this->secret("Enter new user password", null, false);
        if ($this->secret("Repeat user password", null, false) != $password) {
            $this->error("Password mismatch.");
            return;
        }

        $user->setPassword($password);
        $user->save();

        $this->write("Password succesfully changed.");
    }
}
