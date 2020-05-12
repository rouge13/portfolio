<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\Skill;
use App\Entity\Techno;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SkillType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label_attr'=>['class'=> 'red-bg', 'style'=> 'color : white'],
                'attr' => ['placeholder' => 'skill name']
            ])
            ->add('description', TextType::class, [
                'label_attr'=>['class'=> 'red-bg', 'style'=> 'color : white'],
                'attr' => ['placeholder' => 'description']
            ])
            ->add('image',FileType::class, [
                'mapped'=>false,
                'required' =>false,
                'label_attr'=>['class'=> 'red-bg', 'style'=> 'color : white'],
                'attr' => ['placeholder' => 'image']
            ])
            ->add('techno', EntityType::class, [
                'class' => Techno::class,
                'label_attr'=>['class'=> 'red-bg', 'style'=> 'color : white'],
                'choice_label' => 'name'])
            ->add('save', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Skill::class,
        ]);
    }
}
