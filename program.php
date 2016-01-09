<?php /* Template Name: program */ ?>
<?php get_header(); ?>
<?php 
  if ( have_posts() ) {
    while ( have_posts() ) {
      the_post(); ?>

      <div class="programWrap">
        <div class="container">
          <?php if ( is_active_sidebar( 'program' ) ) : ?>
          <div class="sidebar program_side">
            <?php dynamic_sidebar( 'program' ); ?>
          </div><!-- /sidebar -->
          <?php endif; ?>
          <div class="program__main_content">
            <h1><?php the_title(); ?></h1>
            <ul class="extras">
              <?php 
                $ticketLink = get_field('ticket_link');
                $vidLink = get_field('video_link');
                $photoLink = get_field('photo_link');
                $press = get_field('press_release');
              ?>
              <?php 
                if($ticketLink != ''){
                  echo '<li><a target="_blank" href="' . $ticketLink . '"><span class="icon tickets">&nbsp;</span>Tickets</a></li>';
                }
                if($vidLink != ''){
                  echo '<li><a target="_blank" href="'. $vidLink . '"><span class="icon video">&nbsp;</span>Video</a></li>';
                }
                if($photoLink != ''){
                  echo '<li><a target="_blank" href="'.$photoLink.'"><span class="icon photo">&nbsp;</span>Photos</a></li>';
                }
                if($press != ''){
                  echo '<li><a target="_blank" href="'.$press.'"><span class="icon press">&nbsp;</span>Press Release</a></li>';
                }
              ?>
            </ul>
            <?php the_content(); ?>
            <?php
               $link = get_field('call_to_action_link');
               $text = get_field('call_to_action_text');
               if($link && $text){
                  echo'<p class="program_cta"><a href="' . $link . '">' . $text . '</a></p>';
                }
            ?>
          </div><!-- /main_content -->
        </div><!-- /container -->
      </div><!-- /programWrap -->

    <?php
    } // end while
  } // end if
  ?>
<?php get_footer(); ?>
