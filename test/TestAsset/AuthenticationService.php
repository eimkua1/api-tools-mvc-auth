<?php

namespace LaminasTest\ApiTools\MvcAuth\TestAsset;

use Laminas\ApiTools\MvcAuth\Identity\IdentityInterface;

class AuthenticationService
{
    /** @var IdentityInterface */
    protected $identity;

    /**
     * @param IdentityInterface $identity
     */
    public function setIdentity($identity)
    {
        $this->identity = $identity;
    }

    /**
     * @return IdentityInterface
     */
    public function getIdentity()
    {
        return $this->identity;
    }

    /**
     * @return $this
     */
    public function getStorage()
    {
        return $this;
    }

    /**
     * @param IdentityInterface $identity
     */
    public function write($identity)
    {
        $this->setIdentity($identity);
    }
}
