<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <?php echo $this->Html->link(__('Mengra'), array('controller' => 'users', 'action' => 'index'), array('class' => 'brand')); ?>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?php echo __('Entities'); ?>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <?php
                                    echo $this->Html->link(
                                        'Users',
                                        array(
                                            'controller' => 'users',
                                            'action' => 'index'
                                        )
                                    );
                                ?>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav pull-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon icon-user"></i>
                            <?php
                                $name = Configure::read('User.name');
                                echo $name;
                            ?>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <?php
                                    echo $this->Html->link(
                                        __('Edit Profile'),
                                        array(
                                            'controller' => 'users',
                                            'action' => 'edit_profile'
                                        )
                                    );
                                ?>
                            </li>
                            <li>
                                <?php
                                    echo $this->Html->link(
                                        __('Change Password'),
                                        array(
                                            'controller' => 'users',
                                            'action' => 'edit_profile'
                                        )
                                    );
                                ?>
                            </li>
                            <li>
                                <?php
                                    echo $this->Html->link(
                                        __('<i class="icon icon-off"></i> Logout'),
                                        array(
                                            'controller' => 'users',
                                            'action' => 'logout'
                                        ),
                                        array(
                                            'escape' => false
                                        )
                                    );
                                ?>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>