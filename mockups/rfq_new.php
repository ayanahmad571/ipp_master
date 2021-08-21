<?php
$MockupTitle = "RFQ Generate";
?>
<?php
function mockupText($title, $col)
{
?>
    <div class="form-group col-<?php echo $col; ?>">
        <label><?php echo $title; ?></label>
        <input type="text" class="form-control">
    </div>
<?php
}

function mockupDrop($title, $col, $options)
{
?>
    <div class="form-group col-<?php echo $col; ?>">
        <label><?php echo $title; ?></label>
        <select class="form-control">
            <?php
            if (is_array($options)) {
                foreach ($options as $opt) {
            ?>
                    <option><?php echo $opt; ?></option>
            <?php
                }
            }
            ?>
        </select>
    </div>
<?php
}

function mockupTabs($title, $col, $options)
{
?>
    <div class="form-group col-<?php echo $col; ?>">
        <label><?php echo $title; ?></label>

        <div class="selectgroup selectgroup-pills">
            <?php
            if (is_array($options)) {
                foreach ($options as $opt) {
            ?>
                    <label class="selectgroup-item">
                        <input type="checkbox" name="" value="1" class="selectgroup-input">
                        <span class="selectgroup-button"><?php echo $opt; ?></span>
                    </label>
            <?php
                }
            }
            ?>
        </div>
    </div>
<?php
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?php echo $MockupTitle; ?></title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Template CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/components.css">
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>



            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1><?php echo $MockupTitle; ?></h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                            <div class="breadcrumb-item"><a href="#">Forms</a></div>
                            <div class="breadcrumb-item"><?php echo $MockupTitle; ?></div>
                        </div>
                    </div>

                    <div class="section-body">

                        <div class="row">
                            <div class="col-12 ">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>RFQ Draft </h4>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <?php
                                            mockupText("Customer Name", 2);
                                            mockupTabs(
                                                "Customer Location",
                                                3,
                                                array("Local", "GCC", "Export")
                                            );
                                            mockupText("Port Name", 2);
                                            mockupDrop(
                                                "INCOTERMS",
                                                2,
                                                array("Option 1", "Option 2", "Option 3")
                                            );


                                            mockupText("Design Name", 2);
                                            mockupDrop(
                                                "Application",
                                                2,
                                                array("Baby Wipes", "Bird Seeds", "....")
                                            );
                                            mockupDrop(
                                                "Structure",
                                                2,
                                                array("Bag", "Pouch", "Roll")
                                            );
                                            mockupDrop(
                                                "EVIDENCE OF PRODUCT STRUCTURE",
                                                2,
                                                array("Sample", "JPG", "Customer Specs")
                                            );
                                            mockupDrop(
                                                "Qty Units",
                                                2,
                                                array("KGs", "KMs", "MTRs", "...")
                                            );
                                            mockupText("FG Order QTY", 2);
                                            mockupDrop(
                                                "FG Qty Units",
                                                2,
                                                array("KGs", "KMs", "MTRs", "...")
                                            );
                                            echo "</div><div class='row'>";
                                            mockupDrop(
                                                "Single Delivery?",
                                                2,
                                                array("Yes", "No")
                                            );
                                            mockupText("Number of Deliveries - if prev yes", 2);
                                            echo "</div><div class='row'>";
                                            mockupText("Date - Delivery 1", 4);
                                            mockupText("QTY  - Delivery 1", 4);
                                            mockupDrop(
                                                "Qty Units - Delivery 1",
                                                4,
                                                array("KGs", "KMs", "MTRs", "...")
                                            );
                                            mockupText("Date - Delivery 2", 4);
                                            mockupText("QTY  - Delivery 2", 4);
                                            mockupDrop(
                                                "Qty Units - Delivery 2",
                                                4,
                                                array("KGs", "KMs", "MTRs", "...")
                                            );

                                            mockupText("Cylinder Amortisation QTY", 4);
                                            mockupText("Sales Code", 4);
                                            mockupText("Commision", 4);
                                            echo "</div><div class='row'>Coil Details";
                                            echo "</div><div class='row'>";
                                            mockupText("Weight Per Coil", 3);
                                            mockupText("OD of a Coil", 3);
                                            mockupText("Meters of a Coil", 3);
                                            mockupText("Width of a Coil", 3);
                                            mockupText("FG Laminate GSM", 3);










                                            ?>



                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </section>
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
                </div>
                <div class="footer-right">
                    2.3.0
                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="../assets/js/stisla.js"></script>


    <!-- Template JS File -->
    <script src="../assets/js/scripts.js"></script>
    <script src="../assets/js/custom.js"></script>

    <!-- Page Specific JS File -->
    <script src="../assets/js/page/forms-advanced-forms.js"></script>
</body>

</html>