<?php get_header(); ?>

<main role="main" class="site-content">

  <section class="content">

    <h1 class="page-title">Search Results</h1>

    <h2>Search Again?</h2>
    <?php include_once( 'partials/search-form.php' ); ?>

    <ul class="hfeed">
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

      <?php include( 'partials/post-preview.php' ); ?>

    <?php endwhile; ?>
    </ul>

    <?php if ( function_exists( 'pagination' ) ) { pagination(); } ?>

  </section>

  <?php get_sidebar(); ?>

</main>

<?php get_footer(); ?>
