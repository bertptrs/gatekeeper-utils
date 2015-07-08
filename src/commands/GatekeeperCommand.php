<?php

namespace solutionweb\gatekeeper\utils\commands;

use mako\reactor\Command;
use mako\cli\input\Input;
use mako\cli\output\Output;
use mako\auth\Gatekeeper;
use mako\auth\user\UserInterface;

/**
 * Abstract base class for a gatekeeper command.
 *
 * @author Bert Peters <bert.ljpeters@gmail.com>
 */
abstract class GatekeeperCommand extends Command
{

    /**
     * Gatekeeper instance.
     *
     * @var Gatekeeper
     */
    protected $gatekeeper;

    public function __construct(Input $input, Output $output, Gatekeeper $gatekeeper)
    {
        parent::__construct($input, $output);

        $this->gatekeeper = $gatekeeper;
    }

    /**
     * Get a user.
     *
     * @param string|int $what An identifier for the user; either an ID, username or email.
     * @return UserInterface|boolean The user found, or boolean false if no such user.
     */
    protected function getUserByAnything($what)
    {
        $userProvider = $this->gatekeeper->getUserProvider();

        // First, check if we have been given an ID.
        if (is_numeric($what)) {
            $user = $userProvider->getById((int) $what);
            if ($user !== false) {
                return $user;
            }
        }

        // Check if we have an email and use that.
        if (filter_var($what, FILTER_VALIDATE_EMAIL) !== false) {
            $user = $userProvider->getByEmail($what);
            if ($user !== false) {
                return $user;
            }
        }

        // Should be a username now.
        return $userProvider->getByUsername($what);
    }

}
