<?php

namespace BeerScoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ReviewType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title')
            ->add('userName')
            ->add('aromaScore', ChoiceType::class, array('choices'  => $this->getScoreChoices()))
            ->add('appearanceScore', ChoiceType::class, array('choices'  => $this->getScoreChoices()))
            ->add('tasteScore', ChoiceType::class, array('choices'  => $this->getScoreChoices()))
            ->add('palateScore', ChoiceType::class, array('choices'  => $this->getScoreChoices()))
            ->add('content');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BeerScoreBundle\Entity\Review'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'beerscorebundle_review';
    }

    private function getScoreChoices()
    {
        return [
            '0' => 0,
            '1' => 1,
            '2' => 2,
            '3' => 3,
            '4' => 4,
            '5' => 5,
            '6' => 6,
            '7' => 7,
            '8' => 8,
            '9' => 9,
            '10' => 10,
        ];
    }
}
