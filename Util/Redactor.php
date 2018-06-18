<?php

namespace AdminBundle\Util;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Redactor implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * Sets the container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     * @required
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function getWebConfiguration($envName)
    {
        $settings = [];
        $config = $this->container->getParameter(sprintf('admin.redactor.%s', $envName));
        $settings = array_merge($config['settings'], $settings);

        return $settings;
    }

}
