  <footer class="site-footer">

    <?php if ( false ) : ?>
    <nav class="nav footer-nav">
      <?php wp_nav_menu( array( 'menu' => 'Main-Nav', 'theme_location' => 'footer', 'container' => false ) ); ?>
    </nav>
    <?php endif; ?>

    <p class="legal"><?php echo SITE_NAME; ?> &copy; <?php echo date( 'Y' ); ?> All Rights Reserved</p>

  </footer>

  <?php wp_footer(); ?>

  <?php if ( 'local' == WP_ENV ) : ?>
  <!-- Live Reload -->
  <script src="//localhost:35729/livereload.js"></script>
  <?php endif; ?>

</body>

</html>
