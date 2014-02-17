<?php

	/************* CONFIG *******************/
	// API Key from ypool.net
	$api_key = 'XXXXXXXXXXXXXXXXXXXXXXXX';
	// Coins: XPM, FTC, PTS, DOGE, MTC, RIC
	$coins = array('XPM', 'RIC', 'DOGE');

	
	/*********** DO NOT CHANGE **************/
	$workers = array();
	$personal_stats = array();
	foreach($coins as $c){
		$workers[$c] = json_decode(file_get_contents('http://ypool.net/api/workers?coinType='.$c.'&key='.$api_key), true);
		$personal_stats[$c] = json_decode(file_get_contents('http://ypool.net/api/personal_stats?coinType='.$c.'&key='.$api_key), true);
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>MinerDash</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="icon/favicon.ico" type="image/x-icon" />
<link href="css/bootstrap.css" rel="stylesheet" media="screen">
<link href="css/custom.css" rel="stylesheet" media="screen">
</head>
<body>
<div class="container">
<div class="page-header">
	<h1>MinerDash <small>YPool.net worker dashboard</small></h1>
</div>
<div class="row">
	<div class="col-xs-2">
        <ul class="nav nav-tabs tabs-left">
		  <?php
			  $i = 1;
			  foreach($coins as $c){
				echo '<li '.($i == 1 ? 'class="active"' : '').'><a href="#'.$c.'" data-toggle="tab">'.$c.'</a></li>';
				$i++;
			  }
		  ?>
        </ul>
	</div>
	<div class="col-xs-9">
        <div class="tab-content">
			<?php $i = 1; foreach($coins as $c){ ?>
			<div class="tab-pane <?= ($i == 1 ? 'active' : '') ?>" id="<?= $c ?>">
				<div class="row">
					<article class="col-sm-4 col-xs-6">
						<div class="data-block plan-block">
							<section id="current_price"><h3><?= $personal_stats[$c]['balance'] ?></h3><p>Balance</p></section>
						</div>
					</article>
					<article class="col-sm-4 col-xs-6">
						<div class="data-block plan-block">
							<section>
								<h3><?= $personal_stats[$c]['unconfirmedBalance'] ?></h3>
								<p>Unconfirmed (<?= $c ?>)</p>
							</section>
						</div>
					</article>
					<article class="col-sm-4 col-xs-6">
						<div class="data-block plan-block">
							<section>
								<h3><?= $personal_stats[$c]['shareValueCurrentRound'] ?></h3>
								<p>Shares</p>
							</section>
						</div>
					</article>
				</div>

				<table class="table table-hover">
					<thead>
					<tr>
					  <th>#</th>
					  <th>Worker name</th>
					  <th>Workser status</th>
					  <th>Connected clients</th>
					</tr>
					</thead>
					<tbody>
					<?php
						$ii = 1;
						foreach($workers[$c]['workers'] as $w){
							
						echo '<tr>
						  <td>'.$ii.'</td>
						  <td>'.$w['workerName'].'</td>
						  <td>'.($w['isActive'] > 0 ? "<span class=\"label label-success\">Active</span>" : "<span class=\"label label-primary\">Inactive</span>").'</td>
						  <td>'.$w['isActive'].'</td>
						</tr>';
						$ii++;
						}
					?>
					</tbody>
				</table>
			</div>
			<?php $i++; } ?>
        </div>
	</div>
</div>
<div class="footer">
	<p>Github <a href="https://github.com/Edocsyl/MinerDash">MinerDash</a></p>
</div>
</div>
<script src="http://code.jquery.com/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
</script>
</body>
</html>