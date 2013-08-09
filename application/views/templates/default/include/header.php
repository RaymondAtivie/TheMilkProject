<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">

        <title>The Milk Project</title>


        <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/bootstrap-responsive.min.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/font-awesome.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/custom.css') ?>" rel="stylesheet">        
        <link href="<?php echo base_url('assets/css/animate-custom.css') ?>" rel="stylesheet">      
        <link href="<?php echo base_url('assets/css/datatables.css') ?>" rel="stylesheet">        

        <script src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/timeago.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/datatables.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/custom.js') ?>"></script>



        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="../assets/js/html5shiv.js"></script>
        <![endif]-->

        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url('assets/ico/apple-touch-icon-144-precomposed.png') ?>">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url('assets/ico/apple-touch-icon-114-precomposed.png') ?>">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url('assets/ico/apple-touch-icon-72-precomposed.png') ?>">
        <link rel="apple-touch-icon-precomposed" href="<?php echo base_url('assets/ico/apple-touch-icon-57-precomposed.png') ?>">
        <link rel="shortcut icon" href="../assets/ico/favicon.png">


        <style type="text/css">

            /* Sticky footer styles
            -------------------------------------------------- */

            html,
            body {
                height: 100%;
                /* The html and body elements cannot have any padding or margin. */                  

                /*                background-color: #e4ffc2;
                                background-image: url(<?php echo base_url('assets/img/back_2.png'); ?>);
                                background-repeat: repeat;
                                background-position: top left;
                                background-attachment: scroll;*/
            }

            /* Wrapper for page content to push down footer */
            #wrap {
                min-height: 100%;
                height: auto !important;
                height: 100%;
                /* Negative indent footer by it's height */
                margin: 0 auto -60px;           
            }

            /* Set the fixed height of the footer here */
            #push,
            #footer {
                height: 60px;
            }
            #footer {
                background-color: #f5f5f5;
            }

            /* Lastly, apply responsive CSS fixes as necessary */
            @media (max-width: 767px) {
                #footer {
                    margin-left: -20px;
                    margin-right: -20px;
                    padding-left: 20px;
                    padding-right: 20px;
                }
            }



            /* Custom page CSS
            -------------------------------------------------- */
            /* Not required for template or sticky footer method. */

            #wrap > .container {
                margin-top: 50px;
                margin-bottom: 60px;
                /*                background-color: white;
                                box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
                                -o-box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
                                -moz-box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
                                -webkit-box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);*/
            }
            .container .credit {
                margin: 20px 0;
            }
            code {
                font-size: 80%;
            }
            form textarea{
                resize: none;
            }
        </style>
    </head>
    <body>


        <!-- Part 1: Wrap all page content here -->
        <div id="wrap">

            <!-- Fixed navbar -->
            <div class="navbar navbar-fixed-top navbar-inverse">
                <div class="navbar-inner">
                    <div class="container">
                        <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="brand" href="<?php echo base_url(); ?>">The Milk Project</a>


                        <div class="nav-collapse collapse pull-right">
                            <ul class="nav">
                                <li class="active"><a href="<?php echo base_url('home'); ?>">Home</a></li>
                                <li><a href="#about">About</a></li>
                                <li><a href="#about">Rules</a></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categories <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <?php foreach($categories as $cat){ ?>
                                        <li><a href="<?php echo base_url("category/".$cat->id) ?>"><?php echo $cat->name ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </li>

                                <?php if (isset($user_header) AND $user_header == "yes") { ?>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $user->first_name . " " . $user->last_name ?> <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#"><span class="badge badge-inverse"><?php echo $user->getUnreadNotification()?></span> Notification(s)</a></li>
                                            <li><a href="#"><i class="icon-circle credits"></i> <?php echo $user->credit ?> Credits</a></li>
                                            <li><a href="#"><i style="color: brown" class="icon-trophy"></i> 3 Trophies</a></li>
                                            <li class="divider"></li>
                                            <li class="nav-header">Settings</li>
                                            <li><a href="<?php echo base_url('user/dashboard'); ?>">Account</a></li>
                                            <li><a href="<?php echo base_url('login/logout'); ?>">Logout</a></li>
                                        </ul>
                                    </li>
                                <?php } else { ?>

                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sign In <b class="caret"></b></a>                                        
                                        <div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px">                                            

                                            <?php echo form_open('login'); ?>
                                            <input style="margin-bottom: 15px;" placeholder="Username" type="text" name="username" size="30" />
                                            <input style="margin-bottom: 15px;" placeholder="Password" type="password" name="password" size="30" />
                                            <label class="string optional">
                                                <input style="float: left; margin-right: 10px;" type="checkbox" name="remember_me" value="yes" />
                                                Remember me
                                            </label>

                                            <input class="btn btn-primary" style="clear: left; width: 100%; height: 32px; font-size: 13px;" type="submit" name="commit" value="Sign In" />
                                            </form>

                                        </div>
                                    </li>                                    
                                    <li><a href="#">Sign Up</a></li>
                                <?php } ?>
                            </ul>
                        </div><!--nav-collapse -->
                    </div>
                </div>
            </div>

            <div class="container">