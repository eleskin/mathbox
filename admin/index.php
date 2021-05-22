<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MathBox</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<form id="form" method="post">
    <input type="text" name="title">
    <div id="editorjs"></div>
    <input type="text" id="editorjs-value" name="editor_text">
    <button type="submit" class="btn btn-primary avt_btn" id="editorjs-save-btn">Сохранить</button>
</form>


<?php
require_once '../db.php';

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) die($conn->connect_error);

$text = $_POST['editor_text'];
$title = $_POST['title'];

if (isset($_POST['editor_text']) && isset($_POST['title'])) {
  $conn->query("INSERT INTO lessons VALUES(NULL, '$title', '$text')");
}
$conn->close();
?>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/simple-image@latest"></script>
<script>
  const editor = new EditorJS({
    /**
     * Id of Element that should contain the Editor
     */
    holder: 'editorjs',
    tools: {
      image: SimpleImage,
    },
    placeholder: 'Let`s write an awesome story!',
    onChange: (event) => {
      document.querySelector('#editorjs-save-btn').setAttribute('disabled', true);
      event.saver.save().then((output) => {
        document.querySelector('#editorjs-value').value = JSON.stringify(output.blocks);
        document.querySelector('#editorjs-save-btn').removeAttribute('disabled');
      });
    },

  })
</script>
</body>
</html>