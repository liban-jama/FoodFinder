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
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="product.php">Product</a>
                        </li>
                        <li class="nav-item active">
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
        <!-- END -- Add HTML code for the top menu section (navigation bar) -->
        <?php require_once('config.php'); ?>

        <div class = "jumbotron">
            <p class = "lead">Select your preferred City, to see which stores are nearest to you!</p>
            <hr class = "my-4">
            <form method="GET" action="nearest.php">
                <select name="City" onchange='this.form.submit()'>
                    <option selected style="color: black;">Select City</option>
                    <?php
                    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

                    if (mysqli_connect_errno()) {
                        die(mysqli_connect_error());
                    }

                    $sql = "SELECT DISTINCT City FROM Stores";

                    if ($result = mysqli_query($connection, $sql)) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option value="' . $row['City'] . '">';
                            echo $row['City'];
                            echo "</option>";
                        }

                        mysqli_free_result($result);
                    }
                    ?>
                </select>

                <?php
                if ($_SERVER["REQUEST_METHOD"] == "GET")
                {
                    if (isset($_GET['City']) )
                    {
                ?>
                <p>&nbsp;</p>
                <table class="table table-hover">
                    <thead>
                        <tr class="table-success">
                            <th scope="col"> Store </th>
                            <th scope="col"> Address </th>
                            <th scope="col"> City </th>
                            <th scope="col"> Phone Number </th>
                            <th scope="col"><center>Get Directions</center></th>
                        </tr>
                    </thead>
                    <?php
                        if ( mysqli_connect_errno() )
                        {
                            die( mysqli_connect_error() );
                        }
                        $sql = "  SELECT *
                            FROM Stores
                            WHERE Stores.City = '{$_GET['City']}'";

                        if ($result = mysqli_query($connection, $sql))
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {
                    ?>
                    <tr>
                        <td><?php echo $row['Name'] ?></td>
                        <td><?php echo $row['Address'] ?></td>
                        <td><?php echo $row['City'] ?></td>
                        <script>
                            function getDirections(){
                                var MyJSStringVar  = "<?php Print($row['Name']. ', '. $row['Address']. ','. $row['City']); ?>";
                                window.open("https://www.google.com/maps/search/?api=1&query=" + MyJSStringVar )
                            }
                        </script>
                        <td><?php echo $row['PhoneNumber'] ?></td>
                        <td onclick="getDirections()">
                            <center><img src="http://34.174.91.50/TCSS445/img/map_pin.png" height="20" width="20" ></center>
                        </td>
                    </tr>
                    <?php
                            }
                            // release the memory used by the result set
                            mysqli_free_result($result);
                        }
                    } // end if (isset)
                } // end if ($_SERVER)
                    ?>
                </table>
            </form>
        </div>
    </body>
</html>