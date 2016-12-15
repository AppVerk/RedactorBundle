<?php

namespace Cube\RedactorBundle\Service;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Redactor implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function getWebConfiguration($envName)
    {
        $settings = array();
        $config = $this->container->getParameter(sprintf('cube_redactor.%s', $envName));
        $settings = array_merge($config['settings'], $settings);
        return $settings;
    }
}
