<?php

namespace Cube\RedactorBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class CubeRedactorExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        foreach ($config as $envName => $envConfig) {
            foreach (['file', 'image'] as $subKey) {
                $fileKey = 'upload_' . $subKey;
                if (!isset($envConfig[$fileKey]['dir'])) {
                    continue;
                }
                $paths = explode('web', $envConfig[$fileKey]['dir']);
                $envConfig[$fileKey]['web_dir'] = $paths[1];
            }
            /**
             * Clean empty config arrays
             */
            $cleanArrays = [
                'upload_image' => ['mimeTypes'],
                'settings' => ['buttons', 'formattingTags', 'airButtons']
            ];
            foreach ($cleanArrays as $key => $subKeys) {
                foreach ($subKeys as $subKey) {
                    if (isset($envConfig[$key][$subKey]) && !count($envConfig[$key][$subKey])) {
                        unset($envConfig[$key][$subKey]);
                    }
                }
            }

            $container->setParameter(sprintf('cube_redactor.%s', $envName), $envConfig);
        }
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('form.yml');
        $loader->load('services.yml');
    }
}
