<?php

namespace solutionweb\gatekeeper\utils\commands;

/**
 * Manager command for group membership.
 *
 * @author Bert Peters <bert@solution-web.nl>
 */
class GroupMemberCommand extends GatekeeperCommand
{

    protected $commandInformation = [
        "description" => "Add or remove users to and from a group.",
        "arguments" => [
            "group" => [
                "description" => "The group to be managed.",
                "optional" => false,
            ],
            "user" => [
                "description" => "The user to add or remove",
                "optional" => false,
            ],
        ],
        "options" => [
            "remove" => [
                "description" => "Remove the user instead of adding him.",
                "optional" => true,
            ],
        ],
    ];

    /**
     *
     *
     * @param string $arg2 An identifier for a group.
     * @param string $arg3 An identifier for a user.
     * @param boolean $remove Whether or not to remove the user from the group instead of adding him.
     */
    public function execute($arg2, $arg3, $remove = false) {
        $group = $this->getGroupByAnything($arg2);
        if ($group === false) {
            $this->error("No such group.");
            return;
        }
        $user = $this->getUserByAnything($arg3);
        if ($user === false) {
            $this->error("No such user.");
            return;
        }

        if ($remove === false) {
            if ($group->isMember($user)) {
                $this->write("User is already in group.");
            } else {
                $group->addUser($user);
                $this->write("Added user to group.");
            }
        } else {
            if ($group->isMember($user)) {
                $group->removeUser($user);
                $this->write("Removed user from group.");
            } else {
                $this->write("User is not in group.");
            }
        }
    }
}
