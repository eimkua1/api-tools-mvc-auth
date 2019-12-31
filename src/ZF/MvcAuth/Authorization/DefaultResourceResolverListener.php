<?php

/**
 * @see       https://github.com/laminas-api-tools/api-tools-mvc-auth for the canonical source repository
 * @copyright https://github.com/laminas-api-tools/api-tools-mvc-auth/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas-api-tools/api-tools-mvc-auth/blob/master/LICENSE.md New BSD License
 */

namespace Laminas\ApiTools\MvcAuth\Authorization;

use Laminas\ApiTools\MvcAuth\MvcAuthEvent;
use Laminas\Http\Request;
use Laminas\Mvc\Router\RouteMatch;

class DefaultResourceResolverListener
{
    /**
     * @var array
     */
    protected $restControllers;

    public function __construct(array $restControllers = array())
    {
        $this->restControllers = $restControllers;
    }

    /**
     * Attempt to determine the authorization resource based on the request
     *
     * Looks at the matched controller.
     *
     * If the controller is in the list of rest controllers, determines if we
     * have a collection or a resource, based on the presence of the named
     * identifier in the route matches or query string.
     *
     * Otherwise, looks for the presence of an "action" parameter in the route
     * matches.
     *
     * Once created, it is injected into the $mvcAuthEvent.
     *
     * @param MvcAuthEvent $mvcAuthEvent
     */
    public function __invoke(MvcAuthEvent $mvcAuthEvent)
    {
        $mvcEvent   = $mvcAuthEvent->getMvcEvent();
        $request    = $mvcEvent->getRequest();
        $routeMatch = $mvcEvent->getRouteMatch();

        $resource = $this->buildResourceString($routeMatch, $request);
        if (!$resource) {
            return;
        }

        $mvcAuthEvent->setResource($resource);
    }

    /**
     * Creates a resource string based on the controller service name and type
     *
     * For REST services (those passed to the constructor), it returns one of:
     *
     * - <controller service name>::entity
     * - <controller service name>::collection
     *
     * For all others, it uses the "action" route match parameter:
     *
     * - <controller service name>::<action>
     *
     * If it cannot resolve a controller service name, boolean false is returned.
     *
     * @param RouteMatch $routeMatch
     * @param \Laminas\Stdlib\RequestInterface $request
     * @return false|string
     */
    public function buildResourceString(RouteMatch $routeMatch, $request)
    {
        // Considerations:
        // - We want the controller service name
        $controller = $routeMatch->getParam('controller', false);
        if (!$controller) {
            return false;
        }

        // - Is this an RPC or a REST call?
        //   - Basically, if it's not in the api-tools-rest configuration, we assume REST
        if (!array_key_exists($controller, $this->restControllers)) {
            $action = $routeMatch->getParam('action', 'index');
            return sprintf('%s::%s', $controller, $action);
        }

        //   - If it is a REST controller, we need to know if we have a
        //     resource or a controller. The way to determine that is if we have
        //     an identifier. We find that info from the route parameters.
        $identifierName = $this->restControllers[$controller];
        $id = $this->getIdentifier($identifierName, $routeMatch, $request);
        if ($id) {
            return sprintf('%s::entity', $controller);
        }
        return sprintf('%s::collection', $controller);
    }

    /**
     * Attempt to retrieve the identifier for a given request
     *
     * Checks first if the $identifierName is in the route matches, and then
     * as a query string parameter.
     *
     * @param string $identifierName
     * @param RouteMatch $routeMatch
     * @param \Laminas\Stdlib\RequestInterface $request
     * @return false|mixed
     */
    protected function getIdentifier($identifierName, RouteMatch $routeMatch, $request)
    {
        $id = $routeMatch->getParam($identifierName, false);
        if ($id) {
            return $id;
        }

        if (!$request instanceof Request) {
            return false;
        }

        return $request->getQuery($identifierName, false);
    }
}