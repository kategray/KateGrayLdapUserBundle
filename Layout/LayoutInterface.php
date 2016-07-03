<?php

namespace KateGray\LdapUserBundle\Layout;

interface LayoutInterface
{
    public function __construct($configuration);

    public function layout($input);
}
