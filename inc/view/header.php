<?php
/**
 * AgorActu
 *
 * RSS agregator with anonymous comments
 *
 * @link      https://github.com/rachyandco/agoractu/wiki
 * @copyright 2012 Swiss Pirate Party (www.partipirate.ch)
 * @version   0.1
 */
?><!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Agoractu - L'actualité romande sans censure</title>
		<link rel="stylesheet" type="text/css" href="<?php echo $this->basePath() ?>css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $this->basePath() ?>css/bootstrap-responsive.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $this->basePath() ?>css/jquery.ias.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $this->basePath() ?>css/agoractu.css">
<?php
// the client can already start to download files, while we finish preparing the view
flush();
?>
	</head>
	<body>
		<div class="navbar navbar-inverse">
			<div class="navbar-inner">
 				<div class="container">
					<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="brand" href="<?php echo $this->basePath() ?>">AgorActu</a>
					<div class="nav-collapse collapse">
						<ul class="nav">
							<li class="dropdown"><a id="drop1" role="button" class="dropdown-toggle" data-toggle="dropdown" href="#">Les Articles<b class="caret"></b></a>
								<ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
									<li role=menuitem><a tabindex="-1" href="<?php echo $this->basePath() ?>">Tous les derniers</a></li>
									<li role=menuitem><a tabindex="-1" href="<?php echo $this->basePath() ?>most-comments">Les Articles les plus commentés</a></li>
									<li role=menuitem><a tabindex="-1" href="<?php echo $this->basePath() ?>last-comments">Les derniers commentaires</a></li>
								</ul>
							</li>
							<li><a href="<?php echo $this->basePath() ?>feeds">Liste des feeds</a></li>
							<li class="divider-vertical"></li>
							<li><a data-toggle="modal" href="#ModalPropos">A Propos</a></li>
						</ul>
						<form class="navbar-search pull-left" method="post" action="<?php echo $this->basePath() ?>">
							<input class="search-query" type="text" name="search" value="" placeholder="Search">
							<input class="hidden" type="submit" value="Submit" />
						</form>
					</div>
				</div>
			</div>
		</div>
		<header class="jumbotron subhead" id="overview">
			<div class="container">
				<h1>AgorActu</h1>
				<p class="lead">Le concentré de la presse romande avec des commentaires anonymes.</p>
			</div>
		</header>
<?php // modal box for info start ?>
		<div class="modal hide fade" id="ModalPropos" tabindex="-1" role="dialog" aria-labelledby="ModalProposLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="ModalProposLabel">A Propos d'Agoractu</h3>
			</div>
			<div class="modal-body">Agregateur de feed RSS pour commenter anonymement.</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
				</div>
			</div>
<?php // modal box for info end ?>
