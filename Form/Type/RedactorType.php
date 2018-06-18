<?php

namespace AppVerk\RedactorBundle\Form\Type;

use AppVerk\RedactorBundle\Service\Redactor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RedactorType extends AbstractType
{
    /**
     * @var Redactor
     */
    protected $redactor;

    /**
     * @param Redactor $redactor
     */
    public function __construct(Redactor $redactor)
    {
        $this->redactor = $redactor;
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        parent::buildView($view, $form, $options);
        $config = $this->redactor->getWebConfiguration($form->getConfig()->getAttribute('redactor'));
        $view->vars['redactor_config'] = $config;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->setAttribute('redactor', $options['redactor']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'redactor' => false
        ]);
    }
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return TextareaType::class;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'redactor';
    }
}
