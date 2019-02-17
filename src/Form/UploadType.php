<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;

class UploadType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('csv', FileType::class, [
                'label' => 'Upload a .csv file',
                'required' => false,
                'attr' => ['class' => 'upload-csv']
//                'constraints' => new File(['mimeTypes' => ['text/csv']])
            ])
            ->add('xlsx', FileType::class, [
                'label' => 'Upload a .xlsx file',
                'required' => false,
                'attr' => ['class' => 'upload-xslx'],
                'constraints' => new File(['mimeTypes' => ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']])
            ])
            ->add('convert', SubmitType::class);
    }
}