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

/* echo "<footer class=\"footer\">
      <div class=\"container\">

      </div>
    </footer>";
*/
//<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>

// include all javascripts at the bottom of the HTML file
?>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo $this->basePath() ?>js/jquery.ias.min.js"></script>
		<script type="text/javascript">jQuery.ias({loader:'<img src="<?php echo $this->basePath() ?>img/loader.gif">'});</script>
		<script type="text/javascript" src="<?php echo $this->basePath() ?>js/bootstrap.min.js"></script>
<?php if(strpos($this->self, 'admin')) { ?>
		<script type="text/javascript">setInterval(function(){$('div#adminrefresh').load('admin.php #adminrefresh');}, 5000);</script>
<?php } ?>
		<script type="text/javascript" src="//suyb.googlecode.com/files/jquery.ui.totop.js"></script>
		<script type="text/javascript" src="<?php echo $this->basePath() ?>js/agoractu.js"></script>
	</body>
</html>
