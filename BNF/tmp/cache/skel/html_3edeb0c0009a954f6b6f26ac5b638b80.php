<?php

/*
 * Squelette : squelettes/inclure/tete.html
 * Date :      Thu, 25 May 2017 20:30:30 GMT
 * Compile :   Fri, 26 May 2017 08:26:48 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette squelettes/inclure/tete.html
// Temps de compilation total: 0.501 ms
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
	<meta name="description" content="La France en Amérique" />
	<meta name="keywords" content="La France en Amérique, à la découverte du Canada" />
	<meta name="author" content="Hugo Chaimovitch, Anthony Marques et Cédric Leduc" />

 <!-- formulairesimple -->
<link rel="stylesheet" href="https://unpkg.com/purecss@0.6.2/build/pure-min.css" integrity="sha384-UQiGfs9ICog+LwheBSRCt1o5cbyKIHbwjWscjemyBMT9YCUMZffs6UqUTd0hObXD" crossorigin="anonymous">

<!-- Font awesome-->
<link rel="stylesheet" href="' .
find_in_path('font-awesome-4.7.0/css/font-awesome.min.css') .
'">
<link rel="stylesheet" href="' .
find_in_path('css/leaflet.awesome-markers.css') .
'">

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
	<link rel="icon" href="' .
find_in_path('favicon.ico') .
'" type="image/x-icon">

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

<!--leaflet-->
<link rel="stylesheet" href="' .
find_in_path('css/leaflet.css') .
'" />



	</head>
	<body>
');

	return analyse_resultat_skel('html_3edeb0c0009a954f6b6f26ac5b638b80', $Cache, $page, 'squelettes/inclure/tete.html');
}
?>