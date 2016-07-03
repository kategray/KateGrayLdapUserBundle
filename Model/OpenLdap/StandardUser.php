<?php

namespace KateGray\LdapUserBundle\Model\OpenLdap;

use FOS\UserBundle\Model\User as BaseUser;
use FOS\UserBundle\Model\UserInterface;

class StandardUser extends BaseUser implements UserInterface
{
    /**
     * Removes sensitive data from the user.
     */
    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }
}
