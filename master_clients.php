<?php
require_once("server_fundamentals/SessionHandler.php");

getHead("Master Clients");
?>

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
                    <?php getPageTitle("Master - Clients"); ?>
                    <!-- TOP CONTENT BLOCKS -->

                    <div class="row">
                        <div class="col-12 ">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h4>All Clients (Live Display Order)</h4>
                                </div>
                                <div class="card-body text-justify">
                                    <table class="table table-striped table-bordered ">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Code</th>
                                                <th>Name</th>
                                                <th>Visible</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>


                                        <tbody>
                                            <?php
                                            $getClients = mysqlSelect("SELECT * FROM `clients_main` order by client_name asc");
                                            if (is_array($getClients)) {
                                                $c = 1;
                                                foreach ($getClients as $Mat) {
                                            ?>
                                                    <form action="MasterControllers/ClientsController" method="POST">
                                                        <input type="hidden" name="client_id" value="<?php echo $Mat['client_id'] ?>" />
                                                        <tr>
                                                            <td><?php echo $c ?></td>
                                                            <td><input type="text" required class="form-control" name="client_code" value="<?php echo $Mat['client_code'] ?>" /></td>
                                                            <td><input type="text" required class="form-control" name="client_name" value="<?php echo $Mat['client_name'] ?>" /></td>
                                                            <td><input type="number" min="0" max="1" step="1" required class="form-control" name="client_show" value="<?php echo $Mat['client_show'] ?>" /></td>
                                                            <td><button class="btn btn-warning" type="submit">Save</button></td>
                                                        </tr>
                                                    </form>
                                            <?php
                                                    $c++;
                                                }
                                            }
                                            ?>
                                            <tr>
                                                <form action="MasterControllers/ClientsController" method="POST">
                                                    <td>NEW</td>
                                                    <td><input type="text" required class="form-control" name="add_client_code" placeholder="Code" /></td>
                                                    <td ><input type="text" required class="form-control" name="add_client_name" placeholder="Name" /></td>
                                                    <td>VISIBLE</td>
                                                    <td><button class="btn btn-success" type="submit">Add</button></td>
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