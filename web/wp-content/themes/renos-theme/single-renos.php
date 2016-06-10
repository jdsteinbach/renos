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
              echo '<li><a href="' . $i['link'] . '">' . $i['link'] . '</a></li>';
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
            <p class="start-date">Start Date: <?php echo date( "F j, Y", strtotime( $reno_details['start_date'] ) ); ?></p>
            <p class="end-date">End Date: <?php echo date( "F j, Y", strtotime( $reno_details['end_date'] ) ); ?></p>
          </div>
        </div>
        <div class="reno-cost">
          <h2>Estimated Cost</h2>
          <h3>Materials</h3>
          <table>
            <tr>
              <th>Name</th>
              <th>From</th>
              <th>Price</th>
              <th>Qty</th>
              <th>Total</th>
            </tr>
            <?php $cost = 0;
            foreach ( $reno_details['materials'] as $m ) {
              $cost = $cost + $m['price'] * $m['quantity'];
              echo '<tr><td>' . $m['name'] . '</td><td><a href="' . $m['link'] . '">Buy Here</a></td><td>$' . $m['price'] . '</td><td>' . $m['quantity'] . '</td><td>$' . $m['price'] * $m['quantity'] . '</td></tr>';
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
