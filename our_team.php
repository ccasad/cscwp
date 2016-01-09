<?php /* Template Name: Our Team */ ?>
<?php get_header(); ?>
<?php 

  class teamMember{
    public $title;
    public $bio;
    public $name;
    public $group;
    public $id;
    public $groupOneOrder;
    public $groupTwoOrder;
    public $groupThreeOrder;
    public $groupFourOrder;
    public $groupFiveOrder;
    public $isStemEducator;
  }

  $mgmt = array();
  $bod = array();
  $advice = array();
  $counsil = array();
  $stemEducator = array();

  if ( have_posts() ) {
    while ( have_posts() ) {
      the_post(); ?>
      <?php 
        $args = array(
          'post_parent' => get_the_ID(),
          'post_status' => 'publish' );

        $children = get_children($args);
        foreach($children as $child){
          $person = new teamMember();
          $person->id = $child->ID;
          $person->name = $child->post_title;
          $person->bio = apply_filters('the_content', $child->post_content);
          $person->title = get_field('title', $child->ID);
          $person->group = get_field('group', $child->ID);

          if(in_array("mgmtTeam" ,$person->group)){
            $person->groupOneOrder = get_field('management_team_order', $child->ID);
            $person->isStemEducator = get_field('is_stem_educator', $child->ID);
            if($person->isStemEducator === 'yes'){
              array_push($stemEducator,$person);
            }
            else{
              array_push($mgmt, $person);
            }
          }
          if(in_array("bod", $person->group)){
            $person->groupTwoOrder = get_field('board_of_directors_order', $child->ID);
            array_push($bod, $person);
          }
          if(in_array('adviceBoard', $person->group)){
            $person->groupThreeOrder = get_field('advisory_board_order', $child->ID);
            array_push($advice, $person);
          }
          if(in_array('counsil', $person->group)){
            $person->groupFourOrder = get_field('stem_advisory_council_order', $child->ID);
            array_push($counsil, $person);
          }
        }
      
        //Sort arrays based on order field
        function sortMgmt($a, $b){
          if($a->groupOneOrder == $b->groupOneOrder){ return 0 ; }
          return ($a->groupOneOrder < $b->groupOneOrder) ? -1 : 1;
        }
        function sortBod($a, $b){
          if($a->groupTwoOrder == $b->groupTwoOrder){ return 0 ; }
          return ($a->groupTwoOrder < $b->groupTwoOrder) ? -1 : 1;
        }
        function sortAdviceBoard($a, $b){
          if($a->groupThreeOrder == $b->groupThreeOrder){ return 0 ; }
          return ($a->groupThreeOrder < $b->groupThreeOrder) ? -1 : 1;
        }
        function sortStem($a, $b){
          if($a->groupFourOrder == $b->groupFourOrder){ return 0 ; }
          return ($a->groupFourOrder < $b->groupFourOrder) ? -1 : 1;
        }

        usort($mgmt, "sortMgmt");
        usort($stemEducator, "sortMgmt");
        usort($bod, "sortBod");
        usort($advice, "sortAdviceBoard");
        usort($counsil, "sortStem");
      ?>

      <div class="programWrap">
        <div class="container">
          <?php if ( is_active_sidebar( 'team' ) ) : ?>
          <div class="sidebar">
            <?php dynamic_sidebar( 'team' ); ?>
          </div><!-- /sidebar -->
          <?php endif; ?>
          <div class="program__main_content">
            <div class="tabNav">
              <a class="active" href="#mgmtTeam">Management Team</a>
              <a href="#bod">Board of Directors</a>
              <a href="#AdviceBoard">Advisory Board</a>
              <a href="#Counsil">STEM Advisory Council</a>
            </div>
            <div class="tab_panel open" id="mgmtTeam">
              <h1>Management Team</h1>
              <p class="team_cat_intro"><?php echo get_field('management_team_intro', get_the_ID()); ?></p>
              <?php 
                $output = '';
                foreach($mgmt as $p){
                  $output .= '<div class="bio">';
                  $output .= '<h3 class="bio__name">'.$p->name.'</h3>';
                  $output .= '<p class="bio__title">'.$p->title.'</p>';
                  $output .= $p->bio;
                  $output .= '</div>';
                }
                echo $output;
              ?>
              <?php 
                $output = '<h1>STEM Educator</h1>';
                foreach($stemEducator as $p){
                  $output .= '<div class="bio">';
                  $output .= '<h3 class="bio__name">'.$p->name.'</h3>';
                  //$output .= '<p class="bio__title">'.$p->title.'</p>';
                  //$output .= $p->bio;
                  $output .= '</div>';
                }
                if(count($stemEducator) > 0){
                  echo $output;
                }
              ?>
            </div>
            <div class="tab_panel" id="bod">
              <h1>Board of Directors</h1>
              <p class="team_cat_intro"><?php echo get_field('board_of_directors_intro', get_the_ID()); ?></p>
              <?php 
                $output = '';
                foreach($bod as $p){
                  $output .= '<div class="bio">';
                  $output .= '<h3 class="bio__name">'.$p->name.'</h3>';
                  $output .= '<p class="bio__title">'.$p->title.'</p>';
                  $output .= $p->bio;
                  $output .= '</div>';
                }
                echo $output;
              ?>
            </div>
            <div class="tab_panel" id="AdviceBoard">
              <h1>Advisory Board</h1>
              <p class="team_cat_intro"><?php echo get_field('advisory_board_intro', get_the_ID()); ?></p>
              <?php 
                $output = '';
                foreach($advice as $p){
                  $output .= '<div class="bio">';
                  $output .= '<h3 class="bio__name">'.$p->name.'</h3>';
                  $output .= '<p class="bio__title">'.$p->title.'</p>';
                  //$output .= $p->bio;
                  $output .= '</div>';
                }
                echo $output;
              ?>
            </div>
            <div class="tab_panel" id="Counsil">
              <h1>STEM Advisory Council</h1>
              <p class="team_cat_intro"><?php echo get_field('stem_advistory_council_intro', get_the_ID()); ?></p>
              <?php 
                $output = '';
                foreach($counsil as $p){
                  $output .= '<div class="bio">';
                  $output .= '<h3 class="bio__name">'.$p->name.'</h3>';
                  $output .= '<p class="bio__title">'.$p->title.'</p>';
                  //$output .= $p->bio;
                  $output .= '</div>';
                }
                echo $output;
              ?>
            </div>
          </div><!-- /main_content -->
        </div><!-- /container -->
      </div><!-- /programWrap -->

    <?php
    } // end while
  } // end if
  ?>
<?php get_footer(); ?>
