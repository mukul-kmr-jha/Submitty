<!--link href="resources/bootstrap/css/bootstrap.min.css" rel="stylesheet"-->
<link href="resources/bootmin.css" rel="stylesheet"></link>
<link href="resources/main.css" rel="stylesheet"></link>


<?php if ($points_possible == 0) {
    $pecent = 0;
} else {
    $percent = (int)($points_received * 100 / $points_possible);
}
?>


<?php require_once("private/view/nav_container.php");?>
<td class=main_panel valign=top height=100%>
    <div class="panel panel-default" style="max-width:none">
        <div class="panel-body"><!-- Panel Body Summary -->
            <h2>Homework <?php echo $homework_number;?></h2>
            <div class="panel-body" style="text-align: right;"> <!-- Body homework select -->
                <span>Select Homework</span>
                <form action="">
                    <select name="number">
                    <?php for ($i = 1; $i <= $last_homework; $i++) {?>
                        <option value="<?php echo $i;?>" <?php if ($i == $homework_number) {?> selected <?php }?>>Homework <?php echo $i;?></option>
                    <?php } ?>
                    </select>
                    <input type="submit" value="Go">
                </form>
            </div><!-- End Homework Select -->
            <div class="row"><!-- Summary Table -->
                <div class="col-sm-4">
                    <span>Summary:<br> You currently are submitting <b>Version 1</b> with a score of <b>11/15</b><br><br>
                    <span>Select Version: </span>
                    <form action="index.php?page=homework">
                        <select name="version">
                            <?php for ($i = 1; $i <= $max_version_number; $i++) {?>
                                <option value="<?php echo $i;?>" <?php if ($i == $version_number) {?> selected <?php }?>>Version <?php echo $i;?></option>
                            <?php }?>
                        </select>
                        <input type="submit" value="Go">
                    </form>
                    <br>
                    <br>
                    <br>
                    <form action="" style="text-align:center;">
                    <input type="submit" class="btn btn-primary" value="Submit using Version <?php echo $version_number;?>"></input>
                    </form>
                </div>
                <div class="col-sm-7">
                    <ul class="list-group">
                        <?php foreach($homework_summary as $item) {?>
                            <?php if (isset($item["score"]) && isset($item["points_possible"]) && $item["points_possible"] != 0) {
                                if (!($item["points_possible"] > 0)) {
                                    $part_percent = 1;
                                } else {
                                    $part_percent = $item["score"] / $item["points_possible"];
                                }
                                if ($part_percent == 1) {
                                    $class = "";
                                } else if ($part_percent >= 0.5) {
                                    $class = " list-group-item-warning";
                                } else {
                                    $class = " list-group-item-danger";
                                }
                            } else {
                                $class = "";
                            }?>
                          <li class="list-group-item <?php echo $class;?>">
                              <span class="badge">
                                <?php if (isset($item["score"])) {
                                    echo $item["score"];
                                    if (isset($item["points_possible"])) {
                                        echo "/".$item["points_possible"];
                                    }
                                } else if (isset($item["value"])) {
                                    echo $item["value"];
                                }
                                ?>
                              </span>
                              <?php echo $item["title"];?>
                          </li>
                        <?php } ?>
                    </ul>
                </div>
            </div><!-- End Summary Table -->
            <div class="panel-body" style="text-align: right"><!-- Upload New Homework -->
                <form action="#" method="post" enctype="multipart/form-data">
                    <label for="file" style="margin-right: 5%;">Filename:</label>
                    <input type="file" name="file" id="file" style="display: inline" />
                    <span class="group-btn">
                        <input type="submit" name="submit" value="Submit" class="btn btn-primary" style="margin-top: 10px">
                    </span>
                </form>
            </div><!-- End Upload New Homework -->
        </div><!-- Ends Panel Body Summary -->
    </div><!-- Ends panel-default -->
    <div class="panel panel-default"><!-- Homework Output Compare And Diff -->
        <div class="row" style="margin-left: 10px; margin-right: 10px">
            <?php foreach($homework_tests as $test) {?>
                <?php if (isset($test["score"]) && isset($test["points_possible"]) && $test["points_possible"] != 0) {
                    if (!($test["points_possible"] > 0)) {
                        $part_percent = 1;
                    } else {
                        $part_percent = $test["score"] / $test["points_possible"];
                    }
                    if ($part_percent == 1) {
                        $class = "badge alert-success";
                    } else if ($part_percent >= 0.5) {
                        $class = "badge alert-warning";
                    } else {
                        $class = "badge alert-danger";
                    }
                } else {
                    $class = "badge";
                }?>
                <h4 style="margin-left: 10px; text-align: left;"><?php echo $test["title"];?> <span class="<?php echo $class;?>"><?php echo $test["score"]."/".$test["points_possible"];?></span></h4>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        My output
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        Teacher output
                    </div>
                </div>
                
            <?php } ?>
        </div>
    </div><!-- End Homework Output Compare And Diff -->
</div><!-- End Col Blog-Main -->




</table>
</body>
</html>
