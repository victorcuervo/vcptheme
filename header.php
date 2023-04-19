<?php
/**
 *
 * @package VCP
 * @subpackage VCP 2
 * @since VCP 2
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

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
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<!-- Navegación -->
	<div id="menu">

		<nav class="navbar-default" role="navigation">
			<div class="container-fluid container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse"
						data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?php echo get_home_url(); ?>"><?php bloginfo('name'); ?></a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

					<?php if (has_nav_menu('primary'))
						wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'nav navbar-nav'));
					?>


					<form class="navbar-form navbar-right" role="search" action="<?php echo get_home_url(); ?>/search/"
						id="cse-search-box">
						<div class="form-group">
							<input type="text" name="q" size="31" class="form-control" placeholder="¿Qué buscas?">
							<input type="hidden" name="cx" value="partner-pub-<?php echo get_option('vcp_search'); ?>" />
							<input type="hidden" name="cof" value="FORID:10" />
							<input type="hidden" name="ie" value="UTF-8" />
						</div>
						<button type="submit" class="btn btn-default">Buscar</button>
					</form>
					<!--<script type="text/javascript" src="http://www.google.es/coop/cse/brand?form=cse-search-box&amp;lang=es"></script>-->

				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>

	</div>


	<!-- Cabecera -->
	<div id="cabecera">
		<div class="container">
			<!-- <div class="page-header col-md-4"> -->
			<div class="page-header">

				<?php
				$titulo = single_tag_title('', FALSE);
				if (empty($titulo))
					$titulo = single_post_title('', FALSE);

				if (is_front_page())
					echo '<h1>' . get_bloginfo('name') . '<br/><small>' . get_bloginfo('description') . '</small></h1>';
				else
					echo '<h1>' . $titulo . '<h1>';


				?>

			</div>

			<?php dynamic_sidebar('adscabecera'); ?>

		</div>
	</div>


	<!-- Menu Secundario -->
	<div id="destacados">
		<div class="container hidden-sm hidden-xs">
			<p class="navbar-text"><strong>No Te Pierdas:</strong> </p>

			<?php if (has_nav_menu('secondary'))
				wp_nav_menu(array('theme_location' => 'secondary', 'menu_class' => 'nav nav-pills'));
			?>

		</div>
	</div>