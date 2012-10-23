<?php

namespace Blogger\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BlogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('author', 'text', array('read_only' => true))
            ->add('title')
            ->add('blog', 'textarea', array(
        'attr' => array(
            'class' => 'tinymce',
            'data-theme' => 'advanced' // simple, advanced, bbcode
   
        )
        ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Blogger\BlogBundle\Entity\Blog'
        ));
    }

    public function getName()
    {
        return 'blogger_blogbundle_blogtype';
    }
}
