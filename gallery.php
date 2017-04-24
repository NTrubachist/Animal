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
    <title>Gallery</title>

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
        <?php $blocks->insertNavBar(); ?>
    </div>
</div>
<div class="container">
    <div class="row main">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 name">
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
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 footer">
            <center><p>Animals 2017</p></center>
        </div>
    </div>
</div>
</body>
</html>