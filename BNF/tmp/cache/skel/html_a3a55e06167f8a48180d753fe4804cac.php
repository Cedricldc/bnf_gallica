<?php

/*
 * Squelette : ../plugins-dist/dump/prive/style_prive_plugin_dump.html
 * Date :      Fri, 07 Apr 2017 13:07:02 GMT
 * Compile :   Fri, 26 May 2017 15:59:39 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette ../plugins-dist/dump/prive/style_prive_plugin_dump.html
// Temps de compilation total: 0.512 ms
//

function html_a3a55e06167f8a48180d753fe4804cac($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'
' .
'<'.'?php header("X-Spip-Cache: 360000"); ?'.'>'.'<'.'?php header("Cache-Control: max-age=360000"); ?'.'>'.'<'.'?php header("X-Spip-Statique: oui"); ?'.'>' .
'<'.'?php header("' . 'Content-Type: text/css; charset=iso-8859-15' . '"); ?'.'>' .
'<'.'?php header("' . 'Vary: Accept-Encoding' . '"); ?'.'>' .
vide($Pile['vars'][$_zzz=(string)'claire'] = (	'#' .
	interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'couleur_claire', null), 'edf3fe'),true)))) .
vide($Pile['vars'][$_zzz=(string)'foncee'] = (	'#' .
	interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'couleur_foncee', null), '3874b0'),true)))) .
vide($Pile['vars'][$_zzz=(string)'left'] = interdire_scripts(choixsiegal(entites_html(table_valeur(@$Pile[0], (string)'ltr', null),true),'left','left','right'))) .
vide($Pile['vars'][$_zzz=(string)'right'] = interdire_scripts(choixsiegal(entites_html(table_valeur(@$Pile[0], (string)'ltr', null),true),'left','right','left'))) .
'.liste-objets.dump tr .fichier label {display:block; width: 260px;word-wrap:break-word;}
.liste-objets.dump tr .taille {text-align:right;}

.formulaire_restaurer .editer div.choix {border:0;background: none;padding: 0;}

');

	return analyse_resultat_skel('html_a3a55e06167f8a48180d753fe4804cac', $Cache, $page, '../plugins-dist/dump/prive/style_prive_plugin_dump.html');
}
?>