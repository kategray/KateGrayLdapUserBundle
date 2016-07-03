<?php
namespace KateGray\LdapUserBundle\Layout;

use KateGray\LdapUserBundle\Model\OpenLdap\StandardUser;

interface LayoutInterface {
    public function __construct ($configuration);

    public function layout ($input);
}
