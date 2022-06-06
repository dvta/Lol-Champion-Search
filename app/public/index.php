<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $champion = ucwords(strtolower($_POST['champion']));
    $pdo = require '../database/database.php';

    $statement = $pdo->prepare("SELECT * FROM champions WHERE name LIKE :champion");
    $statement->bindValue(':champion', '%'.$champion.'%');
    $statement->execute();
    $champion = $statement->fetch(PDO::FETCH_ASSOC);

    if (!($champion)) {
        $champion = ucwords(strtolower($_POST['champion']));
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "http://ddragon.leagueoflegends.com/cdn/12.10.1/data/en_US/champion/$champion.json",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ]);

        json_decode(curl_exec($curl));

        if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 403) {
            $error = 'This champion is not available.';
            $code = 403;
            include 'errors.php';
            exit;
        }
        $champion = json_decode(curl_exec($curl))->data->$champion;

        curl_close($curl);

        $name = $champion->name;
        $title = $champion->title;
        $avatar_image = 'http://ddragon.leagueoflegends.com/cdn/12.10.1/img/champion/'.$champion->image->full;
        $loading_image = 'http://ddragon.leagueoflegends.com/cdn/img/champion/loading/'.$champion->name.'_0.jpg';
        $description = $champion->lore;
        $role = $champion->tags[0];

        $statement = $pdo->prepare(
            "INSERT INTO champions (name, title, avatar_image, loading_image, description, role) 
                        VALUES (:name, :title, :avatar_image, :loading_image, :description, :role)"
        );

        $statement->bindValue(':name', $name);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':avatar_image', $avatar_image);
        $statement->bindValue(':loading_image', $loading_image);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':role', $role);
        $statement->execute();

        header('Location: show.php?id='.$pdo->lastInsertId());
    }

    header('Location: show.php?id='.$champion['id']);

}

?>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="css/style.css" rel="stylesheet">
</head>
<body>


<div class="bg-indigo-900 relative overflow-hidden h-screen">
    <video autoplay loop muted class="absolute h-full w-full object-cover">
        <source src="https://www.leagueoflegends.com/static/hero-0632cbf2872c5cc0dffa93d2ae8a29e8.webm" type="video/mp4" />
        Your browser does not support the video tag.
    </video>
    <div class="inset-0 bg-black opacity-25 absolute">
    </div>
    <header class="absolute top-0 left-0 right-0 z-20">
        <nav class="container mx-auto px-6 md:px-12 py-4">
            <div class="md:flex justify-center items-center">
                <div class="flex justify-between items-center">
                    <div class="md:hidden">
                        <button class="text-white focus:outline-none">
                            <svg class="h-12 w-12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 6H20M4 12H20M4 18H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="hidden md:flex items-center">
                    <a class="text-lg uppercase mx-3 text-white cursor-pointer hover:text-gray-300"
                        href="list.php"
                    >
                        Your Champions
                    </a>
                    <a class="text-lg uppercase mx-3 text-white cursor-pointer hover:text-gray-300" href="https://www.leagueoflegends.com/en-gb/" target="_blank">
                        league of legends
                    </a>
                </div>
            </div>
        </nav>
    </header>
    <div class="container mx-auto px-6 md:px-12 relative z-10 flex items-center py-32 xl:py-40">
        <div class="w-full flex flex-col items-center relative z-10">
            <h1 class="font-lol text-7xl text-center sm:text-5xl text-yellow-700 leading-tight mt-4">
                Search Champions
            </h1>
            <form action="index.php" method="post">
            <div class=" relative">
                <input type="text" id="champion"
                       name="champion"
                       class=" mt-4 rounded-lg border-transparent flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-transparent text-white placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-yellow-700 focus:border-transparent"
                       placeholder="Your Champion"/>
            </div>
            <button type="submit" class="block bg-gray-800 hover:bg-gray-900 py-3 px-4 text-lg text-white font-bold uppercase mt-10 lol-button">
                Search
            </button>
            </form>
        </div>
    </div>
</div>


</body>
</html>








