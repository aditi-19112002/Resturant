<?php include_once "connect.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>

  <?php include_once "header1.php";?>

  <div class="flex-1 bg-slate-700 p-6">
     <div class="flex space-x-6">
        <div class="w-1/2 bg-white text-black shadow-md p-4 mb-8">
            <div class="w-64 mt-4">
                <a href="" class="block px-4 py-2 bg-red-500 text-white rounded mb-2">Insert food detail</a>
            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <!-- Food Detail Form -->
                    <div class="mb-3">
                        <label for="names" class="block text-black"> Name</label>
                        <input type="text" id="names" name="names" class="form-control w-full px-3 py-2 border rounded-lg">
                    </div>
                    <div class="mb-3">
                        <label for="descriptions" class="block text-black">Description:</label>
                        <textarea rows="4" name="descriptions" id="descriptions" class="form-control w-full px-3 py-2 border rounded-lg"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="prices" class="block text-black">Prices</label>
                        <input type="text" name="prices" id="prices" class="form-control w-full px-3 py-2 border rounded-lg">
                    </div>
                    <div class="mb-3">
                        <label for="categories" class="block text-black">Categories:</label>
                        <select name="categories" id="categories" class="form-select w-full px-3 py-2 border rounded-lg">
                            <option value="">Select category here</option>
                            <?php
                            $query = mysqli_query($connect, "select * from category");
                            while ($row = mysqli_fetch_array($query)) {
                                $cat_id = $row['cat_id'];
                                $cat_name = $row['cat_name'];
                                echo "<option value='$cat_id'>$cat_name</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="cover_image" class="block text-black">Cover Image:</label>
                        <input type="file" id="cover_image" name="cover_image" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="is_vegetarian" class="block text-black">Vegetarian:</label>
                        <input type="checkbox" id="is_vegetarian" name="is_vegetarian" class="form-checkbox">
                    </div>
                    <div class="mb-3">
                        <label for="prep_time" class="block text-black">Preparation Time (minutes):</label>
                        <input type="text" id="prep_time" name="prep_time" class="form-control w-full px-3 py-2 border rounded-lg">
                    </div>
                    <div class="mb-3">
                        <input type="submit" name="create_menu" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-blue-600" value="Insert food">
                    </div>
                </form>
                <?php
                if (isset($_POST['create_menu'])) {
                    $_names = $_POST['names'];
                    $_descriptions = $_POST['descriptions'];
                    $_prices = $_POST['prices'];
                    $_categories = $_POST['categories'];
                    $_cover_image = $_FILES['cover_image']['name'];
                    $_tmp_cover_image = $_FILES['cover_image']['tmp_name'];
                    $_is_vegetarian = isset($_POST['is_vegetarian']) ? 1 : 0;
                    $_prep_time = $_POST['prep_time'];

                    move_uploaded_file($_tmp_cover_image, "images/$_cover_image");

                    $query = mysqli_query($connect, "INSERT INTO menu(names, descriptions, prices, categories, cover_image, is_vegetarian, prep_time) VALUES('$_names', '$_descriptions', '$_prices', '$_categories', '$_cover_image', '$_is_vegetarian', '$_prep_time')");
                    if ($query) {
                        echo "<script>window.open('index.php', '_self')</script>";
                    } else {
                        echo "<script>alert('failed')</script>";
                    }
                }
                ?>
            </div>
        </div>

        <div class="w-1/2 bg-white text-black shadow-md p-4 mb-8 ">
            <div class="w-64 mt-4">
                <a href="" class="block px-4 py-2 bg-red-500 text-white rounded mb-2">Insert category detail</a>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="cat_name" class="block text-black font-semibold">Category name:</label>
                        <input type="text" id="cat_name" name="cat_name" placeholder="Enter category name" class="form-control w-full px-3 py-2 border rounded-lg">
                    </div>
                    <div class="mb-3">
                        <input type="submit" name="create_category" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-blue-600" value="Insert category">
                    </div>
                </form>
                <?php
                if (isset($_POST['create_category'])) {
                    $cat_name = $_POST['cat_name'];

                    $query = mysqli_query($connect, "INSERT INTO category(cat_name) VALUES('$cat_name')");
                    if ($query) {
                        echo "<script>window.open('insert_food.php', '_self')</script>";
                    } else {
                        echo "<script>alert('failed')</script>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
  </div>
</body>
</html>
