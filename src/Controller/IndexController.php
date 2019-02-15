<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\File;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param Request $request
     * @return Response
     */
    public function convert(Request $request): Response
    {
        $convertFrom = $this->createFormBuilder()
            ->add('file', FileType::class, [
                'label' => 'Upload a .csv file',
                'constraints' => new File(['mimeTypes' => ['application/pdf']])
            ])
            ->add('file', FileType::class, [
                'label' => 'Upload a .xlsx file',
                'constraints' => new File(['mimeTypes' => ['application/pdf']])
            ])
            ->add('convert', SubmitType::class)
            ->getForm();

        $convertFrom->handleRequest($request);

        if($convertFrom->isSubmitted() && $convertFrom->isValid()) {
            $data = $convertFrom->getData();
        }

        return $this->render('base.html.twig', [
            'convertForm' => $convertFrom->createView()
        ]);

    }
}