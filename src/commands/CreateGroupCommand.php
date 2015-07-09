<?php

namespace solutionweb\gatekeeper\utils\commands;

/**
 * Command to create a new group.
 *
 * @author Bert Peters <bert@solution-web.nl>
 */
class CreateGroupCommand extends GatekeeperCommand
{
    protected $commandInformation = [
        "description" => "Create a new group.",
        "arguments" => [
            "name" => [
                "description" => "The new name for the group.",
                "optional" => false,
            ],
        ],
    ];

    /**
     * Create a new group.
     *
     * @param string $arg2 Thenew name for the group.
     */
    public function execute($arg2)
    {
        $group = $this->gatekeeper->createGroup($arg2);

        $this->write("Created group " . $group->getId());
    }
}
