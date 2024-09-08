<?php
get_header();
$reno_details = get_fields();
// var_dump($reno_details);
?>

<main role="main" class="site-content">

  <section class="content">

    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

    <?php edit_post_link('Edit', '', '' ); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <div class="entry-content reno">
        <div class="reno-description">
          <h2>Description</h2>
          <?php the_content(); ?>
          <h2>Inspiration Links</h2>
          <ul>
            <?php foreach ( $reno_details['inspiration'] as $i ) {
              $img_title = return_curl_contents( $i['link'], '<title>', '</title>' );
              $img_url   = return_curl_contents( $i['link'], 'og:image" content="', '"' );
              echo '<li class="inspiration-card"><a class="inspiration-image" href="' . $i['link'] . '" style="background-image:url(' . $img_url . ')"><span>' . $img_title . '</span></a></li>';
            } ?>
          </ul>
        </div>
        <div class="reno-sidebar">
          <div class="reno-room">
            <h2>Room</h2>
            <p><?php echo implode( ', ', wp_get_post_terms( $post->ID, 'room', array("fields" => "names") ) ); ?></p>
          </div>
          <div class="reno-priority">
            <h2>Priority</h2>
            <p><?php echo ucwords( $reno_details['priority'] ); ?></p>
          </div>
          <div class="reno-dates">
            <h2>Dates</h2>
            <p class="start-date"><b>Start Date:</b> <?php echo date( "F j, Y", strtotime( $reno_details['start_date'] ) ); ?></p>
            <p class="end-date"><b>End Date:</b> <?php echo date( "F j, Y", strtotime( $reno_details['end_date'] ) ); ?></p>
          </div>
        </div>
        <div class="reno-cost">
          <h2>Estimated Cost</h2>
          <h3>Materials</h3>
          <table>
            <tr>
              <th></th>
              <th>Name</th>
              <th>Price</th>
              <th>Qty</th>
              <th>Total</th>
              <th>From</th>
            </tr>
            <?php $cost = 0;
            foreach ( $reno_details['materials'] as $m ) {
              $cost = $cost + $m['price'] * $m['quantity'];
              $m_img_url = return_curl_contents( $m['link'], 'og:image" content="', '"' );
              echo '<tr><td class="material-image" style="background-image:url(' . $m_img_url . ')"></td><td>' . $m['name'] . '</td><td>$' . $m['price'] . '</td><td>' . $m['quantity'] . '</td><td>$' . $m['price'] * $m['quantity'] . '</td><td><a class="button" href="' . $m['link'] . '">Buy Here</a></td></tr>';
            } ?>
          </table>

          <h3>Labor</h3>
          <p>$<?php echo $reno_details['labor_cost']; ?></p>

          <h3>Total Cost</h3>
          <p><b>$<?php echo $reno_details['labor_cost'] + $cost; ?></b></p>
        </div>
      </div>
    </article>

    <?php endwhile; ?>

  </section>

  <?php get_sidebar(); ?>

</main>

<?php get_footer(); ?>
