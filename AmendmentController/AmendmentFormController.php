<?php
require_once("../server_fundamentals/SessionHandler.php");
require_once("AmendmentHelper.php");

/*
1 	Generated Amendment Form
2 	Requesting Sale Verification
3 	Sales Verifier Rejected Amendment
4 	Requesting Accounts Approval
5 	Accounts Rejected Amendment
6 	Requesting Technical Verification
7 	Technical Rejected Verification
8 	Requesting Planning Verification
9 	Planning Rejected Verification
10 	Amendment Accepted
99 	Discarded
*/

if (!isset($_POST['afm_ref'])) {
    die("Invalid Amendment Form Submitted");
}

if (!isset($_POST['from'])) {
    die("Invalid From Status");
}

if (!isset($_POST['to'])) {
    die("Invalid To Status");
}
# VERIFICATION CHECKS

## Check if work orders exists
$WorkOrderMain = mysqlSelect(workOrderPagesQuery("1,2,3,10", true, $_POST['afm_ref']));

if (is_array($WorkOrderMain)) {
    $WorkOrderMain = $WorkOrderMain[0];
} else {
    die('Invalid Work Order Supplied');
}

## If this amendment is currently being verified or open
$checkIn = mysqlSelect(getRawAmendmentQuery(
    $_POST['from'],
    false,
    false,
    $_POST['afm_ref']
));

if (!is_array($checkIn)) {
    die("This amendment form doesn't exist for this status");
}


# PRE FORM CREATION CHECKS END

$logText = $USER_ARRAY['lum_code'] . " - " . $USER_ARRAY['lum_name'] . " has published amendment form with ID: " .
    $checkIn[0]['afm_id'] . " and REF:" . $_POST['afm_ref'] . " STATUS (" . $checkIn[0]['afm_status'] . ", " . $_POST['to'] . ")";

# TODO add user account checks


if ($_POST['to'] < 1 || ($_POST['to'] > 10 && $_POST['to'] != 99)) {
    die("Invalid Landing Status Selected");
}
$extraCol = "";
$extraRow = "";

if ($_POST['to'] == 3 || $_POST['to'] == 5 || $_POST['to'] == 7 || $_POST['to'] == 9) {
    echo "<p style='color:red;'>";
    checkPost("reason", true);
    echo "</p>";

    $extraCol = "`afm_reject_lum_id`, `afm_reject_text`, ";
    $extraRow = " '" . $USER_ARRAY['lum_id'] . "','" . $_POST['reason'] . "', ";
    $logText = $USER_ARRAY['lum_code'] . " - " . $USER_ARRAY['lum_name'] .
        " rejected amendment form with ID: " . $checkIn[0]['afm_id'] . " and REF:" . $_POST['afm_ref'] . " reason :" . $_POST['reason'] 
        . " STATUS (" . $checkIn[0]['afm_status'] . ", " . $_POST['to'] . ")";
}
$insertSQL = mysqlInsertData("INSERT INTO `amendment_form_main`(`afm_rel_wo_ref`, `afm_reason`, `afm_mod_1`, `afm_mod_2`, `afm_mod_3`, 
    `afm_notes`, `afm_gen_lum_id`, `afm_gen_dnt`, " . $extraCol . " `afm_status`)
     VALUES (
         " . $_POST['afm_ref'] . ",
         '" . $checkIn[0]['afm_reason'] . "',
         '" . $checkIn[0]['afm_mod_1'] . "',
         '" . $checkIn[0]['afm_mod_2'] . "',
         '" . $checkIn[0]['afm_mod_3'] . "',
         '" . $checkIn[0]['afm_notes'] . "',
         '" . $USER_ARRAY['lum_id'] . "',
         '" . time() . "',
         " . $extraRow . "
         '" . $_POST['to'] . "'

     )", true);

if (!is_numeric($insertSQL)) {
    die("Could not publish this amendment form, contact Admin");
}
logInsert(
    basename($_SERVER['PHP_SELF']),
    $_SESSION[SESSION_HASH_NAME],
    $USER_ARRAY['lum_id'],
    $_SERVER['REMOTE_ADDR'],
    $logText,
    "mysqlInsertData"
);

die("This action has been successfully completed.");
