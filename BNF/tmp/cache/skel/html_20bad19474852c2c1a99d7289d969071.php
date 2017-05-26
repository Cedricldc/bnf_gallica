<?php

/*
 * Squelette : squelettes/sommaire.html
 * Date :      Thu, 25 May 2017 19:41:48 GMT
 * Compile :   Fri, 26 May 2017 08:26:48 GMT
 * Boucles :   teaser, histoire, introduction, voy1, cartier, voy2, voyage2, voy3, voyage3, mcautTeam, autTeam, team
 */ 

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
		array('squelettes/sommaire.html','html_20bad19474852c2c1a99d7289d969071','teaser',34,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	lang_select($GLOBALS['spip_lang']);
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		lang_select_public($Pile[$SP]['lang'], '', $Pile[$SP]['titre']);
		$t0 .= (
'
                                    <h2 class="to-animate">' .
interdire_scripts(typo(supprimer_numero($Pile[$SP]['titre']), "TYPO", $connect, $Pile[0])) .
'</h2>
                                    <h3 class="to-animate teaser-bottom">' .
interdire_scripts(propre($Pile[$SP]['texte'], $connect, $Pile[0])) .
'</h3>
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
		array('squelettes/sommaire.html','html_20bad19474852c2c1a99d7289d969071','histoire',47,$GLOBALS['spip_lang'])
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
                      <h3 class="to-animate">' .
interdire_scripts(typo($Pile[$SP]['soustitre'], "TYPO", $connect, $Pile[0])) .
'</h3>
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
		array('squelettes/sommaire.html','html_20bad19474852c2c1a99d7289d969071','introduction',59,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	lang_select($GLOBALS['spip_lang']);
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		lang_select_public($Pile[$SP]['lang'], '', $Pile[$SP]['titre']);
		$t0 .= (
'
      							           <p class="to-animate">' .
interdire_scripts(propre($Pile[$SP]['texte'], $connect, $Pile[0])) .
'</p>
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
		array('squelettes/sommaire.html','html_20bad19474852c2c1a99d7289d969071','voy1',71,$GLOBALS['spip_lang'])
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
		array('squelettes/sommaire.html','html_20bad19474852c2c1a99d7289d969071','cartier',84,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	lang_select($GLOBALS['spip_lang']);
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		lang_select_public($Pile[$SP]['lang'], '', $Pile[$SP]['titre']);
		$t0 .= (
'
            							        <p class="to-animate colonnetexte">' .
interdire_scripts(propre($Pile[$SP]['texte'], $connect, $Pile[0])) .
'</p>
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
		array('squelettes/sommaire.html','html_20bad19474852c2c1a99d7289d969071','voy2',93,$GLOBALS['spip_lang'])
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
		array('squelettes/sommaire.html','html_20bad19474852c2c1a99d7289d969071','voyage2',109,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	lang_select($GLOBALS['spip_lang']);
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		lang_select_public($Pile[$SP]['lang'], '', $Pile[$SP]['titre']);
		$t0 .= (
'
							                       <p>' .
interdire_scripts(propre($Pile[$SP]['texte'], $connect, $Pile[0])) .
'</p>
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
		array('squelettes/sommaire.html','html_20bad19474852c2c1a99d7289d969071','voy3',119,$GLOBALS['spip_lang'])
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
		array('squelettes/sommaire.html','html_20bad19474852c2c1a99d7289d969071','voyage3',135,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	lang_select($GLOBALS['spip_lang']);
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		lang_select_public($Pile[$SP]['lang'], '', $Pile[$SP]['titre']);
		$t0 .= (
'
                                    <p>' .
interdire_scripts(propre($Pile[$SP]['texte'], $connect, $Pile[0])) .
'</p>
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
		array('squelettes/sommaire.html','html_20bad19474852c2c1a99d7289d969071','mcautTeam',163,$GLOBALS['spip_lang'])
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
		array('squelettes/sommaire.html','html_20bad19474852c2c1a99d7289d969071','autTeam',158,$GLOBALS['spip_lang'])
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
							</span> ' .
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
		array('squelettes/sommaire.html','html_20bad19474852c2c1a99d7289d969071','team',146,$GLOBALS['spip_lang'])
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

//
// Fonction principale du squelette squelettes/sommaire.html
// Temps de compilation total: 9.435 ms
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


        <section id="fh5co-home" data-section="home" style="background-image: url(' .
find_in_path('images/cartebglowco.jpg') .
');background-size:100%; background-repeat: no-repeat; background-color: #121036;" data-stellar-background-ratio="1.5">
            <div class="container">
                <div class="text-wrap">
                    <div class="text-inner">
                        <div class="row">
                          <div class="logo_site to-animate"><img class="logo" src="' .
find_in_path('images/logo_site.svg') .
'"/></div>
                            <div class="titles text-center">
                                <h1 class="title to-animate">' .
interdire_scripts(typo($GLOBALS['meta']['nom_site'], "TYPO", $connect, $Pile[0])) .
'</h1>
                                <h2 class="subtitle to-animate" style="line-height:1.2em;">' .
interdire_scripts(typo($GLOBALS['meta']['slogan_site'], "TYPO", $connect, $Pile[0])) .
'</h2>
                            </div>
                            <div class="row">
                              <div class="to-animate arrow">
                                        <img class="anim-arrow bounce" width="40" height="40" alt="" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCA1MTIgNTEyIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxwYXRoIGZpbGw9IiNGRkZGRkYiIGQ9Ik0yOTMuNzUxLDQ1NS44NjhjLTIwLjE4MSwyMC4xNzktNTMuMTY1LDE5LjkxMy03My42NzMtMC41OTVsMCwwYy0yMC41MDgtMjAuNTA4LTIwLjc3My01My40OTMtMC41OTQtNzMuNjcyDQoJbDE4OS45OTktMTkwYzIwLjE3OC0yMC4xNzgsNTMuMTY0LTE5LjkxMyw3My42NzIsMC41OTVsMCwwYzIwLjUwOCwyMC41MDksMjAuNzcyLDUzLjQ5MiwwLjU5NSw3My42NzFMMjkzLjc1MSw0NTUuODY4eiIvPg0KPHBhdGggZmlsbD0iI0ZGRkZGRiIgZD0iTTIyMC4yNDksNDU1Ljg2OGMyMC4xOCwyMC4xNzksNTMuMTY0LDE5LjkxMyw3My42NzItMC41OTVsMCwwYzIwLjUwOS0yMC41MDgsMjAuNzc0LTUzLjQ5MywwLjU5Ni03My42NzINCglsLTE5MC0xOTBjLTIwLjE3OC0yMC4xNzgtNTMuMTY0LTE5LjkxMy03My42NzEsMC41OTVsMCwwYy0yMC41MDgsMjAuNTA5LTIwLjc3Miw1My40OTItMC41OTUsNzMuNjcxTDIyMC4yNDksNDU1Ljg2OHoiLz4NCjwvc3ZnPg0K"
                                        />
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section id="fh5co-teaser" data-section="teaser">
            <div class="container">
                <div class="text-wrap">
                    <div class="text-inner">
                        <div class="row">
                            <div class="text-center">
                                ' .
BOUCLEteaserhtml_20bad19474852c2c1a99d7289d969071($Cache, $Pile, $doublons, $Numrows, $SP) .
'
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="fh5co-explore" data-section="explore">
          <div class="container">
            ' .
BOUCLEhistoirehtml_20bad19474852c2c1a99d7289d969071($Cache, $Pile, $doublons, $Numrows, $SP) .
'
            <div class="fh5co-project">
                <div id="map1" class="to-animate mapleaflet"></div>
                <div class="col-md-12">
                    <span class="position" style="text-align:justify">
                            ' .
BOUCLEintroductionhtml_20bad19474852c2c1a99d7289d969071($Cache, $Pile, $doublons, $Numrows, $SP) .
'
  							          </span>
                </div>
              </div>
            </div>
        </section>


        <section id="fh5co-explore2" data-section="explore2">
          <div class="container">
                ' .
BOUCLEvoy1html_20bad19474852c2c1a99d7289d969071($Cache, $Pile, $doublons, $Numrows, $SP) .
'
                    <!--image en background?-->
                    <div id="map2" class="to-animate mapleaflet"></div>
                    <span class="position" style="text-align:justify">
                              ' .
BOUCLEcartierhtml_20bad19474852c2c1a99d7289d969071($Cache, $Pile, $doublons, $Numrows, $SP) .
'
							              </span>
            </div>
          </section>

          <section id="fh5co-explore3" data-section="explore3">
            <div class="container">
                    ' .
BOUCLEvoy2html_20bad19474852c2c1a99d7289d969071($Cache, $Pile, $doublons, $Numrows, $SP) .
'
            </div>
              <img class=full-image src="' .
find_in_path('images/map3.jpg') .
'"/>
            <div class="container">
                        <span class="position" style="text-align:justify">
                                ' .
BOUCLEvoyage2html_20bad19474852c2c1a99d7289d969071($Cache, $Pile, $doublons, $Numrows, $SP) .
'
							              </span>

              </div>
            </section>

            <section id="fh5co-explore4" data-section="explore4">
              <div class="container">
                        ' .
BOUCLEvoy3html_20bad19474852c2c1a99d7289d969071($Cache, $Pile, $doublons, $Numrows, $SP) .
'
                            <div class="col-md-12">
                                <div class="project-grid to-animate-2" style="background-image:  url(' .
find_in_path('images/homemm.jpg') .
');">
                                </div>
                                <span class="position" style="text-align:justify">
                                ' .
BOUCLEvoyage3html_20bad19474852c2c1a99d7289d969071($Cache, $Pile, $doublons, $Numrows, $SP) .
'
                              </span>
                            </div>
                </div>
        </section>

        <section id="fh5co-team" data-section="team">
            <div class="fh5co-team">
                <div class="container">
                    ' .
BOUCLEteamhtml_20bad19474852c2c1a99d7289d969071($Cache, $Pile, $doublons, $Numrows, $SP) .
'
                </div>
              </div>
            </section>

                <section id="fh5co-appli" data-section="appli">
                    <div class="fh5co-appli">
                        <div class="container">
                            <div id="Application_mobile" class="content-section text-center">
                                <div class="row">
                                    <div class="container">
                                        <div class="col-md-12 section-heading text-center">
                                            <h2 class="to-animate">Application mobile:</h2>
                                            <h3 class="to-animate"> L\'application mobile de "La france en Amérique" permet de<strong> jouer</strong> avec les cartes à travers une découverte ludique et interactive !</h3>
                                            <div class="app-image">
                                              <img class="to-animate app-visual" src="' .
find_in_path('images/app.png') .
'" alt="application"/>
                                            </div><div class="app-image">
                                              <img class="to-animate app-visual" src="' .
find_in_path('images/app2.png') .
'" alt="application 2"/>
                                            </div>
                                            <a href="' .
find_in_path('page_application_mobile.html') .
'" class="btn btn-default btn-lg to-animate">Téléchargez !</a>
                                        </div>
                                    </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </section>
                            ' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette('inclure/pied') . ', array(\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . '), array("compil"=>array(\'squelettes/sommaire.html\',\'html_20bad19474852c2c1a99d7289d969071\',\'\',203,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>
                                ' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette('inclure/fin') . ', array(\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . '), array("compil"=>array(\'squelettes/sommaire.html\',\'html_20bad19474852c2c1a99d7289d969071\',\'\',204,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>
');

	return analyse_resultat_skel('html_20bad19474852c2c1a99d7289d969071', $Cache, $page, 'squelettes/sommaire.html');
}
?>