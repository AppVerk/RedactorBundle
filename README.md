# RedactorBundle

Symfony Redactor Bundle. The bundle required to working [redactor.js](https://imperavi.com/redactor) script.

## Configure

Require the bundle with composer:

    $ composer require app-verk/redactor-bundle

Enable the bundle in the kernel:

    <?php
    // app/AppKernel.php

    public function registerBundles()
    {
        $bundles = array(
            // ...
            new AppVerk\RedactorBundle\RedactorBundle(),
            // ...
        );
    }
    
Add to config.yml:

    twig:
        form:
            resources:
                - 'RedactorBundle:Redactor:fields.html.twig'
                
    redactor:
        basic:
            settings:
                lang: 'en'
                minHeight: 300
                
Add these libs into your layout:

    <!--css -->
    <link rel="stylesheet" href="{{ asset('/your-folder/redactor.css') }}" />
    
    <!-- js -->
    <script src="{{ asset('/your-folder/redactor.js') }}"></script>
    <script src="{{ asset('bundles/redactor/js/symfony-script.js') }}"></script>
    
## Redactor Form Type

    <?php
    
    use Symfony\Component\Form\AbstractType;
    use AppVerk\RedactorBundle\Form\Type\RedactorType;
    use Symfony\Component\Form\FormBuilderInterface;
    
    class Post extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $formMapper
                ->add('body', RedactorType::class, [
                    'redactor' => 'basic' // your config name
                ])
            ;
        }
    }

## License

The bundle is released under the [MIT License](LICENSE).
