<?php
const HOST = 'localhost';
const USERNAME = 'root';
const PASSWORD = '';
const DATABASE = 'blog';

function createDBConnection(): mysqli
{
    $conn = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}


function closeDBConnection(mysqli $conn): void
{
    $conn->close();
}


function saveFile($file, $data) {
  $myFile = fopen($file, 'w');
  if ($myFile) {
    $result = fwrite($myFile, $data);
    if ($result) {
        echo 'Данные успешно сохранены в файл';
    } else {
        echo 'Произошла ошибка при сохранении данных в файл';
    }
    fclose($myFile);
  } else {
        echo 'Произошла ошибка при открытии файла';
  }
}


function saveImage($imageBase64, $imageName): string {
	$imageName = str_replace(' ', '_', $imageName);
	$imageBase64Array = explode(';base64,', $imageBase64);
	$imgExtention = str_replace('data:image/', '', $imageBase64Array[0]);
	$imageDecoded = base64_decode($imageBase64Array[1]);
	saveFile("images/{$imageName}.{$imgExtention}", $imageDecoded);
	return "images/{$imageName}.{$imgExtention}";
}


$method = $_SERVER['REQUEST_METHOD'];

$conn = createDBConnection();

if ($method == "POST"){
	$dataAsJson = file_get_contents("php://input");
	$dataAsArray = json_decode($dataAsJson, true);
	$author_url = saveImage($dataAsArray['author_url'], $dataAsArray['author']);
	$image_url = saveImage($dataAsArray['image_url'], $dataAsArray['title']);

    $sql = "INSERT INTO post (title, subtitle, content, author, author_url, image_url, publish_date, 
	tag_type, tag_text, featured) VALUES ('{$dataAsArray['title']}', '{$dataAsArray['subtitle']}', 
	'{$dataAsArray['content']}', '{$dataAsArray['author']}', '{$author_url}', '{$image_url}', 
	'{$dataAsArray['publish_date']}', '{$dataAsArray['tag_type']}', '{$dataAsArray['tag_text']}', 
	{$dataAsArray['featured']})";
	print_r($sql);
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

closeDBConnection($conn);

?>