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
                                    <li class="active"><a href="index.php" class="">Home</a></li>
                                    <li class=" dropdown"><a href="animal.php" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Animal <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Home</a></li>
                                            <li><a href="#">Wild</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="gallery.php">Gallery</a></li>
                                    <li><a href="contacts.php">Contacts</a></li>
                                </ul>
                                <ul class="nav navbar-nav navbar-right">
                                    <li class=""><a href="#" data-toggle="modal" data-target="#login-modal">Sign in</a></li>
                                    <li class=""><a href="#" data-toggle="modal" data-target="#register-modal">Register</a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>
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
            <div class="col-lg-3 col-md-2 col-sm-12 col-xs-12 leftside">
            </div>
            <div class="col-lg-9 col-md-10 col-sm-12 col-xs-12 main">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 name">
                        <center><h1>Animals</h1></center>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text">
                        <br>
                        <p>The word "animal" comes from the Latin animalis, meaning having breath, having soul or living being.</p>
                        <p>In everyday non-scientific usage the word excludes humans – that is, "animal" is often used to refer only to non-human members of the kingdom Animalia; often, only closer relatives of humans such as mammals and other vertebrates, are meant.</p>
                        <p>The biological definition of the word refers to all members of the kingdom Animalia, encompassing creatures as diverse as sponges, jellyfish, insects, and humans.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
