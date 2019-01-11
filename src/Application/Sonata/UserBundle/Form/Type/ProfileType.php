<?php

/*
 * This file is part of the Sonata Project package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\UserBundle\Form\Type;

use Sonata\UserBundle\Model\UserInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProfileType extends AbstractType
{
    /**
     * @var string
     */
    private $class = 'Application\\Sonata\\UserBundle\\Entity\\User';


    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('gender', 'sonata_user_gender', array(
                'label' => 'form.label_gender',
                'required' => true,
                'translation_domain' => 'SonataUserBundle',
                'choices' => array(
                    'u'  =>  '',
                    UserInterface::GENDER_FEMALE => 'gender_female',
                    UserInterface::GENDER_MALE => 'gender_male',
                ),
            ))
            ->add('firstname', null, array(
                'label' => 'form.label_firstname',
                'translation_domain' => 'SonataUserBundle',
                'required' => false,
            ))
            ->add('lastname', null, array(
                'label' => 'form.label_lastname',
                'required' => false,
                'translation_domain' => 'SonataUserBundle',
            ))
            ->add('username', null, array(
                'label' => 'form.label_username',
                'required' => false,
                'translation_domain' => 'SonataUserBundle',
            ))
            ->add('email', null, array(
                'label' => 'form.label_email',
                'required' => false,
                'translation_domain' => 'SonataUserBundle',
            ))
            ->add('phone', null, array(
                'label' => 'form.label_phone',
                'translation_domain' => 'SonataUserBundle',
                'required' => false,
            ))
        ;
    }

    /**
     * {@inheritdoc}
     *
     * @deprecated Remove it when bumping requirements to Symfony 2.7+
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $this->configureOptions($resolver);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'md_sonata_user_profile';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
