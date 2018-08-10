<?php
include "config/connect.php";
?>
<!DOCTYPE html>

<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <?php include "head.php";?>
	</head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <div class="page-wrapper">
            <?php include "topmenu.php";?>
            <!-- BEGIN HEADER & CONTENT DIVIDER -->
            <div class="clearfix"> </div>
            <!-- END HEADER & CONTENT DIVIDER -->
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <?php include "menu.php";?>
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">

						
						<div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN SAMPLE FORM PORTLET-->
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption font-red-sunglo">
                                            <span class="caption-subject bold uppercase"> Default Form</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <form role="form">
                                                <div class="form-group">
                                                    <label>Left Icon(.input-sm)</label>
                                                    <div class="input-icon input-icon-sm">
                                                        <i class="fa fa-bell-o"></i>
                                                        <input type="text" class="form-control input-sm" placeholder="Left icon"> </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Right Icon(.input-sm)</label>
                                                    <div class="input-icon input-icon-sm right">
                                                        <i class="fa fa-bell-o"></i>
                                                        <input type="text" class="form-control input-sm" placeholder="Left icon"> </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Circle Input</label>
                                                    <div class="input-icon right">
                                                        <i class="fa fa-microphone"></i>
                                                        <input type="text" class="form-control input-circle input-sm" placeholder="Right icon"> </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Input with Icon</label>
                                                    <div class="input-group input-icon right">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-envelope font-purple"></i>
                                                        </span>
                                                        <i class="fa fa-exclamation tooltips" data-original-title="Invalid email." data-container="body"></i>
                                                        <input id="email" class="input-error form-control input-sm" type="text" value=""> </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Static Control :</label>
                                                    <p class="form-control-static"> email@example.com </p>
                                                </div>
                                                <div class="form-group">
                                                    <label>Disabled</label>
                                                    <input type="text" class="form-control input-sm" placeholder="Disabled" disabled>
												</div>
                                                <div class="form-group">
                                                    <label>Readonly</label>
                                                    <input type="text" class="form-control input-sm" placeholder="Readonly" readonly>
												</div>
                                                <div class="form-group">
                                                    <label>Dropdown</label>
                                                    <select class="form-control input-sm">
                                                        <option>Option 1</option>
                                                        <option>Option 2</option>
                                                        <option>Option 3</option>
                                                        <option>Option 4</option>
                                                        <option>Option 5</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Multiple Select</label>
                                                    <select multiple class="form-control input-sm">
                                                        <option>Option 1</option>
                                                        <option>Option 2</option>
                                                        <option>Option 3</option>
                                                        <option>Option 4</option>
                                                        <option>Option 5</option>
                                                    </select>
                                                </div>
												<div class="form-group">
                                                    <label>จังหวัด</label>
                                                    <select class="form-control input-sm" id="province" name="province">
                                                        <option value="">Select</option>
														<?php
															$sql = "SELECT * FROM tbl_province ORDER BY PROVINCE_NAME";
															$result = mysqli_query($conn, $sql);
															if (mysqli_num_rows($result) > 0){
																while($row = mysqli_fetch_assoc($result)){
																	echo "<option value=\"$row[PROVINCE_ID]\">$row[PROVINCE_NAME]</option>";
																}
															}
														?>
                                                    </select>
                                                </div>
												<div class="form-group">
                                                    <label>อำเภอ</label>
                                                    <select class="form-control input-sm" id="amphoe" name="amphoe">
                                                        <option value="">Select</option>
                                                    </select>
                                                </div>
												<div class="form-group">
                                                    <label>ตำบล</label>
                                                    <select class="form-control input-sm" id="district" name="district">
                                                        <option value="">Select</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Textarea</label>
                                                    <textarea class="form-control input-sm" rows="3"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputFile1">File input</label>
                                                    <input type="file" id="exampleInputFile1">
                                                    <p class="help-block"> some help text here. </p>
                                                </div>
                                                <div class="form-group">
                                                    <label>Checkboxes</label>
                                                    <div class="mt-checkbox-list">
                                                        <label class="mt-checkbox"> Checkbox 1
                                                            <input type="checkbox" value="1" name="test" />
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-checkbox"> Checkbox 2
                                                            <input type="checkbox" value="1" name="test" />
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-checkbox"> Checkbox 3
                                                            <input type="checkbox" value="1" name="test" />
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Outline Checkboxes</label>
                                                    <div class="mt-checkbox-list">
                                                        <label class="mt-checkbox mt-checkbox-outline"> Checkbox 1
                                                            <input type="checkbox" value="1" name="test" />
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-checkbox mt-checkbox-outline"> Checkbox 2
                                                            <input type="checkbox" value="1" name="test" />
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-checkbox mt-checkbox-outline"> Checkbox 3
                                                            <input type="checkbox" value="1" name="test" />
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Inline Checkboxes</label>
                                                    <div class="mt-checkbox-inline">
                                                        <label class="mt-checkbox">
                                                            <input type="checkbox" id="inlineCheckbox1" value="option1"> Checkbox 1
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-checkbox">
                                                            <input type="checkbox" id="inlineCheckbox2" value="option2"> Checkbox 2
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-checkbox mt-checkbox-disabled">
                                                            <input type="checkbox" id="inlineCheckbox3" value="option3" disabled> Disabled
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Radios</label>
                                                    <div class="mt-radio-list">
                                                        <label class="mt-radio"> Radio 1
                                                            <input type="radio" value="1" name="test" />
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio"> Radio 2
                                                            <input type="radio" value="1" name="test" />
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio"> Radio 3
                                                            <input type="radio" value="1" name="test" />
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Outline Radios</label>
                                                    <div class="mt-radio-list">
                                                        <label class="mt-radio mt-radio-outline"> Radio 1
                                                            <input type="radio" value="1" name="test" />
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio mt-radio-outline"> Radio 2
                                                            <input type="radio" value="1" name="test" />
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio mt-radio-outline"> Radio 3
                                                            <input type="radio" value="1" name="test" />
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Inline Radio</label>
                                                    <div class="mt-radio-inline">
                                                        <label class="mt-radio">
                                                            <input type="radio" name="optionsRadios" id="optionsRadios4" value="option1" checked> Option 1
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="optionsRadios" id="optionsRadios5" value="option2"> Option 2
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio mt-radio-disabled">
                                                            <input type="radio" name="optionsRadios" id="optionsRadios6" value="option3" disabled> Disabled
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn blue">Submit</button>
                                                <button type="button" class="btn default">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- END SAMPLE FORM PORTLET-->
							</div>
						</div>
						
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
            </div>
            <!-- END CONTAINER -->
            <?php include "footer.php"; ?>
        </div>


        <?php include "footer_script.php"; ?>
		<script type="text/javascript">
			jQuery(function($) {
				jQuery('body').on('change','#province',function(){
					jQuery.ajax({
						'type':'POST',
						'url':'get_amphoe.php',
						'cache':false,
						'data':{province:jQuery(this).val()},
						'success':function(html){
							jQuery("#amphoe").html(html);
						}
					});
					return false;
				});
				jQuery('body').on('change','#amphoe',function(){
					jQuery.ajax({
						'type':'POST',
						'url':'get_district.php',
						'cache':false,
						'data':{amphoe:jQuery(this).val()},
						'success':function(html){
							jQuery("#district").html(html);
						}
					});
					return false;
				});
			});
		</script>

    </body>

</html>