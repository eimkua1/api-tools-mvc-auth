<?php

/**
 * @see       https://github.com/laminas-api-tools/api-tools-mvc-auth for the canonical source repository
 * @copyright https://github.com/laminas-api-tools/api-tools-mvc-auth/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas-api-tools/api-tools-mvc-auth/blob/master/LICENSE.md New BSD License
 */

namespace Laminas\ApiTools\MvcAuth\Identity;

use Laminas\Permissions\Rbac\Role;

class GuestIdentity extends Role implements IdentityInterface
{
    /** @var string  */
    protected static $identity = 'guest';

    public function __construct()
    {
        parent::__construct(static::$identity);
    }

    /**
     * @return string
     */
    public function getRoleId()
    {
        return static::$identity;
    }

    /**
     * @return null
     */
    public function getAuthenticationIdentity()
    {
        return null;
    }
}
