<?php
session_start();
//if(!isset($_SESSION['id']) || $_SESSION['role'] !='sportif'){
//    header("location: login.php");
//}


require_once "../classes/checker.php";
require_once "../classes/coach.php";
require_once "../config/database.php";


if(!isset($_SESSION['id'])){
    header("location: login.php");
}







?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Coaches - CoachPro</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

<!-- Navigation -->
<nav class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
        <a href="index.php" class="text-2xl font-bold text-green-600">CoachPro</a>

        <div class="hidden md:flex gap-6">
            <a href="index.php" class="hover:text-green-600">Home</a>
            <a href="coaches.php" class="hover:text-green-600">Find Coaches</a>
            <a href="login.php" class="hover:text-green-600">Login</a>
        </div>

        <button id="mobileMenuBtn" class="md:hidden">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>
</nav>

<!-- Page Content -->
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row gap-6">

        <!-- Filters Sidebar (static / visual only) -->
        <aside class="md:w-64">
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="font-bold mb-4">Filters</h3>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Sports</label>
                    <div class="space-y-2">
                        <label class="flex items-center"><input type="checkbox" class="mr-2"> Football</label>
                        <label class="flex items-center"><input type="checkbox" class="mr-2"> Basketball</label>
                        <label class="flex items-center"><input type="checkbox" class="mr-2"> Tennis</label>
                        <label class="flex items-center"><input type="checkbox" class="mr-2"> Swimming</label>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Level</label>
                    <select class="w-full px-3 py-2 border rounded-lg">
                        <option>All Levels</option>
                        <option>Beginner</option>
                        <option>Intermediate</option>
                        <option>Advanced</option>
                        <option>Pro</option>
                    </select>
                </div>

                <button class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700">
                    Apply Filters
                </button>
            </div>
        </aside>

        <!-- Coaches List -->
        <main class="flex-1">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php
                        $pdo = new connect();
                        $fetcher = new checker($pdo->connecting());
                        $coaches = $fetcher->getAllCoaches();
                        foreach ($coaches as $coach):
                    ?>
                <!-- Coach 1 -->
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                    <img src="/placeholder.svg?height=200&width=200"
                         alt="image"
                         class="w-full h-48 object-cover rounded-lg mb-4">

                    <h3 class="text-xl font-bold mb-2"><?= $coach->getName()  ?></h3>

                    <div class="flex flex-wrap gap-2 mb-2">
                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm"><?= $coach->getName()  ?></span>
                    </div>

                    <p class="text-gray-600 mb-2"><?= $coach->getExp()  ?> ans d'experience• ⭐ 4.8</p>
                    <p class="text-gray-500 text-sm mb-4">
                        <?= $coach->getBio  ?>
                    </p>

                    <a href="coach_profile.php?id=<?= $coach->getId() ?>"
                       class="block text-center bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                        View Profile
                    </a>
                </div>
                <?php
                endforeach;
                ?>

            </div>
        </main>
    </div>
</div>

<!-- Mobile Menu Script (optional) -->
<script>
    document.getElementById('mobileMenuBtn').addEventListener('click', function () {
        let menu = document.getElementById('mobileMenu');

        if (!menu) {
            menu = document.createElement('div');
            menu.id = 'mobileMenu';
            menu.className = 'md:hidden px-4 pb-4 bg-white shadow';
            menu.innerHTML = `
                <a href="index.php" class="block py-2 hover:text-green-600">Home</a>
                <a href="coaches.php" class="block py-2 hover:text-green-600">Find Coaches</a>
                <a href="login.php" class="block py-2 hover:text-green-600">Login</a>
            `;
            this.closest('nav').appendChild(menu);
        } else {
            menu.classList.toggle('hidden');
        }
    });
</script>

</body>
</html>
