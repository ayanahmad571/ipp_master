<?php
require_once("server_fundamentals/SessionHandler.php");

getHead("WO Sales");

$genQuery = workOrderPagesQuery("1");
$retQuery = workOrderPagesQuery("3");
$pubQuery = workOrderPagesQuery("1,3", true);

?>

<link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css" />
<link rel="stylesheet" href="assets/modules/izit.css">

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>

            <?php
            getTopBar();
            getNavbar($USER_ARRAY['user_type_mod_id']);



            ?>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <?php getPageTitle("Sales Order - Sales"); ?>
                    <!-- TOP CONTENT BLOCKS -->
                    <?php
                    $getMaster = mysqlSelect("select * from sales_groups_master order by sgm_name ");

                    if (is_array($getMaster)) {
                        foreach ($getMaster as $Master) {
                    ?>
                            <div class="row">
                                <div class="col-12 ">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h4><?php echo $Master['sgm_name'] ?></h4>
                                        </div>
                                        <div class="card-body text-justify">
                                            <table class="table table-striped table-bordered " id="DraftsContainerTable">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Role</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $getPeeps = mysqlSelect("select s.*, concat(u.lum_code, ' ', u.lum_name) as disp_name, t.user_type_name from sales_groups_people s 
                                                    left join user_main u on sgp_lum_id = lum_id
                                                    left join user_types t on u.lum_user_type = t.user_type_id
                                                    where sgp_sgm_id =".$Master['sgm_id']);

                                                    if (is_array($getPeeps)) {
                                                        foreach ($getPeeps as $Peep) {
                                                    ?>
                                                            <tr>
                                                                <td><?php echo $Peep['disp_name']; ?></td>
                                                                <td><?php echo $Peep['user_type_name']; ?></td>
                                                                <td>
                                                                    <form action="server_fundamentals/AdminController" method="POST">
                                                                        <input type="hidden" name="del_user_group" value="<?php echo $Peep['sgp_id']; ?>" />
                                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                    <?php
                                                        }
                                                    }
                                                    ?>

                                                    <tr>
                                                        <form action="server_fundamentals/AdminController" method="POST">
                                                            <input type="hidden" name="user_group_add" value="<?php echo $Master['sgm_id'] ?>" />
                                                            <td colspan="2" > 
                                                                <select class="form-control" name="user_id">
                                                                    <?php
                                                                    $getAllUsers = mysqlSelect("select * from user_main where lum_valid =1");
                                                                    foreach($getAllUsers as $UserOne){
                                                                    ?>
                                                                        <option value="<?php echo $UserOne['lum_id']; ?>"><?php echo $UserOne['lum_code']." ".$UserOne['lum_name'] ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </td>     
                                                            <td><button type="submit" class="btn btn-success">Add to Group</button></td>
                                                        </form>
                                                    </tr>
                                                </tbody>

                                            </table>

                                            <p>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>




                </section>



            </div><!-- Main Content  -->

            <?php
            getFooter();
            ?>

        </div><!-- Main Wrapper  -->
    </div><!-- App -->
    <?php

    getScripts();
    ?>


</body>

</html>