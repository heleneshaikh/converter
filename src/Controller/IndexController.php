<?php

namespace App\Controller;

use App\Form\UploadType;
use App\Service\ConversionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
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
        $fileSystem = new Filesystem();
        $fileSystem->remove($this->getParameter('file_uploads_directory'));

        $convertFrom = $this->createForm(UploadType::class);
        $convertFrom->handleRequest($request);
        $convertedFile = null;

        if ($convertFrom->isSubmitted() && $convertFrom->isValid()) {
            $data = $convertFrom->getData();

            /** @var UploadedFile $file */
            $file = $data['csv'] ?? $data['xlsx'];

            if ($file) {
                $convertedFile = $converter->convertFile($file);
//                $response = new BinaryFileResponse($convertedFile);
//                $response->deleteFileAfterSend(true);
                if ($convertedFile !== null) {
                    return $this->file($convertedFile);
                }
            }
        }

        return $this->render('base.html.twig', [
            'convertForm' => $convertFrom->createView()
        ]);
    }
}