<?php
/**
 * Standard OpenLDAP Layout.
 *
 * This layout places users in ou=People, groups in ou=Groups, and service accounts in ou=Services.
 */

namespace KateGray\LdapUserBundle\Layout\OpenLdap;

use KateGray\LdapUserBundle\Layout\LayoutInterface;
use KateGray\LdapUserBundle\Model\OpenLdap\StandardUser;
use Zend\Ldap\Node;

class Standard implements LayoutInterface
{
    protected $configuration;

    public function __construct($configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * Layout a user or group.
     */
    public function layout($input)
    {
        if ($input instanceof StandardUser) {
            $user = $input;

            $primary_attr = $this->configuration['user']['primary_attribute'];
            $primary_value = null;
            if ($primary_attr == 'mail') {
                $primary_value = $user->getEmail();
            } elseif ($primary_attr == 'uid') {
                $primary_value = $user->getUsername();
            }

            // todo escape this
            $dn = sprintf('%s=%s,ou=People,%s',
                $primary_attr,
                $primary_value,
                $this->configuration['base_dn']
            );

            $node = Node::create($dn);

            return $node;
        }

        throw new \Exception('Unknown input provided to layout');
    }
}
