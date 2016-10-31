<?php
/**
 * Created by PhpStorm.
 * User: bpeters
 * Date: 31/10/16
 * Time: 10:02
 */

namespace tests\solutionweb\gatekeeper\utils\commands;


use mako\auth\Gatekeeper;
use mako\auth\user\UserInterface;
use mako\cli\input\Input;
use mako\cli\output\Output;
use solutionweb\gatekeeper\utils\commands\CreateUserCommand;

class CreateUserCommandTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateUser()
    {
        $input = $this->createMock(Input::class);
        $output = $this->createMock(Output::class);

        $user = $this->createMock(UserInterface::class);
        $user->expects($this->once())->method('getId')->willReturn(42);
        
        $gatekeeper = $this->createMock(Gatekeeper::class);
        $gatekeeper->expects($this->once())
            ->method('createUser')
            ->with('jdoe', 'john.doe@example.org', 'foobar', true)
            ->willReturn($user);

        $command = new CreateUserCommand($input, $output, $gatekeeper);

        $command->execute(false, 'foobar', 'john.doe@example.org', 'jdoe');
    }
}