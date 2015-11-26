<?php

namespace solutionweb\gatekeeper\utils\filters;

use mako\auth\Gatekeeper;
use mako\http\Request;
use mako\http\Response;
use mako\http\routing\URLBuilder;
use mako\session\Session;

/**
 * Filter to require a login for the current route.
 *
 * @author Bert Peters
 */
class LoginRequiredFilter
{
    /**
     * @var Gatekeeper
     */
    protected $gatekeeper;
    /**
     * @var URLBuilder
     */
    protected $urlBuilder;
    /**
     * @var Session
     */
    protected $session;

    public function __construct(Request $request, Response $response, Gatekeeper $gatekeeper, URLBuilder $urlBuilder, Session $session)
    {
        $this->gatekeeper = $gatekeeper;
        $this->urlBuilder = $urlBuilder;
        $this->session = $session;
    }

    public function filter()
    {
        if ($this->gatekeeper->isGuest()) {
            return $this->gatekeeper->basicAuth();
        }
    }
}
