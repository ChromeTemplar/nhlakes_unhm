<html>
<body>
<h1>Import 2014 Access Sites</h1>
<p>
Export each access site's excel sheet to a csv file individually.
</p>
<p>
Upload the csv file (*csv files ONLY*) on this page, and type in the name of the access site being submitted.
</p>
<form action="upload_file.php" method="post"
enctype="multipart/form-data">
Access Site Name<input type="text" name="siteName" maxlength="50">
<label for="file">Filename:</label>
<input type="file" name="file" id="file"><br>
<input type="submit" name="submit" value="Submit">
</form>

</body>
</html> 