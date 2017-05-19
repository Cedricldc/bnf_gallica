<?php

/*
 * Squelette : squelettes/inclure/pied.html
 * Date :      Thu, 18 May 2017 14:53:31 GMT
 * Compile :   Fri, 19 May 2017 10:33:59 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette squelettes/inclure/pied.html
// Temps de compilation total: 0.055 ms
//

function html_b878135c25670f91695b26160af4b123($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = '<div id="fh5co-footer" role="contentinfo">
		<div class="container">
			<div class="row">
			
			 <section id="fh5co-logo" data-section="logo">
		<div class="fh5co-logo"></div>
		<div class="container"></div>
      <center><p><img class="size-full wp-image-1201 alignnone" src="squelettes/images/logoo.png" alt="" width="160" height="160" />&nbsp;&nbsp;&nbsp;&nbsp; <img class="size-full wp-image-1201 alignnone" src="squelettes/images/logo8.png" alt="" width="250" height="160" /></p>
			      
  <br>
        <div class="container text-center">
            <p>Copyright &copy; La France en Amérique</p>
	    </div>
				    <!-- Formulaire de contact
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
	-->';

	return analyse_resultat_skel('html_b878135c25670f91695b26160af4b123', $Cache, $page, 'squelettes/inclure/pied.html');
}
?>