<?php
require_once("server_fundamentals/SessionHandler.php");

getHead("Master Materials");
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
                                    <h4>All Materials (Live Display Order)</h4>
                                </div>
                                <div class="card-body text-justify">
                                    <table class="table table-striped table-bordered ">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Density</th>
                                                <th>Show</th>
                                                <th>Position</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>


                                        <tbody>
                                            <?php
                                            $getMats = mysqlSelect("SELECT * FROM `materials_main` order by material_position,material_id asc");
                                            if (is_array($getMats)) {
                                                $c = 1;
                                                foreach ($getMats as $Mat) {
                                            ?>
                                                    <form action="MasterControllers/MaterialsController.php" method="POST">
                                                        <input type="hidden" name="material_id" value="<?php echo $Mat['material_id'] ?>" />
                                                        <tr>
                                                            <td><?php echo $c ?></td>
                                                            <td><input type="text" required class="form-control" name="material_name" value="<?php echo $Mat['material_value'] ?>" /></td>
                                                            <td><input type="text" required class="form-control" name="material_density" value="<?php echo $Mat['material_density'] ?>" /></td>
                                                            <td><input type="number" min="0" max="1" step="1" required class="form-control" name="material_show" value="<?php echo $Mat['material_show'] ?>" /></td>
                                                            <td><input type="number" min="1" required class="form-control" name="material_position" value="<?php echo $Mat['material_position'] ?>" /></td>
                                                            <td><button class="btn btn-warning" type="submit">Save</button></td>
                                                        </tr>
                                                    </form>
                                            <?php
                                                    $c++;
                                                }
                                            }
                                            ?>
                                            <tr>
                                                <form action="MasterControllers/MaterialsController.php" method="POST">
                                                    <td>NEW</td>
                                                    <td><input type="text" required class="form-control" name="add_material_name" placeholder="Name" /></td>
                                                    <td><input type="text" required class="form-control" name="add_material_density" placeholder="Density" /></td>
                                                    <td>VISIBLE</td>
                                                    <td><input type="number" min="1" required class="form-control" name="add_material_position" placeholder="Position" /></td>
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