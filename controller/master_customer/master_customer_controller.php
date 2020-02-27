<?php
include '../../engine/configdb_for_ajax_datatable.php'; 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
 
// DB table to use
$table = 'customer';
 
// Table's primary key
$primaryKey = 'CUSTOMERID';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case object
// parameter names
$columns = array(
    array( 'db' => 'CUSTOMERID', 'dt' => 0),
    array( 'db' => 'FULLNAME', 'dt' => 1),
    array( 'db' => 'KTP', 'dt' => 2),
    array( 'db' => 'NPWP', 'dt' => 3),
    array( 'db' => 'ADDRESS', 'dt' => 4),
    array( 'db' => 'TELPHP', 'dt' => 5),
    array( 'db' => 'EMAIL', 'dt' => 6),
    array(
        'db'        => 'DATECREATE',
        'dt'        => 7,
        'formatter' => function( $d, $row ) {
            return date( 'jS F Y', strtotime($d));
        }
    ),
    array( 'db' => 'CUSTOMERID', 'dt' => 8),
);
  
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( '../../assets/helpers/ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_config, $table, $primaryKey, $columns )
);