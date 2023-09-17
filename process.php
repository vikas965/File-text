<?php
require_once __DIR__ . '/vendor/autoload.php';

use Smalot\PdfParser\Parser;

// Check if a PDF file was uploaded
if ($_FILES['pdf_file']['error'] === UPLOAD_ERR_OK) {
    // Get the temporary uploaded file path
    $tmpFilePath = $_FILES['pdf_file']['tmp_name'];

    // Load the PDF file
    $parser = new Parser();
    $pdf = $parser->parseFile($tmpFilePath);

    // Extract text from each page
    $pdfText = '';
    foreach ($pdf->getPages() as $page) {
        $pdfText .= $page->getText();
    }

    // Display the extracted text
    echo "<h2>Extracted Text from PDF:</h2>";
    echo "<pre>$pdfText</pre>";
} else {
    echo 'Error uploading the PDF file.';
}
?>
