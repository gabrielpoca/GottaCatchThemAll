<?php

$sql_user_badge_table = 'userbadge';
$sql_users_table = 'users';
$dbhandle;

/**
 * Initialize configurations.
 * @global type $dbhandle Database handler.
 * @global string $sql_user_badge_table Table name.
 */
function initConfigs() {
    global $dbhandle;
    global $sql_user_badge_table;

    /* Init Database */
    $dbhandle = sqlite_open('database.db', 0666, $error);
    if (!$dbhandle)
	die($error);
}

/**
 * End configurations.
 * @global type $dbhandle Database handler. 
 */
function endConfigs() {
    global $dbhandle;
    /* Close database */
    sqlite_close($dbhandle);
}

/**
 * Creates the database.
 * @global type $dbhandle Database handler.
 * @global string $sql_user_badge_table Table name.
 */
function createUserBadgeDatabase() {
    global $dbhandle;
    global $sql_user_badge_table;

    $createQuery = "CREATE TABLE " . $sql_user_badge_table . " (id INTEGER NOT NULL, bid INTEGER NOT NULL)";
    $execCreate = sqlite_exec($dbhandle, $createQuery);
    if (!$execCreate)
	die("Cannot execute query.");
}


function insertBadgeUser($uid, $bid) {
    global $dbhandle;
    global $sql_user_badge_table;
    $query = "INSERT INTO " . $sql_user_badge_table . " VALUES ( " . $uid . "," . $bid . ")";
    $execQuery = sqlite_exec($dbhandle, $query);
    if (!$execQuery)
	die("Cannot execute query.");
}


function queryDatabase($query) {
    global $dbhandle;

    return sqlite_query($dbhandle, $query);
}


function objectToArray($d) {
    if (is_object($d)) {
	// Gets the properties of the given object
	// with get_object_vars function
	$d = get_object_vars($d);
    }

    if (is_array($d)) {
	/*
	 * Return array converted to object
	 * Using __FUNCTION__ (Magic constant)
	 * for recursive call
	 */
	return array_map(__FUNCTION__, $d);
    } else {
	// Return array
	return $d;
    }
}

?>
