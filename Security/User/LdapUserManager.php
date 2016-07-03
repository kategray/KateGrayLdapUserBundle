<?php

namespace KateGray\LdapUserBundle\Security\User;

use FOS\UserBundle\Model\UserManagerInterface;
use FOS\UserBundle\Model\UserInterface;
use KateGray\LdapUserBundle\Layout\LayoutInterface;
use KateGray\LdapUserBundle\Model\OpenLdap\StandardUser;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class LdapUserManager implements UserManagerInterface
{
    /**
     * Configuration
     */
    protected $configuration;

    /**
     * @var EncoderFactoryInterface
     */
    protected $encoderFactory;

    /**
     * @var LayoutInterface
     */
    protected $layout;

    /*
     * @Todo: Get these from the configuration
     */
    public function __construct (EncoderFactoryInterface $encoderFactory, LayoutInterface $layout, $configuration) {
        $this->encoderFactory = $encoderFactory;
        $this->layout = $layout;
        $this->configuration = $configuration;
    }

    /**
     * Creates an empty user instance.
     *
     * @return UserInterface
     */
    public function createUser() {
        $user = new StandardUser();

        return $user;
    }

    /**
     * Deletes a user.
     *
     * @param UserInterface $user
     *
     * @return void
     */
    public function deleteUser(UserInterface $user) {

    }

    /**
     * Finds one user by the given criteria.
     *
     * @param array $criteria
     *
     * @return UserInterface
     */
    public function findUserBy(array $criteria) {

    }

    /**
     * Find a user by its username.
     *
     * @param string $username
     *
     * @return UserInterface or null if user does not exist
     */
    public function findUserByUsername($username) {

    }

    /**
     * Finds a user by its email.
     *
     * @param string $email
     *
     * @return UserInterface or null if user does not exist
     */
    public function findUserByEmail($email) {

    }

    /**
     * Finds a user by its username or email.
     *
     * @param string $usernameOrEmail
     *
     * @return UserInterface or null if user does not exist
     */
    public function findUserByUsernameOrEmail($usernameOrEmail) {

    }

    /**
     * Finds a user by its confirmationToken.
     *
     * @param string $token
     *
     * @return UserInterface or null if user does not exist
     */
    public function findUserByConfirmationToken($token) {

    }

    /**
     * Returns a collection with all user instances.
     *
     * @return \Traversable
     */
    public function findUsers() {

    }

    /**
     * Returns the user's fully qualified class name.
     *
     * @return string
     */
    public function getClass() {
    }

    /**
     * Reloads a user.
     *
     * @param UserInterface $user
     *
     * @return void
     */
    public function reloadUser(UserInterface $user) {

    }

    /**
     * Updates a user.
     *
     * @param UserInterface $user
     *
     * @return void
     */
    public function updateUser(UserInterface $user) {
        $this->updateCanonicalFields($user);
        $this->updatePassword($user);

        // Layout the user
        $node = $this->layout->layout ($user);

        var_dump ($node);
        var_dump ($user);
        exit ('Updating user');
    }

    /**
     * Updates the canonical username and email fields for a user.
     *
     * @param UserInterface $user
     *
     * @return void
     */
    public function updateCanonicalFields(UserInterface $user) {

    }

    /**
     * Updates a user password if a plain password is set.
     *
     * @param UserInterface $user
     *
     * @return void
     */
    public function updatePassword(UserInterface $user) {
        if (0 !== strlen($password = $user->getPlainPassword())) {
            $encoder = $this->getEncoder($user);
            $user->setPassword($encoder->encodePassword($password, $user->getSalt()));
            $user->eraseCredentials();
        }
    }

    protected function getEncoder(UserInterface $user)
    {
        return $this->encoderFactory->getEncoder($user);
    }
}
