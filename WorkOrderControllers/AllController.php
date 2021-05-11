<?php
require_once("../server_fundamentals/SessionHandler.php");
require_once("../AmendmentController/AmendmentHelper.php");

if (isset($_POST['rowDiffChecker']) && isset($_POST['ids']) && isset($_POST['not_ski'])) {
    if (is_numeric(($_POST['rowDiffChecker'])) && is_numeric($_POST['not_ski'])) {
        $notIn = false;
        if ($_POST['not_ski'] == 1) {
            $notIn = true;
        }

        $getDrafts = mysqlSelect(workOrderPagesQuery($_POST['ids'], $notIn));

        $nos = 0;
        if (is_array($getDrafts)) {
            $nos = count($getDrafts);
        }
        if ($nos != $_POST['rowDiffChecker']) {
            echo $nos;
            die();
        } else {
            echo "0";
            die();
        }
    }
}

if (isset($_POST['amendRowDiffChecker']) && isset($_POST['ids']) && isset($_POST['not_ski'])) {
    if (is_numeric(($_POST['amendRowDiffChecker'])) && is_numeric($_POST['not_ski'])) {
        $notIn = false;
        if ($_POST['not_ski'] == 1) {
            $notIn = true;
        }

        if ($_POST['sales'] == 1) {
            $pubQuery = getWOSales($USER_ARRAY);
        } else {
            $pubQuery = getPubQuery();
        }

        $getDrafts = mysqlSelect(getAmendmentWrapped($pubQuery, $_POST['ids'], $notIn));

        $nos = 0;
        if (is_array($getDrafts)) {
            $nos = count($getDrafts);
        }
        if ($nos != $_POST['amendRowDiffChecker']) {
            echo $nos;
            die();
        } else {
            echo "0";
            die();
        }
    }
}
