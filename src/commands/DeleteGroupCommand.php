<?php

namespace solutionweb\gatekeeper\utils\commands;

/**
 * Command to delete groups.
 *
 * @author Bert Peters <bert.ljpeters@gmail.com>
 */
class DeleteGroupCommand extends GatekeeperCommand
{
    protected $commandInformation = [
        "description" => "Delete a group.",
        "arguments" => [
            "group" => [
                "description" => "An identifier for the group to delete.",
                "optional" => false,
            ],
        ],
        "options" => [
            "force" => [
                "description" => "Do not prompt for confirmation.",
                "optional" => true,
            ],
        ],
    ];

    /**
     * Delete a group.
     *
     * @param string $arg2 The group to create.
     * @param boolean $force if true, this command will not prompt for confirmation.
     */
    public function execute($arg2, $force = false)
    {
        $group = $this->getGroupByAnything($arg2);
        if ($group === false) {
            $this->error("No such group.");
            return;
        }

        if ($force !== false || $this->confirm("Delete group?")) {
            if ($group->delete()) {
                $this->write("Group deleted.");
            } else {
                $this->error("Could not delete group.");
            }
        }
    }
}
