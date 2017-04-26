<?php
	session_start();
	include("php/class_Blocks.php");
	
	$blocks = new Blocks();
?>

<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href = "./libs/bootstrap/css/bootstrap.css" rel ="stylesheet">
    <script src="./libs/jQuery/jquery2.1.4.min.js"></script>
    <script src="./libs/bootstrap/js/bootstrap.js"> </script>
    <link href="./css/style.css" rel="stylesheet">
    <title>Articles</title>
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
    <div class="row"><br>
        <?php $blocks->insertNavBar(); ?>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-2 col-sm-12 col-xs-12 leftside">
            <div class="left-navigation">
                <?php $blocks->insertPostList(); ?>
            </div>
        </div>
        <div class="col-lg-9 col-md-10 col-sm-12 col-xs-12 main">
            <div class="row">
                <?php $blocks->insertPost($_GET['postid']); ?>
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
                                    <?php $blocks->insertComments($_GET['postid']); ?>
                                </ul>
                            </div>
                            <div class="tab-pane" id="add-comment">
                                <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" class="form-horizontal" id="commentForm" role="form">
                                    <div class="form-group">
                                        <label for="email" class="col-sm-2 control-label">Comment</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="commentText" id="addComment" rows="5"></textarea>
                                        </div>
                                    </div>
									<input type="hidden" name="commentpostid" value="<?php echo $_GET['postid']; ?>">
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button class="btn btn-success text-uppercase" type="submit" name="submitComment"><span class="glyphicon glyphicon-ok"></span> Summit comment</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
						<br><br><br>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 footer">
            <center><p>Animals 2017</p></center>
        </div>
    </div>
</div>
</body>
</html>
