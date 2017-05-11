<?php

/*
 * Squelette : squelettes/sommaire.html
 * Date :      Thu, 11 May 2017 09:20:15 GMT
 * Compile :   Thu, 11 May 2017 09:31:05 GMT
 * Boucles :   mcautTeam, autTeam, team, teaser, histoire, introduction, voy1, cartier, voy2, voyage2, voy3, voyage3
 */ 

function BOUCLEmcautTeamhtml_20bad19474852c2c1a99d7289d969071(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	if (!isset($command['table'])) {
		$command['table'] = 'mots';
		$command['id'] = 'mcautTeam';
		$command['from'] = array('mots' => 'spip_mots','L1' => 'spip_mots_liens');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("mots.titre");
		$command['orderby'] = array();
		$command['join'] = array('L1' => array('mots','id_mot'));
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	$command['where'] = 
			array(
			array('=', 'L1.id_objet', sql_quote($Pile[$SP]['id_auteur'], '', '')), 
			array('=', 'L1.objet', sql_quote('auteur')), 
			array('=', 'mots.id_groupe', "2"));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('squelettes/sommaire.html','html_20bad19474852c2c1a99d7289d969071','mcautTeam',125,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t1 = (
'
							      ' .
interdire_scripts(typo(supprimer_numero($Pile[$SP]['titre']), "TYPO", $connect, $Pile[0])) .
'
							      ');
		$t0 .= ((strlen($t1) && strlen($t0)) ? ',' : '') . $t1;
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLEmcautTeam @ squelettes/sommaire.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLEautTeamhtml_20bad19474852c2c1a99d7289d969071(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	if (!isset($command['table'])) {
		$command['table'] = 'auteurs';
		$command['id'] = 'autTeam';
		$command['from'] = array('auteurs' => 'spip_auteurs','L1' => 'spip_auteurs_liens');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("auteurs.id_auteur",
		"auteurs.nom",
		"auteurs.bio",
		"auteurs.email",
		"auteurs.url_site",
		"auteurs.input_1");
		$command['orderby'] = array();
		$command['join'] = array('L1' => array('auteurs','id_auteur'));
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	$command['where'] = 
			array(
quete_condition_statut('auteurs.statut','!5poubelle','!5poubelle',''), 
			array('=', 'L1.id_objet', sql_quote($Pile[$SP]['id_article'], '', '')), 
			array('=', 'L1.objet', sql_quote('article')));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('squelettes/sommaire.html','html_20bad19474852c2c1a99d7289d969071','autTeam',120,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t0 .= (
'
					<div class="col-md-4"> 
						<div class="team-box text-center to-animate-2">
							<div class="user"><img class="img-reponsive" src="IMG/auton' .
$Pile[$SP]['id_auteur'] .
'.png" alt="' .
interdire_scripts(typo(supprimer_numero($Pile[$SP]['nom']), "TYPO", $connect, $Pile[0])) .
'"></div>
							<h3>' .
interdire_scripts(typo(supprimer_numero($Pile[$SP]['nom']), "TYPO", $connect, $Pile[0])) .
'</h3>
							<span class="position">' .
BOUCLEmcautTeamhtml_20bad19474852c2c1a99d7289d969071($Cache, $Pile, $doublons, $Numrows, $SP) .
'
							</span>
							' .
interdire_scripts(propre($Pile[$SP]['bio'], $connect, $Pile[0])) .
'
							<ul class="social-media">
								<li><a href="mail_to(' .
interdire_scripts($Pile[$SP]['email']) .
')" class="dribbble"><i class="icon-envelope-o"></i></a></li>								
								<li><a href="' .
calculer_url($Pile[$SP]['url_site'],'','url', $connect) .
'" class="codepen"><i class="icon-feed"></i></a></li>
								<li><a href="' .
interdire_scripts($Pile[$SP]['input_1']) .
'" class="github"><i class="icon-github-alt"></i></a></li>
							</ul>
						</div>
					</div>
				        ');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLEautTeam @ squelettes/sommaire.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLEteamhtml_20bad19474852c2c1a99d7289d969071(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	if (!isset($command['table'])) {
		$command['table'] = 'articles';
		$command['id'] = 'team';
		$command['from'] = array('articles' => 'spip_articles');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("articles.id_article",
		"articles.titre",
		"articles.texte",
		"articles.lang");
		$command['orderby'] = array();
		$command['where'] = 
			array(
quete_condition_statut('articles.statut','publie,prop,prepa/auteur','publie',''), 
quete_condition_postdates('articles.date',''), 
			array('=', 'articles.id_article', "3"));
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	if (defined("_BOUCLE_PROFILER")) $timer = time()+microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('squelettes/sommaire.html','html_20bad19474852c2c1a99d7289d969071','team',108,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	lang_select($GLOBALS['spip_lang']);
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		lang_select_public($Pile[$SP]['lang'], '', $Pile[$SP]['titre']);
		$t0 .= (
'
				<div class="row">
					<div class="col-md-12 section-heading text-center">
						<h2 class="to-animate">' .
interdire_scripts(typo(supprimer_numero($Pile[$SP]['titre']), "TYPO", $connect, $Pile[0])) .
'</h2>
						<div class="row">
							<div class="col-md-8 col-md-offset-2 subtext">
								<h3 class="to-animate">' .
interdire_scripts(propre($Pile[$SP]['texte'], $connect, $Pile[0])) .
'</h3>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
				      ' .
BOUCLEautTeamhtml_20bad19474852c2c1a99d7289d969071($Cache, $Pile, $doublons, $Numrows, $SP) .
'
				    </div>
	');
		lang_select();
	}
	lang_select();
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLEteam @ squelettes/sommaire.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLEteaserhtml_20bad19474852c2c1a99d7289d969071(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	if (!isset($command['table'])) {
		$command['table'] = 'articles';
		$command['id'] = 'teaser';
		$command['from'] = array('articles' => 'spip_articles');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("articles.titre",
		"articles.texte",
		"articles.lang");
		$command['orderby'] = array();
		$command['where'] = 
			array(
quete_condition_statut('articles.statut','publie,prop,prepa/auteur','publie',''), 
quete_condition_postdates('articles.date',''), 
			array('=', 'articles.id_article', "4"));
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	if (defined("_BOUCLE_PROFILER")) $timer = time()+microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('squelettes/sommaire.html','html_20bad19474852c2c1a99d7289d969071','teaser',151,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	lang_select($GLOBALS['spip_lang']);
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		lang_select_public($Pile[$SP]['lang'], '', $Pile[$SP]['titre']);
		$t0 .= (
'
                            <div>
                                <div>
                                    <h2 class="to-animate">' .
interdire_scripts(typo(supprimer_numero($Pile[$SP]['titre']), "TYPO", $connect, $Pile[0])) .
'</h2>
                                    <div>
                                        <div>
                                            <h3 class="to-animate">' .
interdire_scripts(propre($Pile[$SP]['texte'], $connect, $Pile[0])) .
'</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ');
		lang_select();
	}
	lang_select();
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLEteaser @ squelettes/sommaire.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLEhistoirehtml_20bad19474852c2c1a99d7289d969071(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	if (!isset($command['table'])) {
		$command['table'] = 'articles';
		$command['id'] = 'histoire';
		$command['from'] = array('articles' => 'spip_articles');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("articles.titre",
		"articles.soustitre",
		"articles.lang");
		$command['orderby'] = array();
		$command['where'] = 
			array(
quete_condition_statut('articles.statut','publie,prop,prepa/auteur','publie',''), 
quete_condition_postdates('articles.date',''), 
			array('=', 'articles.id_article', "7"));
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	if (defined("_BOUCLE_PROFILER")) $timer = time()+microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('squelettes/sommaire.html','html_20bad19474852c2c1a99d7289d969071','histoire',172,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	lang_select($GLOBALS['spip_lang']);
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		lang_select_public($Pile[$SP]['lang'], '', $Pile[$SP]['titre']);
		$t0 .= (
'
				<div class="row">
					<div class="col-md-12 section-heading text-center">
						<h2 class="to-animate">' .
interdire_scripts(typo(supprimer_numero($Pile[$SP]['titre']), "TYPO", $connect, $Pile[0])) .
'</h2>
						<div class="row">
							<div class="col-md-8 col-md-offset-2 subtext">
								<h3 class="to-animate">' .
interdire_scripts(typo($Pile[$SP]['soustitre'], "TYPO", $connect, $Pile[0])) .
'</h3>
							</div>
						</div>
					</div>
				</div>
		      ');
		lang_select();
	}
	lang_select();
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLEhistoire @ squelettes/sommaire.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLEintroductionhtml_20bad19474852c2c1a99d7289d969071(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	if (!isset($command['table'])) {
		$command['table'] = 'articles';
		$command['id'] = 'introduction';
		$command['from'] = array('articles' => 'spip_articles');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("articles.texte",
		"articles.lang",
		"articles.titre");
		$command['orderby'] = array();
		$command['where'] = 
			array(
quete_condition_statut('articles.statut','publie,prop,prepa/auteur','publie',''), 
quete_condition_postdates('articles.date',''), 
			array('=', 'articles.id_article', "6"));
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	if (defined("_BOUCLE_PROFILER")) $timer = time()+microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('squelettes/sommaire.html','html_20bad19474852c2c1a99d7289d969071','introduction',190,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	lang_select($GLOBALS['spip_lang']);
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		lang_select_public($Pile[$SP]['lang'], '', $Pile[$SP]['titre']);
		$t0 .= (
'
							      ' .
interdire_scripts(propre($Pile[$SP]['texte'], $connect, $Pile[0])) .
'
							      ');
		lang_select();
	}
	lang_select();
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLEintroduction @ squelettes/sommaire.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLEvoy1html_20bad19474852c2c1a99d7289d969071(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	if (!isset($command['table'])) {
		$command['table'] = 'articles';
		$command['id'] = 'voy1';
		$command['from'] = array('articles' => 'spip_articles');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("articles.titre",
		"articles.soustitre",
		"articles.lang");
		$command['orderby'] = array();
		$command['where'] = 
			array(
quete_condition_statut('articles.statut','publie,prop,prepa/auteur','publie',''), 
quete_condition_postdates('articles.date',''), 
			array('=', 'articles.id_article', "12"));
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	if (defined("_BOUCLE_PROFILER")) $timer = time()+microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('squelettes/sommaire.html','html_20bad19474852c2c1a99d7289d969071','voy1',198,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	lang_select($GLOBALS['spip_lang']);
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		lang_select_public($Pile[$SP]['lang'], '', $Pile[$SP]['titre']);
		$t0 .= (
'
				<div class="row">
					<div class="col-md-12 section-heading text-center">
						<h2 class="to-animate">' .
interdire_scripts(typo(supprimer_numero($Pile[$SP]['titre']), "TYPO", $connect, $Pile[0])) .
'</h2>
						<div class="row">
							<div class="col-md-8 col-md-offset-2 subtext">
								<h3 class="to-animate">' .
interdire_scripts(typo($Pile[$SP]['soustitre'], "TYPO", $connect, $Pile[0])) .
'</h3>
							</div>
						</div>
					</div>
				
					      ');
		lang_select();
	}
	lang_select();
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLEvoy1 @ squelettes/sommaire.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLEcartierhtml_20bad19474852c2c1a99d7289d969071(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	if (!isset($command['table'])) {
		$command['table'] = 'articles';
		$command['id'] = 'cartier';
		$command['from'] = array('articles' => 'spip_articles');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("articles.texte",
		"articles.lang",
		"articles.titre");
		$command['orderby'] = array();
		$command['where'] = 
			array(
quete_condition_statut('articles.statut','publie,prop,prepa/auteur','publie',''), 
quete_condition_postdates('articles.date',''), 
			array('=', 'articles.id_article', "8"));
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	if (defined("_BOUCLE_PROFILER")) $timer = time()+microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('squelettes/sommaire.html','html_20bad19474852c2c1a99d7289d969071','cartier',213,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	lang_select($GLOBALS['spip_lang']);
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		lang_select_public($Pile[$SP]['lang'], '', $Pile[$SP]['titre']);
		$t0 .= (
'
							      ' .
interdire_scripts(propre($Pile[$SP]['texte'], $connect, $Pile[0])) .
'
							      ');
		lang_select();
	}
	lang_select();
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLEcartier @ squelettes/sommaire.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLEvoy2html_20bad19474852c2c1a99d7289d969071(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	if (!isset($command['table'])) {
		$command['table'] = 'articles';
		$command['id'] = 'voy2';
		$command['from'] = array('articles' => 'spip_articles');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("articles.titre",
		"articles.soustitre",
		"articles.lang");
		$command['orderby'] = array();
		$command['where'] = 
			array(
quete_condition_statut('articles.statut','publie,prop,prepa/auteur','publie',''), 
quete_condition_postdates('articles.date',''), 
			array('=', 'articles.id_article', "13"));
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	if (defined("_BOUCLE_PROFILER")) $timer = time()+microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('squelettes/sommaire.html','html_20bad19474852c2c1a99d7289d969071','voy2',219,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	lang_select($GLOBALS['spip_lang']);
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		lang_select_public($Pile[$SP]['lang'], '', $Pile[$SP]['titre']);
		$t0 .= (
'
				<div class="row">
					<div class="col-md-12 section-heading text-center">
						<h2 class="to-animate">' .
interdire_scripts(typo(supprimer_numero($Pile[$SP]['titre']), "TYPO", $connect, $Pile[0])) .
'</h2>
						<div class="row">
							<div class="col-md-8 col-md-offset-2 subtext">
								<h3 class="to-animate">' .
interdire_scripts(typo($Pile[$SP]['soustitre'], "TYPO", $connect, $Pile[0])) .
'</h3>
							</div>
						</div>
					</div>
				
					      ');
		lang_select();
	}
	lang_select();
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLEvoy2 @ squelettes/sommaire.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLEvoyage2html_20bad19474852c2c1a99d7289d969071(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	if (!isset($command['table'])) {
		$command['table'] = 'articles';
		$command['id'] = 'voyage2';
		$command['from'] = array('articles' => 'spip_articles');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("articles.texte",
		"articles.lang",
		"articles.titre");
		$command['orderby'] = array();
		$command['where'] = 
			array(
quete_condition_statut('articles.statut','publie,prop,prepa/auteur','publie',''), 
quete_condition_postdates('articles.date',''), 
			array('=', 'articles.id_article', "9"));
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	if (defined("_BOUCLE_PROFILER")) $timer = time()+microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('squelettes/sommaire.html','html_20bad19474852c2c1a99d7289d969071','voyage2',235,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	lang_select($GLOBALS['spip_lang']);
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		lang_select_public($Pile[$SP]['lang'], '', $Pile[$SP]['titre']);
		$t0 .= (
'
							      ' .
interdire_scripts(propre($Pile[$SP]['texte'], $connect, $Pile[0])) .
'
							      ');
		lang_select();
	}
	lang_select();
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLEvoyage2 @ squelettes/sommaire.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLEvoy3html_20bad19474852c2c1a99d7289d969071(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	if (!isset($command['table'])) {
		$command['table'] = 'articles';
		$command['id'] = 'voy3';
		$command['from'] = array('articles' => 'spip_articles');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("articles.titre",
		"articles.soustitre",
		"articles.lang");
		$command['orderby'] = array();
		$command['where'] = 
			array(
quete_condition_statut('articles.statut','publie,prop,prepa/auteur','publie',''), 
quete_condition_postdates('articles.date',''), 
			array('=', 'articles.id_article', "14"));
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	if (defined("_BOUCLE_PROFILER")) $timer = time()+microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('squelettes/sommaire.html','html_20bad19474852c2c1a99d7289d969071','voy3',241,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	lang_select($GLOBALS['spip_lang']);
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		lang_select_public($Pile[$SP]['lang'], '', $Pile[$SP]['titre']);
		$t0 .= (
'
				<div class="row">
					<div class="col-md-12 section-heading text-center">
						<h2 class="to-animate">' .
interdire_scripts(typo(supprimer_numero($Pile[$SP]['titre']), "TYPO", $connect, $Pile[0])) .
'</h2>
						<div class="row">
							<div class="col-md-8 col-md-offset-2 subtext">
								<h3 class="to-animate">' .
interdire_scripts(typo($Pile[$SP]['soustitre'], "TYPO", $connect, $Pile[0])) .
'</h3>
							</div>
						</div>
					</div>
				</div>
					      ');
		lang_select();
	}
	lang_select();
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLEvoy3 @ squelettes/sommaire.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLEvoyage3html_20bad19474852c2c1a99d7289d969071(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	if (!isset($command['table'])) {
		$command['table'] = 'articles';
		$command['id'] = 'voyage3';
		$command['from'] = array('articles' => 'spip_articles');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("articles.texte",
		"articles.lang",
		"articles.titre");
		$command['orderby'] = array();
		$command['where'] = 
			array(
quete_condition_statut('articles.statut','publie,prop,prepa/auteur','publie',''), 
quete_condition_postdates('articles.date',''), 
			array('=', 'articles.id_article', "11"));
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	if (defined("_BOUCLE_PROFILER")) $timer = time()+microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('squelettes/sommaire.html','html_20bad19474852c2c1a99d7289d969071','voyage3',256,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	lang_select($GLOBALS['spip_lang']);
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		lang_select_public($Pile[$SP]['lang'], '', $Pile[$SP]['titre']);
		$t0 .= (
'
							      ' .
interdire_scripts(propre($Pile[$SP]['texte'], $connect, $Pile[0])) .
'
							      ');
		lang_select();
	}
	lang_select();
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLEvoyage3 @ squelettes/sommaire.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}

//
// Fonction principale du squelette squelettes/sommaire.html
// Temps de compilation total: 7.662 ms
//

function html_20bad19474852c2c1a99d7289d969071($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (

'<'.'?php echo recuperer_fond( ' . argumenter_squelette('inclure/tete') . ', array(\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . '), array("compil"=>array(\'squelettes/sommaire.html\',\'html_20bad19474852c2c1a99d7289d969071\',\'\',1,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>
' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette('inclure/menu') . ', array(\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . '), array("compil"=>array(\'squelettes/sommaire.html\',\'html_20bad19474852c2c1a99d7289d969071\',\'\',2,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>


      <section id="fh5co-home" data-section="home" style="" data-stellar-background-ratio="0.5">
		<div class="gradient"></div>
		<div class="container">
			<div class="text-wrap">
				<div class="text-inner">
					<div class="row">
						<div class="col-md-8 col-md-offset-2 text-center">
							<h1 class="to-animate">' .
interdire_scripts(typo($GLOBALS['meta']['nom_site'], "TYPO", $connect, $Pile[0])) .
'</h1>
							<h2 class="to-animate">' .
interdire_scripts(typo($GLOBALS['meta']['slogan_site'], "TYPO", $connect, $Pile[0])) .
'</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	

		  	
	   <!--  Chiffres et Infos
	<section id="fh5co-services" data-section="services">
		<div class="fh5co-services">
			<div class="container">
				<div class="row">
					<div class="col-md-12 section-heading text-center">
						<h2 class="to-animate">Black Features</h2>
						<div class="row">
							<div class="col-md-8 col-md-offset-2 subtext">
								<h3 class="to-animate">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove. </h3>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="core-features">
						<div class="grid2 to-animate" style="background-image: url(' .
find_in_path('images/full_image_2.jpg') .
');">
						</div>
						<div class="grid2">
							<div class="core-f">
								<div class="row">
									<div class="col-md-12">
										<div class="core">
											<i class="icon-cloud-download to-animate-2"></i>
											<div class="fh5co-post to-animate">
												<h3>Free Download</h3>
												<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
											</div>
										</div>
										<div class="core">
											<i class="icon-laptop to-animate-2"></i>
											<div class="fh5co-post to-animate">
												<h3>Responsive Layout</h3>
												<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
											</div>
										</div>
										<div class="core">
											<i class="icon-gear to-animate-2"></i>
											<div class="fh5co-post to-animate">
												<h3>24/7 Help &amp; Support</h3>
												<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
											</div>
										</div>
										<div class="core">
											<i class="icon-columns to-animate-2"></i>
											<div class="fh5co-post to-animate">
												<h3>Lots of Elements</h3>
												<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="fh5co-counter-section" class="fh5co-counters">
					<div class="container">
						<div class="row to-animate">
							<div class="col-md-3 text-center">
								<span class="fh5co-counter js-counter" data-from="0" data-to="3452" data-speed="5000" data-refresh-interval="50"></span>
								<span class="fh5co-counter-label">Cups of Coffee</span>
							</div>
							<div class="col-md-3 text-center">
								<span class="fh5co-counter js-counter" data-from="0" data-to="234" data-speed="5000" data-refresh-interval="50"></span>
								<span class="fh5co-counter-label">Client</span>
							</div>
							<div class="col-md-3 text-center">
								<span class="fh5co-counter js-counter" data-from="0" data-to="6542" data-speed="5000" data-refresh-interval="50"></span>
								<span class="fh5co-counter-label">Projects</span>
							</div>
							<div class="col-md-3 text-center">
								<span class="fh5co-counter js-counter" data-from="0" data-to="8687" data-speed="5000" data-refresh-interval="50"></span>
								<span class="fh5co-counter-label">Finished Projects</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
		  Fin chiffres et stats -->
		  <section id="fh5co-team" data-section="team">
		<div class="fh5co-team">
			<div class="container">
			' .
BOUCLEteamhtml_20bad19474852c2c1a99d7289d969071($Cache, $Pile, $doublons, $Numrows, $SP) .
'

		


			<br><br><br>
			  <section id="fh5co-teaser" data-section="teaser">
		<div class="fh5co-teaser">
			<div class="container">
			<section id="teaser" style="width:100%">
                <div>
                    <div>
                        ' .
BOUCLEteaserhtml_20bad19474852c2c1a99d7289d969071($Cache, $Pile, $doublons, $Numrows, $SP) .
'
                    </div>
                </div>
            </section>
		      </div>
				</div>
      </section>
	
	<section id="fh5co-explore" data-section="explore">
		<div class="container">
			' .
BOUCLEhistoirehtml_20bad19474852c2c1a99d7289d969071($Cache, $Pile, $doublons, $Numrows, $SP) .
'
		<div class="fh5co-project">
			<div class="container">

    <div id="map"></div>
	<script src="' .
find_in_path('js/iiif-example.js') .
'"></script>
					<div class="col-md-12">
					      <span class="position" style="text-align:justify">' .
BOUCLEintroductionhtml_20bad19474852c2c1a99d7289d969071($Cache, $Pile, $doublons, $Numrows, $SP) .
'
							</span>
  
					</div>
	
					
			' .
BOUCLEvoy1html_20bad19474852c2c1a99d7289d969071($Cache, $Pile, $doublons, $Numrows, $SP) .
'
					<div class="col-md-12">
					      <div class="project-grid to-animate-2" style="background-image:  url(' .
find_in_path('images/fleuve.jpg') .
');">
					      </div>
					      <span class="position" style="text-align:justify">' .
BOUCLEcartierhtml_20bad19474852c2c1a99d7289d969071($Cache, $Pile, $doublons, $Numrows, $SP) .
'
							</span>
							
							
			' .
BOUCLEvoy2html_20bad19474852c2c1a99d7289d969071($Cache, $Pile, $doublons, $Numrows, $SP) .
'

					      <div class="col-md-12">
					      <div class="project-grid to-animate-2" style="background-image:  url(' .
find_in_path('images/nicolay.jpg') .
');">
					      </div>
					      <span class="position" style="text-align:justify">' .
BOUCLEvoyage2html_20bad19474852c2c1a99d7289d969071($Cache, $Pile, $doublons, $Numrows, $SP) .
'
							</span>
							
			<div class="container">
			' .
BOUCLEvoy3html_20bad19474852c2c1a99d7289d969071($Cache, $Pile, $doublons, $Numrows, $SP) .
'
					      <div class="col-md-12">
					      <div class="project-grid to-animate-2" style="background-image:  url(' .
find_in_path('images/homemm.jpg') .
');">
					      </div>
					      <span class="position" style="text-align:justify">' .
BOUCLEvoyage3html_20bad19474852c2c1a99d7289d969071($Cache, $Pile, $doublons, $Numrows, $SP) .
'
							</span>
					<!-- surplus
					
					<div class="col-md-12 text-center">
						<div class="project-grid to-animate-2" style="background-image:  url(' .
find_in_path('images/project-4.jpg') .
');">
							<div class="desc">
								<h3><a href="#">Tattoo</a></h3>
								<span>By: Louie D\' Great</span>
							</div>
						</div>
					</div>
					<div class="col-md-12 text-center">
						<div class="project-grid to-animate-2" style="background-image:  url(' .
find_in_path('images/project-5.jpg') .
');">
							<div class="desc">
								<h3><a href="#">Train Theme</a></h3>
								<span>By: Ivan Kim</span>
							</div>
						</div>
					</div>
					<div class="col-md-12 text-center">
						<div class="project-grid to-animate-2" style="background-image:  url(' .
find_in_path('images/project-6.jpg') .
');">
							<div class="desc">
								<h3><a href="#">Dance Theme</a></h3>
								<span>By: FreeHTML5.co</span>
							</div>
						</div>
					</div>-->
				</div>
			</div>	
		</div>
		 
	</section>
	
	<section id="fh5co-appli" data-section="appli">
		<div class="fh5co-appli">
			<div class="container">
		    <section id="Application_mobile" class="content-section text-center">
        <div class="download-section">
            <div class="container">
                <div class="col-lg-8 col-lg-offset-2">
                    <h1>Application mobile:</h1>
		      <p> L\'application mobile de "La france en Amérique" permet de<strong>jouer</strong> avec les cartes à travers une découverte ludique et intéractive !</p>
                    	      <p><img class="size-full wp-image-1201 alignnone" src="squelettes/images/tel.png" alt="" width="130" height="230" /></p>
		    <a href="squelettes/page_application_mobile.html" class="btn btn-default btn-lg">Téléchargez !</a>
                </div>
            </div> 
        </div>
	 
    </section>
	  <br><br><br><br><br><br><br><br><br>
	  <section id="fh5co-logo" data-section="logo">
		<div class="fh5co-logo"></div>
		<div class="container"></div>
      <center><p><img class="size-full wp-image-1201 alignnone" src="squelettes/images/logoo.png" alt="" width="160" height="160" />&nbsp;&nbsp;&nbsp;&nbsp; <img class="size-full wp-image-1201 alignnone" src="squelettes/images/logo8.png" alt="" width="250" height="160" /></p>
			      
  <br>
        <div class="container text-center">
            <p>Copyright &copy; La France en Amérique</p>
	    </div>
	   	    
	    
	    
    
    
    


	
	
	<!-- Informations inutile
	<section id="fh5co-pricing" data-section="pricing">
		<div class="fh5co-pricing">
			<div class="container">
				<div class="row">
					<div class="col-md-12 section-heading text-center">
						<h2 class="to-animate">Plans Built For Every One</h2>
						<div class="row">
							<div class="col-md-8 col-md-offset-2 subtext">
								<h3 class="to-animate">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove. </h3>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3 col-sm-6">
						<div class="price-box to-animate">
							<h2 class="pricing-plan">Starter</h2>
							<div class="price"><sup class="currency">$</sup>7<small>/mo</small></div>
							<p>Basic customer support for small business</p>
							<hr>
							<ul class="pricing-info">
								<li>10 projects</li>
								<li>20 Pages</li>
								<li>20 Emails</li>
								<li>100 Images</li>
							</ul>
							<p><a href="#" class="btn btn-primary">Read More</a></p>
						</div>
					</div>
					<div class="col-md-3 col-sm-6">
						<div class="price-box to-animate">
							<h2 class="pricing-plan">Regular</h2>
							<div class="price"><sup class="currency">$</sup>19<small>/mo</small></div>
							<p>Basic customer support for small business</p>
							<hr>
							<ul class="pricing-info">
								<li>15 projects</li>
								<li>40 Pages</li>
								<li>40 Emails</li>
								<li>200 Images</li>
							</ul>
							<p><a href="#" class="btn btn-primary">Read More</a></p>
						</div>
					</div>
					<div class="clearfix visible-sm-block"></div>
					<div class="col-md-3 col-sm-6 to-animate">
						<div class="price-box popular">
							<div class="popular-text">Best value</div>
							<h2 class="pricing-plan">Plus</h2>
							<div class="price"><sup class="currency">$</sup>79<small>/mo</small></div>
							<p>Basic customer support for small business</p>
							<hr>
							<ul class="pricing-info">
								<li>Unlimitted projects</li>
								<li>100 Pages</li>
								<li>100 Emails</li>
								<li>700 Images</li>
							</ul>
							<p><a href="#" class="btn btn-primary">Read More</a></p>
						</div>
					</div>
					<div class="col-md-3 col-sm-6">
						<div class="price-box to-animate">
							<h2 class="pricing-plan">Enterprise</h2>
							<div class="price"><sup class="currency">$</sup>125<small>/mo</small></div>
							<p>Basic customer support for small business</p>
							<hr>
							<ul class="pricing-info">
								<li>Unlimitted projects</li>
								<li>Unlimitted Pages</li>
								<li>Unlimitted Emails</li>
								<li>Unlimitted Images</li>
							</ul>
							<p><a href="#" class="btn btn-primary">Read More</a></p>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6 col-md-offset-3 col-md-push-3 to-animate">
						<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean</p>
						<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
					</div>
				</div>

			</div>
		</div>
	</section>	
	    Fin informations inutile -->

	 <!-- Lien vers leur page et formulaire contact
	<div class="getting-started getting-started-1">
		<div class="getting-grid" style="background-image:  url(' .
find_in_path('images/full_image_1.jpg') .
');">
			<div class="desc text-center">
				<h2>Getting Started</h2>
				<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
				<p><a href="#" class="btn btn-primary">Get in touch</a></p>
			</div>
		</div>
	</div>

	<div id="fh5co-footer" role="contentinfo">
		<div class="container">
			<div class="row">
				<div class="col-md-4 to-animate">
					<h3 class="section-title">About Us</h3>
					<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics.</p>
					<p class="copy-right">&copy; 2015 Twist Free Template. <br>All Rights Reserved. <br>
						Designed by <a href="http://freehtml5.co/" target="_blank">FREEHTML5.co</a>
						Demo Images: <a href="http://unsplash.com/" target="_blank">Unsplash</a>
					</p>
				</div>

				<div class="col-md-4 to-animate">
					<h3 class="section-title">Our Address</h3>
					<ul class="contact-info">
						<li><i class="icon-map-marker"></i>198 West 21th Street, Suite 721 New York NY 10016</li>
						<li><i class="icon-phone"></i>+ 1235 2355 98</li>
						<li><i class="icon-envelope"></i><a href="#">info@yoursite.com</a></li>
						<li><i class="icon-globe2"></i><a href="#">www.yoursite.com</a></li>
					</ul>
					<h3 class="section-title">Connect with Us</h3>
					<ul class="social-media">
						<li><a href="#" class="facebook"><i class="icon-facebook"></i></a></li>
						<li><a href="#" class="twitter"><i class="icon-twitter"></i></a></li>
						<li><a href="#" class="dribbble"><i class="icon-dribbble"></i></a></li>
						<li><a href="#" class="github"><i class="icon-github-alt"></i></a></li>
					</ul>
				</div>
				<div class="col-md-4 to-animate">
					<h3 class="section-title">Drop us a line</h3>
					<form class="contact-form">
						<div class="form-group">
							<label for="name" class="sr-only">Name</label>
							<input type="name" class="form-control" id="name" placeholder="Name">
						</div>
						<div class="form-group">
							<label for="email" class="sr-only">Email</label>
							<input type="email" class="form-control" id="email" placeholder="Email">
						</div>
						<div class="form-group">
							<label for="message" class="sr-only">Message</label>
							<textarea class="form-control" id="message" rows="7" placeholder="Message"></textarea>
						</div>
						<div class="form-group">
							<input type="submit" id="btn-submit" class="btn btn-send-message btn-md" value="Send Message">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	-->
	' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette('inclure/pied') . ', array(\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . '), array("compil"=>array(\'squelettes/sommaire.html\',\'html_20bad19474852c2c1a99d7289d969071\',\'\',483,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>
	' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette('inclure/fin') . ', array(\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . '), array("compil"=>array(\'squelettes/sommaire.html\',\'html_20bad19474852c2c1a99d7289d969071\',\'\',484,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>
');

	return analyse_resultat_skel('html_20bad19474852c2c1a99d7289d969071', $Cache, $page, 'squelettes/sommaire.html');
}
?>