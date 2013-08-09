<style>
    .accordion-inner{
        border: 0px;
    }
    table.table thead .sorting,
    table.table thead .sorting_asc,
    table.table thead .sorting_desc,
    table.table thead .sorting_asc_disabled,
    table.table thead .sorting_desc_disabled {
        cursor: pointer;
        *cursor: hand;
    }

    table.table thead .sorting { background: url('<?php echo base_url('assets/img/sort_both.png') ?>') no-repeat center right; }
    table.table thead .sorting_asc { background: url('<?php echo base_url('assets/img/sort_asc.png') ?>') no-repeat center right; }
    table.table thead .sorting_desc { background: url('<?php echo base_url('assets/img/sort_desc.png') ?>') no-repeat center right; }

    table.table thead .sorting_asc_disabled { background: url('<?php echo base_url('assets/img/sort_asc_disabled.png') ?>') no-repeat center right; }
    table.table thead .sorting_desc_disabled { background: url('<?php echo base_url('assets/img/sort_desc_disabled.png') ?>') no-repeat center right; }
</style>
<div class="container-fluid">
    <div class="row-fluid">

        <!--CONTROL BOX-->
        <div class="span2">
            <div class="row-fluid">
                <div class="span12">
                    <img src="http://placehold.it/150" class="img-polaroid">

                    <h2><?php echo $userOBJ->username ?></h2>
                    <hr />
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#sellCollapse">
                        <button type="button" class="btn btn-block btn-primary" data-toggle="button">Sell Something</button>
                    </a>
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#addvoucherCollapse">
                        <button type="button" class="btn btn-block btn-primary" data-toggle="button">Load Voucher</button>
                    </a>
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#addvoucherCollapse">
                        <button type="button" class="btn btn-block btn-primary" data-toggle="button">Transfer Credit</button>
                    </a>
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#notification">
                        <button type="button" class="btn btn-block btn-primary" data-toggle="button">Notification <span class="badge badge-inverse"><?php echo $user->getUnreadNotification()?></span> </button>
                    </a>
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#creditHistoryCollapse">
                        <button type="button" class="btn btn-block btn-primary" data-toggle="button">Credit History</button>
                    </a>
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#feedbackCollapse">
                        <button type="button" class="btn btn-block btn-warning" data-toggle="button">Give Feedback</button>
                    </a>    
                    <?php echo $this->session->userdata("show_box"); ?>
                </div>
            </div>
        </div>
        <!--END OF CONTROL BOX-->

        <!--PRODUCT BOX-->
        <div class="span7">

            <div class="row-fluid">
                <span class="12">                    
                    <div class="row-fluid">
                        <div class="span12">

                            <!--SELL SOMETHING COLLAPSE-->
                            <div id="sellCollapse" class="accordion-body collapse">
                                <div class="accordion-inner">
                                    <?php echo validation_errors("<div class='alert alert-error alert-block'><button type='button' class='close' data-dismiss='alert'>&times;</button>", "</div>"); ?>                                

                                    <?php $params = array('class' => 'well form'); ?>
                                    <?php echo form_open('user/addProduct', $params); ?>
                                    <h3>Sell Something</h3>

                                    <div class="row-fluid">
                                        <div class="span6">
                                            <label>Name</label>  
                                            <input name="name" value="<?php echo set_value('name'); ?>"  type="text" class="span10"> 

                                            <label>Category</label>  
                                            <select name="category" class="span10">
                                                <option value="SELECT">-SELECT-</option>
                                                <?php foreach ($categories as $category) { ?>
                                                    <option <?php echo set_select('category', $category->id); ?> value="<?php echo $category->id ?>"><?php echo $category->name ?></option>                            
                                                <?php } ?>
                                            </select> 

                                            <label>Description</label>  
                                            <textarea name="description" style="height: 80px" class="span10"><?php echo set_value('description', $this->input->post('description')); ?></textarea>   
                                        </div>

                                        <div class="span6">
                                            <label>Duration</label>  
                                            <select name="duration" class="span8">
                                                <option value="1" <?php echo set_select('duration', 1); ?>>1 Day</option>
                                                <option value="2" <?php echo set_select('duration', 2); ?>>2 Days</option>
                                                <option value="3" <?php echo set_select('duration', 3); ?>>3 Days</option>
                                                <option value="4" <?php echo set_select('duration', 4); ?>>4 Days</option>
                                                <option value="5" <?php echo set_select('duration', 5); ?>>5 Days</option>
                                                <option value="6" <?php echo set_select('duartion', 6); ?>>6 Days</option>
                                            </select>
                                            <!--<span class="help-inline">How long you want your auction to be up for</span>-->
                                            <br />
                                            <br />

                                            <div class="row-fluid">
                                                <div class="span6">
                                                    <label>Price</label>  
                                                    <div class="input-prepend input-append">
                                                        <span class="add-on">₦</span>
                                                        <input name="price" value="<?php echo set_value('price'); ?>"  class="span4" id="appendedPrependedInput" type="text">
                                                        <span class="add-on">.00</span>
                                                    </div>
                                                </div>                                
                                                <div class="span6">
                                                    <label>Min Bid Increment</label>  
                                                    <select name="min_increment" class="span10">
                                                        <option <?php echo set_select('min_increment', 10); ?> value="10"><?php echo price_tag(10, true); ?></option>
                                                        <option <?php echo set_select('min_increment', 20); ?> value="20"><?php echo price_tag(20, true); ?></option>
                                                        <option <?php echo set_select('min_increment', 50); ?> value="50"><?php echo price_tag(50, true); ?></option>
                                                        <option <?php echo set_select('min_increment', 100); ?> value="100"><?php echo price_tag(100, true); ?></option>
                                                        <option <?php echo set_select('min_increment', 200); ?> value="200"><?php echo price_tag(200, true); ?></option>
                                                        <option <?php echo set_select('min_increment', 500); ?> value="500"><?php echo price_tag(500, true); ?></option>
                                                        <option <?php echo set_select('min_increment', 1000); ?> value="1000"><?php echo price_tag(1000, true); ?></option>
                                                        <option <?php echo set_select('min_increment', 2000); ?> value="2000"><?php echo price_tag(2000, true); ?></option>
                                                        <option <?php echo set_select('min_increment', 5000); ?> value="5000"><?php echo price_tag(5000, true); ?></option>
                                                    </select>
                                                    <span class="help-block">Minimum amount for a bidder to add</span>
                                                </div>                                                            
                                            </div>

                                            <label>Image</label>  
                                            <input name="image" type="file" class="span10">
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">Upload</button>
                                        <button type="reset" class="btn">Clear</button>
                                    </div>

                                    <?php echo form_close(); ?>

                                </div>
                            </div>
                            <!--END OF SELL SOMETHING COLLAPSE-->

                            <!--ADD VOUCHER COLLAPSE-->
                            <div id="addvoucherCollapse" class="accordion-body collapse">
                                <div class="accordion-inner">

                                    <h3>Load Voucher</h3>

                                    <?php $params = array('class' => 'well form pagination-centered'); ?>
                                    <?php echo form_open('user/loadVoucher', $params); ?>

                                    <div class="row-fluid">
                                        <div class="span12 pagination-centered">
                                            <label>Code</label>  
                                            <input name="credit1" maxlength="4" type="text" class="span2 pagination-centered"> <b>-</b>
                                            <input name="credit2" maxlength="4" type="text" class="span2 pagination-centered"> <b>-</b>
                                            <input name="credit3" maxlength="4" type="text" class="span2 pagination-centered">
                                            <br />
                                            <?php
                                            echo $this->session->userdata("load_error");
                                            $this->session->unset_userdata("load_error")
                                            ?>

                                            <button type="submit" class="btn btn-primary">Load</button>
                                        </div>
                                    </div>

                                    <?php echo form_close(); ?>

                                </div>
                            </div>
                            <!--END OF ADD VOUCHER COLLAPSE-->


                            <!--VIEW CREDIT HISTORY COLLAPSE-->
                            <div id="creditHistoryCollapse" class="accordion-body collapse">
                                <div class="accordion-inner well">
                                    <h3>Credit History</h3>
                                    <div class="row-fluid">
                                        <div class="span">
                                            Total: <i class="icon-circle credits"></i><?php echo $userOBJ->credit ?> Credits
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row-fluid">
                                        <div class="span12">
                                            <table class="table table-hover table-condensed" id="history">
                                                <thead>
                                                    <tr>
                                                        <th>Date Time</th>
                                                        <th>Description</th>
                                                        <th>C/D</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!is_array($creditHistory)) { ?>
                                                        <tr class="info">
                                                            <td></td>
                                                            <td>No Credit history yet</td>
                                                            <td></td>
                                                            <td></td>

                                                        </tr>
                                                    <?php } else { ?>
                                                        <?php foreach ($creditHistory as $CH) { ?>
                                                            <tr>
                                                                <td><small><?php echo date("d/m/y H:i:s", strtotime($CH->datetime)); ?></small></td>
                                                                <td><small><?php echo $CH->description ?></small></td>
                                                                <td style="color: white; text-align: center; background-color: <?php echo ($CH->credit_debit == "credit") ? "#47cd1b" : "red" ?>"><small><?php echo ($CH->credit_debit == "credit") ? "C" : "D" ?></small></td>
                                                                <td><i class="icon-circle credits" ></i> <?php echo $CH->amount ?> <small>Credits</small></td>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!--END OF CREDIT HISTORY COLLAPSE-->


                            <!--ADD FEEDBACK COLLAPSE-->
                            <div id="feedbackCollapse" class="accordion-body collapse">
                                <div class="accordion-inner">
                                    <h3>What's wrong? <small>How can we help?</small></h3>

                                    <?php $params = array('class' => 'well form pagination-centered'); ?>
                                    <?php echo form_open('user/addProduct', $params); ?>

                                    <div class="row-fluid">
                                        <div class="span12 pagination-centered">
                                            <label>Let us know</label>  
                                            <textarea name="name" style='height: 100px' class="span7" ></textarea>
                                            <br />
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>

                                    <?php echo form_close(); ?>

                                </div>

                            </div>
                            <!--END OF FEEDBACK COLLAPSE-->

                        </div>                        
                    </div>
                </span>
            </div>

            <div class="row-fluid">
                <div class="span12">
                    <div class="page-header">
                        <h2>My Products <small>Ongoing</small></h2>
                    </div>

                    <ul class="thumbnails">
                        <?php if (!is_array($userProducts)) { ?>
                            <div class="alert alert-info">No products have been uploaded yet</div>
                        <?php } else { ?>
                            <?php foreach ($userProducts as $product) { ?>
                                <li class="span4 pagination-centered" style="margin-left: 10px">
                                    <div class="thumbnail">
                                        <a href="<?php echo base_url('product/' . $product->id) ?>">
                                            <img src="http://placehold.it/300x200" alt="300x200" style="width: 300px; height: 200px;" >
                                        </a>
                                        <div class="caption">
                                            <p><?php echo $product->name ?></p>
                                            <!--<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam...</p>-->
                                            <p>
                                                Price: <?php echo price_tag($product->price) ?>
                                                <br />
                                                <b>Highest Bid: <?php echo price_tag($product->highest_bid) ?></b>
                                            </p>
                                            <p><a class="disabled btn btn-primary countdownTimer" yr="2013" m="11" d="12" h="14" min="11" s="11">3D 23:12:45</a></p>
                                            <p>
                                            <div class="btn-group">
                                                <button title="Edit" class="btn"><i class="icon-pencil"></i></button>
                                                <a href="<?php echo base_url('product/' . $product->id) ?>"><button title="View" class="btn"><i class="icon-search"></i></button></a>
                                                <button title="Delete" class="btn btn-warning"><i class="icon-trash"></i></button>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            <?php
                            }
                        }
                        ?>   
                    </ul>
                </div>
            </div>

        </div>
        <!--END OF PRODUCT BOX-->


        <!--PRODUCT BOX-->
        <div class="span3">
            <div class="page-header">
                <h2>Featured <small>Deals</small></h2>
            </div>
<?php foreach ($lProducts as $product) { ?>
                <div class="row-fluid" style="margin-bottom: 40px">
                    <div class="span4">
                        <a href="<?php echo base_url('product/' . $product->id); ?>">
                            <img src="http://placehold.it/100" style="width: 100px" class="img-circle">
                        </a>
                    </div>
                    <div class="span8">
                        <div class="row-fluid">
                            <div class="span12">
                                <a href="<?php echo base_url('product/' . $product->id); ?>">
                                    <b><?php echo $product->name ?></b>
                                </a>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <small><?php echo $product->description ?>...</small>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <button class="disabled btn btn-primary btn-small">4D 3:44:23</button>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <a href="<?php echo base_url('product/' . $product->id); ?>">
                                    <button class="btn btn-success btn-small">BID</button>
                                </a>
                                <button class="btn btn-success btn-small" title="Add to watch list"><i class="icon-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
<?php } ?>   
        </div>
        <!--END OF PRODUCT BOX-->

    </div>
</div>
<?php if ($this->session->userdata("temp_show_box")) { ?>
    <script>
        $("a[href=<?php echo $this->session->userdata("temp_show_box"); ?>] button").button('toggle');
        $("<?php echo $this->session->userdata("temp_show_box"); ?>").collapse('show');
    </script>
    <?php
    $this->session->unset_userdata("temp_show_box");
}
?>
<script>

    /* Set the defaults for DataTables initialisation */
    $.extend(true, $.fn.dataTable.defaults, {
        "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
        "sPaginationType": "bootstrap",
        "oLanguage": {
            "sLengthMenu": "_MENU_ records per page"
        }
    });


    /* Default class modification */
    $.extend($.fn.dataTableExt.oStdClasses, {
        "sWrapper": "dataTables_wrapper form-inline"
    });


    /* API method to get paging information */
    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
    {
        return {
            "iStart": oSettings._iDisplayStart,
            "iEnd": oSettings.fnDisplayEnd(),
            "iLength": oSettings._iDisplayLength,
            "iTotal": oSettings.fnRecordsTotal(),
            "iFilteredTotal": oSettings.fnRecordsDisplay(),
            "iPage": oSettings._iDisplayLength === -1 ?
                    0 : Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
            "iTotalPages": oSettings._iDisplayLength === -1 ?
                    0 : Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
    };


    /* Bootstrap style pagination control */
    $.extend($.fn.dataTableExt.oPagination, {
        "bootstrap": {
            "fnInit": function(oSettings, nPaging, fnDraw) {
                var oLang = oSettings.oLanguage.oPaginate;
                var fnClickHandler = function(e) {
                    e.preventDefault();
                    if (oSettings.oApi._fnPageChange(oSettings, e.data.action)) {
                        fnDraw(oSettings);
                    }
                };

                $(nPaging).addClass('pagination').append(
                        '<ul>' +
                        '<li class="prev disabled"><a href="#">&larr; ' + oLang.sPrevious + '</a></li>' +
                        '<li class="next disabled"><a href="#">' + oLang.sNext + ' &rarr; </a></li>' +
                        '</ul>'
                        );
                var els = $('a', nPaging);
                $(els[0]).bind('click.DT', {action: "previous"}, fnClickHandler);
                $(els[1]).bind('click.DT', {action: "next"}, fnClickHandler);
            },
            "fnUpdate": function(oSettings, fnDraw) {
                var iListLength = 5;
                var oPaging = oSettings.oInstance.fnPagingInfo();
                var an = oSettings.aanFeatures.p;
                var i, ien, j, sClass, iStart, iEnd, iHalf = Math.floor(iListLength / 2);

                if (oPaging.iTotalPages < iListLength) {
                    iStart = 1;
                    iEnd = oPaging.iTotalPages;
                }
                else if (oPaging.iPage <= iHalf) {
                    iStart = 1;
                    iEnd = iListLength;
                } else if (oPaging.iPage >= (oPaging.iTotalPages - iHalf)) {
                    iStart = oPaging.iTotalPages - iListLength + 1;
                    iEnd = oPaging.iTotalPages;
                } else {
                    iStart = oPaging.iPage - iHalf + 1;
                    iEnd = iStart + iListLength - 1;
                }

                for (i = 0, ien = an.length; i < ien; i++) {
                    // Remove the middle elements
                    $('li:gt(0)', an[i]).filter(':not(:last)').remove();

                    // Add the new list items and their event handlers
                    for (j = iStart; j <= iEnd; j++) {
                        sClass = (j == oPaging.iPage + 1) ? 'class="active"' : '';
                        $('<li ' + sClass + '><a href="#">' + j + '</a></li>')
                                .insertBefore($('li:last', an[i])[0])
                                .bind('click', function(e) {
                            e.preventDefault();
                            oSettings._iDisplayStart = (parseInt($('a', this).text(), 10) - 1) * oPaging.iLength;
                            fnDraw(oSettings);
                        });
                    }

                    // Add / remove disabled classes from the static elements
                    if (oPaging.iPage === 0) {
                        $('li:first', an[i]).addClass('disabled');
                    } else {
                        $('li:first', an[i]).removeClass('disabled');
                    }

                    if (oPaging.iPage === oPaging.iTotalPages - 1 || oPaging.iTotalPages === 0) {
                        $('li:last', an[i]).addClass('disabled');
                    } else {
                        $('li:last', an[i]).removeClass('disabled');
                    }
                }
            }
        }
    });


    /*
     * TableTools Bootstrap compatibility
     * Required TableTools 2.1+
     */
    if ($.fn.DataTable.TableTools) {
        // Set the classes that TableTools uses to something suitable for Bootstrap
        $.extend(true, $.fn.DataTable.TableTools.classes, {
            "container": "DTTT btn-group",
            "buttons": {
                "normal": "btn",
                "disabled": "disabled"
            },
            "collection": {
                "container": "DTTT_dropdown dropdown-menu",
                "buttons": {
                    "normal": "",
                    "disabled": "disabled"
                }
            },
            "print": {
                "info": "DTTT_print_info modal"
            },
            "select": {
                "row": "active"
            }
        });

        // Have the collection use a bootstrap compatible dropdown
        $.extend(true, $.fn.DataTable.TableTools.DEFAULTS.oTags, {
            "collection": {
                "container": "ul",
                "button": "li",
                "liner": "a"
            }
        });
    }

    jQuery.extend(jQuery.fn.dataTableExt.oSort, {
        "num-html-pre": function(a) {
            var x = String(a).replace(/<[\s\S]*?>/g, "");
            return parseFloat(x);
        },
        "num-html-asc": function(a, b) {
            return ((a < b) ? -1 : ((a > b) ? 1 : 0));
        },
        "num-html-desc": function(a, b) {
            return ((a < b) ? 1 : ((a > b) ? -1 : 0));
        }
    });
    
    jQuery.extend( jQuery.fn.dataTableExt.oSort, {
    "date-euro-pre": function ( a ) {
        if ($.trim(a) != '') {
            var frDatea = $.trim(a).split(' ');
            var frTimea = frDatea[1].split(':');
            var frDatea2 = frDatea[0].split('/');
            var x = (frDatea2[2] + frDatea2[1] + frDatea2[0] + frTimea[0] + frTimea[1] + frTimea[2]) * 1;
        } else {
            var x = 10000000000000; // = l'an 1000 ...
        }
         
        return x;
    },
 
    "date-euro-asc": function ( a, b ) {
        return a - b;
    },
 
    "date-euro-desc": function ( a, b ) {
        return b - a;
    }
} );

jQuery.extend( jQuery.fn.dataTableExt.oSort, {
    "natural-asc": function ( a, b ) {
        return naturalSort(a,b);
    },
 
    "natural-desc": function ( a, b ) {
        return naturalSort(a,b) * -1;
    }
} );

    /* Table initialisation */
    $(document).ready(function() {
        $('#history').dataTable({
            "sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
            "aaSorting": [[0, "desc"]],
            "sPaginationType": "bootstrap",
            "aoColumns": [
                {"sType": 'natural'},
                {"sType": 'natural'},
                {"sType": 'natural'},
                {"sType": 'num-html'}],
            "oLanguage": {
                "sLengthMenu": "_MENU_ Records"
            }

        });
    });
</script>