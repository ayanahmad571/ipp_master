<?php
require_once("../server_fundamentals/SessionHandler.php");


// DB table to use
$table = 'master_work_order_main';
 
// Table's primary key
$primaryKey = 'master_wo_id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'master_wo_ref',  'dt' => 0 ),
    array( 'db' => 'client_name',  'dt' => 1 ),
    array( 'db' => 'master_wo_design_id',   'dt' => 2 ),
    array( 'db' => 'sales_full',     'dt' => 3 ),
    array( 'db' => 'gen_full',     'dt' => 4 ),
    array(
        'db'        => 'master_wo_gen_dnt',
        'dt'        => 5,
        'formatter' => function( $d, $row ) {
            return date( 'd-m-Y @ h:i:s a', ($d));
        }
    ),
    array(
        'db'        => 'master_wo_ref',
        'dt'        => 6,
        'formatter' => function( $d, $row ) {
            return '<button onclick="openWindow('.$d.')" class="btn btn-primary mt-1">View</button>';
        }
    )    
);
 
// SQL server connection information
$sql_details = array(
    'user' => DB_USER,
    'pass' => DB_PASS,
    'db'   => DB_NAME,
    'host' => DB_HOST
);
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( 'ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, 9)
);
?>