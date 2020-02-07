<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Foto;
use App\Entity\User;
use Doctrine\DBAL\Types\SmallIntType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class PhotoUploadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titel', TextType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 3, 'max' => 30])
                ]
            ])
            ->add('beschrijving', TextareaType::class, [
                'constraints' => [
                    new Length(['max' => 255])
                ]
            ])
            ->add('fileurl', FileType::class, [
                'required' => true,
                'constraints' => [
                    new File([
                        'maxSize' => '4096k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png'
                        ],
                        'mimeTypesMessage' => 'Please upload PNG, JPEG or JPG',
                    ])
                ],
            ])
            ->add('categories', EntityType::class, [
                'required' => true,
                'class' => Category::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('categories')
                        ->orderBy('categories.name', 'ASC');
                },
                'choice_label' => 'name',
                'label' => false,
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('camera', HiddenType::class, [
                'required' => false
            ])
            ->add('comment', HiddenType::class, [
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Foto::class,
        ]);
    }
}
