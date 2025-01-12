<?php
get_header();
?>

<div id="cuerpo" class="container">
    <header class="author-header">
			<div class="w-25 p-3 float-end">
				<?php echo vcp_thumbnail('author') ?>
			</div>
			<div class="headline w-75">
				<h2 class="author-name">
                    <?php echo get_the_author(); ?>
				</h2>
			</div>
		</header>

		<div id="author-summary">
			<?php
               // Author description
                $author_description = get_the_author_meta('description');
                if (!empty($author_description)):
                    printf('<div class="author-description">%s</div>', $author_description); 
                endif;
            ?>
		</div>

        <div class="headline"><h2>Artículos de <?php echo get_the_author(); ?></h2></div>
		    <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-6">

<?php
    // Author posts
    $author_id = get_the_author_meta('ID');
    $args = array(
        'author' => $author_id,
        'posts_per_page' => -1
    );
    $author_posts = new WP_Query($args);

    if ($author_posts->have_posts()):
        ?>
        <ul>
        <?php while ($author_posts->have_posts()) : $author_posts->the_post(); ?>
            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
        <?php
        endwhile;
        ?>
        </ul>
        <?php
    endif;
    wp_reset_postdata();
    ?>
    </div></div>

</div>

<?php
    get_footer();
?>