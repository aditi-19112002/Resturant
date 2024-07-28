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
        <?php
        $menu_id = $_GET['menu_id'];
        $query = mysqli_query($connect, "SELECT menu.*, category.cat_name FROM menu JOIN category ON menu.categories = category.cat_id WHERE menu.id ='$menu_id'");
        if (!$query) {
            die("Query failed: " . mysqli_error($connect));
        }
        $data = mysqli_fetch_array($query);
        ?>

        <div class="flex">
            <div class="w-1/3 ml-2 mt-2 mr-2">
                <div class="bg-white shadow-md rounded-md p-4">
                    <img src="<?= "images/" . $data['cover_image']; ?>" alt="Image" class="w-full h-52 object-cover rounded-t-md">
                </div>
            </div>
            <div class="w-2/3">
                <table>
                    <thead>
                        <tr>
                            <th class="p-4 text-black">Name:</th>
                            <td class="p-4"><?= $data['names']; ?></td>
                        </tr>
                        <tr>
                            <th class="p-4 text-black">Category:</th>
                            <td class="p-4"><?= $data['cat_name']; ?></td>
                        </tr>
                        <tr>
                            <th class="p-4 text-black">Price:</th>
                            <td class="p-4"><?= $data['prices']; ?></td>
                        </tr>
                        <tr>
                            <th class="p-4 text-black">Preparation Time:</th>
                            <td class="p-4"><?= $data['prep_time']; ?> min</td>
                        </tr>
                        <tr>
                            <th class="p-4 text-black">Description:</th>
                            <td class="p-4"><?= $data['descriptions']; ?></td>
                        </tr>
                        <tr>
                            <th class="p-4 text-black">Type:</th>
                            <td class="p-4 <?= $data['is_vegetarian'] ? 'text-green-600' : 'text-red-600'; ?>">
                                <?= $data['is_vegetarian'] ? 'Vegetarian' : 'Non-Vegetarian'; ?>
                            </td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

        <div class="grid grid-cols-4 mt-8">
            <?php
            $query = mysqli_query($connect, "SELECT * FROM menu JOIN category ON menu.categories = category.cat_id WHERE menu.id <> '$menu_id'");
            $count = mysqli_num_rows($query);

            if ($count < 1) {
                echo "<h1 class='text-4xl'> No related menus available</h1>";
            }
            while ($data = mysqli_fetch_array($query)) {
            ?>
                <div class="w-full ml-2 mt-8 mr-2">
                    <div class="bg-white shadow-md rounded-md p-4" style="height:250px;object-fit:cover">
                        <img src="<?= "images/" . $data['cover_image']; ?>" alt="Image" class="w-full h-52 object-cover rounded-t-md">
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

</body>
</html>
