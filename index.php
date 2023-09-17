<!DOCTYPE html>
<html>
<head>
    <title>PDF Text Extractor</title>
</head>
<body>
    <h2>Upload a PDF File</h2>
    <form action="allfiles1.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file" accept=".pdf, .docx, .txt" required>
        <button type="submit">Extract Text</button>
    </form>
</body>
</html>
