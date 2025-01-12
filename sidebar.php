<div class="col-md-3">
    <aside id="sidebar">

        <div id="author">
            <div class="headline">
                <h4>
                    <?php the_author_meta('first_name');
                    echo ' ';
                    the_author_meta('last_name') ?>
                </h4>
            </div>
            <div class="img-thumbnail rounded float-end">
                <?php echo get_avatar(get_the_author_meta('ID'), 86); ?>
            </div>
            <div class="author-description">
                <?php the_author_meta('description'); ?>
            </div>
            <div class="author-social">
                <?php if (get_the_author_meta('user_url')): ?>
                    <a href="<?php the_author_meta('user_url'); ?>" target="_blank" rel="author external"><i class="fa-solid fa-house"></i></a>
                <? endif; ?>
                <?php if (get_the_author_meta('twitter')): ?>
                    <a href="<?php the_author_meta('twitter'); ?>" target="_blank"><i class="fa-brands fa-twitter fa-bounce"></i></a>
                <? endif; ?>
                <?php if (get_the_author_meta('github')): ?>
                    <a href="<?php the_author_meta('github'); ?>" target="_blank"><i class="fa-brands fa-github"></i></a>
                <? endif; ?>
                <?php if (get_the_author_meta('facebook')): ?>
                    <a href="<?php the_author_meta('facebook'); ?>" target="_blank"><i class="fa-brands fa-facebook"></i></a>
                <? endif; ?>
                <?php if (get_the_author_meta('linkedin')): ?>
                    <a href="<?php the_author_meta('linkedin'); ?>" target="_blank"><i class="fa-brands fa-linkedin"></i></a>
                <? endif; ?>
                <?php if (get_the_author_meta('youtube')): ?>
                    <a href="<?php the_author_meta('youtube'); ?>" target="_blank"><i class="fa-brands fa-youtube"></i></a>
                <? endif; ?>
                <?php if (get_the_author_meta('instagram')): ?>
                    <a href="<?php the_author_meta('instagram'); ?>" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                <? endif; ?>


            </div>
        </div>

        <?php
            $categories = get_the_category();
            if (isset($categories) && (sizeof($categories)>=1)) {
                $category = $categories[0]->cat_name;
                echo vcp_getmanual($category);
                //echo vcp_gettest($category);
            }
        ?>
    
        <?php dynamic_sidebar('adslateral'); ?> 

        <?php dynamic_sidebar('sidebarlateral'); ?>


        <?php //vcp_informacion_articulo(); ?>


        <div class="headline">
            <h4>
                <?php echo get_option('vcp_categorias'); ?>
            </h4>
        </div>

        <div class="categorias">
            <ul id="categorias">
                <?php
                    $args = array(
                        'orderby' => 'name',
                        'parent' => 0
                    );
                    $categories = get_categories($args);

                    foreach ($categories as $category) {
                        echo '<li><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></li>';
                    }
                ?>

            </ul>

        </div>



    </aside>
</div>