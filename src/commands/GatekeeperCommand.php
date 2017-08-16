<?php

namespace solutionweb\gatekeeper\utils\commands;

use mako\gatekeeper\Authentication;
use mako\gatekeeper\entities\group\GroupEntityInterface;
use mako\gatekeeper\entities\user\UserEntityInterface;
use mako\reactor\Command;
use mako\cli\input\Input;
use mako\cli\output\Output;

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
     * @var Authentication
     */
    protected $gatekeeper;

    public function __construct(Input $input, Output $output, Authentication $gatekeeper)
    {
        parent::__construct($input, $output);

        $this->gatekeeper = $gatekeeper;
    }

    /**
     * Get a user.
     *
     * @param string|int $what An identifier for the user; either an ID, username or email.
     * @return UserEntityInterface|boolean The user found, or boolean false if no such user.
     */
    protected function getUserByAnything($what)
    {
        $userProvider = $this->gatekeeper->getUserRepository();

        return $userProvider->getByIdentifier($what);
    }

    /**
     * Get a group by any identifier.
     *
     * @param string|int $identifier An identifier for the group, ID or name.
     * @return GroupEntityInterface|boolean The requested group, or false.
     */
    protected function getGroupByAnything($identifier)
    {
        return $this->gatekeeper->getGroupRepository()
            ->getByIdentifier($identifier);
    }
}
