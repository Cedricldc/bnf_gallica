<?php

/*
 * Squelette : ../plugins/auto/skeleditor/v2.7.11/prive/squelettes/contenu/skeleditor.html
 * Date :      Fri, 07 Apr 2017 13:07:03 GMT
 * Compile :   Fri, 21 Apr 2017 09:08:19 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette ../plugins/auto/skeleditor/v2.7.11/prive/squelettes/contenu/skeleditor.html
// Temps de compilation total: 1.622 ms
//

function html_7b2438f16adf22cb7a011040d18091f4($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
(!(skeleditor_dossier(''))  ?
		('<p class=\'notice\'>' . ' ' . (	' ' .
	_T('skeleditor:explications_creer_dossier_squelettes') .
	'</p>')) :
		'') .
'
' .
invalideur_session($Cache, sinon_interdire_acces(((function_exists("autoriser")||include_spip("inc/autoriser"))&&autoriser('skeleditor')?" ":""))) .
'

' .
vide($Pile['vars'][$_zzz=(string)'file'] = interdire_scripts(trim(entites_html(sinon(table_valeur(@$Pile[0], (string)'f', null), ''),true)))) .
(((strlen(table_valeur($Pile["vars"], (string)'file', null))) AND ((((strncmp(table_valeur($Pile["vars"], (string)'file', null),interdire_scripts(eval('return '.'_DIR_RACINE'.';')),interdire_scripts(strlen(eval('return '.'_DIR_RACINE'.';')))) == '0')) ?'' :' ')))  ?
		(' ' . (	'
' .
	vide($Pile['vars'][$_zzz=(string)'file'] = interdire_scripts(concat(eval('return '.'_DIR_RACINE'.';'),table_valeur($Pile["vars"], (string)'file', null)))))) :
		'') .
'
' .
vide($Pile['vars'][$_zzz=(string)'path'] = skeleditor_dossier('')) .
(((table_valeur($Pile["vars"], (string)'file', null)) OR (interdire_scripts(((trim(entites_html(table_valeur(@$Pile[0], (string)'upload', null),true))) ?'' :' '))))  ?
		(' ' . (	'
	<h1 class="grostitre">' .
	_T('skeleditor:fichier') .
	(($t2 = strval(((($a = basename(table_valeur($Pile["vars"], (string)'file', null))) OR (is_string($a) AND strlen($a))) ? $a : _T('public|spip|ecrire:info_sans_titre'))))!=='' ?
			(' ' . $t2) :
			'') .
	'</h1>
	<div class="noajax">
	' .
	executer_balise_dynamique('FORMULAIRE_EDITER_SQUELETTE',
	array(table_valeur($Pile["vars"], (string)'path', null),table_valeur($Pile["vars"], (string)'file', null)),
	array('../plugins/auto/skeleditor/v2.7.11/prive/squelettes/contenu/skeleditor.html','html_7b2438f16adf22cb7a011040d18091f4','',11,$GLOBALS['spip_lang'])) .
	'</div>
	' .
	skeleditor_codemirror(table_valeur($Pile["vars"], (string)'file', null)) .
	'
')) :
		'') .
'
' .
(((((table_valeur($Pile["vars"], (string)'file', null)) ?'' :' ')) AND (interdire_scripts(((trim(entites_html(table_valeur(@$Pile[0], (string)'upload', null),true))) ?' ' :''))))  ?
		(' ' . (	'
	<h1 class="grostitre">' .
	_T('skeleditor:action_upload') .
	'</h1>
	' .
	executer_balise_dynamique('FORMULAIRE_UPLOAD_SQUELETTE',
	array(table_valeur($Pile["vars"], (string)'path', null)),
	array('../plugins/auto/skeleditor/v2.7.11/prive/squelettes/contenu/skeleditor.html','html_7b2438f16adf22cb7a011040d18091f4','',8,$GLOBALS['spip_lang'])))) :
		'') .
'
' .
'<' . '?php header("X-Spip-Filtre: '.'liens_absolus' . '"); ?'.'>');

	return analyse_resultat_skel('html_7b2438f16adf22cb7a011040d18091f4', $Cache, $page, '../plugins/auto/skeleditor/v2.7.11/prive/squelettes/contenu/skeleditor.html');
}
?>