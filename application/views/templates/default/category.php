<style>
    a:hover{
        text-decoration: none;
    }
</style>
<div class="container-fluid">  

    <div class="row">
        <div class="span12">

            <div class="hero-unit" style="padding: 0px">
                <div class="row-fluid">
                    <div class="span4" style="padding: 20px; padding-top: 15px">
                        <h1><?php echo $category->name ?></h1>
                        <p><br /> </p>
                        <p style="font-size: smaller"><?php echo $category->description ?>jbsndjfn dfins ifbsidnf idusfyudsfbhsebf sjd fhuhsjbdhbf shfbdsj fsdhfb sjdfljhdsbfh dbfjlds bfhdsfjbfj bhbj jhglbughbfuy bhj</p>
                    </div>
                    <div class="span8">
                        <img src="http://placehold.it/1020x330" />
                        <!--<p><a class="btn btn-primary btn-large">Learn more</a></p>-->
                    </div>
                </div>
                
            </div>

            <div class="row-fluid">
                <div class="span12">
                    <ul class="thumbnails">
                        <?php foreach($products as $product) { ?>
                            <li class="span3 pagination-centered" style="margin-left: 15px">
                                <div class="thumbnail">
                                    <a href="<?php echo base_url('product/'.$product->id) ?>">
                                        <img data-src="http://placehold.it/300x200" alt="300x200" style="width: 300px; height: 200px;" >
                                    </a>
                                    <div style="padding-top: 0px;" class="caption">
                                        <h3 style="padding-top: 0px; margin-top: 0px"><?php echo $product->name ?></h3>
                                        <!--<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam...</p>-->
                                        <p>Price: <?php echo price_tag($product->price) ?></p>
                                        <p><b>Highest Bid: N4000</b></p>
                                        <p><a class="disabled btn btn-primary countdownTimer" yr="2013" m="11" d="12" h="14" min="11" s="11">3D 23:12:45</a></p>
                                        <p><a href="product" class="btn btn-success">BID</a></p>
                                    </div>
                                </div
                            </li>
                        <?php } ?>   
                    </ul>
                </div>
            </div>     

        </div>
    </div>
</div>

