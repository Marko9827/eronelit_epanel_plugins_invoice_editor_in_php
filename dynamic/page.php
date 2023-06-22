<?php


if (isset($_GET['saved_id'])) {
    if (!empty($_GET['saved_id'])) {
         
        echo "<script id='saved_id' type='text/javascript'>
        setTimeout(function(){
            $('.invoice-box input').prop( 'disabled', true );
            $('#saved_id, .btn-add-row, .save-btn-info, #".$_GET['saved_id']."').remove();
            $('.invoice-box table tr.top table td.title').css({'pointer-events':'none'});
            $('.btn-remove-row').html('<i class=\"fas fa-trash-alt\"></i> ". lang('dash_th_delete')."');
        },100);
        </script><div class='invoice-box'>";
        include($this->getDIR() . "/data/index_" . $_GET['saved_id'] . ".html");
        echo "</div>";
    }
} else {
?>
    <div class="invoice-box">


        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="4">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="/?sourcedash=logo.svg" style="width:100%;/* max-width:300px;*/">
                                <input type="file" id="invoice_img" />
                                <span>Recommended size: 1500 / 2</span>
                            </td>

                            <td>
                                <input style="text-align: right;" placeholder="Invoice #: 123"><br> Created: <?php echo date("Y/m/d"); ?><br><input style="text-align: right;" placeholder="Due: example <?php echo date("Y/m/d"); ?>" /> </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class=" information">
                <td colspan="4">
                    <table id="information_table_4">
                        <tr>
                            <td>
                                <input placeholder="Example, Inc." /><br>
                                <input placeholder="12345 Example Road" /><br>
                                <input placeholder="Example, CA 12345" /><br>
                            </td>

                            <td id="info-head-right">
                                <input placeholder="Example Corp." /><br>
                                <input placeholder="Example name" /><br>
                                <input type="email" placeholder="inf@example.com" /><br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td colspan="3">
                    Payment Method
                </td>

                <td>
                    Check #
                </td>
            </tr>

            <tr class="details">
                <td colspan="3">
                    <input value="Check" />
                </td>

                <td>
                    <input type="number" style="text-align: right;" max="4" maxlength="4" placeholder="1000" />
                </td>
            </tr>

            <tr class=" heading">
                <td>
                    Item
                </td>

                <td>
                    Unit Cost
                </td>

                <td>
                    Quantity
                </td>

                <td>
                    Price
                </td>
            </tr>

            <tr class="item">
                <td>
                    <input value="Website design" placeholder="Item name" />
                </td>

                <td>
                    $<input type="number" placeholder="Cost" value="300" />
                </td>

                <td>
                    <input type="number" value="1" placeholder="Quantity" />
                </td>

                <td>
                    $300.00
                </td>
            </tr>



            <tr>
                <td colspan="4">
                    <button class="btn-add-row btn btn-primary ">Add row</button>
                    <button style="margin-left: 5px;" class="btn-remove-row btn btn-danger ">Remove last row</button>
                    <button style="margin-left: 5px;" class="btn btn-info save-btn-info" onclick="ajax_saveF('<?php echo $url; ?>');"><i class="fas fa-save"></i> Save</button>
                    <button style="margin-left: 5px;" class="btn btn-info pdf-btn-info" onclick="window.print()"><i class="far fa-file-pdf"></i> Download</button>
                </td>
            </tr>

            <tr class="total">
                <td colspan="3"></td>

                <td>
                    Total: $385.00
                </td>
            </tr>
        </table>

        <?php



        ?>
    </div> <?php }

        echo " <ul id='invoice_saved'>";
        foreach (glob('plugins/' . $name . '/data/*.html') as $file) {

            $number = filter_var($file, FILTER_SANITIZE_NUMBER_INT);
            
            echo "<li id='$number' style='background-image: url(/plugins/$name/static/image/cover_preview.svg);'><div-header>"; ?>
    <div class="form-group form-group-id-button-ao" style="display: inline-flex;">
        <a href="/?admin=plugins"><button name="post-submit" style="margin-left:0px;" class="btn   form-control btn-danger"><i class="fas fa-trash-alt"></i> <?php echo lang('dash_th_delete'); ?></button></a>
        <a href="/?plugin=einvoice&saved_id=<?php echo $number; ?>" target="_blank"><button name="post-submit" style="margin-left:12px; padding-left:10px;" class="btn btn-primary form-control"><i class="fas fa-link"></i> <?php echo lang('dash_th_preview'); ?></button></a>
    </div>
<?php echo "</div-header><br><div-content><p>" . lang('dash_th_name') . ": $number <br>Size: " . $this->formatBytes(filesize($file)) ."<br>" .lang('dash_th_date').": ". date("F d Y H:i:s.", filemtime($file))."</p></div-content><div-footer></div-footer></li>";
        }
        echo "</ul>";


?>