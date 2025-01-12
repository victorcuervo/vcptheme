<?php
/**
 * Template Name: Home Page
 * Plantilla para la página principal
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */


get_header(); ?>

<div id="cuerpo" class="container">



	<?php if (have_posts()): ?>
		<header class="home-header">
			<div class="w-25 p-3 float-end">
				<?php echo vcp_thumbnail('article') ?>
			</div>
			<div class="headline w-75 p-1" id="home-info">
				<h2><?php the_title(); ?></h2>
			</div>
		</header>

	<?php
		the_content(); ?>


	<!-- Section -->
	<section>
		<header class="major">
			<h2>Últimos Artículos</h2>
		</header>
		<div class="posts">
			<article>
				<a href="#" class="image"><img src="images/pic01.jpg" alt="" /></a>
				<h3>Interdum aenean</h3>
				<p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
				<ul class="actions">
					<li><a href="#" class="button">More</a></li>
				</ul>
			</article>
			<article>
				<a href="#" class="image"><img src="images/pic02.jpg" alt="" /></a>
				<h3>Nulla amet dolore</h3>
				<p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
				<ul class="actions">
					<li><a href="#" class="button">More</a></li>
				</ul>
			</article>
			<article>
				<a href="#" class="image"><img src="images/pic03.jpg" alt="" /></a>
				<h3>Tempus ullamcorper</h3>
				<p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
				<ul class="actions">
					<li><a href="#" class="button">More</a></li>
				</ul>
			</article>
			<article>
				<a href="#" class="image"><img src="images/pic04.jpg" alt="" /></a>
				<h3>Sed etiam facilis</h3>
				<p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
				<ul class="actions">
					<li><a href="#" class="button">More</a></li>
				</ul>
			</article>
			<article>
				<a href="#" class="image"><img src="images/pic05.jpg" alt="" /></a>
				<h3>Feugiat lorem aenean</h3>
				<p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
				<ul class="actions">
					<li><a href="#" class="button">More</a></li>
				</ul>
			</article>
			<article>
				<a href="#" class="image"><img src="images/pic06.jpg" alt="" /></a>
				<h3>Amet varius aliquam</h3>
				<p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
				<ul class="actions">
					<li><a href="#" class="button">More</a></li>
				</ul>
			</article>
		</div>
	</section>
	

		<div class="headline">
			<h2>Lenguajes de Programación</h2>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-md-6 col-lg-3">
					<div class="card mb-3" style="max-width: 540px;">
						<a href="/html5/">
							<div class="row g-0">
								<div class="col-4">
									<img src="<?php echo get_template_directory_uri(); ?>/img/tecnologias/logos/html5_150.png"
										class="img-fluid rounded-start p-2" alt="Ejemplos Desarrollo HTML5">
								</div>
								<div class="col-8">
									<div class="card-body">
										<h5 class="card-title">HTML5</h5>
										<p class="card-text">Aprender a desarrollar páginas web mediante HTML5 aprendiendo cómo manejar los nuevos elementos de este lenguaje.</p>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-md-6 col-lg-3">
					<div class="card mb-3" style="max-width: 540px;">
						<a href="/java/">
							<div class="row g-0">
								<div class="col-4">
									<img src="<?php echo get_template_directory_uri(); ?>/img/tecnologias/logos/java_150.png"
										class="img-fluid rounded-start p-2" alt="Ejemplos Programación Java">
								</div>
								<div class="col-8">
									<div class="card-body">
										<h5 class="card-title">Java</h5>
										<p class="card-text">Ejemplos que te enseñarán a desarrollar código Java desde tu primer "Hola Mundo" hasta casos más complejos.</p>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-md-6 col-lg-3">
					<div class="card mb-3" style="max-width: 540px;">
						<a href="/javascript/">
							<div class="row g-0">
								<div class="col-4">
									<img src="<?php echo get_template_directory_uri(); ?>/img/tecnologias/logos/javascript_150.png"
										class="img-fluid rounded-start p-2" alt="Ejemplos Programación Javascript">
								</div>
								<div class="col-8">
									<div class="card-body">
										<h5 class="card-title">Javascript</h5>
										<p class="card-text">Ofrece capacidades dinámicas interesantes en tu página web desarrollando scripts de código en Javascript.</p>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-md-6 col-lg-3">
					<div class="card mb-3" style="max-width: 540px;">
						<a href="/css/">
							<div class="row g-0">
								<div class="col-4">
									<img src="<?php echo get_template_directory_uri(); ?>/img/tecnologias/logos/css_150.png"
										class="img-fluid rounded-start p-2" alt="Ejemplos Desarrollo CSS">
								</div>
								<div class="col-8">
									<div class="card-body">
										<h5 class="card-title">CSS</h5>
										<p class="card-text">Mejora el diseño y estilo de tus páginas web aprendiendo cómo desarrollar con CSS (Cascade Style Sheet).</p>

									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-md-6 col-lg-3">
					<div class="card mb-3" style="max-width: 540px;">
						<a href="/bootstrap/">
							<div class="row g-0">
								<div class="col-4">
									<img src="<?php echo get_template_directory_uri(); ?>/img/tecnologias/logos/bootstrap_150.png"
										class="img-fluid rounded-start p-2" alt="Ejemplos Programación Bootstrap">
								</div>
								<div class="col-8">
									<div class="card-body">
										<h5 class="card-title">Bootstrap</h5>
										<p class="card-text">Utiliza el framework Bootstrap para aprovechar de forma sencilla todas las capacidades de Javascript y CSS.</p>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-md-6 col-lg-3">
					<div class="card mb-3" style="max-width: 540px;">
						<a href="/emberjs/">
							<div class="row g-0">
								<div class="col-4">
									<img src="<?php echo get_template_directory_uri(); ?>/img/tecnologias/logos/emberjs_150.png"
										class="img-fluid rounded-start p-2" alt="Ejemplos Programación Ember.js">
								</div>
								<div class="col-8">
									<div class="card-body">
										<h5 class="card-title">Ember.js</h5>
										<p class="card-text">Optimiza el desarrollo web en Javascript productivo con el framework Ember.js para desarrolladores web ambiciosos.</p>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-md-6 col-lg-3">
					<div class="card mb-3" style="max-width: 540px;">
						<a href="/groovy/">
							<div class="row g-0">
								<div class="col-4">
									<img src="<?php echo get_template_directory_uri(); ?>/img/tecnologias/logos/groovy_150.png"
										class="img-fluid rounded-start p-2" alt="Ejemplos Programación Groovy">
								</div>
								<div class="col-8">
									<div class="card-body">
										<h5 class="card-title">Groovy</h5>
										<p class="card-text">Desarrolla con el lenguaje orientado a objetos Groovy para ejecutarlo dentro de tu plataforma de ejecución Java.</p>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-md-6 col-lg-3">
					<div class="card mb-3" style="max-width: 540px;">
						<a href="/html/">
							<div class="row g-0">
								<div class="col-4">
									<img src="<?php echo get_template_directory_uri(); ?>/img/tecnologias/logos/html_150.png"
										class="img-fluid rounded-start p-2" alt="Ejemplos Desarrollo HTML">
								</div>
								<div class="col-8">
									<div class="card-body">
										<h5 class="card-title">HTML</h5>
										<p class="card-text">Los principios de desarrollo web se fundamentan sobre el lenguaje HTLM para el desarrollo de páginas web.</p>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-md-6 col-lg-3">
					<div class="card mb-3" style="max-width: 540px;">
						<a href="/jquery/">
							<div class="row g-0">
								<div class="col-4">
									<img src="<?php echo get_template_directory_uri(); ?>/img/tecnologias/logos/jquery_150.png"
										class="img-fluid rounded-start p-2" alt="Ejemplos Programación jQuery">
								</div>
								<div class="col-8">
									<div class="card-body">
										<h5 class="card-title">jQuery</h5>
										<p class="card-text">Utiliza la librería jQuery rápida, pequeña y con muchas funcionalidades para el desarrollo de tus páginas web.</p>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-md-6 col-lg-3">
					<div class="card mb-3" style="max-width: 540px;">
						<a href="/dotnet/">
							<div class="row g-0">
								<div class="col-4">
									<img src="<?php echo get_template_directory_uri(); ?>/img/tecnologias/logos/dotnet_150.png"
										class="img-fluid rounded-start p-2" alt="Artículos de Programación .Net">
								</div>
								<div class="col-8">
									<div class="card-body">
										<h5 class="card-title">.Net</h5>
										<p class="card-text">Aprende a utilizar la plataforma de desarrollo .Net para poder crear aplicaciones de escritorio Windows.</p>

									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-md-6 col-lg-3">
					<div class="card mb-3" style="max-width: 540px;">
						<a href="/mongodb/">
							<div class="row g-0">
								<div class="col-4">
									<img src="<?php echo get_template_directory_uri(); ?>/img/tecnologias/logos/mongodb_150.png"
										class="img-fluid rounded-start p-2" alt="Ejemplos Programación MongoDB">
								</div>
								<div class="col-8">
									<div class="card-body">
										<h5 class="card-title">MongoDB</h5>
										<p class="card-text">Utiliza las capacidades de la base de datos NoSQL MongoDB para poder almacenar todo tipo de datos en tus aplicaciones.</p>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-md-6 col-lg-3">
					<div class="card mb-3" style="max-width: 540px;">
						<a href="/nodejs/">
							<div class="row g-0">
								<div class="col-4">
									<img src="<?php echo get_template_directory_uri(); ?>/img/tecnologias/logos/nodejs_150.png"
										class="img-fluid rounded-start p-2" alt="Ejemplos Programación Node.js">
								</div>
								<div class="col-8">
									<div class="card-body">
										<h5 class="card-title">Node.js</h5>
										<p class="card-text">Amplia tus conocimientos en Javascript para desarrollar aplicaciones servidor utilizando Node.js.</p>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-md-6 col-lg-3">
					<div class="card mb-3" style="max-width: 540px;">
						<a href="/php/">
							<div class="row g-0">
								<div class="col-4">
									<img src="<?php echo get_template_directory_uri(); ?>/img/tecnologias/logos/php_150.png"
										class="img-fluid rounded-start p-2" alt="Ejemplos Programación PHP">
								</div>
								<div class="col-8">
									<div class="card-body">
										<h5 class="card-title">PHP</h5>
										<p class="card-text">Crea aplicaciones web de servidor aprovechando todas las capacidades que ofrece el lenguaje de programación PHP.</p>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-md-6 col-lg-3">
					<div class="card mb-3" style="max-width: 540px;">
						<a href="/python/">
							<div class="row g-0">
								<div class="col-4">
									<img src="<?php echo get_template_directory_uri(); ?>/img/tecnologias/logos/python_150.png"
										class="img-fluid rounded-start p-2" alt="Ejemplos Programación Python">
								</div>
								<div class="col-8">
									<div class="card-body">
										<h5 class="card-title">Python</h5>
										<p class="card-text">Aprovecha la sencillez del lenguaje de programación Pyhton para poder construir cualquier tipo de aplicación.</p>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-md-6 col-lg-3">
					<div class="card mb-3" style="max-width: 540px;">
						<a href="/reactjs/">
							<div class="row g-0">
								<div class="col-4">
									<img src="<?php echo get_template_directory_uri(); ?>/img/tecnologias/logos/react_150.png"
										class="img-fluid rounded-start p-2" alt="Ejemplos Programación React">
								</div>
								<div class="col-8">
									<div class="card-body">
										<h5 class="card-title">React</h5>
										<p class="card-text">Utiliza React para construir interfaces de usuario basados en componentes y así crear aplicaciones de usuario nativas.</p>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-md-6 col-lg-3">
					<div class="card mb-3" style="max-width: 540px;">
						<a href="/sql/">
							<div class="row g-0">
								<div class="col-4">
									<img src="<?php echo get_template_directory_uri(); ?>/img/tecnologias/logos/sql_150.png"
										class="img-fluid rounded-start p-2" alt="Ejemplos Programación SQL">
								</div>
								<div class="col-8">
									<div class="card-body">
										<h5 class="card-title">SQL</h5>
										<p class="card-text">Mediante el uso de sentencias SQL podrás realizar consultas y modificar datos sobre bases de datos relacionales.</p>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-md-6 col-lg-3">
					<div class="card mb-3" style="max-width: 540px;">
						<a href="/typescript/">
							<div class="row g-0">
								<div class="col-4">
									<img src="<?php echo get_template_directory_uri(); ?>/img/tecnologias/logos/typescript_150.png"
										class="img-fluid rounded-start p-2" alt="Ejemplos Programación Typescript">
								</div>
								<div class="col-8">
									<div class="card-body">
										<h5 class="card-title">Typescript</h5>
										<p class="card-text">Convierte Javascript en un lenguaje de programación con fuerte tipado para tener mayor control mediante Typescript.</p>

									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-md-6 col-lg-3">
					<div class="card mb-3" style="max-width: 540px;">
						<a href="/xml/">
							<div class="row g-0">
								<div class="col-4">
									<img src="<?php echo get_template_directory_uri(); ?>/img/tecnologias/logos/xml_150.png"
										class="img-fluid rounded-start p-2" alt="Ejemplos Desarrollo XML">
								</div>
								<div class="col-8">
									<div class="card-body">
										<h5 class="card-title">XML</h5>
										<p class="card-text">Define estructuras de metainformación de propósito general mediante el uso de elementos y valores con XML.</p>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-md-6 col-lg-3">
					<div class="card mb-3" style="max-width: 540px;">
						<a href="/xslt/">
							<div class="row g-0">
								<div class="col-4">
									<img src="<?php echo get_template_directory_uri(); ?>/img/tecnologias/logos/xsl_150.png"
										class="img-fluid rounded-start p-2" alt="Ejemplos Desarrollo XSLT">
								</div>
								<div class="col-8">
									<div class="card-body">
										<h5 class="card-title">XSLT</h5>
										<p class="card-text">Realiza transformaciones y conversiones de datos basadas en XML mediantes estructuras XSLT.</p>

									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>

		<div class="blockquote-wrapper">
			<div class="blockquote">
				<h1>
				Mantén un aprendizaje continuo, se constante, comparte y difunde el arte de programar.
				</h1>
				<h4>&mdash;Víctor Cuervo</h4>
			</div>
		</div>

		<?php 
			printf('%s', vcp_get_last_articles2('',''));
		?>



		<div class="row">
			<div class="col-md-12">
				<?php dynamic_sidebar('adspost'); ?>
			</div>
		</div>

		<?php

	endif;
	?>

</div><!-- #Fin Contenido Principal -->

<?php
get_footer();