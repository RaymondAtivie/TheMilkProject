<style>
    a:hover{
        text-decoration: none;
    }

</style>
<div class="container-fluid">  

    <div class="row-fluid">
        <div class="span9">

            <div class="hero-unit">
                <h1>The Milk Project <small>beta</small></h1>
                <p>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
                <!--<p><a class="btn btn-primary btn-large">Learn more</a></p>-->

            </div>

            <div class="page-header">
                <h2>Latest <small>New deals</small></h2>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <ul class="thumbnails">
                        <?php foreach ($lProducts as $product) { ?>
                            <li class="span3 pagination-centered" style="margin-left: 15px">
                                <div class="thumbnail">
                                    <a href="<?php echo base_url('product/' . $product->id) ?>">
                                        <img src="http://placehold.it/300x200" alt="300x200" style="width: 300px; height: 200px;" >
                                    </a>
                                    <div class="caption">
                                        <h4><?php echo $product->name ?></h4>
                                        <!--<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam...</p>-->
                                        <p>
                                            Price: <?php echo price_tag($product->price) ?>
                                            <br />
                                            <b>Highest Bid: <?php echo price_tag($product->highest_bid) ?></b>
                                        </p>
                                        <p><a class="disabled btn btn-primary countdownTimer" yr="2013" m="11" d="12" h="14" min="11" s="11">3D 23:12:45</a></p>
                                        <p><a href="product" class="btn btn-success">BID</a></p>
                                    </div>
                                </div>
                            </li>
                        <?php } ?>   
                    </ul>
                </div>
            </div>  


            <?php foreach ($categoryProducts as $cProducts) { ?>
                <?php if (count($cProducts) > 1) { ?>
                    <div id='cat_<?php echo $cProducts['obj']->name ?>'><br /><br /></div>
                    <div class="page-header">
                        <a  href="<?php echo base_url('category/' . $cProducts['obj']->id) ?>"><h2><?php echo $cProducts['obj']->name ?> <small><?php echo $cProducts['obj']->short_description ?></small></h2></a>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <ul class="thumbnails">
                                <?php foreach ($cProducts as $k => $p) { ?>
                                    <?php if (is_int($k)) { ?>
                                        <li class="span3 pagination-centered" style="margin-left: 15px">
                                            <div class="thumbnail" style="border: 0px!important">
                                                <a href="<?php echo base_url('product/' . $p->id) ?>">
                                                    <img data-src="holder.js/300x200" alt="300x200" style="width: 300px; height: 200px;" src="data:image/png;base64,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">
                                                </a>
                                                <div class="caption">
                                                    <h4><?php echo $p->name ?></h4>
                                                    <!--<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam...</p>-->
                                                    <p>
                                                        Price: <?php echo price_tag($p->price) ?>
                                                        <br />
                                                        <b>Highest Bid: <?php echo price_tag($p->highest_bid) ?></b>
                                                    </p>
                                                    <p><a class="disabled btn btn-primary countdownTimer" yr="2013" m="11" d="12" h="14" min="11" s="11">3D 23:12:45</a></p>
                                                    <p><a href="product" class="btn btn-success">BID</a></p>
                                                </div>
                                            </div
                                        </li>
                                    <?php
                                    }
                                }
                                ?>   
                            </ul>
                        </div>
                    </div>            
                <?php
                }
            }
            ?> 


        </div>
        <div class="span3">

            <div class="row-fluid">
                <div class="span12">
                    <div id="myCarousel" data-interval="3000" class="carousel slide" style="width: 300px">
                        <ol class="carousel-indicators">                        
                            <?php for ($i = 0; $i < 5; $i++) { ?>
                                <li data-target="#myCarousel" data-slide-to="<?php echo $i ?>" class="<?php echo ($i == 0) ? "active" : "" ?>"></li>
                            <?php } ?>
                        </ol>
                        <div class="carousel-inner">
                            <?php for ($i = 0; $i < 5; $i++) { ?>
                                <div class="item <?php echo ($i == 0) ? "active" : "" ?>">
                                    <img src="http://placehold.it/300x260" alt="">
                                    <div class="carousel-caption" style="opacity: 0.3">
                                        <h4><?php echo $i ?> Thumbnail label</h4>
                                        <p>Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                    </div>
                                </div>
<?php } ?>
                        </div>
                        <a class="left" href="#myCarousel" data-slide="prev"><i style="font-size: 22px" class="icon-chevron-sign-left"></i></a>
                        <a class="right" href="#myCarousel" data-slide="next"><i style="font-size: 22px" class="icon-chevron-sign-right"></i></a>
                        <!--<a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>-->
                    </div>
                </div>
                <div class="span12" data-spy="affix" data-offset-top="320">
                    <div class="page-header">
                        <h2>Category <small>header</small></h2>                        
                    </div>
                    <div id="navbar">
                        <ul class="nav nav-pills nav-stacked">
                            <?php foreach ($categories as $category) { ?>
                                <li><a href='#cat_<?php echo $category->name ?>'><?php echo $category->name ?></a></li>                            
<?php } ?>
                        </ul>
                    </div>
                </div>

            </div>



        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
       $(".carousel").carousel(); 
    });
</script>