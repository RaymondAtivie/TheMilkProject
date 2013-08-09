<div class="row-fluid">

    <!--PRODUCT BOX-->
    <div class="span4 pagination-centered">
        <div class="span12">
            <div class="caption">
                <h3>
                    <small><?php echo $product->category; ?></small>
                    <br />
                    <?php echo $product->name; ?>
                </h3>
            </div>
            <div class="row">
                <div class="span12">
                    <a href="#" class="thumbnail">
                        <img src="http://placehold.it/300x200" alt="300x200" style="width: 400px; height: 220px;" >
                    </a>
                </div>
            </div>

            <div class="row visible-desktop" style="margin-top: 25px">
                <ul class="thumbnails">
                    <?php for ($i = 0; $i < 4; $i++) { ?>
                        <li class="span3">
                            <a href="#" class="thumbnail">
                                <img src="http://placehold.it/300x200" alt="300x200" style="width: 300px; height: 100px;" src="">
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <!--END OF PRODUCT BOX-->


    <!--PRICE BID BOX-->
    <div class="span4 pagination-centered">
        <h1><br /></h1>
        <p><?php echo $product->description ?></p>
        <p><h2><small>Starting Prcie: <?php echo $product->price ?></small></h2></p>
        <p><h2>Highest Bid: <?php echo price_tag($product->highest_bid) ?></h2></p>
        <p><button class="btn-large btn countdownTimer" yr="2013" m="8" d="5" h="12" min="0" s="0" style="color: black">4D 12:12:32</button></p>
        <?php if (isset($bid_status)) { ?>
            <div class='alert animated alert-<?php echo $bid_status ?> alert-block'><button type='button' class='close' data-dismiss='alert'>&times;</button><?php echo $bid_msg ?></div>
        <?php } ?>
        <p><button class="btn ttp btn-success" data-html="true" id="bidButton" data-toggle="popover">PLACE A BID</button></p>
        <p>
            <button class='btn btn-link'><i class='icon-search'></i> Add to Watch list</button>
            <button class='btn btn-link'><i class='icon-plus'></i> Add to Wish list</button>
        </p>
    </div>
    <!--END OF PRICE BID BOX-->

    <!--BID HISTORY BOX-->
    <div class="span4" style="padding-left: 15px; border-left: 1px solid #D0D0D0;">
        <h3>Bid History</h3>
        <h4><?php echo count($PBH) ?> Bid(s)</h4>

        <div class="row-fluid">
            <div class="span12">

                <table class="table table-bordered table-hover">
                    <tr>
                        <th>Time</th>
                        <th>Name</th>
                        <th>Amount</th>
                    </tr>
                    <?php if ($PBH) { ?>
                        <?php foreach ($PBH as $p) { ?>
                            <tr>
                                <td><time class="timeago" title="<?php echo $p->time ?>" datetime="<?php echo $p->time ?>"><?php echo $p->time ?></time></td>
                                <td><?php echo $p->user->username ?></td>
                                <td><?php echo $p->amount ?></td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr class="error pagination-centered">
                            <td style="text-align: center" colspan="3">No one has bided for this product yet</td>                            
                        </tr>
                    <?php } ?>
                </table>

            </div>

        </div>
    </div>
    <!--END OF BID HISTORY BOX-->
</div>

<script>
    $(document).ready(function() {

<?php if ($this->session->userdata("loggedIn")) { ?>
    <?php if ($biddable) { ?>
                var content = "You cannot bid for your own product";

                $("#bidButton").popover({
                    "placement": "bottom",
                    "title": "Sorry",
                    "content": content
                });
    <?php } else { ?>
                var content = "<form action='<?php echo base_url("user/bid/" . $product->id) ?>' method='post' >\
                                                                            <input name='bid' value='<?php echo $product->highest_bid ?>' type='hidden'>\
                                                                                <div style='display: inline;' class='input-prepend'>" +
                        "<span class='add-on'>₦</span>" +
                        "<span style='color: black; width: 70px' class='uneditable-input bidTextBox' id='prependedInput' type='text'><?php echo $product->highest_bid ?></span>" +
                        "</div>" +
                        "<div class='btn-group'>" +
                        "<button type='button' id='decBid' ref='<?php echo $product->min_increment; ?>' class='btn btn-info'>-<?php echo price_tag($product->min_increment); ?></button>\
                                                                                <button type='button' id='incBid' ref='<?php echo $product->min_increment; ?>' class='btn btn-info'>+<?php echo price_tag($product->min_increment); ?></button>\
                                                                              </div>" +
                        "<span class='help-inline'>Mininum bid increment of <?php echo price_tag($product->min_increment); ?></span>" +
                        "<button style='margin-top: 15px' class='btn btn-block btn-primary'>Place Bid</button>" +
                        "</form>";


                $("#bidButton").popover({
                    "placement": "bottom",
                    "title": "Make your Bid",
                    "content": content
                });
    <?php } ?>
<?php } else { ?>
            var content = "<form action='<?php echo base_url("login?redirect=product/" . $product->id) ?>' method='post' >\
                                                                        <input style='margin-bottom: 15px;' placeholder='Username' type='text' name='username' size='30' />\
                                                                        <input style='margin-bottom: 15px;' placeholder='Password' type='password' name='password' size='30' />\
                                                                        <label class='string optional'>\
                                                                            <input style='float: left; margin-right: 10px;' type='checkbox' name='remember_me' value='yes' />\
                                                                            Remember me\
                                                                        </label>\
                                                                        <input class='btn btn-primary' style='clear: left; width: 100%; height: 32px; font-size: 13px;' type='submit' name='commit' value='Sign In' />\
                                                                    </form>";

            $("#bidButton").popover({
                "placement": "bottom",
                "title": "You must be signed in to Bid",
                "content": content
            });
<?php } ?>


        $("#incBid").live('click', function() {
            var cur = $("input[name=bid]").val();
            var inc = $(this).attr("ref");
            ans = parseInt(cur) + parseInt(inc);

            $("input[name=bid]").val(ans);
            $(".bidTextBox").text(ans);
        });

        $("#decBid").live('click', function() {
            var cur = $("input[name=bid]").val();
            var inc = $(this).attr("ref");
            ans = parseInt(cur) - parseInt(inc);

            $("input[name=bid]").val(ans);
            $(".bidTextBox").text(ans);
        });
    });
</script>