<?php

namespace App\Controller;

use App\Form\UploadType;
use App\Service\ConversionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param Request $request
     * @param ConversionService $converter
     * @return Response
     */
    public function index(Request $request, ConversionService $converter): Response
    {
        $convertFrom = $this->createForm(UploadType::class);
        $convertFrom->handleRequest($request);

        if ($convertFrom->isSubmitted() && $convertFrom->isValid()) {
            $data = $convertFrom->getData();

            /** @var UploadedFile $file */
            $file = $data['csv'] ?? $data['xlsx'];
            $convertedFile = null;

            if ($file) {
                $convertedFile = $converter->convertFile($file);

                return $this->file($convertedFile);
            }
        }

        return $this->render('base.html.twig', [
            'convertForm' => $convertFrom->createView()
        ]);
    }
}