<?php

/*
 * Squelette : ../prive/squelettes/body.html
 * Date :      Fri, 07 Apr 2017 13:07:03 GMT
 * Compile :   Fri, 26 May 2017 15:59:40 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette ../prive/squelettes/body.html
// Temps de compilation total: 2.587 ms
//

function html_b1432dd727ecb80a50019f8bc0477fcc($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
pipeline( 'body_prive' , (	'<body class="' .
		interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'type-page', null), 'page'),true)) .
		(($t3 = strval(interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'composition', null), ''),true))))!=='' ?
				((	' ' .
			interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'type-page', null), 'page'),true)) .
			'_') . $t3) :
				'') .
		(($t3 = strval(interdire_scripts(invalideur_session($Cache, table_valeur($GLOBALS["visiteur_session"], (string)'statut', null)))))!=='' ?
				(' statut_' . $t3) :
				'') .
		(($t3 = strval(interdire_scripts(invalideur_session($Cache, table_valeur($GLOBALS["visiteur_session"], (string)'id_auteur', null)))))!=='' ?
				(' auteur_' . $t3) :
				'') .
		' ' .
		init_body_class('') .
		(($t3 = strval(interdire_scripts(((match(entites_html(sinon(table_valeur(@$Pile[0], (string)'type-page', null), 'page'),true),'_edit$')) ?' ' :''))))!=='' ?
				($t3 . 'edition') :
				'') .
		'">') ) .
'
	' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette('prive/squelettes/inclure/barre-nav') . ', array(\'recherche\' => ' . argumenter_squelette(@$Pile[0]['recherche']) . ',
	\'plugins\' => ' . argumenter_squelette(parametres_css_prive('')) . ',
	\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . '), array("compil"=>array(\'../prive/squelettes/body.html\',\'html_b1432dd727ecb80a50019f8bc0477fcc\',\'\',2,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>
	<div id="page">
		' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette('prive/objets/liste/auteurs_enligne') . ', array(\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . '), array("compil"=>array(\'../prive/squelettes/body.html\',\'html_b1432dd727ecb80a50019f8bc0477fcc\',\'\',4,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>
		' .
interdire_scripts(invalideur_session($Cache, alertes_auteur(table_valeur($GLOBALS["visiteur_session"], (string)'id_auteur', null)))) .
'
		<div class="largeur">
			<div id="haut">
				<div id="chemin">
					' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette((	'prive/squelettes/hierarchie/' .
	interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'type-page', null),true)))) . ', array_merge('.var_export($Pile[0],1).',array(\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . ')), array("compil"=>array(\'../prive/squelettes/body.html\',\'html_b1432dd727ecb80a50019f8bc0477fcc\',\'\',9,$GLOBALS[\'spip_lang\']),\'ajax\' => ($v=( ' . argumenter_squelette('hierarchie') . '))?$v:true), _request("connect"));
?'.'>
				</div>
				
				' .
recuperer_fond( (	'prive/squelettes/top/' .
	interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'type-page', null),true))) , array_merge($Pile[0],array()), array('ajax' => ($v=( 'top' ))?$v:true,'compil'=>array('../prive/squelettes/body.html','html_b1432dd727ecb80a50019f8bc0477fcc','',12,$GLOBALS['spip_lang'])), _request('connect')) .
'</div>
			<div id="conteneur" class="' .
interdire_scripts((is_string(null)?vide($GLOBALS['largeur_ecran']=null):(isset($GLOBALS['largeur_ecran'])?$GLOBALS['largeur_ecran']:''))) .
'">
				<div id="navigation" class=\'lat\' role=\'contentinfo\'>
					' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette((	'prive/squelettes/navigation/' .
	interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'type-page', null),true)))) . ', array_merge('.var_export($Pile[0],1).',array(\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . ')), array("compil"=>array(\'../prive/squelettes/body.html\',\'html_b1432dd727ecb80a50019f8bc0477fcc\',\'\',16,$GLOBALS[\'spip_lang\']),\'ajax\' => ($v=( ' . argumenter_squelette('navigation') . '))?$v:true), _request("connect"));
?'.'>
				' .
(($t1 = strval(interdire_scripts((((table_valeur(eval('return '.'$GLOBALS'.';'),'spip_ecran') == 'large')) ?' ' :''))))!=='' ?
		($t1 . '
				</div>
				<div id="extra" class=\'lat\' role=\'complementary\'>') :
		'') .
'
					' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette((	'prive/squelettes/extra/' .
	interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'type-page', null),true)))) . ', array_merge('.var_export($Pile[0],1).',array(\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . ')), array("compil"=>array(\'../prive/squelettes/body.html\',\'html_b1432dd727ecb80a50019f8bc0477fcc\',\'\',18,$GLOBALS[\'spip_lang\']),\'ajax\' => ($v=( ' . argumenter_squelette('extra') . '))?$v:true), _request("connect"));
?'.'>' .
'
				</div>
				<div id="contenu" role=\'main\'>
					' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette((	'prive/squelettes/contenu/' .
	interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'type-page', null),true)))) . ', array_merge('.var_export($Pile[0],1).',array(\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . ')), array("compil"=>array(\'../prive/squelettes/body.html\',\'html_b1432dd727ecb80a50019f8bc0477fcc\',\'\',21,$GLOBALS[\'spip_lang\']),\'ajax\' => ($v=( ' . argumenter_squelette('contenu') . '))?$v:true), _request("connect"));
?'.'>
				</div>
			</div>
			<br class="nettoyeur" />
		</div>
		<div id="pied">
			<div class="largeur">
			' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette('prive/squelettes/inclure/pied') . ', array(\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . '), array("compil"=>array(\'../prive/squelettes/body.html\',\'html_b1432dd727ecb80a50019f8bc0477fcc\',\'\',28,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>
			</div>
		</div>
	</div>
</body>
');

	return analyse_resultat_skel('html_b1432dd727ecb80a50019f8bc0477fcc', $Cache, $page, '../prive/squelettes/body.html');
}
?>