
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
                       <a href="<?php echo base_url('employee-task-report'); ?>" class="waves-effect"><i data-icon="&#xe026;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">My Task(s)</span></a>
                   </li>

                    <li>
                       <a href="<?php echo base_url('employee-logs'); ?>" class="waves-effect"><i data-icon="&#xe026;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">My Logs</span></a>
                   </li>

                    <li> <a href="javascript:void(0);" class="waves-effect"><i data-icon="&#xe026;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu"> Leave <span class="fa arrow"></span> </span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url('apply-employee-leave'); ?>" class="waves-effect"><i data-icon="&#xe026;" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">Apply for leave</span></a> </li>
                            <li> <a href="<?php echo base_url('employee-leave'); ?>" class="waves-effect"><i data-icon="&#xe026;" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">My leave!</span></a> </li>
                            <li> <a href="<?php echo base_url('history-leave'); ?>" class="waves-effect"><i data-icon="&#xe026;" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">Leave History</span></a> </li>
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

                            echo '<a href="'.base_url('employee-notifications').'" class="waves-effect"><i data-icon="&#xe026;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Notification</span>' . (($numNotifications > 0) ? '<span class="label label-rouded label-info pull-right">' . $numNotifications . ' new</span>' : "") .'</a>';
                        ?>
                    </li>
                   </ul>
            </div>
        </div>