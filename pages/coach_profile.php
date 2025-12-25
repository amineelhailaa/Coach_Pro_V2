<?php
//error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
//ini_set('display_errors', 1);

//session_start();
//require_once "./config/db.php";
//$user = $_SESSION['user_id'];
//$id = $_GET['id'];
//var_dump($user,$id);
//if($_SERVER['REQUEST_METHOD']==="POST"){
//    $statement = $con->prepare("insert into reservation (client_id,coach_id,start_date,duree,status) values (?,?,?,?,? )");
//$start = $_POST['start_date'];
//$duree= $_POST['duree'];
//$status = "in progress";
//    $statement->bind_param("sssis",$user,$id,$start,$duree,$status);
//    $statement->execute();
//}

try {
    if($_SERVER['REQUEST_METHOD']==='GET') {
        $id = $_GET['id'];
        $con = new connect();
        $pdo = $con->connecting();
        $repo = new checker($pdo);
        $array = $repo->getSeances($id); //array of seances of that coach


    }
    else {
        header("/pages/login.php");
        exit();
    }

}catch (Throwable $err){
    echo $err->getMessage();
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coach Profile - CoachPro</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
            <!-- Logo links to index.php, green theme -->
            <a href="index.php" class="text-2xl font-bold text-green-600">CoachPro</a>
            <div class="hidden md:flex gap-6">
                <a href="index.php" class="hover:text-green-600">Home</a>
                <a href="coaches.php" class="hover:text-green-600">Find Coaches</a>
                <!-- Link to login.php -->
                <a href="login.php" class="hover:text-green-600">Login</a>
            </div>
        </div>
    </nav>

    <div class="max-w-5xl mx-auto px-4 py-8">
        <!-- Coach Header -->
        <?php



        ?>
        <div class="bg-white p-8 rounded-lg shadow mb-6">
            <div class="flex flex-col md:flex-row gap-6">
                <img id="coachPhoto" src="/placeholder.svg?height=200&width=200" alt="Coach" class="w-48 h-48 rounded-lg object-cover">
                <div class="flex-1">
                    <h1 id="coachName" class="text-3xl font-bold mb-2">coach name</h1>
                    <div id="coachSports" class="flex flex-wrap gap-2 mb-4">asdfasdf</div>
                    <p id="coachBio" class="text-gray-700">asdfasdf</p>
                </div>
            </div>
        </div>

        SELECT FORMAT(SaleDate, 'dddd') AS DayOfWeek,
        SUM(QuantitySold) AS TotalQuantitySold
        FROM #TempProductSales
        GROUP BY FORMAT(SaleDate, 'dddd');


        <div class="bg-white p-8 rounded-lg shadow mb-6">
            <h2 class="text-2xl font-bold mb-4">Availability</h2>

            <div class="space-y-4">

                <div>
                    <h3 class="font-semibold mb-2">Monday</h3>
                    <div class="flex gap-2">
                        <button class="slot px-4 py-2 border rounded-lg hover:bg-green-100"
                                data-day="Monday"
                                data-time="09:00 – 10:00">
                            09:00 – 10:00
                        </button>

                        <button class="slot px-4 py-2 border rounded-lg hover:bg-green-100"
                                data-day="Monday"
                                data-time="10:00 – 11:00">
                            10:00 – 11:00
                        </button>
                    </div>
                </div>

                <div>
                    <h3 class="font-semibold mb-2">Wednesday</h3>
                    <div class="flex gap-2">
                        <button class="slot px-4 py-2 border rounded-lg hover:bg-green-100"
                                data-day="Wednesday"
                                data-time="14:00 – 15:00">
                            14:00 – 15:00
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="bookingModal"
         class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">

        <div class="bg-white rounded-lg p-6 max-w-md w-full">
            <h3 class="text-xl font-bold mb-4">Confirm Reservation</h3>

            <p class="mb-4 text-gray-700">
                You are about to book:
                <br>
                <strong id="modalSlotText"></strong>
            </p>

            <div class="flex gap-4">
                <button class="flex-1 bg-green-600 text-white py-2 rounded-lg hover:bg-green-700">
                    Confirm
                </button>

                <button id="closeModal"
                        class="flex-1 bg-gray-300 py-2 rounded-lg hover:bg-gray-400">
                    Cancel
                </button>
            </div>
        </div>
    </div>

    <script>
        /* =========================
           MODAL BEHAVIOR ONLY
        ========================= */

        const modal = document.getElementById('bookingModal');
        const modalText = document.getElementById('modalSlotText');
        const closeBtn = document.getElementById('closeModal');

        document.querySelectorAll('.slot').forEach(btn => {
            btn.addEventListener('click', () => {
                const day = btn.dataset.day;
                const time = btn.dataset.time;

                modalText.textContent = `${day} • ${time}`;
                modal.classList.remove('hidden');
            });
        });

        closeBtn.addEventListener('click', () => {
            modal.classList.add('hidden');
        });

        // Optional: click outside modal closes it
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.add('hidden');
            }
        });
    </script>

    <!-- Review submission modal -->
    <div id="reviewSubmitModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg p-8 max-w-md w-full">
            <h3 class="text-2xl font-bold mb-4">Leave a Review</h3>
            <form method="POST" action="/avis/create.php">
                <input type="hidden" name="coach_id" id="reviewCoachId">
                <input type="hidden" name="reservation_id" value="">

                <div class="mb-4">
                    <label class="block font-medium mb-2">Your Review (max 90 characters)</label>
                    <textarea name="avis" maxlength="90" rows="3" required class="w-full px-3 py-2 border rounded-lg"></textarea>
                    <div class="text-sm text-gray-500 mt-1">Character count: <span id="reviewCharCount">0</span>/90</div>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="flex-1 bg-green-600 text-white py-2 rounded-lg hover:bg-green-700">Submit Review</button>
                    <button type="button" onclick="closeReviewSubmitModal()" class="flex-1 bg-gray-300 py-2 rounded-lg hover:bg-gray-400">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script src="../js/app.js"></script>
    <script>


                function openBookingModal() {
            document.getElementById('bookingModal').classList.remove('hidden');
        }

        function closeBookingModal() {
            document.getElementById('bookingModal').classList.add('hidden');
        }

        function openReviewSubmitModal() {
            document.getElementById('reviewCoachId').value = coach.id;
            document.getElementById('reviewSubmitModal').classList.remove('hidden');
        }

        function closeReviewSubmitModal() {
            document.getElementById('reviewSubmitModal').classList.add('hidden');
        }

        const reviewTextarea = document.querySelector('#reviewSubmitModal textarea[name="avis"]');
        if (reviewTextarea) {
            reviewTextarea.addEventListener('input', function() {
                document.getElementById('reviewCharCount').textContent = this.value.length;
            });
        }


    </script>
</body>
</html>
