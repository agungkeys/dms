<?php
include '../../engine/configdb_for_ajax_datatable.php'; 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
 
// DB table to use
$table = 'cluster';
 
// Table's primary key
$primaryKey = 'CLUSTERID';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case object
// parameter names
$columns = array(
    array( 'db' => 'CLUSTERID', 'dt' => 0),
    array( 'db' => 'PROJECTNAME', 'dt' => 1),
    array( 'db' => 'KAVBLOK', 'dt' => 2),
    array( 'db' => 'KAVNO', 'dt' => 3),
    array( 'db' => 'TYPELB', 'dt' => 4),
    array( 'db' => 'TYPELT', 'dt' => 5),
    array( 'db' => 'EXCESSLAND', 'dt' => 6),
    array( 'db' => 'STATUS', 'dt' => 7),
    array(
        'db'        => 'DATECREATE',
        'dt'        => 8,
        'formatter' => function( $d, $row ) {
            return date( 'jS F Y', strtotime($d));
        }
    ),
    array( 'db' => 'CLUSTERID', 'dt' => 9),
);
  
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( '../../assets/helpers/ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_config, $table, $primaryKey, $columns )
);


