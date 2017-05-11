<?php

/*
 * Squelette : squelettes/inclure/tete.html
 * Date :      Thu, 11 May 2017 09:17:49 GMT
 * Compile :   Thu, 11 May 2017 09:31:05 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette squelettes/inclure/tete.html
// Temps de compilation total: 0.238 ms
//

function html_3edeb0c0009a954f6b6f26ac5b638b80($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>' .
interdire_scripts(typo($GLOBALS['meta']['nom_site'], "TYPO", $connect, $Pile[0])) .
'</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Template by FreeHTML5.co" />
	<meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
	<meta name="author" content="FreeHTML5.co" />

  <!-- 
	//////////////////////////////////////////////////////

	FREE HTML5 TEMPLATE 
	DESIGNED & DEVELOPED by FREEHTML5.CO
		
	Website: 		http://freehtml5.co/
	Email: 			info@freehtml5.co
	Twitter: 		http://twitter.com/fh5co
	Facebook: 		https://www.facebook.com/fh5co

	//////////////////////////////////////////////////////
	 -->
	  <!-- IIIF -->
	   <link rel="stylesheet" href="' .
find_in_path('css/iiif.css') .
'">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.2/dist/leaflet.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.0.2/dist/leaflet.js"></script>
    <script src="https://rawgit.com/mejackreed/Leaflet-IIIF/master/leaflet-iiif.js"></script>
    
  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

	<link href="https://fonts.googleapis.com/css?family=Inconsolata:400,700" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="' .
find_in_path('css/animate.css') .
'">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="' .
find_in_path('css/icomoon.css') .
'">
	<!-- Simple Line Icons -->
	<link rel="stylesheet" href="' .
find_in_path('css/simple-line-icons.css') .
'">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="' .
find_in_path('css/bootstrap.css') .
'">
	<!-- Style -->
	<link rel="stylesheet" href="' .
find_in_path('css/style.css') .
'">


	<!-- Modernizr JS -->
	<script src="' .
find_in_path('js/modernizr-2.6.2.min.js') .
'"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>');

	return analyse_resultat_skel('html_3edeb0c0009a954f6b6f26ac5b638b80', $Cache, $page, 'squelettes/inclure/tete.html');
}
?>