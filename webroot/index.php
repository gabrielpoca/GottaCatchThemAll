<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link href="main.css" rel="stylesheet" type="text/css">
        <title>GottaaCatchThemAll</title>
    </head>
    <body style="position:relative">
	<div style="position:absolute;top:0;left:0;">
	    <embed src="sounds/gottacatchemall.mp3" style="width:100px;height:10px"  />
	</div>
	<?php
	require_once 'database.php';

	initConfigs();

	if (isset($_GET['all']) && $_GET['all']) {
	    $query = "SELECT * FROM " . $sql_users_table;
	} else {
	    $query = "SELECT * FROM " . $sql_users_table . " LIMIT 30";
	}
	
	$result = queryDatabase($query);
	?>
	
	<h1>Gotta Catch 'em All</h1>
	<a href="index.php?all=true">Show All</a>
	<div id="content">
	    
	    <?php
	    //while ($entry = sqlite_fetch_array($result, SQLITE_ASSOC)) :
	    for ($k = 1; $entry = sqlite_fetch_array($result, SQLITE_ASSOC); ++$k) :
		?>
    	    <div class="row">
    		<div class="count"><?php
	    if ($entry['count'] != '30')
		echo '<span class="normal">', $entry['count'], '</span>';
	    else
		echo '<span class="caralho">', $entry['count'], '<br />Caralho</span>';
		?></div>
    		<div class="img"><?php echo "<img src=" . $entry['avatar'] . " />"; ?></div>
    		<div class="clear"></div>
    		<div class="nick"><?php echo "<a href='https://codebits.eu/", $entry['nick'] . "'>", $k, '.&nbsp;&nbsp;&nbsp;', $entry['nick'] . "</a>" ?></div>
    	    </div>

	    <?php endfor; ?>

	    <?php
	    endConfigs();
	    ?>

	</div>
	<div class="clear"></div>
	<div id="ft">
	    por <a href="https://codebits.eu/Chew118">Gabriel Poca</a>&nbsp;|&nbsp;<a href="https://codebits.eu/pfac">Pedro Costa</a>&nbsp;|&nbsp;<a href="https://codebits.eu/naps62">Miguel Palhas</a>&nbsp;|&nbsp;<a href="https://codebits.eu/PilhasII">José Alves</a>   
	</div>

    </body>
</html>
