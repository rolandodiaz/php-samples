<?php

namespace Upc\Sunat\SunatBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DebtType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('concept', null, array(
                    'empty_value' => '---Seleccione---',
                    'required' => true
                ))
                ->add('person', null, array(
                    'empty_value' => '---Seleccione---',
                    'required' => true
                ))
                ->add('period', null, array())
                ->add('resolutionNumber', null, array())
                ->add('taxCode', null, array())
                ->add('amount', null, array())
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
            'data_class' => 'Upc\Sunat\SunatBundle\Entity\Debt'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'debt';
    }

}
