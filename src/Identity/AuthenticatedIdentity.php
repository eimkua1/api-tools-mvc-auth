<?php

/**
 * @see       https://github.com/laminas-api-tools/api-tools-mvc-auth for the canonical source repository
 * @copyright https://github.com/laminas-api-tools/api-tools-mvc-auth/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas-api-tools/api-tools-mvc-auth/blob/master/LICENSE.md New BSD License
 */

namespace Laminas\ApiTools\MvcAuth\Identity;

use Laminas\Permissions\Rbac\Role;
use Laminas\Permissions\Rbac\RoleInterface;

class AuthenticatedIdentity extends Role implements IdentityInterface
{
    /** @var string|RoleInterface */
    protected $identity;

    /**
     * @param string|RoleInterface $identity
     */
    public function __construct($identity)
    {
        $this->identity = $identity;
    }

    /**
     * @return string
     */
    public function getRoleId()
    {
        return $this->name;
    }

    /**
     * @return RoleInterface|string
     */
    public function getAuthenticationIdentity()
    {
        return $this->identity;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}
