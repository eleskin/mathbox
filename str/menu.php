<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MathBox</title>
    <!-- Bootstrap CSS (jsDelivr CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/index.js" defer></script>
    <!-- Bootstrap Bundle JS (jsDelivr CDN) -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8"
            crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <header>
        <div class="d-flex justify-content-center">
            <div class="logo">
                <h2><a href="/" class="logo_a">MATHBOX</a></h2>
            </div>
        </div>
        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item nav_item">
                                <a class="nav-link active" aria-current="page" href="/">Теория вероятности</a>
                            </li>
                            <li class="nav-item nav_item">
                                <a class="nav-link" aria-current="page" href="/">Математическая статистика</a>
                            </li>
                            <li class="nav-item nav_item">
                                <a class="nav-link " aria-current="page" href="/">Отзывы</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <form method="get" action="../search.php" class="search d-flex justify-content-between align-items-center">
            <input class="act_input" placeholder="Поиск" required name="search_q">
            <input class="btn btn-primary avt_btn" type="submit" value="Найти">
        </form>
    </header>

    <main class="main pad">
        <ul class="list-group">
          <?php
          require_once '../db.php';

          $conn = new mysqli($host, $user, $password, $database);
          if ($conn->connect_error) die($conn->connect_error);

          $query = "SELECT * FROM lessons";
          $result = $conn->query($query);
          if (!$result) die($conn->error);

          $rows = $result->num_rows;

          for ($j = 0; $j < $rows; $j++) {
            $result->data_seek($j);
            $row = $result->fetch_array(MYSQLI_ASSOC);

            echo "
                    <a href='./mat.php?id=" . $row['id'] . "' class=\"list-group-item list-group-item-action\">" . $row['title'] . "</a>
                ";

          }

          $result->close();
          $conn->close();
          ?>
        </ul>
    </main>

    <footer>
        <div class="d-flex justify-content-center">
            <p> © ГУУ, 2021 </p>
        </div>
    </footer>
</div>
</body>
</html>
