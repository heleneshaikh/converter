<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function convert(Request $request)
    {
        $convertFrom = $this->createFormBuilder()
            ->add('file', FileType::class)
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