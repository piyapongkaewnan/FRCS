<?php

/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
 
require( '../../includes/DBConnect.php' );
require( 'ssp.class.php' );

class DataTableSS  extends SSP  {
	
var $GET;
// DB table to use
var $table;

// Table's primary key
var $primaryKey;
var $getVar;
var $whereAll;

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
var $columns = array();

// SQL server connection information
var $sql_details = array(
	'user' =>DB_USER ,
	'pass' =>DB_PASS ,
	'db'   => DB,
	'host' => DB_HOST
);


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
public function Init(){
	return SSP::complex( $this->GET, $this->sql_details, $this->table, $this->primaryKey, $this->columns , null , $this->whereAll );
}

}