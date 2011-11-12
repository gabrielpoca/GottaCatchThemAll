<?php

require_once 'database.php';

initConfigs();

queryDatabase("DELETE FROM " . $sql_users_table);

/* DEFINES */
$username = '';
$password = '';

$select_query = "SELECT id, count(*) FROM " . $sql_user_badge_table . " GROUP BY id ORDER BY count(*) DESC";

$insert_query = "INSERT INTO " . $sql_users_table . " (id, nick, avatar, count) VALUES ";
$update_query_init = "UPDATE " . $sql_users_table . " SET cout=";
$update_query_end = " WHERE id=";

$user_info_url = "https://services.sapo.pt/Codebits/user/";

$token_request = "https://services.sapo.pt/Codebits/gettoken?user=$username&passwo$passwordd";
$user_info_url = "https://services.sapo.pt/Codebits/user/";

/* MAIN */
$token_array = objectToArray(json_decode(file_get_contents($token_request)));
$token = $token_array['token'];
$user_info_end_token = "?token=" . $token;

$result = queryDatabase($select_query);

while ($entry = sqlite_fetch_array($result, SQLITE_ASSOC)) {

    $user_info_array = objectToArray(json_decode(file_get_contents($user_info_url . $entry['id'] . $user_info_end_token)));

    $tmp_select = queryDatabase("SELECT id FROM " . $sql_users_table . " WHERE id=" . $entry['id']);
    
    if (!sqlite_fetch_array($tmp_select, SQLITE_ASSOC)) {
	echo "INSERT ".$entry['id']."\n";
	$insert_query_tmp = $insert_query . " ('" . $entry['id'] . "','" . $user_info_array['nick'] . "','" . $user_info_array['avatar'] . "','" . $entry['count(*)'] . "')";
	queryDatabase($insert_query_tmp);
    } else {
	echo "UPDATE ".$entry['id']."\n";
	$update_query_tmp = $update_query_init.$entry['count'].$update_query_end;
	queryDatabase($update_query_tmp);
    }
}

endConfigs();
?>
