





<script type="text/javascript"
src="<?php echo $base_url; ?>/assets/ext/jquery-ui/jquery-ui-timepicker-addon.js"></script>

<script type="text/javascript"
src="<?php echo $base_url; ?>/assets/js/backend_dashboard.js"></script>




<script type="text/javascript">
    var GlobalVariables = {
        'csrfToken': <?php echo json_encode($this->security->get_csrf_hash()); ?>,
        'availableProviders': <?php echo json_encode($available_providers); ?>,
        'availableServices': <?php echo json_encode($available_services); ?>,
        'dateFormat': <?php echo json_encode($date_format); ?>,
        'baseUrl': <?php echo '"' . $base_url . '"'; ?>,
        'customers': <?php echo json_encode($customers); ?>,
        'user': {
            'id': <?php echo $user_id; ?>,
            'email': <?php echo '"' . $user_email . '"'; ?>,
            'role_slug': <?php echo '"' . $role_slug . '"'; ?>,
            'privileges': <?php echo json_encode($privileges); ?>
        }
    };

    $(document).ready(function () {
        BackendDashboard.initialize(true);




    });
</script>



<!-- Page Content -->
<div id="dashboard-page" class="container-fluid">
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header" >Aujourd'hui	<?php
                            $date = date('d-m-Y');
                            echo $date;
                            ?></h1>

                        <form class="form-inline form-date" role="form">
                            <div class="form-group">
                                <label for="date1">start date:</label>
                                <input type="date" class="form-control" id="date1" placeholder="Enter date" >
                            </div>
                            <div class="form-group">
                                <label for="date2">end date:</label>
                                <input type="date" class="form-control" id="date2" placeholder="Enter date" >
                            </div>							
                            <button type="button" class="btn btn-default" id="date_button">Filter</button>

                        </form>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">

                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-calendar-check-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge number_appointment"><?php echo $number_appointment; ?></div>
                                        <div>Rendez-vous!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <div class="row">

                                    <div class="col-xs-9 text-right">
                                        <div class="huge number_appointment_confirmed"><?php echo $number_appointment_confirmed; ?></div>
                                        <div>Revenu confirmé!</div>
                                    </div>
                                    <div class="col-xs-3">
                                        <strong>TND</strong>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <div class="row">

                                    <div class="col-xs-9 text-right">
                                        <div class="huge number_appointment_projected"><?php echo $number_appointment_projected; ?></div>
                                        <div>Revenu Prévues!</div>
                                    </div>
                                    <div class="col-xs-3">
                                        <strong>TND</strong>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <div class="row">

                                    <div class="col-xs-9 text-right">
                                        <div class="huge number_appointment_total"><?php echo $number_appointment_price; ?></div>
                                        <div>Total Estimé!</div>
                                    </div>
                                    <div class="col-xs-3">
                                        <strong>TND</strong>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Liste d'attente							
                            </div>
                            <div class="panel-body">
                                <div class="list-group" id="waiting_list">
                                    <div class="list-group-item results"></div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Liste des rendez vous
                            </div>
                            <div class="panel-body">
                                <div class="list-group" id="appointment_list">
                                    <div class="list-group-item results"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Notifications
                            </div>
                            <div class="panel-body">
                                <div class="list-group" id="notification_list">
                                    <div class="list-group-item results"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
</div>