<?php

namespace solutionweb\gatekeeper\utils;

use mako\application\Package;

/**
 * Package registraion class.
 *
 * @author Bert Peters <bert@solution-web.nl>
 */
class GatekeeperUtilsPackage extends Package
{

    protected $packageName = "solution-web/gatekeeper-utils";

    /**
     * Register the available commands.
     */
    protected $commands = [
        "gatekeeper::user.create" => 'solutionweb\gatekeeper\utils\commands\CreateUserCommand',
        "gatekeeper::user.activate" => 'solutionweb\gatekeeper\utils\commands\ActivateUserCommand',
        "gatekeeper::user.password" => 'solutionweb\gatekeeper\utils\commands\SetPasswordCommand',
        "gatekeeper::group.create" => 'solutionweb\gatekeeper\utils\commands\CreateGroupCommand',
        "gatekeeper::group.delete" => 'solutionweb\gatekeeper\utils\commands\DeleteGroupCommand',
        "gatekeeper::group.member" => 'solutionweb\gatekeeper\utils\commands\GroupMemberCommand',
    ];
}
