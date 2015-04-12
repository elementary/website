<?php

function Breadcrumbs($Breadcrumbs) {

	$Crumbs = array();
	while (!empty($Breadcrumbs)) {
		$Offset = strrpos($Breadcrumbs, '/');
		$Crumb = substr($Breadcrumbs, $Offset + 1);
		$Crumbs[$Crumb] = $Breadcrumbs;
		$Breadcrumbs = substr($Breadcrumbs, 0, $Offset);
	}
	$Crumbs['MDR'] = '/';
	$Crumbs = array_reverse($Crumbs);

	return $Crumbs;

}