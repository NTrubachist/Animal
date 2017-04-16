<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href = "./libs/bootstrap/css/bootstrap.css" rel ="stylesheet">
    <script src="./libs/jQuery/jquery2.1.4.min.js"></script>
    <script src="./libs/bootstrap/js/bootstrap.js"> </script>
    <link href="./css/style.css" rel="stylesheet">
    <title>Home</title>
    
    <script>
        $(function(){
            $('.button-checkbox').each(function(){
                var $widget = $(this),
                    $button = $widget.find('button'),
                    $checkbox = $widget.find('input:checkbox'),
                    color = $button.data('color'),
                    settings = {
                        on: {
                            icon: 'glyphicon glyphicon-check'
                        },
                        off: {
                            icon: 'glyphicon glyphicon-unchecked'
                        }
                    };

                $button.on('click', function () {
                    $checkbox.prop('checked', !$checkbox.is(':checked'));
                    $checkbox.triggerHandler('change');
                    updateDisplay();
                });

                $checkbox.on('change', function () {
                    updateDisplay();
                });

                function updateDisplay() {
                    var isChecked = $checkbox.is(':checked');
                    // Set the button's state
                    $button.data('state', (isChecked) ? "on" : "off");

                    // Set the button's icon
                    $button.find('.state-icon')
                        .removeClass()
                        .addClass('state-icon ' + settings[$button.data('state')].icon);

                    // Update the button's color
                    if (isChecked) {
                        $button
                            .removeClass('btn-default')
                            .addClass('btn-' + color + ' active');
                    } else {
                        $button
                            .removeClass('btn-' + color + ' active')
                            .addClass('btn-default');
                    }
                }
                function init() {
                    updateDisplay();
                    // Inject the icon if applicable
                    if ($button.find('.state-icon').length == 0) {
                        $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
                    }
                }
                init();});
        });
    </script>
    <script>
        $(document).ready(function(){

            $(".filter-button").click(function(){
                var value = $(this).attr('data-filter');

                if(value == "all")
                {
                    $('.filter').show('1000');
                }
                else
                {
                    $(".filter").not('.'+value).hide('3000');
                    $('.filter').filter('.'+value).show('3000');

                }
            });

        });
    </script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="navbar-wrapper">
            <div class="container-fluid">
                <nav class="navbar navbar-fixed-top">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="index.php">Animal</a>
                        </div>
                        <div id="navbar" class="navbar-collapse collapse">
                            <ul class="nav navbar-nav">
                                <li><a href="index.php" class="">Home</a></li>
                                <li class=" dropdown"><a href="animal.php" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Animal <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Home</a></li>
                                        <li><a href="#">Wild</a></li>
                                    </ul>
                                </li>
                                <li class="active"><a href="gallery.php">Gallery</a></li>
                                <li><a href="contacts.php">Contacts</a></li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li class=""><a href="#" data-toggle="modal" data-target="#login-modal">Sign in</a></li>
                                <li class=""><a href="#" data-toggle="modal" data-target="#register-modal">Register</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
                    <div class="modal-dialog">
                        <div class="loginmodal-container">
                            <h1>Sign in to Your Account</h1><br>
                            <form>
                                <h4>Username or e-mail</h4>
                                <input type="text" name="user" placeholder="username or e-mail">
                                <h4>Password</h4>
                                <input type="password" name="pass" placeholder="password">
                                <input type="submit" name="login" class="login loginmodal-submit" value="Sign in">
                            </form>
                            <div class="login-help">
                                <a href="#">Register</a> - <a href="#">Forgot Password</a>
                            </div>
                        </div>
                    </div>
                </div>
                //Register
                <div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
                    <div class="modal-dialog">
                        <div class="registermodal-container">
                            <h1>Create a new Account</h1><br>
                            <form>
                                <h4>*Name</h4>
                                <input type="text" name="name" placeholder="name">
                                <h4>*Surname</h4>
                                <input type="text" name="surname" placeholder="surname">
                                <h4>*Username</h4>
                                <input type="text" name="user" placeholder="username">
                                <h4>*E-mail</h4>
                                <input type="email" name="email" placeholder="e-mail">
                                <h4>*Password</h4>
                                <input type="password" name="pass" placeholder="password">
                                <input type="submit" name="register" class="register registermodal-submit" value="Register">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row main">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nameg">
            <center><h1>Gallery</h1></center>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text">
        <div align="center">
            <button class="btn btn-default filter-button" data-filter="all">All</button>
            <button class="btn btn-default filter-button" data-filter="wild">Wild</button>
            <button class="btn btn-default filter-button" data-filter="home">Home </button>
            <button class="btn btn-default filter-button" data-filter="funny">Funny</button>
            <button class="btn btn-default filter-button" data-filter="africa">Africa</button>
            <button class="btn btn-default filter-button" data-filter="forest">Forest</button>
        </div>
        <br/>


            <div class="gallery_product col-lg-4 col-md-4 col-sm-6 col-xs-6 filter wild forest">
                <img src="gallery/wild/wild6.jpg" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-6 col-xs-6 filter wild forest funny">
                <img src="gallery/wild/wild7.jpg" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-6 col-xs-6 filter funny">
                <img src="gallery/funny/funny2.jpg" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-6 col-xs-6 filter funny">
                <img src="gallery/funny/funny3.jpg" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-6 col-xs-6 filter funny">
                <img src="gallery/funny/funny4.jpg" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-6 col-xs-6 filter home">
                <img src="gallery/home/home1.jpg" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-6 col-xs-6 filter home">
                <img src="gallery/home/home2.jpg" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-6 col-xs-6 filter home">
                <img src="gallery/home/home3.jpg" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-6 col-xs-6 filter home">
                <img src="gallery/home/home4.jpg" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-6 col-xs-6 filter wild africa">
                <img src="gallery/wild/wild1.jpg" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-6 col-xs-6 filter wild africa">
                <img src="gallery/wild/wild2.jpg" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-6 col-xs-6 filter funny">
                <img src="gallery/funny/funny1.jpg" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-6 col-xs-6 filter wild africa">
                <img src="gallery/wild/wild3.jpg" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-6 col-xs-6 filter wild forest">
                <img src="gallery/wild/wild4.jpg" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-6 col-xs-6 filter wild africa">
                <img src="gallery/wild/wild5.jpg" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-6 col-xs-6 filter home">
                <img src="gallery/home/home5.jpg" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-6 col-xs-6 filter wild">
                <img src="gallery/wild/wild8.jpg" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-6 col-xs-6 filter wild africa">
                <img src="gallery/wild/wild9.jpg" class="img-responsive">
            </div>




        </div>
    </div>
</div>
</body>
</html>