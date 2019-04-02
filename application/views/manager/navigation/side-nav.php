
<div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3> </div>
                <ul class="nav" id="side-menu">
                    <li class="divider"> </li>

                    <li>
                       <a href="<?php echo base_url('dashboard'); ?>" class="waves-effect"><i data-icon="&#xe026;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Dashboard</span></a>
                    </li>

                    <li>
                       <a href="<?php echo base_url('employee-report'); ?>" class="waves-effect"><i data-icon="&#xe026;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Employee Report</span></a>
                       <a href="<?php echo base_url('task-report'); ?>" class="waves-effect"><i data-icon="&#xe026;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Task Report</span></a>
                       <a href="<?php echo base_url('service-report'); ?>" class="waves-effect"><i data-icon="&#xe026;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Service Report</span></a>
                       <a href="<?php echo base_url('vehicle-report'); ?>" class="waves-effect"><i data-icon="&#xe026;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Vehicle Report</span></a>
                   </li>

                    <li> <a href="javascript:void(0);" class="waves-effect"><i data-icon="&#xe026;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu"> Leave <span class="fa arrow"></span> </span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url('manage-emp-leave'); ?>" class="waves-effect"><i data-icon="&#xe026;" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">Leave Requests</span></a> </li>
                            <li> <a href="<?php echo base_url('leave-list'); ?>" class="waves-effect"><i data-icon="&#xe026;" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">Leaves</span></a> </li>
                            <li> <a href="<?php echo base_url('leave-report'); ?>" class="waves-effect"><i data-icon="&#xe026;" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">Leave Report</span></a> </li>
                        </ul>
                    </li>

                    <li class="devider"></li>
                    <li>
                        <?php

                            $numNotifications = 0;

                            if( $notificationsStats !== null) {
                                $numNotifications = $notificationsStats;
                            }
                            //echo '<a href="' . base_url('reviews') .'" class="waves-effect"><i class="ti-comments fa-fw"></i> <span class="hide-menu"> Reviews</span>' . (($numNotifications > 0) ? '<span class="label label-rouded label-info pull-right">' . $numNotifications . ' new</span>' : "") .'</a>';

                            echo '<a href="'.base_url('manager-notifications').'" class="waves-effect"><i data-icon="&#xe026;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Notification</span>' . (($numNotifications > 0) ? '<span class="label label-rouded label-info pull-right">' . $numNotifications . ' new</span>' : "") .'</a>';
                        ?>
                    </li>
                   </ul>
            </div>
        </div>