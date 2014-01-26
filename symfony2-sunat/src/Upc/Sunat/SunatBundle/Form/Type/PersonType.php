<?php

namespace Upc\Sunat\SunatBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PersonType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name', null, array())
                ->add('ruc', null, array())
                ->add('phone', null, array(
                    'required' => false
                ))
                ->add('type', 'choice', array(
                    'label' => 'Tipo',
                    'empty_value' => '---Seleccione---',
                    'choices' => \Upc\Sunat\SunatBundle\Entity\Person::$TYPES
                ))
                ->add('save', 'submit', array(
                    'label' => 'Guardar',
                    'attr' => array('class' => 'btn btn-primary'),))
                ->add('saveAndAdd', 'submit', array(
                    'label' => 'Guardar y Añadir Otro',
                    'attr' => array('class' => 'btn btn-primary')));
        }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Upc\Sunat\SunatBundle\Entity\Person'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'person';
    }

}
