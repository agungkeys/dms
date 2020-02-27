<?php
include '../../engine/configdb_for_ajax_datatable.php'; 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
$table = 'viewtransactioncost';
 
// Table's primary key
$primaryKey = 'TRANSACTIONID';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case object
// parameter names
$columns = array(
    array( 'db' => 'TRANSACTIONID', 'dt' => 0),
    array( 'db' => 'GROUPS', 'dt' => 1),
    array( 'db' => 'MAINCATEGORYNAME', 'dt' => 2),
    array( 'db' => 'CATEGORYNAME', 'dt' => 3),
    array( 'db' => 'TRANSACTIONTITLE', 'dt' => 4),
    array( 'db' => 'CHEQUE', 'dt' => 5),
    array( 'db' => 'PROJECTNAME', 'dt' => 6),
    array( 'db' => 'AMOUNT', 'dt' => 7),
    array( 'db' => 'ACCOUNTNAME', 'dt' => 8),
    array( 'db' => 'CREATED', 'dt' => 9),
    array(
        'db'        => 'DATE',
        'dt'        => 10,
        'formatter' => function( $d, $row ) {
            return date( 'd-m-Y', strtotime($d));
        }
    ),
    array( 'db' => 'MAINCATEGORYID', 'dt' => 11),
    array( 'db' => 'ACCOUNTBANKNAME', 'dt' => 12)
);
  
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( '../../assets/helpers/ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_config, $table, $primaryKey, $columns )
);