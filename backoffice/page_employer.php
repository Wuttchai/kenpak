<!DOCTYPE html>

<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <?php include "head.php";?>
		<!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
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
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption font-dark">
                                            <span class="caption-subject bold uppercase">Row Reordering</span>
											<a href="javascript:;" class="btn btn-circle green-jungle btn-sm"> + Add </a>
											<a href="javascript:;" class="btn btn-circle btn-default btn-sm"> Download Template </a>
											<a href="javascript:;" class="btn btn-circle btn-default btn-sm"> Upload File </a>
											<a href="javascript:;" class="btn btn-circle btn-default btn-sm"> Advance Search </a>
                                        </div>
                                        <div class="tools"> </div>
                                    </div>
                                    <div class="portlet-body">
                                        <table class="table table-striped table-checkable table-bordered table-hover" id="sample_1">
                                            <thead>
                                                <tr>
                                                    <th> Seq </th>
                                                    <th> Browser </th>
                                                    <th> Platform(s) </th>
                                                    <th> Engine version </th>
                                                    <th> CSS grade </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td> 1 </td>
                                                    <td> Internet Explorer 4.0 </td>
                                                    <td> Win 95+ </td>
                                                    <td> 4 </td>
                                                    <td>
														<a href="javascript:;" class="btn btn-circle btn-xs blue"><i class="glyphicon glyphicon-pencil"></i> Edit </a>
														<a href="javascript:;" class="btn btn-circle btn-xs red"><i class="glyphicon glyphicon-trash"></i> Delete </a>
													</td>
                                                </tr>
                                                <tr>
                                                    <td> 2 </td>
                                                    <td> Internet Explorer 5.0 </td>
                                                    <td> Win 95+ </td>
                                                    <td> 5 </td>
                                                    <td> C </td>
                                                </tr>
                                                <tr>
                                                    <td> 3 </td>
                                                    <td> Internet Explorer 5.5 </td>
                                                    <td> Win 95+ </td>
                                                    <td> 5.5 </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 4 </td>
                                                    <td> Internet Explorer 6 </td>
                                                    <td> Win 98+ </td>
                                                    <td> 6 </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 5 </td>
                                                    <td> Internet Explorer 7 </td>
                                                    <td> Win XP SP2+ </td>
                                                    <td> 7 </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 6 </td>
                                                    <td> AOL browser (AOL desktop) </td>
                                                    <td> Win XP </td>
                                                    <td> 6 </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 7 </td>
                                                    <td> Firefox 1.0 </td>
                                                    <td> Win 98+ / OSX.2+ </td>
                                                    <td> 1.7 </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 8 </td>
                                                    <td> Firefox 1.5 </td>
                                                    <td> Win 98+ / OSX.2+ </td>
                                                    <td> 1.8 </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 9 </td>
                                                    <td> Firefox 2.0 </td>
                                                    <td> Win 98+ / OSX.2+ </td>
                                                    <td> 1.8 </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 10 </td>
                                                    <td> Firefox 3.0 </td>
                                                    <td> Win 2k+ / OSX.3+ </td>
                                                    <td> 1.9 </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 11 </td>
                                                    <td> Camino 1.0 </td>
                                                    <td> OSX.2+ </td>
                                                    <td> 1.8 </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 12 </td>
                                                    <td> Camino 1.5 </td>
                                                    <td> OSX.3+ </td>
                                                    <td> 1.8 </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 13 </td>
                                                    <td> Netscape 7.2 </td>
                                                    <td> Win 95+ / Mac OS 8.6-9.2 </td>
                                                    <td> 1.7 </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 14 </td>
                                                    <td> Netscape Browser 8 </td>
                                                    <td> Win 98SE+ </td>
                                                    <td> 1.7 </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 15 </td>
                                                    <td> Netscape Navigator 9 </td>
                                                    <td> Win 98+ / OSX.2+ </td>
                                                    <td> 1.8 </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 16 </td>
                                                    <td> Mozilla 1.0 </td>
                                                    <td> Win 95+ / OSX.1+ </td>
                                                    <td> 1 </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 17 </td>
                                                    <td> Mozilla 1.1 </td>
                                                    <td> Win 95+ / OSX.1+ </td>
                                                    <td> 1.1 </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 18 </td>
                                                    <td> Mozilla 1.2 </td>
                                                    <td> Win 95+ / OSX.1+ </td>
                                                    <td> 1.2 </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 19 </td>
                                                    <td> Mozilla 1.3 </td>
                                                    <td> Win 95+ / OSX.1+ </td>
                                                    <td> 1.3 </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 20 </td>
                                                    <td> Mozilla 1.4 </td>
                                                    <td> Win 95+ / OSX.1+ </td>
                                                    <td> 1.4 </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 21 </td>
                                                    <td> Mozilla 1.5 </td>
                                                    <td> Win 95+ / OSX.1+ </td>
                                                    <td> 1.5 </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 22 </td>
                                                    <td> Mozilla 1.6 </td>
                                                    <td> Win 95+ / OSX.1+ </td>
                                                    <td> 1.6 </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 23 </td>
                                                    <td> Mozilla 1.7 </td>
                                                    <td> Win 98+ / OSX.1+ </td>
                                                    <td> 1.7 </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 24 </td>
                                                    <td> Mozilla 1.8 </td>
                                                    <td> Win 98+ / OSX.1+ </td>
                                                    <td> 1.8 </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 25 </td>
                                                    <td> Seamonkey 1.1 </td>
                                                    <td> Win 98+ / OSX.2+ </td>
                                                    <td> 1.8 </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 26 </td>
                                                    <td> Epiphany 2.20 </td>
                                                    <td> Gnome </td>
                                                    <td> 1.8 </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 27 </td>
                                                    <td> Safari 1.2 </td>
                                                    <td> OSX.3 </td>
                                                    <td> 125.5 </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 28 </td>
                                                    <td> Safari 1.3 </td>
                                                    <td> OSX.3 </td>
                                                    <td> 312.8 </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 29 </td>
                                                    <td> Safari 2.0 </td>
                                                    <td> OSX.4+ </td>
                                                    <td> 419.3 </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 30 </td>
                                                    <td> Safari 3.0 </td>
                                                    <td> OSX.4+ </td>
                                                    <td> 522.1 </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 31 </td>
                                                    <td> OmniWeb 5.5 </td>
                                                    <td> OSX.4+ </td>
                                                    <td> 420 </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 32 </td>
                                                    <td> iPod Touch / iPhone </td>
                                                    <td> iPod </td>
                                                    <td> 420.1 </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 33 </td>
                                                    <td> S60 </td>
                                                    <td> S60 </td>
                                                    <td> 413 </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 34 </td>
                                                    <td> Opera 7.0 </td>
                                                    <td> Win 95+ / OSX.1+ </td>
                                                    <td> - </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 35 </td>
                                                    <td> Opera 7.5 </td>
                                                    <td> Win 95+ / OSX.2+ </td>
                                                    <td> - </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 36 </td>
                                                    <td> Opera 8.0 </td>
                                                    <td> Win 95+ / OSX.2+ </td>
                                                    <td> - </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 37 </td>
                                                    <td> Opera 8.5 </td>
                                                    <td> Win 95+ / OSX.2+ </td>
                                                    <td> - </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 38 </td>
                                                    <td> Opera 9.0 </td>
                                                    <td> Win 95+ / OSX.3+ </td>
                                                    <td> - </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 40 </td>
                                                    <td> Opera 9.2 </td>
                                                    <td> Win 88+ / OSX.3+ </td>
                                                    <td> - </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 41 </td>
                                                    <td> Opera 9.5 </td>
                                                    <td> Win 88+ / OSX.3+ </td>
                                                    <td> - </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 42 </td>
                                                    <td> Opera for Wii </td>
                                                    <td> Wii </td>
                                                    <td> - </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 43 </td>
                                                    <td> Nokia N800 </td>
                                                    <td> N800 </td>
                                                    <td> - </td>
                                                    <td> A </td>
                                                </tr>
                                                <tr>
                                                    <td> 44 </td>
                                                    <td> Nintendo DS browser </td>
                                                    <td> Nintendo DS </td>
                                                    <td> 8.5 </td>
                                                    <td> C/A
                                                        <sup>1</sup>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- END EXAMPLE TABLE PORTLET-->
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
		<!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="assets/pages/scripts/table-datatables-rowreorder.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
		<!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->

    </body>

</html>