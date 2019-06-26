<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>Погода, чтобы не попадать под дождь</title>
</head>
<body>
  <div class='queryCityBlock'>
    <form action="index.php" method="GET">
      Город: <select name='q'>
          <option value='Omsk' >Омск</option>
          <option value='Moscow'>Москва</option>
          <option value='Saint%20Petersburg'>Санкт-Петербург</option>
          </select>
      <input type='submit'>
    </form>

    <?php
    $qCity = $_GET["q"];
    $qCountry = 'RU';
    $qLang = 'ru';
    $qUnits = 'metric';
    $apiKey = 'yourApiKey';

    if (file_exists(__DIR__.'/config_local.php')) {
        include __DIR__.'/config_local.php';
    }

    require ('request.php');
    ?>

  </div>
</body>
</html>