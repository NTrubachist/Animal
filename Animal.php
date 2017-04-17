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
                                <li ><a href="index.php" class="">Home</a></li>
                                <li class="active"><a href="Animal.php" class="">Animal</a></li>
                                <li><a href="gallery.php">Gallery</a></li>
                                <li ><a href="contacts.php" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Contacts <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="contacts.php">Contacts</a></li>
                                        <li><a href="#" data-toggle="modal" data-target="#contact-modal">Contact us</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li class=""><a href="#" data-toggle="modal" data-target="#login-modal">Sign in</a></li>
                                <li class=""><a href="#" data-toggle="modal" data-target="#register-modal">Register</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
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
        <div class="col-lg-3 col-md-2 col-sm-12 col-xs-12 leftside">
            <div class="left-navigation">
                <ul class="list">
                    <h4><strong>Wild</strong></h4>
                    <li>Lion</li>
                    <li>Tiger</li>
                    <li>Wolf</li>
                    <li>Bear</li>
                    <li>Shark</li>
                </ul>

                <br>

                <ul class="list">
                    <h4><strong>Home</strong></h4>
                    <li>Dog</li>
                    <li>Cat</li>
                    <li>Bunny</li>
                    <li>Mouse</li>
                    <li>Bird</li>
                </ul>
            </div>
        </div>
        <div class="col-lg-9 col-md-10 col-sm-12 col-xs-12 main">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 name">
                    <center><h1>Articles</h1></center>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text">

                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 comments">
                    <div class="comment-tabs">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="active"><a href="#comments-logout" role="tab" data-toggle="tab"><h4 class="reviews text-capitalize">Comments</h4></a></li>
                            <li><a href="#add-comment" role="tab" data-toggle="tab"><h4 class="reviews text-capitalize">Add comment</h4></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="comments-logout">
                                <ul class="media-list">

                                    <li class="media">
                                        <a class="pull-left" href="#">
                                            <img class="media-object img-circle" src="https://s3.amazonaws.com/uifaces/faces/twitter/lady_katherine/128.jpg" alt="profile">
                                        </a>
                                        <div class="media-body">
                                            <div class="well well-lg">
                                                <h4 class="media-heading text-uppercase reviews">Kriztine</h4>
                                                <ul class="media-date text-uppercase reviews list-inline">
                                                    <li class="dd">22</li>
                                                    <li class="mm">09</li>
                                                    <li class="aaaa">2014</li>
                                                </ul>
                                                <p class="media-comment">
                                                    Yehhhh... Thanks for sharing.
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-pane" id="add-comment">
                                <form action="#" method="post" class="form-horizontal" id="commentForm" role="form">
                                    <div class="form-group">
                                        <label for="email" class="col-sm-2 control-label">Comment</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="addComment" id="addComment" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button class="btn btn-success btn-circle text-uppercase" type="submit" id="submitComment"><span class="glyphicon glyphicon-send"></span> Summit comment</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</body>
</html>