<?php
include '../../engine/configdb_for_ajax_datatable.php'; 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

$table = 'categorymaincategory';

 
// Table's primary key
$primaryKey = 'CATEGORYID';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case object
// parameter names
$columns = array(
    array( 'db' => 'CATEGORYID', 'dt' => 0),
    array( 'db' => 'GROUPS', 'dt' => 1),
    array( 'db' => 'MAINCATEGORYNAME', 'dt' => 2),
    array( 'db' => 'CATEGORYNAME', 'dt' => 3),
    array( 'db' => 'DESCRIPTION', 'dt' => 4),
    array(
        'db'        => 'DATECREATE',
        'dt'        => 5,
        'formatter' => function( $d, $row ) {
            return date( 'jS F Y', strtotime($d));
        }
    ),
    array( 'db' => 'CATEGORYID', 'dt' => 6),
    array( 'db' => 'COLOR', 'dt' => 7)
);
  
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( '../../assets/helpers/ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_config, $table, $primaryKey, $columns )
);