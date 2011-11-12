
<?php

require_once 'database.php';

initConfigs();
queryDatabase("DELETE FROM ".$sql_user_badge_table);

$badgesURL = "https://services.sapo.pt/Codebits/listbadges";
// to add user id
$badgesUsersURL = "https://services.sapo.pt/Codebits/badgesusers/";

$badgesArray = json_decode(file_get_contents($badgesURL));

foreach ($badgesArray as $b) {
    // Get Badge Array
    $oBadgeArray = objectToArray($b);
    // Get Badge ID
    $badgeID = $oBadgeArray['id'];
    // Badge -> Users Array
    $oBadgeUserArray = objectToArray(json_decode(file_get_contents("$badgesUsersURL$badgeID")));
    // Loop Users
    foreach ($oBadgeUserArray as $c) {
	insertBadgeUser($c['uid'], $badgeID);
    }
}

endConfigs();

?>
   
