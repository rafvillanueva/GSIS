<style type="text/css">
    @import url('https://fonts.googleapis.com/css?family=Montserrat');

    #kiao:hover {background-color: transparent;}
    a {color: #000; font-family: font-family: 'Montserrat', sans-serif;}
    a:active {background-color: transparent;}

    body {font-family: 'Montserrat', sans-serif;}
    
</style>
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color: #ED1F24; border: 0px;">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php" style="color: #fff;">           
            <p><b style="font-size: 24px;">V</b> ineyard College | <small> cPanel</small></p>
        </a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="kiao" style="color: #fff;">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="../../login/logout/logout.php?logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation" style="">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                       <b>User Accounts-Management</b>
                    </div>
                </li>
                <li>
                    <a href="accounts"><i class="fa fa-fw fa-user"></i> &nbsp;List of Accounts</a>
                </li>
                <li>
                    <a href="accounts-add"><i class="fa fa-fw fa-plus"></i> &nbsp;Create Account</a>
                </li>
                <li>
                    <a href="../"><i class="fa fa-fw fa-arrow-left"></i> &nbsp;Back</a>
                </li>
            </ul>
        </div>
    </div>
</nav>