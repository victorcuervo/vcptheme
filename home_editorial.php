<?php
/**
 * Template Name: Editorial
 * Plantilla para la página principal que incluye la editorial
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

	<?php the_content(); ?>



	<!-- Editorial -->
	<?php

		// Comprobamos si hay editorial
		$editorial = get_option('vcp_editorial');

		if ($editorial != 0):
			// Post de la Editorial
			$posteditorial = wp_get_recent_posts(array('numberposts' => '1', 'post_status' => 'publish', 'category' => $editorial))[0];

			if (isset($posteditorial)):
	?>
		
	<header id="header">
		<a href="<?php echo get_home_url(); ?>/categoria/editorial/" class="titulo-editorial"><strong>Editorial</strong> por Víctor Cuervo</a>
	</header>
	<section id="editorial" class="container my-5">
		<div class="row">
			<div class="col-md-6 d-flex flex-column justify-content-start mb-3 mb-md-0">
				<h2 class="titular-1"><?php echo $posteditorial["post_title"] ?></h2>
				<p><?php echo $posteditorial["post_excerpt"] ?></p>
				<span><a href="<?php echo get_permalink($posteditorial["ID"]) ?>" title="<?php echo esc_attr($posteditorial["post_title"]) ?>" class="btn btn-primary btn-sm">Leer Más</a>
				<a href="<?php echo get_permalink($posteditorial["ID"]) ?>" title="<?php echo esc_attr($posteditorial["post_title"]) ?>" class="btn btn-primary btn-sm">Otras Editoriales</a>
				<a href="<?php echo get_permalink($posteditorial["ID"]) ?>" title="<?php echo esc_attr($posteditorial["post_title"]) ?>" class="btn btn-primary btn-sm">Suscribirse</a></span>
			</div>
			<div class="col-md-6">
				<?php echo get_the_post_thumbnail($posteditorial["ID"], 'full', array('class' => 'img-fluid rounded h-100', 'alt' => get_the_title($posteditorial["ID"]))); ?>
			</div>
		</div>
	</section>
	
	<?php
			endif;
		endif;
	?>


	<!-- Últimos Códigos -->
	<?php
		$excluded_categories = array(get_cat_ID('Editorial'), get_cat_ID('Blog'));
		printf('%s', vcp_get_last_articles(null,'category__not_in',$excluded_categories));
	?>

	<!-- Cita -->
	<div class="blockquote-wrapper">
		<div class="blockquote">
			<h2>
			Mantén un aprendizaje continuo, se constante, comparte y difunde el arte de programar.
			</h2>
			<h4>&mdash;Víctor Cuervo</h4>
		</div>
	</div>


	<!-- Lenguajes de Programación -->
	<section>
		<header class="headline">
			<h2>Lenguajes de Programación</h2>
		</header>
		<div class="container">
			<div class="row">
				<?php
				$languages = [
					['url' => '/html5/', 'img' => 'html5_150.png', 'alt' => 'Ejemplos Desarrollo HTML5', 'title' => 'HTML5'],
					['url' => '/java/', 'img' => 'java_150.png', 'alt' => 'Ejemplos Programación Java', 'title' => 'Java'],
					['url' => '/javascript/', 'img' => 'javascript_150.png', 'alt' => 'Ejemplos Programación Javascript', 'title' => 'Javascript'],
					['url' => '/css/', 'img' => 'css_150.png', 'alt' => 'Ejemplos Desarrollo CSS', 'title' => 'CSS'],
					['url' => '/bootstrap/', 'img' => 'bootstrap_150.png', 'alt' => 'Ejemplos Programación Bootstrap', 'title' => 'Bootstrap'],
					['url' => '/emberjs/', 'img' => 'emberjs_150.png', 'alt' => 'Ejemplos Programación Ember.js', 'title' => 'Ember.js'],
					['url' => '/groovy/', 'img' => 'groovy_150.png', 'alt' => 'Ejemplos Programación Groovy', 'title' => 'Groovy'],
					['url' => '/html/', 'img' => 'html_150.png', 'alt' => 'Ejemplos Desarrollo HTML', 'title' => 'HTML'],
					['url' => '/jquery/', 'img' => 'jquery_150.png', 'alt' => 'Ejemplos Programación jQuery', 'title' => 'jQuery'],
					['url' => '/dotnet/', 'img' => 'dotnet_150.png', 'alt' => 'Artículos de Programación .Net', 'title' => '.Net'],
					['url' => '/mongodb/', 'img' => 'mongodb_150.png', 'alt' => 'Ejemplos Programación MongoDB', 'title' => 'MongoDB'],
					['url' => '/nodejs/', 'img' => 'nodejs_150.png', 'alt' => 'Ejemplos Programación Node.js', 'title' => 'Node.js'],
					['url' => '/php/', 'img' => 'php_150.png', 'alt' => 'Ejemplos Programación PHP', 'title' => 'PHP'],
					['url' => '/python/', 'img' => 'python_150.png', 'alt' => 'Ejemplos Programación Python', 'title' => 'Python'],
					['url' => '/reactjs/', 'img' => 'react_150.png', 'alt' => 'Ejemplos Programación React', 'title' => 'React'],
					['url' => '/sql/', 'img' => 'sql_150.png', 'alt' => 'Ejemplos Programación SQL', 'title' => 'SQL'],
					['url' => '/typescript/', 'img' => 'typescript_150.png', 'alt' => 'Ejemplos Programación Typescript', 'title' => 'Typescript'],
					['url' => '/xml/', 'img' => 'xml_150.png', 'alt' => 'Ejemplos Desarrollo XML', 'title' => 'XML'],
					['url' => '/xslt/', 'img' => 'xsl_150.png', 'alt' => 'Ejemplos Desarrollo XSLT', 'title' => 'XSLT'],
				];

				foreach ($languages as $language) {
					echo '<div class="col-6 col-sm-4 col-md-3 col-lg-2 d-flex align-items-stretch">';
					echo '<div class="card mb-3 flex-grow-1">';
					echo '<a href="/categoria' . $language['url'] . '">';
					echo '<div class="row g-0">';
					echo '<div class="col-4">';
					echo '<img src="' . get_template_directory_uri() . '/img/tecnologias/logos/' . $language['img'] . '" class="img-fluid rounded-start p-2" alt="' . $language['alt'] . '">';
					echo '</div>';
					echo '<div class="col-8 d-flex align-items-center justify-content-end">';
					echo '<div class="card-body text-start">';
					echo '<h5 class="card-title">' . $language['title'] . '</h5>';
					echo '</div>';
					echo '</div>';
					echo '</div>';
					echo '</a>';
					echo '</div>';
					echo '</div>';
				}
				?>
			</div>
		</div>
	</section>



	<!-- Vídeo -->
	<?php

		// Recupero el último vídeo
		$idtagvideo = get_term_by('name', 'Vídeo', 'post_tag')->term_id;
		$post_videos = wp_get_recent_posts(array('numberposts' => '1', 'post_status' => 'publish', 'tag_id' => $idtagvideo));
		$video_url = get_post_meta($post_videos[0]["ID"], 'video', true);
		if ($video_url):

	?>

	<section id="video" class="container my-5">
		<div class="row">
			<div class="col-md-6 bg-light d-flex flex-column justify-content-start" style="padding-top: 40px; padding-bottom: 40px;">
				<?php
				$video_title = str_replace('Vídeo ', '', $post_videos[0]["post_title"]);
				?>
				<h3 class="titular-2"><i class="fas fa-video"></i> <?php echo $video_title; ?></h3>
				<p><?php echo $post_videos[0]["post_excerpt"]; ?></p>
				<span><a href="<?php echo get_home_url(); ?>/tag/video/" title="Vídeos de Programación" class="btn btn-primary btn-sm">Ver Más Vídeos</a></span>	
			</div>
			<div class="col-md-6 d-flex align-items-center">
				<div class="embed-responsive embed-responsive-16by9 w-100 h-100">
					<iframe class="embed-responsive-item w-100 h-100" src="<?php echo esc_url($video_url); ?>" title="<?php echo $video_title; ?><" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</section>

	<?php endif; ?>



	<!-- Blog -->
	</section>

	<?php
		$idblog = get_cat_ID('Blog');
		$post_blogs = wp_get_recent_posts(array('numberposts' => '2', 'post_status' => 'publish', 'category' => $idblog));
	?>

	<section id="blog" class="container my-5">
		<header class="headline">
			<h2>Blog. <span style="color:#7f888f; font-size: 0.9em;">Actualidad sobre programación</span></h2>
		</header>
		<div class="row mb-4">
			<div class="col-md-6">
				<?php echo get_the_post_thumbnail($post_blogs[0]["ID"], 'full', array('class' => 'img-fluid', 'alt' => get_the_title($post_blogs[0]["ID"]))); ?>
			</div>
			<div class="col-md-6 d-flex flex-column justify-content-start">	
				<p><span style="color:#7f888f;"><i class="fas fa-calendar-alt"></i> <?php echo get_the_date('j F Y', $post_blogs[0]["ID"]); ?></span></p>
				<h3><?php echo $post_blogs[0]["post_title"]; ?></h3>
				<p><?php echo $post_blogs[0]["post_excerpt"]; ?></p>
				<span><a href="<?php echo get_permalink($post_blogs[0]["ID"]) ?>" title="<?php echo esc_attr($post_blogs[0]["post_title"]) ?>"  class="btn btn-primary btn-sm">Leer Más</a></span>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 d-flex flex-column justify-content-start">
				<p><span style="color:#7f888f;"><i class="fas fa-calendar-alt"></i> <?php echo get_the_date('j F Y', $post_blogs[1]["ID"]); ?></span></p>
				<h3><?php echo $post_blogs[1]["post_title"]; ?></h3>
				<p><?php echo $post_blogs[1]["post_excerpt"]; ?></p>
				<span><a href="<?php echo get_permalink($post_blogs[1]["ID"]) ?>" title="<?php echo esc_attr($post_blogs[1]["post_title"]) ?>" class="btn btn-primary btn-sm">Leer Más</a></span>
			</div>
			<div class="col-md-6">
			<?php echo get_the_post_thumbnail($post_blogs[1]["ID"], 'full', array('class' => 'img-fluid', 'alt' => get_the_title($post_blogs[1]["ID"]))); ?>
			</div>
		</div>
	</section>


	
	<style>
		.btn-sm {
			display: inline-block;
			padding: 10px 20px;
			width: auto;
			background-color: #fff;
			color: #3365A3;
			transition: background-color 0.3s ease;
		}

		.btn-sm:hover {
			background-color: #3365A3;
			color: #fff;
		}

		.titular-1, .titular-2 {
			font-family: 'Roboto Slab', serif;
			margin-bottom: 20px;
			font-weight: 700;
			line-height: 1.3;
			border: none;
		}

		.titular-1 {
			font-size: 3.5em;
		}

		.titular-2 {
			font-size: 2.5em;
		}
	</style>


	




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