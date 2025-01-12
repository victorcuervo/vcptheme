<?php
/**
 *
 * @package VCP
 * @subpackage VCP 2
 * @since VCP 2
 */
?>
<!DOCTYPE html>
<html lang="es-ES">

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		<?php wp_title('|', true, 'right'); ?>
	</title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/img/favicon.ico">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('template_directory'); ?>/img/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php bloginfo('template_directory'); ?>/img/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php bloginfo('template_directory'); ?>/img/favicon-16x16.png">
	<link rel="manifest" href="<?php bloginfo('template_directory'); ?>/img/site.webmanifest">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<!-- Navegación -->
	<nav id="menu-principal" class="navbar navbar-expand-md navbar-dark">
		<div class="container">				
			<a class="navbar-brand" href="<?php echo get_home_url(); ?>"><?php bloginfo('name'); ?></a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
				data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
				aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<?php if (has_nav_menu('primary'))
					wp_nav_menu(array('container' => '', 'theme_location' => 'primary', 'menu_class' => 'navbar-nav me-auto mb-2 mb-lg-0'));
				?>
				<form class="d-flex" role="search" action="<?php echo get_home_url(); ?>/search/" id="cse-search-box">
					<input class="form-control me-2" name="q" type="search" placeholder="¿Qué buscas?" aria-label="Search">
					<input type="hidden" name="cx" value="partner-pub-<?php echo get_option('vcp_search'); ?>">
					<input type="hidden" name="cof" value="FORID:10">
					<input type="hidden" name="ie" value="UTF-8">
					<button class="btn btn-outline-light" type="submit">Buscar</button>
				</form>
			</div>
		</div>
	</nav>

	<!-- Cabecera -->
	<div id="cabecera">
		<div class="container">
			<div class="page-header">

				<?php
				$titulo = single_tag_title('', FALSE);
				if (empty($titulo))
					$titulo = single_post_title('', FALSE);

				if (is_front_page())
					echo '<h1>' . get_bloginfo('name') . '<br><small class="m-1 fs-4 lh-sm">' . get_bloginfo('description') . '</small></h1>';
				else
					echo '<h1>' . $titulo . '</h1>';
				?>

			</div>
			<?php dynamic_sidebar('adscabecera'); ?>
		</div>
		
	</div>

	<!-- Menu Secundario -->
	<nav id="destacados">
		<div class="container d-none d-md-flex">
			<p class="navbar-text"><strong>No Te Pierdas:</strong> </p>

			<?php if (has_nav_menu('secondary'))
				wp_nav_menu(array('theme_location' => 'secondary', 'menu_class' => 'nav nav-pills'));
			?>

		</div>
	</nav>
