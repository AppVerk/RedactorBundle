<?php

namespace AppVerk\RedactorBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class RedactorExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        foreach ($config as $envName => $envConfig) {
            /**
             * Clean empty config arrays
             */
            $cleanArrays = [
                'upload_image' => ['mimeTypes'],
                'settings'     => ['buttons', 'formattingTags', 'airButtons']
            ];
            foreach ($cleanArrays as $key => $subKeys) {
                foreach ($subKeys as $subKey) {
                    if (isset($envConfig[$key][$subKey]) && !count($envConfig[$key][$subKey])) {
                        unset($envConfig[$key][$subKey]);
                    }
                }
            }
            $container->setParameter(sprintf('redactor.%s', $envName), $envConfig);
        }

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('form.yml');
        $loader->load('services.yml');
    }
}
