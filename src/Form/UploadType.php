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
        $xlsxMime = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';

        $builder
            ->add('csv', FileType::class, [
                'label' => 'csv to xlsx',
                'required' => false,
                'attr' => ['class' => 'button__input--csv', 'accept' => '.csv, text/csv'],
                'label_attr' => ['class' => 'button__label']
//                'constraints' => new File(['mimeTypes' => ['text/csv']])
            ])
            ->add('xlsx', FileType::class, [
                'label' => 'xlsx to csv',
                'required' => false,
                'attr' => ['class' => 'button__input--xlsx', 'accept' => '.xlsx,' . $xlsxMime . '\''],
                'label_attr' => ['class' => 'button__label'],
                'constraints' => new File(['mimeTypes' => [$xlsxMime]])
            ])
            ->add('convert', SubmitType::class, [
                'label' => false,
                'attr' => ['class' => 'button-submit'],
            ]);
    }
}