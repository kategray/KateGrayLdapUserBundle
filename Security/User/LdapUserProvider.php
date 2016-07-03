<?php
namespace KateGray\LdapUserBundle\Security\User;

use KateGray\LdapUserBundle\Model\OpenLdap\StandardUser;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class LdapUserProvider implements UserProviderInterface
{
    public function loadUserByUsername($username)
    {
        return new StandardUser();
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof StandardUser) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }


    public function supportsClass ($class) {
var_dump ($class);
exit ();
        if ($class === 'KateGray\\LdapUserBundle\\Model\\OpenLdap\\StandardUser') {
            return true;
        }

        return false;
    }
}
