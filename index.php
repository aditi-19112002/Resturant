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
<div class="h-96 bg-cover bg-center"
    style="background-image: url('https://b.zmtcdn.com/web_assets/81f3ff974d82520780078ba1cfbd453a1583259680.png');">
    <div class="flex text-white py-3 px-36 gap-4 items-center justify-between w-full">
        <div class="flex items-center space-x-6">
            <img src="https://www.foodfood.com/assets/images/logo/logo.png" class="w-16 h-16">
        </div>
        <div class="flex items-center gap-8">
            <a href="#" class="text-white">Home</a>
            <a href="#" class="text-white">Menu</a>
            <a href="insert_food.php" class="text-white">Reservation</a>
            <a href="#" class="text-white">Contact</a>
        </div>
    </div>
    <div class="flex items-center justify-center h-1/2 flex-col">
        <h2 class="text-4xl font-semibold mb-2 text-white">Welcome to Our Restaurant</h2>
        <p class="text-lg text-white">Experience the best dining in town</p>
        <div class="w-1/2 mx-auto mt-8">
            <form method="GET" action="" class="flex items-center bg-gray-200 border border-pink-500 rounded-full px-1 mt-1 mr-1">
                <input type="search" name="search" placeholder="Search" size="35" class="rounded-full py-1 px-1 flex-1" style="background-color: transparent; border: none; font-size: 14px;">
                <button type="submit" name="find" class="bg-transparent text-black py-1 px-1 rounded-full" style="font-size: 14px;">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>
    </div>
</div>
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
        if (isset($_GET['find'])){
    $search = $_GET['search'];
    $query = mysqli_query($connect, "SELECT menu.*, category.cat_name FROM menu JOIN category ON menu.categories = category.cat_id WHERE menu.names LIKE '%$search%'");
    if (!$query) {
        die("Query failed: " . mysqli_error($connect));
    }
}  else{
    if (isset($_GET['cat_id'])){
        $cat_id = $_GET['cat_id'];
        $query = mysqli_query($connect, "select * from menu JOIN category ON menu.categories=category.cat_id where cat_id='$cat_id'"); 
    }
    else{
        $query = mysqli_query($connect, "select * from menu JOIN category ON menu.categories=category.cat_id");   
    
} 
}

    $count=mysqli_num_rows($query);

        if($count < 1){
          echo "<h1 class=text-4xl> Not avaible food <h1>";
        }
  

while ($data = mysqli_fetch_array($query)) :
    ?>

                <div class="menu-card bg-white shadow-lg rounded-lg overflow-hidden">
                    <img src="<?= "images/" . $data['cover_image']; ?>" alt="Image" class="w-full h-40">
                    <div class="p-4 flex flex-col justify-between flex-1">
                        <div>
                            <h2 class="text- font-semibold mb-2"><?= $data['names']; ?></h2>
                            <p class="<?= $data['is_vegetarian'] ? 'text-green-600' : 'text-red-600'; ?>">
                                <?= $data['is_vegetarian'] ? 'Vegetarian' : 'Non-Vegetarian'; ?>
                            </p>
                            <p class="text-gray-800 font-semibold">Category: <?= $data['cat_name']; ?></p>
                            <a href="view_menu.php?menu_id=<?=$data['id'];?>" class="mt-4 inline-block px-3 py-1 bg-blue-500 text-white rounded-full text-sm hover:bg-blue-600">
            View
        </a>
                        </div>
                       
                        
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>
</body>
</html>