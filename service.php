<?php
require_once "config.php";
?>
<?php session_start();


if (isset($_SESSION['email']) != NULL) {
    $userEmail = $_SESSION['email'];
} else {
    echo '<script>
    alert("Please Login first");
    window.location.href="index.php";
    </script>';
}
?>
<?php
if (isset($_POST["add_to_cart"])) {
    if (isset($_SESSION["service_cart"])) {
        $item_array_id = array_column($_SESSION["service_cart"], "item_id");
        if (!in_array($_GET["id"], $item_array_id)) {
            $count = count($_SESSION["service_cart"]);
            $item_array = array(
                'item_id'               =>     $_GET["id"],
                'item_name'               =>     $_POST["serviceName"],
                'item_price'          =>     $_POST["price"],
                'staffID'          =>     $_POST["staffID"]
            );
            $_SESSION["service_cart"][$count] = $item_array;
        } else {
            echo '<script>alert("Item Already Added")</script>';
            echo '<script>window.location="service.php"</script>';
        }
    } else {
        $item_array = array(
            'item_id'               =>     $_GET["id"],
            'item_name'               =>     $_POST["serviceName"],
            'item_price'          =>     $_POST["price"],
            'staffID'          =>     $_POST["staffID"]
        );
        $_SESSION["service_cart"][0] = $item_array;
    }
}
if (isset($_GET["action"])) {
    if ($_GET["action"] == "delete") {
        foreach ($_SESSION["service_cart"] as $keys => $values) {
            if ($values["item_id"] == $_GET["id"]) {
                unset($_SESSION["service_cart"][$keys]);
                echo '<script>alert("Item Removed")</script>';
                echo '<script>window.location="service.php"</script>';
            }
        }
    }
}
?>



<!Doctype html>
<html>

<head>
    <title>Service Order Page</title>
    <link rel="shortcut icon" href="./Logo/Calina_Logo-03.png" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <!--This is my kit font awesome pls remind me-------------------------------------------->
    <script src="https://kit.fontawesome.com/92d742c429.js" crossorigin="anonymous"></script>
    <!--------------------------------------------------------------------------------------->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="food.css">
    <?php
    $query = "SELECT * FROM AdditionalService";
    $result = mysqli_query($conn, $query);
    ?>

    <script>
        var food_ID;
        $(document).ready(function() {
            $('#food').change(function() {
                var food_ID = $(this).val();
                console.log(food_ID);
            });
            $('#food').change(function() {
                $.ajax({
                    url: "data.php",
                    method: "POST",
                    data: {
                        foodID: $(this).val()
                    },
                    dataType: "text",
                    success: function(price) {
                        $('#price').html(price);
                        $('#price').val(data)

                    }

                });
            });

        });
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <a href="index.php" class="navbar-brand"><img src="Logo/Calina_Logo-tiny.png" alt="logo"></a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav">
                <a href="index.php" class="nav-item nav-link active"><i class="fa fa-home"></i> Home</a>
                <a href="roomSelectPage.php" class="nav-item nav-link"><i class="fa fa-bed"></i> Find & Reserve</a>
                <a href="food.php" class="nav-item nav-link"><i class="fa fa-cutlery"></i> Food & Dining</a>
                <a href="service&facility.php" class="nav-item nav-link" tabindex="-1"><i class="fa fa-car"></i> Service & Facility</a>
            </div>
            <div class="navbar-nav ml-auto">
                <?php if (isset($_SESSION['email']) != NULL) : ?>
                    <a class="nav-item nav-link"> <i class="fas fa-user-alt"> </i> <?php echo $_SESSION['email']; ?> </a>
                    <form class="form-inline" action="logout.php" method="POST">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="logout">Logout</button>
                    </form>
                <?php else : ?>
                    <a class="nav-item nav-link dropdown-toggle mr-md-2" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="fas fa-user-alt"></i>Login</a>
                    <div class="dropdown-menu dropdown-menu-right p-3">
                        <form class="form-horizontal" method="POST" accept-charset="UTF-8" action="login_action.php">
                            <input class="form-control login" type="text" name="email" placeholder="Email" id="email">
                            <input class="form-control login" type="password" name="password" placeholder="Password" id="pass">
                            <input class="btn btn-primary" type="submit" name="submit" value="Login">
                        </form>
                    </div>
                    <a href="register.php" class="nav-item nav-link"> <i class="fas fa-user-plus"> </i> Sign up</a>
                <?php endif ?>
            </div>
        </div>
    </nav>
    <div class="container">
        <h1>Additional Service</h1>
        <p>Please fill the infomation.</p>
        <table id="myTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Price</th>
                    <th></th>
                </tr>
            </thead>
            <?php if (mysqli_num_rows($result) > 0) : ?>
                <?php while ($row = mysqli_fetch_array($result)) : ?>
                    <form method="post" action="service.php?action=add&id=<?php echo $row["serviceID"]; ?>">
                        <tr>
                            <td>
                                <div class="form-group">
                                    <?php echo '<input type=text id="serviceName" name="serviceName" class="form-control" readonly value="' . $row['serviceName'] . '">' ?>
                                    <?php echo '<input type=hidden id="staffID" name="staffID" class="form-control" readonly value="' . $row['staffID'] . '">' ?>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <?php echo '<input type=number id="unitPrice" name="price" class="form-control" readonly value="' . $row['price'] . '">' ?>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
                                </div>
                            </td>
                        </tr>
                    </form>
                <?php endwhile; ?>
            <?php endif; ?>
        </table>
    </div>
    <p><br /></p>
    <div class="container">
        <form method="POST" action="service_action.php" name="order">
            <table class="table table-bordered table-striped">
                <thread>
                    <th>Service Name</th>
                    <th>Price</th>
                    <th>Action</th>
                </thread>
                <?php
                if (!empty($_SESSION["service_cart"])) {
                    $total = 0;
                    foreach ($_SESSION["service_cart"] as $keys => $values) {
                ?>
                        <tr>
                            <td><?php echo $values["item_name"]; ?></td>
                            <td><?php echo $values["item_price"]; ?> ฿</td>
                            <td><a href="service.php?action=delete&id=<?php echo $values["item_id"];?>"><span class="btn btn-danger">Remove</span></a></td>
                        </tr>
                    <?php
                        $total = $total +  $values["item_price"];
                    }
                    ?>
                    <tr>
                        <td colspan="2" align="right">Total</td>
                        <td align="right"><?php echo number_format($total, 2); ?> ฿</td>
                    </tr>
                <?php
                }
                ?>
            </table>
            <div class="container">

                <div class="form-group row">
                    <label for="Branch" class="col-sm-2 col-form-label col-form-label-lg"><b>Branch</b></label>
                    <div class="col-sm-10">
                        <select class="form-control form-control-lg" name="Branch" id="branch" required>
                            <option value="">Select Branch</option>
                            <?php
                            $Bquery = "SELECT * FROM Branch ORDER BY branchID";
                            $Bresult = $conn->query($Bquery);
                            if ($Bresult->num_rows > 0) {
                                while ($Brow = $Bresult->fetch_assoc()) {
                                    echo '<option value="' . $Brow['branchID'] . '">' . $Brow['title'] . '</option>';
                                }
                            } else {
                                echo '<option value="">Branch is not available</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Branch" class="col-sm-2 col-form-label col-form-label-lg"><b>Room Number</b></label>
                    <div class="col-sm-10">
                        <p><input type="text" name="roomID" placeholder="Enter your room number" class="form-control form-control-lg mb-2" required></p>
                    </div>
                </div>
            </div>
            <input type="submit" name="sumbit" style="margin-top:5px; " align="center" class="btn btn-lg btn-primary mx-auto d-block" value="submit" />
        </form>

    </div>

</body>

</html>