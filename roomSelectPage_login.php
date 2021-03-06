<!Doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="roomSelectPage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!--This is my kit font awesome pls remind me-------------------------------------------->
    <script src="https://kit.fontawesome.com/92d742c429.js" crossorigin="anonymous"></script>
    <!--------------------------------------------------------------------------------------->
    <script>
        $('.carousel').carousel({
            interval: 3000
        })
    </script>
</head>

<body>

    <div>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <a href="index.php" class="navbar-brand"><img src="Logo/Calina_Logo-tiny.png" alt="logo"></a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav">
                    <a href="index.php" class="nav-item nav-link active"><i class="fa fa-home"></i> Home</a>
                    <a href="roomSelectPage_login.php" class="nav-item nav-link"><i class="fa fa-bed"></i> Room Reservation</a>
                    <a href="#" class="nav-item nav-link"><i class="fa fa-cutlery"></i> Food Service</a>
                    <a href="#" class="nav-item nav-link" tabindex="-1"><i class="fa fa-car"></i> Other Service</a>
                </div>
                <div class="navbar-nav ml-auto">
                    <?php
                    if (!isset($_SESSION['email'])) {
                        echo '<div class="dropdown-menu dropdown-menu-right p-3">
                            <form class="form-horizontal" method="POST" accept-charset="UTF-8" action="login_action.php">
                                <input class="form-control login" type="text" name="email" placeholder="Email" id="email">
                                <input class="form-control login" type="password" name="password" placeholder="Password" id="pass">
                                <input class="btn btn-primary" type="submit" name="submit" value="Login">
                            </form>
                        </div>
                        <a href="register.php" class="nav-item nav-link"> <i class="fas fa-user-plus"> </i> Sign up</a>';
                    } else {
                        echo '
                        <a class="nav-link" > <i class="fas fa-user-alt"></i> <?php echo $email ?></a>
                        <form class="form-inline my-2 my-lg-0" action="logout.php" method="POST">
                        <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">Logout</button>
                        </form>';
                    }
                    ?>

                </div>
            </div>
        </nav>
    </div>

    <div class="bd-example">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item drk active">
                    <img class=" img-fluid" src="./picHotelRoom/black1.jpg" alt="First slide">
                    <div class="carousel-caption d-block">
                        <p>CALINA HOTEL</p>
                    </div>
                </div>
                <div class="carousel-item drk">
                    <img class="img-fluid" src="./picHotelRoom/beach2_5.jpg" alt="Second slide">
                    <div class="carousel-caption d-block">
                        <p>CALINA HOTEL</p>
                    </div>
                </div>
                <div class="carousel-item drk">
                    <img class="img-fluid" href="http://google.com" src="./picHotelRoom/hotel2_5.jpg" alt="Third slide">
                    <div class="carousel-caption d-block">
                        <p>CALINA HOTEL</p>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="colorPlate">
        <div class="about">
            <div>
                <div class="container">
                    <div class="w3ls-heading">
                        <h4> ROOM & VILLAS</h4>
                    </div>
                    <p>With warm hues and a slight pop of color, the villas at Crimson Mactan Resort and Spa is bound to make you a striking first impression.<br>Imagine taking a nap on a plush four-poster canopy bed with interiors immersed in local architecture at the best Beach resort in Mactan,<br> Cebu. Each of our spacious villas and luxurious casitas features polished teak floors, locally-sourced Cebuano décor and beautiful domed ceilings made of woven Banig. Feel at home in an expansive living area that leads to mesmerizing views of the pristine Mactan sea from your own private plunge pool. Drained from the day’s activities? Relax and unwind in the sunk-in tub within the most elegant bathroom.</p>
                </div>
                <div class="container">
                    <form name="selectbranch" method="POST" action="login_check.php">
                        <div class="form-group">
                            <select class="form-control form-control-lg" name="Branch" id="branch" required>
                                <option value="">Select Branch</option>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row['branchID'] . '">' . $row['title'] . '</option>';
                                    }
                                } else {
                                    echo '<option value="">Branch is not available</option>';
                                }
                                ?>
                            </select>
                    </form>
                </div>

            </div>
        </div>
        <form name="selectbranch" method="POST" action="login_check.php">
            <button type="submit" class="btn btn-secondary btn-lg" style="margin-left: 47%;" name="submit" value="Explore">Select</button>
        </form>
    </div>
    </div>

    <div class="about_2">
        <div class=grid>
            <figure class="effect-apollo">
                <a class="example-image-link" href="type3_login.php" data-lightbox="example-set">
                    <img src="./picHotelRoom/beach1.jpg" class=" img-fluid">
                    <figcaption>
                        <h2>Suit</h2>
                        <p>One of our finest room</p>
                    </figcaption>
                </a>
            </figure>
        </div>
    </div>

    <div class="about_3">
        <div class="row">
            <div class="col">
                <div class=grid>
                    <figure class="effect-apollo">
                        <a class="example-image-link" href="type1_login.php">
                            <img src="./picHotelRoom/deluxe.jpg" class=" float-left img-fluid">
                            <figcaption>
                                <h2>DELUXE</h2>
                                <p>Your family will feel the truthly confortable</p>
                            </figcaption>
                        </a>
                    </figure>
                </div>
            </div>
            <div class="col">
                <div class=grid>
                    <figure class="effect-apollo">
                        <a class="example-image-link" href="type2_login.php">
                            <img src="./picHotelRoom/private.jpg" class="float-right img-fluid">
                            <figcaption>
                                <h2>Elite</h2>
                                <p>Spectacular will for this room</p>
                            </figcaption>
                        </a>
                    </figure>
                </div>
            </div>
        </div>
    </div>

    <div>
        <footer class="page-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <h6 class="text-uppercase font-weight-bold">Additional Information</h6>
                        <P>This website is for Tab Hotel<br> Thank you for using our page</P>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <h6 class="text-uppercase font-weight-bold">Contact</h6>
                        <p>1640 Riverside Drive, Hill Valley, California
                            <br>book21424@gmail.com
                            <br>+ 01 234 567 88
                            <br>+ 01 234 567 89</p>
                    </div>
                </div>
                <div class="footer-copyright text-uppercase font-weight-bold  text-center">king mongkut's university of technology thonburi </div>
            </div>
        </footer>
    </div>
</body>




</html>