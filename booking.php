<?php
// Start the session
session_start();
require_once "config.php";

if (isset($_SESSION['email']) != NULL) {
    $userEmail = $_SESSION['email'];
    $query = "SELECT * FROM Branch ORDER BY branchID";
    $query_2 = "SELECT * FROM Furniture ";
    $result_2 = $conn->query($query_2);
    $result = $conn->query($query);
} else {
    echo '<script>
    alert("Please Login first");
    window.location.href="index.php";
    </script>';
}
?>

<!Doctype html>
<html>

<head>
    <title>Booking</title>
    <link rel="shortcut icon" href="./Logo/Calina_Logo-03.png" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="bookingstyle.css">
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

    <script>
        $(document).ready(function() {
            $("$btnclr".click).click(function() {
                $('input[type="text"]').val('');
                $(".clear").val('');
            });
        });
    </script>


    <script>
        $(document).ready(function() {


            $("#seeAnotherField").change(function() {
                if ($(this).val() == "creditCard") {
                    $('#otherFieldDiv').show();
                    $('#otherField').attr('required', '');
                    $('#otherField').attr('data-error', 'This field is required.');
                } else {
                    $('#otherFieldDiv').hide();
                    $('#otherField').removeAttr('required');
                    $('#otherField').removeAttr('data-error');
                }
            });
            $("#seeAnotherField").trigger("change");
        })
    </script>

    <script>
        var diffDays = 1;
        var basePrice;
        var keepPrice;
        /* Date picker */
        $(document).ready(function() {


            $(document).ready(function() {
                $("#room_type").change(function() {
                    $.ajax({
                        async: false,
                        url: 'get_price.php',
                        type: 'post',
                        data: {
                            room_type: $(this).val()
                        },
                        success: function(output) {
                            basePrice = output;
                            keepPrice = basePrice * diffDays;
                            document.getElementById("myInput").value = keepPrice;
                            document.getElementById("pricePerNight").value = output;
                        }
                    });
                });
            });

            $("#dt1").datepicker({
                dateFormat: "yy-MM-dd",
                monthNames: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"],
                changeMonth: true,
                changeYear: true,
                buttonText: "Choose",
                minDate : 0,
                onSelect: function() {
                    var date2 = $('#dt1').datepicker('getDate');
                    date2.setDate(date2.getDate() + 1);
                    $('#dt2').datepicker('setDate', date2);
                    //sets minDate to dt1 date + 1
                    $('#dt2').datepicker('option', 'minDate', date2);
                    var a = $("#dt1").datepicker('getDate').getTime();
                    var b = $("#dt2").datepicker('getDate').getTime();
                    var c = 24 * 60 * 60 * 1000;
                    diffDays = Math.round(Math.abs((a - b) / (c)));
                    $("#totaldays").val(diffDays);
                }

            });
            $('#dt2').datepicker({
                dateFormat: "yy-MM-dd",
                monthNames: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"],
                changeMonth: true,
                changeYear: true,
                minDate : 0,
                onClose: function() {
                    var dt1 = $('#dt1').datepicker('getDate');
                    var dt2 = $('#dt2').datepicker('getDate');
                    if (dt2 <= dt1) {
                        var minDate = $('#dt2').datepicker('option', 'minDate');
                        $('#dt2').datepicker('setDate', minDate);
                    }
                    var a = $("#dt1").datepicker('getDate').getTime();
                    var b = $("#dt2").datepicker('getDate').getTime();
                    var c = 24 * 60 * 60 * 1000;
                    diffDays = Math.round(Math.abs((a - b) / (c)));
                    $("#totaldays").val(diffDays);
                    keepPrice = basePrice * diffDays;
                    document.getElementById("myInput").value = keepPrice;

                    //check to prevent a user from entering a date below date of dt1
                }
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

    <form id="Booking" action="booking_action.php" method="POST">
        <div class="container pt-3 bg grey">
            <h1>Booking</h1>
            <p>Please fill the infomation.</p>
            <hr>
            <!--for choose branch -->
            <div class="container">
                <div class="form-group">
                    <!-- <label for="Branch">
                        <h4><b>Branch</b></h4>
                    </label>
                    
                        <select name="Branch" class="form-control form-control-lg" require>
                            <option value="">Select Branch</option>
                            
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['branchID'] . '">' . $row['title'] . '</option>';
                                }
                            } else {
                                echo '<option value="">Branch is not available</option>';
                            }
                            ?>
                        </select> -->
                    <label for="Room_Type">
                        <h4><b>Room Type</b></h4>
                    </label>
                    <select name="Room_Type" id="room_type" class="form-control form-control-lg" required>
                        <option value="">Select Room Type</option>
                        <?php
                        if ($result_2->num_rows > 0) {
                            while ($row = $result_2->fetch_assoc()) {
                                echo '<option value="' . $row['roomType'] . '">' . $row['roomType'] . '</option>';
                            }
                        } else {
                            echo '<option value="">Room type are empty</option>';
                        }
                        ?>
                    </select>
                </div>

                <!--  <div class="form-group">
                        <div class="mb-3">
                            <label for="price">
                                <h4><b>Price</b></h4>
                            </label>
                            <p><input type="text" name="price" readonly="readonly" placeholder="Enter price" class="form-control form-control-lg " required></p>
                        </div>
                    </div> -->

                <h4><b>Guest Name</b></h4>
                <div class="form-row">
                    <div class="col-7 col-sm-3">
                        <label for="firstName"><b>First Name</b></lable>
                            <p><input type="text" name="firstName" placeholder="Enter First name" class="form-control form-control-lg mb-2" required></p>
                    </div>
                    <div class="col-6 col-sm-3">
                        <label for="lastName"><b>Last Name</b></lable>
                            <p><input type="text" name="lastName" placeholder="Enter Last name" class="form-control form-control-lg" required></p>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-3">
                        <label for="From">
                            <h4><b>Arrive</b></h4>
                            </lable>
                            <input type="text" name="From" placeholder="YYYY-MM-DD" id="dt1" class="form-control form-control-lg" required>
                    </div>
                    <div class="col-md-3">
                        <label for="From">
                            <h4><b>Depart</b></h4>
                            </lable>

                            <input type="text" name="To" placeholder="YYYY-MM-DD" id="dt2" class="form-control form-control-lg" required>
                    </div>

                    <div class="col-md-3">
                        <label for="From">
                            <h4><b>Total Days</b></h4>
                            </lable>
                            <input type="text" name="totalDate" placeholder="total date" id="totaldays" class="form-control form-control-lg" readonly>
                    </div>

                </div>

            </div>

            <div class="container">
                <h4><b>Payment Section</b></h4>
                <i class="fa fa-cc-visa" style="color:navy;  font-size:50px"></i>
                <i class="fa fa-cc-amex" style="color:blue; font-size:50px"></i>
                <i class="fa fa-cc-mastercard" style="color:red; font-size:50px"></i>
                <i class="fa fa-cc-discover" style="color:orange; font-size:50px"></i>
                <div class="form-group">
                    <label for="perNight"><b>Room Price Per Night</b></label>
                    <input type="number" class="form-control form-control-lg" name='perNight' id="pricePerNight" placeholder="Price per night" readonly>
                </div>
                <div class="form-group">
                    <label for="calPrice"><b>Total Price</b></label>
                    <input type="number" class="form-control form-control-lg" name='calPrice' id="myInput" placeholder="Total Price" readonly>
                </div>
                <div class="form-group">
                    <label for="seeAnotherField"><b>Select your payment method?</b></label>
                    <select class="form-control form-control-lg" name="payment_method" id="seeAnotherField">
                        <option value="cash">Cash</option>
                        <option value="creditCard">Credit Card</option>
                    </select>
                </div>

                <div class="form-group" id="otherFieldDiv">
                    <label for="cardNumber"><b>Card Number</b></label>
                    <input type=text name="cardNumber" id="otherField" placeholder="Card Number" class="form-control form-control-lg" required>
                </div>

            </div>


            <div class="container">
                <h4><b>Comment Section</b></h4>
                <!-- <label for="rating"><b>Rating</b></label>
                    <select name="rating" class="form-control form-control-lg">
                        <option value=1>1</option>
                        <option value=2>2</option>
                        <option value=3>3</option>
                        <option value=4>4</option>
                        <option value=5>5</option>
                    </select> -->
                <label for="additional"><b>Additional Note</b></label>
                <input type="text" name="additional" placeholder="Type your comment" class="form-control form-control-lg"> </textarea>
            </div>

            <div class="clearfix">
                <button type="submit" value="ignore" formaction="index.php" class="cancelbtn" formnovalidate>Cancel</button>
                <button type="submit" name="submit" class="signupbtn">Confirm</button>
            </div>
    </form>


</body>

</html>