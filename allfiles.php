<?php
require_once __DIR__ . '/vendor/autoload.php';

use Smalot\PdfParser\Parser;
use PhpOffice\PhpWord\IOFactory;

function extractTextFromDocument($filePath, $fileType) {
    $text = '';

    if ($fileType === 'pdf') {
        $parser = new Parser();
        $pdf = $parser->parseFile($filePath);

        foreach ($pdf->getPages() as $page) {
            $text .= $page->getText();
        }
    } elseif ($fileType === 'docx') {
        $phpWord = IOFactory::load($filePath);

        foreach ($phpWord->getSections() as $section) {
            foreach ($section->getElements() as $element) {
                if ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
                    foreach ($element->getElements() as $textElement) {
                        if ($textElement instanceof \PhpOffice\PhpWord\Element\Text) {
                            $text .= $textElement->getText() . ' ';
                        }
                    }
                }
            }
        }
    } elseif ($fileType === 'txt') {
        $text = file_get_contents($filePath);
    } else {
        $text = 'Unsupported file type';
    }

    return $text;
}

if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $fileTempPath = $_FILES['file']['tmp_name'];
    $fileType = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

    $extractedText = extractTextFromDocument($fileTempPath, strtolower($fileType));

    echo "<h2>Extracted Text:</h2>";
    echo "$extractedText";
} else {
    echo 'Error uploading the file.';
}
?>
