<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Food Finder</title>
        <!-- add a reference to the external stylesheet -->
        <link rel="stylesheet" href="https://bootswatch.com/4/superhero/bootstrap.min.css">
    </head>

    <body>
        <!-- START -- Add HTML code for the top menu section (navigation bar) -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Food Finder</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarColor02">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home
                                <span class="visually-hidden">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="product.php">Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="stores.php">Stores</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="discount.php">Discount</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="nearest.php">Nearest Item</a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <?php require_once('config.php'); ?>

        <div class = "jumbotron">
            <p class = "lead">Here is everything about Products that have a discount!</p>
            <hr class = "my-4">
            <form method="GET" action="discount.php">
            <?php
            $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

            if (mysqli_connect_errno()) {
                die(mysqli_connect_error());
            }

            $sql = "SELECT Products.ProductID, Products.Name, Products.Brand, Products.Price, Coupons.Discount, Coupons.CouponID, Products.StoreID, Stores.Name FROM Coupons JOIN Products ON Coupons.productID = Products.ProductID JOIN Stores ON Products.StoreID = Stores.StoreID";
            $result = mysqli_query($connection, $sql);

            if (!$result) {
                die(mysqli_error($connection));
            }

            echo "<table class='table table-hover'>";
            echo "<thead><tr class='table-success'>";
            echo "<th scope='col'> ProductID </th>";
            echo "<th scope='col'> Name </th>";
            echo "<th scope='col'> Brand</th>";
            echo "<th scope='col'> Price </th>";
            echo "<th scope='col'> Discount </th>";
            echo "<th scope='col'> CouponID </th>";
            echo "<th scope='col'> StoreID </th>";
            echo "<th scope='col'> Store Name</th>";
            echo "</tr></thead>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['ProductID'] . "</td>";
                echo "<td>" . $row['Name'] . "</td>";
                echo "<td>" . $row['Brand'] . "</td>";
                echo "<td>" . $row['Price'] . "</td>";
                echo "<td>" . $row['Discount'] . "</td>";
                echo "<td>" . $row['CouponID'] . "</td>";
                echo "<td>" . $row['StoreID'] . "</td>";
                echo "<td>" . $row['Name'] . "</td>";
                echo "</tr>";
            }            echo "</table>";


