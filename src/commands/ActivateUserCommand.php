<?php

namespace solutionweb\gatekeeper\utils\commands;
/**
 * Command to (de)activate a user.
 *
 * @author bpeters
 */
class ActivateUserCommand extends GatekeeperCommand
{
    protected $commandInformation = [
        "description" => "Activate a named user.",
        "options" => [
            "deactivate" => [
                "description" => "Deactivate instead of activate.",
                "optional" => true,
            ],
        ],
    ];

    public function execute($arg2, $deactivate = false)
    {
        $user = $this->getUserByAnything($arg2);
        if ($user === false) {
            $this->error("No such user.");
            return;
        }

        if ($deactivate !== false) {
            $user->deactivate();
            $this->write("User " . $user->getId() . " deactivated.");
        } else {
            $user->activate();
            $this->write("User " . $user->getId() . " activated.");
        }
    }
}
