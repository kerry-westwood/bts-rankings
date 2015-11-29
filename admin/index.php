<!doctype html>
<!--[if lte IE 8]><html class="no-js lt-ie9" lang="en" ><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="en" ><!--<![endif]-->
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BTS Rankings - Admin/Competitions</title>
    <link rel="stylesheet" href="/style/normalize.css" />
    <link rel="stylesheet" href="/style/foundation.css" />
    
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/style/app.css" />
    <!--[if lte IE 8]>
		<link rel="stylesheet" href="/style/ie8-grid.css" />
	<![endif]-->
    <script src="/javascript/modernizr.js"></script>
</head>
<body>
	<div class="row" id="main">
		<?php include("../includes/admin/header.php"); ?>
		
		<div class="row">
			<div class="small-12 columns">
				<h1>Admin</h1>
				<p>To go on this page:</p>
				<ul>
					<li><em>Scores required</em></li>
					<li><em>Incomplete profiles</em></li>
				</ul>
				<p>Ignore content below</p>
			</div>
			<div class="small-6 columns">
				<h2>Competitor Management</h2>
				<ul>
					<li><a href="/admin/competitor/addcompform.html">Add Competitor</a></li>
					<li><a href="/admin/competitor/viewcomp.php">View Competitor</a></li>
					<li><a href="/admin/competitor/editcomp.php">Edit Competitor Details</a></li>
				</ul>
			</div>
			<div class="small-6 columns">
				<h2>Rankings Management</h2>
				<ul>
					<li><a href="/admin/ranking/newranking.php">Generate New Ranking</a></li>
				</ul>
			</div>
		</div>
	</div>

	<script src="/javascript/jquery.js"></script>
    <script src="/javascript/foundation.min.js"></script>
    <!--<script src="../javascript/foundation.accordian.js"></script>
    <script src="../javascript/foundation.clearing.js"></script>
    <script src="../javascript/foundation.reveal.js"></script>
    <script src="../javascript/foundation.tab.js"></script>
    <script src="../javascript/foundation.tooltip.js"></script>-->
	
	<script type="text/javascript">
		$(document).foundation(); 
	</script>
</body>
</html>