<?php include_once "connect.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .menu-card {
            height: 400px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .menu-card img {
            object-fit: cover;
        }
    </style>
</head>
<body>

<h6 class="font-bold justify-between text-center text-3xl text-black mt-4">Special Menu</h6>
<div class="flex flex-wrap">
    <div class="w-64 h-[96vh] mt-7 ml-5">
        <div class="w-64">
            <a href="#" class="block px-4 py-2 bg-red-500 text-white rounded mb-2">Menu</a>
            <?php
            $query = mysqli_query($connect, "SELECT * FROM category");
            while ($row = mysqli_fetch_array($query)) :
                ?>
                <a href="index.php?cat_id=<?=$row['cat_id'];?>" class="block px-4 py-2 bg-gray-100 text-black rounded mb-2"><?= $row['cat_name']; ?></a>
            <?php endwhile; ?>
        </div>
    </div>
    <div class="flex-1 bg-white ml-5 mt-4 mr-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php
        $menu_id=$_GET['menu_id'];
    $query = mysqli_query($connect, "SELECT menu.*, category.cat_name FROM menu JOIN category ON menu.categories = category.cat_id WHERE id ='$menu_id'");
    if (!$query) {
        die("Query failed: " . mysqli_error($connect));
    }
    $count=mysqli_num_rows($query);
$data = mysqli_fetch_array($query) ;
    ?>

<div class="menu-card bg-white shadow-lg rounded-lg overflow-hidden">
    <img src="<?= "images/" . $data['cover_image']; ?>" alt="Image" class="w-full h-40">
    <div class="p-4 flex flex-col justify-between flex-1">
        <div>
            <h2 class="text-lg font-semibold mb-2"><?= $data['names']; ?></h2>
            <h3 class="text-gray-600 mb-2">Price: $<?= $data['prices']; ?>/-</h3>
            <p class="text-gray-600 mb-2">Preparation Time: <?= $data['prep_time']; ?> min</p>
            <p class="<?= $data['is_vegetarian'] ? 'text-green-600' : 'text-red-600'; ?>">
                <?= $data['is_vegetarian'] ? 'Vegetarian' : 'Non-Vegetarian'; ?>
            </p>
        </div>
       
       
    </div>
</div>



        </div>
    </div>
</div>
</body>
</html>