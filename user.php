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
</head>
<body>
<div class="container-fluid">
    <div class="row">
        //Navbar
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
                                <li><a href="Animal.php" class="">Animal</a></li>
                                <li><a href="gallery.php">Gallery</a></li>
                                <li ><a href="contacts.php" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Contacts <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="contacts.php">Contacts</a></li>
                                        <li><a href="#" data-toggle="modal" data-target="#contact-modal">Contact us</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li ><a href="user.php" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class=" glyphicon glyphicon-user"></span> nickname <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="user.php">Profil</a></li>
                                        <li><a href="#">Log out</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                /*change photo*/
                <div class="modal fade" id="changeph-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
                    <div class="modal-dialog">
                        <div class="changephmodal-container">
                            <center><h1>Change photo</h1><br></center>
                            <form>
                                <input type="file" name="photo" placeholder="change photo">
                                <input type="submit" name="message" class="photo changephmodal-submit" value="Save">
                            </form>
                        </div>
                    </div>
                </div>
                /*add article*/
                <div class="modal fade" id="addart-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
                    <div class="modal-dialog">
                        <div class="addartmodal-container">
                            <center><h1>Add article</h1><br></center>
                            <form>
                                <input type="file" name="article" placeholder="add article">
                                <input type="submit" name="message" class="addartmodal-submit" value="Save">
                            </form>
                        </div>
                    </div>
                </div>
                /*change password*/
                <div class="modal fade" id="changeps-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
                    <div class="modal-dialog">
                        <div class="changepsmodal-container">
                            <center><h1>Change password</h1><br></center>
                            <form>
                                <h4>New password</h4>
                                <input type="password" name="password" placeholder="new password">
                                <input type="submit" name="message" class="password changepsmodal-submit" value="Save">
                            </form>
                        </div>
                    </div>
                </div>
                /*change e-mail*/
                <div class="modal fade" id="changeem-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
                    <div class="modal-dialog">
                        <div class="changeemmodal-container">
                            <center><h1>Change e-mail</h1><br></center>
                            <form>
                                <h4>Current e-mail</h4>
                                <h4>New e-mail</h4>
                                <input type="email" name="email" placeholder="e-mail">
                                <input type="submit" name="message" class="email changeemmodal-submit" value="Save">
                            </form>
                        </div>
                    </div>
                </div>
                /*Contac us*/
                <div class="modal fade" id="contact-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
                    <div class="modal-dialog">
                        <div class="contactmodal-container">
                            <center><h1>Contact us</h1><br></center>
                            <form>
                                <h4>Name</h4>
                                <input type="text" name="name" placeholder="name">
                                <h4>Your E-mail</h4>
                                <input type="email" name="email" placeholder="e-mail">
                                <h4>Your Message</h4>
                                <input type="text" name="message" placeholder="Please enter your message here..." rows="5">
                                <input type="submit" name="message" class="contact contactmodal-submit" value="Send">

                            </form>
                        </div>
                    </div>
                </div>
                //Sign in form
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
    <div class="row">
        <div class="col-lg-3 col-md-2 col-sm-12 col-xs-12 reclame">
        </div>
        <div class="col-lg-9 col-md-10 col-sm-12 col-xs-12 main">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 name">
                    <center><h1>Profil</h1></center>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 inp">
                            <center>
                            <p>User photo</p>
                            <img src="gallery/home/home1.jpg" class="img-responsive"></center>
                        </div>
                        <div class="col-lg-9 col-md-8 col-sm-6 col-xs-12 inp">
                            <center>
                                <br>
                                <p>Nickname</p>
                                <p>e-mail</p>
                                <p>last visit time</p>
                            </center>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 inp">
                            <center>
                                <p>Add article</p>
                                <button type="button" class="btn btn-primary btn-md"  data-toggle="modal" data-target="#addart-modal">Add Article</button>
                            </center>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 inp">
                            <center>
                                <p>Change photo</p>
                                <button type="button" class="btn btn-primary btn-md"  data-toggle="modal" data-target="#changeph-modal">Change photo</button>
                                <p>Change password</p>
                                <button type="button" class="btn btn-primary btn-md"  data-toggle="modal" data-target="#changeps-modal">Change password</button>
                            </center>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 inp">
                            <center>
                                <p>Change e-mail</p>
                                <button type="button" class="btn btn-primary btn-md"  data-toggle="modal" data-target="#changeem-modal">Change e-mail</button>
                            </center>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</body>
</html>