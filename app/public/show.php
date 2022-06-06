<?php

$pdo = require '../database/database.php';

$id = $_GET['id'];

$statement = $pdo->prepare("SELECT * FROM champions WHERE id = :id");
$statement->bindValue(':id', $id);
$statement->execute();
$champion = $statement->fetch(PDO::FETCH_ASSOC);

?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/style.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<section class="text-gray-600 body-font">
    <div class="container mx-auto flex px-5 py-10 items-center justify-center flex-col">
        <img class="max-w-xs mb-10 object-cover object-center rounded" alt="hero" src="<?= $champion['loading_image'] ?>">
        <div class="text-center lg:w-2/3 w-full">
            <h2 class="font-bold text-gray-400"><?= $champion['title']?>
            </h2>
            <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">
                <?= $champion['name']?></h1>
            <p class="mb-8 leading-relaxed"><?= $champion['description'] ?></p>
            <div class="flex justify-center">
                <a class="inline-flex text-white bg-yellow-500 border-0 py-2 px-6 focus:outline-none hover:bg-yellow-600 rounded text-lg" href="index.php">Search</a>
                <a class="ml-4 inline-flex text-gray-700 bg-gray-100 border-0 py-2 px-6 focus:outline-none hover:bg-gray-200 rounded text-lg"
                   href="https://www.leagueoflegends.com/en-gb/champions/<?= lcfirst($champion['name'])?>/"
                   target="_blank">Details</a>
            </div>
        </div>
    </div>
</section>

</body>
</html>