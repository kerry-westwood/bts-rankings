<div id="header">
	<div id="sys_nav">
		<ul>
			<li><a href="/" title="Logout">Logout</a></li>
			<li><a href="/" title="Back to main site">Back to main site</a></li>
		</ul>
	</div>
	<div class="small-12 columns">
		<?php $url = $_SERVER['REQUEST_URI']; ?>
		<ul id="nav">
			<li><a href="/admin/" title="Admin Home" id="icon_home" <?php if($url == "/admin/" || $url == "/admin/index.php") {echo "class=\"active\"";}?>>Admin Home</a></li>
			<li><a href="/admin/competitors/" title="Competitors" id="icon_people" <?php if(strpos($url, "/admin/competitors/")!== false){echo "class=\"active\"";}?>>Competitors</a></li>
			<li><a href="/admin/competitions/" title="Competitions" id="icon_comp" <?php if(strpos($url, "/admin/competitions/")!== false){echo "class=\"active\"";}?>>Competitions</a></li>
			<li><a href="/admin/rankings/" title="Rankings" id="icon_rank" <?php if(strpos($url, "/admin/rankings/")!== false){echo "class=\"active\"";}?>>Rankings</a></li>
			<li><a href="/admin/system/" title="System Admin" id="icon_sys" <?php if(strpos($url, "/admin/system/")!== false){echo "class=\"active\"";}?>>System Admin</a></li>
		</ul>
	</div>
	<br class="clear"/>
</div>