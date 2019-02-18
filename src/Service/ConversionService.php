<?php

namespace App\Service;

use PhpOffice\PhpSpreadsheet\Reader\Exception as ReaderException;
use PhpOffice\PhpSpreadsheet\Writer\Exception as WriterException;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as XlsxReader;
use \PhpOffice\PhpSpreadsheet\Writer\Xlsx as XlsxWriter;
use PhpOffice\PhpSpreadsheet\Reader\Csv as CsvReader;
use PhpOffice\PhpSpreadsheet\Writer\Csv as CsvWriter;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ConversionService
{
    /** @var string */
    private $fileUploadPath;

    /**
     * ConversionService constructor.
     * @param $fileUploadPath
     */
    public function __construct($fileUploadPath)
    {
        $this->fileUploadPath = $fileUploadPath;
    }

    /**
     * @param UploadedFile $file
     * @return null|string
     */
    public function convertFile(UploadedFile $file): ?string
    {
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $file->guessExtension();
        $file->move($this->fileUploadPath, $fileName);

        switch ($file->guessClientExtension()) {
            case 'csv':
                return $this->convertCsvToXls($fileName);
            case 'xlsx':
                return $this->convertXlsToCsv($fileName);
        }
        
        return null;
    }

    /**
     * @param string $fileName
     * @return string
     */
    private function convertXlsToCsv(string $fileName): ?string
    {
        $reader = new XlsxReader();

        try {
            $spreadsheet = $reader->load($this->fileUploadPath . '' . $fileName);
            $writer = new CsvWriter($spreadsheet);
            $convertedFileName = $this->fileUploadPath . '' . substr($fileName, 0, strpos($fileName, '.')) . '.csv';
            $writer->save($convertedFileName);

            return $convertedFileName;
        } catch (ReaderException | WriterException $e) {
            echo 'Unable to convert file due to ' . $e->getMessage();
        }

        return $fileName;
    }

    /**
     * @param string $fileName
     * @return null|string
     */
    private function convertCsvToXls(string $fileName): ?string
    {
        $reader = new CsvReader();

        try {
            $spreadsheet = $reader->load($this->fileUploadPath . '' . $fileName);
            $writer = new XlsxWriter($spreadsheet);
            $convertedFileName = $this->fileUploadPath . '' . substr($fileName, 0, strpos($fileName, '.')) . '.xlsx';
            $writer->save($convertedFileName);

            return $convertedFileName;
        } catch (ReaderException | WriterException$e) {
            echo 'Unable to convert file due to ' . $e->getMessage();
        }

        return $fileName;
    }
}
