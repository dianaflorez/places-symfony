<?php
// src/AppBundle/Form/TaskType.php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

// use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class LugarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nombre', TextType::class)
        ->add('descripcion', TextareaType::class)
        // ->add('opciones', TextareaType::class)
        ->add('opciones', EntityType::class, ['class' => 'AppBundle:Opcion', 'multiple' => true])
        // ->add('categoria')
        ->add('categoria', EntityType::class, ['class' => 'AppBundle:Categoria'])
        ->add('foto', FileType::class, ['attr'=> ['onchange' => 'onChange(event)']])
        ->add('top')
     //   ->add('fechaCreacion', DateType::class)
        ->add('save', SubmitType::class, ['label' => 'Nuevo lugar'])
      
        ;
    }
}

