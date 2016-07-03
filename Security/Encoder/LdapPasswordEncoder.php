<?php
namespace Acme\TestBundle\Service;
namespace KateGray\LdapUserBundle\Security\Encoder;

use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class LdapPasswordEncoder implements PasswordEncoderInterface
{

    public function encodePassword($raw, $salt)
    {
        $salt = substr ($salt, 16);

        return sprintf (
            '{crypt}%s',
            crypt ($raw, '$6$rounds=5000$' . $salt . '$')
        );
    }

    public function isPasswordValid($encoded, $raw, $salt)
    {
        return $encoded === $this->encodePassword($raw, $salt);
    }

}
