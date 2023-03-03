<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color: #fff; border-bottom-color: black; border: 0px; height: 130px; box-shadow: 2px 2px 2px #e1e1e1; border-top: 15px solid #ED1F24;">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php" style="color: #fff;">           
            <img src="../img/vineyard.png">
        </a>
    </div><br><br><br><br>
    <div class="navbar-default sidebar" role="navigation" style="">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                       <b><span class="fa fa-user"></span>&nbsp; <?= $g_row['lastName'] . ', ' . $g_row['firstName'] . ' ' . $g_row['middleName'] ?></b>
                    </div>
                </li>
                <li>
                    <a href="panel"><i class="fa fa-fw fa-book"></i> &nbsp;Classes</a>
                </li>
                <li>
                    <a href="Term"><i class="fa fa-fw fa-trophy"></i> &nbsp;Term & Semestral Grades</a>
                </li>
                <!-- <li>
                    <a href="grades"><i class="fa fa-fw fa-certificate"></i> &nbsp;Semestral Grades</a>
                </li> -->
                <li>
                    <a href="password"><i class="fa fa-fw fa-wrench"></i> &nbsp;Change Password</a>
                </li>
                <li>
                    <a href="../../login/logout/logout.php?logout"><i class="fa fa-fw fa-sign-out"></i> &nbsp;Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>