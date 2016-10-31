<?php

namespace solutionweb\gatekeeper\utils;

use mako\application\Package;
use solutionweb\gatekeeper\utils\commands\ActivateUserCommand;
use solutionweb\gatekeeper\utils\commands\CreateGroupCommand;
use solutionweb\gatekeeper\utils\commands\CreateUserCommand;
use solutionweb\gatekeeper\utils\commands\DeleteGroupCommand;
use solutionweb\gatekeeper\utils\commands\GroupMemberCommand;
use solutionweb\gatekeeper\utils\commands\SetPasswordCommand;

/**
 * Package registraion class.
 *
 * @author Bert Peters <bert@solution-web.nl>
 */
class GatekeeperUtilsPackage extends Package
{
    protected $packageName = "bertptrs/gatekeeper-utils";

    /**
     * Register the available commands.
     */
    protected $commands = [
        "gatekeeper::user.create" => CreateUserCommand::class,
        "gatekeeper::user.activate" => ActivateUserCommand::class,
        "gatekeeper::user.password" => SetPasswordCommand::class,
        "gatekeeper::group.create" => CreateGroupCommand::class,
        "gatekeeper::group.delete" => DeleteGroupCommand::class,
        "gatekeeper::group.member" => GroupMemberCommand::class,
    ];
}
