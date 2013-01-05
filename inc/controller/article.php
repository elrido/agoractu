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

/**
 * article controller
 *
 * controls display of articles
 */
class articleController extends agoractu_controller_abstract
{
	/**
	 * list action
	 *
	 * @access public
	 * @return void
	 */
	public function listAction()
	{
		$search = $_POST["search"];
		$postid = $_GET["postid"];

		// pagination
		// find out how many rows are in the table
		$sql = "SELECT COUNT(*) FROM rssingest";
		$result = mysql_query($sql) or trigger_error("SQL", E_USER_ERROR);

		$r = mysql_fetch_row($result);
		$numrows = $r[0];

		// number of rows to show per page
		$rowsperpage = 10;
		// find out total pages
		$totalpages = ceil($numrows / $rowsperpage);

		// get the current page or set a default
		if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
			// cast var as int
			$currentpage = (int) $_GET['currentpage'];
		} else {
			// default page num
			$currentpage = 1;
		} // end if

		// if current page is greater than total pages...
		if ($currentpage > $totalpages) {
			// set current page to last page
			$currentpage = $totalpages;
		} // end if
		// if current page is less than first page...
		if ($currentpage < 1) {
			// set current page to first page
			$currentpage = 1;
		} // end if

		// the offset of the list, based on current page
		$offset = ($currentpage - 1) * $rowsperpage;

	}
}
