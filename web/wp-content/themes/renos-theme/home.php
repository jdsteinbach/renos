<?php get_header(); ?>

<main role="main" class="site-content">

  <section class="content">

    <h2>Latest posts</h2>
    <ul class="hfeed">
    <?php
      $query = new WP_Query( 'posts_per_page=10' );
      if ( $query->have_posts() ) while ( $query->have_posts() ) : $query->the_post();
    ?>

      <?php include( 'partials/post-preview.php' ); ?>

    <?php
      endwhile;
      wp_reset_postdata();
    ?>
    </ul>

  </section>

  <?php get_sidebar(); ?>

</main>

<?php get_footer(); ?>
