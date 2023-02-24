<?php  
namespace templates;
include __DIR__ .'/PageConfig.php';

class page {
	private $config;
	private $title;
	private $absUrl;
	private $metaHeaders = "";
	private $author = "";
	private $mode = "image";
	private $serverUrl = "";

	function __construct($title) {
		$this->config = new \PageConfig();
		$this->title = $title;
		$this->serverUrl = "//".$_SERVER['SERVER_NAME'];
		$this->absUrl = $this->serverUrl."/templates/multiverse";
    }

	function SetAuthor($name){
		$this->author = " by ".$name;
	}
	
	function SetHeaders($headers){
		$this->metaHeaders = $headers;
	}

	function SetLinkMode(){
		$this->mode = "link";
	}

	function SetImageGalleryMode(){
		$this->mode = "image";
	}

	function Print($rows,$linkColumn,$imageColumn,$titleColumn,$DescriptionColumn,$altColumn,$domainColumn){
		$vars = $this->config;
		echo "<!DOCTYPE HTML>
	<html>
		<head>
			<title>$this->title</title>
			<meta charset=\"utf-8\" />
			<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, user-scalable=no\" />
			<link rel=\"stylesheet\" href=\"$this->absUrl/assets/css/main.css\" />
			<noscript><link rel=\"stylesheet\" href=\"$this->absUrl/assets/css/noscript.css\" /></noscript>
			$this->metaHeaders 
			<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
			<style>
			@media screen and (max-width: 650px) {
				#header h1 {
					display: none;
					}
				}
				@media screen and (max-width: 470px) {
					#header nav > ul > li.categoryextra {
					display: none;
				}
				@media screen and (max-width: 350px) {
					#header nav > ul > li.category {
					display: none;
				}
			}
		  </style>
		</head>
		
		<body class=\"is-preload\">

			<!-- Wrapper -->
				<div id=\"wrapper\">

					<!-- Header -->
						<header id=\"header\">
							<h1><a href=\"index.html\"><strong>$this->title</strong>$this->author</a></h1>
							<nav>
								<ul>
									<li class=\"category\"><a class=\"icon solid fa-gamepad\" style=\"cursor: pointer;\" href=\"$this->serverUrl/game\">games</a></li>
									<li class=\"category\"><a class=\"icon solid fa-film\" style=\"cursor: pointer;\" href=\"$this->serverUrl/animation\">animations</a></li>
									<li class=\"categoryextra\"><a class=\"icon solid fa-newspaper\" style=\"cursor: pointer;\" href=\"$this->serverUrl/post\">articles</a></li>
									<li><a href=\"#footer\" class=\"icon solid fa-info-circle\">About</a></li>
								</ul>
							</nav>
						</header>
					<!-- Main -->
						<div id=\"main\">";
		if (count($rows) > 0) {
			foreach ($rows as $row) {
				echo "
				<a href=\"".$row[$domainColumn]."\" ><article class=\"thumb\">
									<a href=\"".$row[$domainColumn]."\" class=\"$this->mode\" ><img src=\"".$row[$imageColumn]."\" alt=\"".$row[$altColumn]."\" /></a>
									<h2>".$row[$titleColumn]."</h2>
									<p>".$row[$DescriptionColumn]."</p>
								</article></a>
				";
			}
		}

		echo "
						</div>

					<!-- Footer -->
						<footer id=\"footer\" class=\"panel\">
							<div class=\"inner split\">
								<div>
									<section>
										<h2>$vars->FOOTER_TITLE</h2>
										<p>$vars->FOOTER_DESC</p>
									</section>
									<section>
									<ul>
										<li><a class=\"icon solid fa-gamepad\" style=\"cursor: pointer;\" href=\"$this->serverUrl/game\">games</a></li>
										<li><a class=\"icon solid fa-film\" style=\"cursor: pointer;\" href=\"$this->serverUrl/animation\">animations</a></li>
										<li><a class=\"icon solid fa-newspaper\" style=\"cursor: pointer;\" href=\"$this->serverUrl/post\">articles</a></li>
									</ul>
									</section>";
		
		if($vars->SOCIAL_ENABLE){
			echo "
									<section>
										<h2>$vars->SOCIAL_TITLE</h2>
										<ul class=\"icons\">";
			if($vars->SOCIAL_TWITTER){
				echo "
											<li><a href=\"$vars->SOCIAL_TWITTER\" class=\"icon brands fa-twitter\"><span class=\"label\">Twitter</span></a></li>";
			}
			if($vars->SOCIAL_FACEBOOK){
				echo "										
											<li><a href=\"$vars->SOCIAL_FACEBOOK\" class=\"icon brands fa-facebook-f\"><span class=\"label\">Facebook</span></a></li>";
			}
			if($vars->SOCIAL_INSTAGRAM){
				echo "
											<li><a href=\"$vars->SOCIAL_INSTAGRAM\" class=\"icon brands fa-instagram\"><span class=\"label\">Instagram</span></a></li>";
			}
			if($vars->SOCIAL_GITHUB){
				echo "
											<li><a href=\"$vars->SOCIAL_GITHUB\" class=\"icon brands fa-github\"><span class=\"label\">GitHub</span></a></li>";
			}
			if($vars->SOCIAL_DRIBBLE){
				echo "
											<li><a href=\"$vars->SOCIAL_DRIBBLE\" class=\"icon brands fa-dribbble\"><span class=\"label\">Dribbble</span></a></li>";
			}
			if($vars->SOCIAL_LINKEDIN){
				echo "
											<li><a href=\"$vars->SOCIAL_LINKEDIN\" class=\"icon brands fa-linkedin-in\"><span class=\"label\">LinkedIn</span></a></li>";
			}
		echo "
										</ul>
									</section>";
		}
		echo "
									<p class=\"copyright\">
										&copy; $vars->COPYRIGHT. Design: <a href=\"http://html5up.net\">HTML5 UP</a>.
									</p>
								</div>
								<div>";
		if($vars->CONTACT_ENABLE){
			echo"
									<section>
										<h2>$vars->CONTACT_TITLE</h2>
										<form method=\"post\" action=\"#\">
											<div class=\"fields\">
												<div class=\"field half\">
													<input type=\"text\" name=\"name\" id=\"name\" placeholder=\"Name\" />
												</div>
												<div class=\"field half\">
													<input type=\"text\" name=\"email\" id=\"email\" placeholder=\"Email\" />
												</div>
												<div class=\"field\">
													<textarea name=\"message\" id=\"message\" rows=\"4\" placeholder=\"Message\"></textarea>
												</div>
											</div>
											<ul class=\"actions\">
												<li><input type=\"submit\" value=\"Send\" class=\"primary\" /></li>
												<li><input type=\"reset\" value=\"Reset\" /></li>
											</ul>
										</form>
									</section>";
		}
		echo "
								</div>
							</div>
						</footer>

				</div>

			<!-- Scripts -->
				<script src=\"$this->absUrl/assets/js/jquery.min.js\"></script>
				<script src=\"$this->absUrl/assets/js/jquery.poptrox.min.js\"></script>
				<script src=\"$this->absUrl/assets/js/browser.min.js\"></script>
				<script src=\"$this->absUrl/assets/js/breakpoints.min.js\"></script>
				<script src=\"$this->absUrl/assets/js/util.js\"></script>
				<script src=\"$this->absUrl/assets/js/main.js\"></script>

		</body>
	</html>";
	}
}
?>