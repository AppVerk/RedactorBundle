<?php

namespace AppVerk\RedactorBundle\Service;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Redactor implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function getWebConfiguration($envName)
    {
        $settings = [];
        $config = $this->container->getParameter(sprintf('redactor.%s', $envName));
        $settings = array_merge($config['settings'], $settings);
        return $settings;
    }
}
