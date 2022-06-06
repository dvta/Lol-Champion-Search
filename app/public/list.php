<?php
$pdo = require '../database/database.php';

$statement = $pdo->prepare("SELECT * FROM champions");
$statement->execute();
$champions = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
</head>
    <nav class="container mx-auto px-6 md:px-12 py-4">
        <div class="md:flex justify-center items-center">
            <div class="flex justify-between items-center">
                <div class="md:hidden">
                    <button class="text-white focus:outline-none">
                        <svg class="h-12 w-12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6H20M4 12H20M4 18H20" stroke="gold" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="hidden md:flex items-center">
                <a class="text-lg uppercase mx-3 text-black cursor-pointer hover:text-gray-300"
                   href="index.php"
                >
                    Search
                </a>
                <a class="text-lg uppercase mx-3 text-black cursor-pointer hover:text-gray-300"
                   href="list.php"
                >
                    Your Champions
                </a>
                <a class="text-lg uppercase mx-3 text-black cursor-pointer hover:text-gray-300" href="https://www.leagueoflegends.com/en-gb/" target="_blank">
                    league of legends
                </a>
            </div>
        </div>
    </nav>
<body>
<div class="container mx-auto px-4 sm:px-8 max-w-3xl">
    <div class="py-2">
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                    <tr>
                        <th scope="col"
                            class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                            Champion
                        </th>
                        <th scope="col"
                            class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                            Role
                        </th>
                        <th scope="col"
                            class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                            Title
                        </th>
                        <th scope="col"
                            class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                            Created at
                        </th>
                        <th scope="col"
                            class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($champions as $champion): ?>
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <a href="show.php?id=<?= $champion['id'] ?>" class="block relative">
                                            <img alt="profil" src="<?= $champion['avatar_image'] ?>"
                                                 class="mx-auto object-cover rounded-full h-10 w-10 "/>
                                        </a>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            <?= $champion['name'] ?>
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    <?= $champion['role'] ?>
                                </p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    <?= $champion['title'] ?>
                                </p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                    <span class="relative">
                                        <?= $champion['created_at'] ?>
                                    </span>
                                </span>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                    </span>
                                <span class="relative">
                                       <a href="delete.php?id=<?= $champion['id'] ?>"
                                          class="text-red-700 hover:text-white hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">Delete</a>
                                    </span>
                                </span>
                            </td>
                        </tr>
                    <?php
                    endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>








