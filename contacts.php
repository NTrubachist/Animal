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
    <title>Contacts</title>
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
        <?php $blocks->insertNavBar(); ?>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-2 col-sm-12 col-xs-12 reclame">
        </div>
        <div class="col-lg-9 col-md-10 col-sm-12 col-xs-12 main">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 name">
                    <center><h1>Contacts</h1></center>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text con">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                       <center><img src="gallery/nikolajs.jpg" align="middle"></center>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                        <center>
                        <br>
                        <p>Nikolajs Trubačistovs - Prokjektu vadītājs</p>
                        <p><span class="glyphicon glyphicon-envelope"><a href="mailto:n.trubachist@gmail.com"> n.trubachist@gmail.com</a></span></p>
                        <p><span class="glyphicon glyphicon-phone"><a href="tel:+371-222-345-22">  22234522</a></span></p></center>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text con">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                        <center><img src="gallery/natalija.jpg" align="middle"></center>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                        <center>
                            <br>
                            <p>Natalija Jansone - Dizaineris/Jaunākais programmētājs</p>
                            <p><span class="glyphicon glyphicon-envelope"><a href="mailto:n.jansone@gmail.com"> n.jansone@gmail.com</a></span></p>
                            <p><span class="glyphicon glyphicon-phone"> <a href="tel:+371-222-345-89">  22234589</a></span></p></center>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text con">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                        <center><img src="gallery/vladislavs.jpg" align="middle"></center>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                        <center>
                            <br>
                            <p>Vladislavs Gordejevs - Vecākais/Jaunākais programmētājs</p>
                            <p><span class="glyphicon glyphicon-envelope"><a href="mailto:v.gordejevs@gmail.com"> v.gordejevs@gmail.com</a></span></p>
                            <p><span class="glyphicon glyphicon-phone"><a href="tel:+371-243-345-22">  24334522</a></span></p></center>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text but">
                    <center>
                        <a href="https://www.facebook.com/AnimalAdventurePark/?fref=ts"><button type="button" class="btn btn-fb"><i class="fa fa-facebook left"></i> Facebook</button></a>
                        <a href="https://www.instagram.com/natalija_jansone/"><button type="button"  class="btn btn-ins"><i class="fa fa-instagram left"></i> Instagram</button></a>
                        <a href="https://github.com/NTrubachist/Animal"><button type="button"  class="btn btn-git"><i class="fa fa-github left"></i> Github</button></a>
                    </center>
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