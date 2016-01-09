<?php /* Template Name: Homepage */ ?>
<?php get_header(); ?>
<?php 
  if ( have_posts() ) {
    while ( have_posts() ) {
      the_post(); ?>

      <?php $args = array(
        'posts_per_page'   => 5,
        'offset'           => 0,
        'category_name'    => 'Slider',
        'orderby'          => 'date',
        'order'            => 'DESC',
        'post_type'        => 'post',
        'post_status'      => 'publish',
        'suppress_filters' => true 
      );
      $slides = get_posts( $args ); 
      $output = '<section class="heroSlider">';
      $output .= '<ul>';
      foreach ($slides as $slide){
        $url = wp_get_attachment_url( get_post_thumbnail_id($slide->ID) );
        $output .= '<li style="background: url(\''.$url.'\') center top no-repeat; background-size: cover;">';
        $output .= '<h4 class="slider__title">'.$slide->post_title.'</h4>';
        $output .= '<p class="slider__text">'.$slide->post_content.'<br ><a href="'. get_field('learn_more_link', $slide->ID) . '">Learn More ></a></p>';
        $output .= '</li>';
      }
      $output .= '</ul>';
      $output .= '</section>';
      echo $output;
      ?>

      <section class="attheLab">
        <div class="contain">
          <h3 class="attheLab__title"><?php the_field('event_highlight_section_title'); ?></h3>
          <p class="attheLab__eventTitle"><?php the_field('event_title'); ?></p>
          <?php $test = get_field('event_image'); ?>
          <img src="<?php echo $test; ?>" />
             
          <a class="attheLab__link" href="<?php echo get_field('event_button_link'); ?>"><?php the_field('event_button_text'); ?></a>
          <div class="attheLab__description"><?php the_field('event_description'); ?><p><a href="<?php the_field('event_link'); ?>">Learn More ></a></p></div>
        </div><!-- /contain -->
      </section><!-- /atthelab -->

      <section class="purchase">
        <div class="contain">
          <?php $field = get_field('purchase_tickets_image');  ?>
          <img src="<?php echo $field['url']; ?>" />
          <a class="purchase__link" href="<?php the_field('purchase_tickets_link'); ?>"><?php the_field('purchase_tickets_link_text'); ?></a>
          <div class="purchase__text"><?php the_field('purchase_tickets_text'); ?></div>
        </div><!-- /contain -->
      </section><!-- /purachse -->

      <?php $args = array(
        'post_parent' => get_the_ID(),
        'post_type'   => 'any', 
        'posts_per_page' => -1,
        'order' => 'DESC',
        'post_status' => 'publish' ); 

        $children_array = get_children( $args); 
      ?>
      <section class="homeQuotes">
        <a class="unslider-arrow prev">&nbsp;</a>
        <a class="unslider-arrow next">&nbsp;</a>
        <ul>
          <?php 
            $output = '';
            foreach ($children_array as $value) {
              $output .= '<li>';
              $output .= '<div class="quote__wrapper">';
              $output .= '<p class="quote__content">'. $value->post_content . '</p>';
              $output .='<p class="quote__attribute">'. get_field('attribute',$value->ID)  .'</p>';
              $output .= '</div>';
              $output .='</li>';
            }
            echo $output;
          ?>
        </ul>
      </section>

      <section class="buckets">
        <div class="contain">
          <div class="bucket">
            <h3 class="bucket__title"><?php the_field('bucket_1_title'); ?></h3>
            <?php $bucketOne = get_field('bucket_1_image'); ?>
            <img class="bucket__img" src="<?php echo $bucketOne['url']; ?>" />
            <p class="bucket__text"><?php the_field('bucket_1_text'); ?></p>
            <?php $bucketOneLink = get_field('bucket_1_link'); ?>
            <a class="bucket__cta" href="<?php echo $bucketOneLink; ?>"><?php the_field('bucket_1_link_text'); ?></a>
          </div>
          <div class="bucket">
            <h3 class="bucket__title"><?php the_field('bucket_2_title'); ?></h3>
            <?php $bucketTwo = get_field('bucket_2_image'); ?>
            <img class="bucket__img" src="<?php echo $bucketTwo['url']; ?>" />
            <p class="bucket__text"><?php the_field('bucket_2_text'); ?></p>
            <?php $bucketTwoLink = get_field('bucket_2_link'); ?>
            <a class="bucket__cta" href="<?php echo $bucketTwoLink; ?>"><?php the_field('bucket_2_link_text'); ?></a>
          </div>
          <div class="bucket">
            <h3 class="bucket__title"><?php the_field('bucket_3_title'); ?></h3>
            <?php $bucketThree = get_field('bucket_3_image');?>
            <img class="bucket__img" src="<?php echo $bucketThree['url']; ?>" />
            <p class="bucket__text"><?php the_field('bucket_3_text'); ?></p>
            <?php $bucketThreeLink = get_field('bucket_3_link');?>
            <a class="bucket__cta" href="<?php echo $bucketThreeLink; ?>"><?php the_field('bucket_3_link_text'); ?></a>
          </div>
        </div>
      </section>
    <?php
    } // end while
  } // end if
  ?>
<?php get_footer(); ?>
