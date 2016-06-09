<?php get_header(); ?>

<main role="main" class="site-content">

  <section class="content">

    <h1 class="page-title">Error 410</h1>
    <p>Content permanently removed.</p>

    <h2>Search the Site</h2>
    <?php include_once( 'partials/search-form.php' ); ?>

    <h2>Latest posts</h2>
    <ul class="hfeed">
    <?php
      $query = new WP_Query( 'posts_per_page=5' );
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
