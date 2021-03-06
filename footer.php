<?php
/**
 * The template for displaying the footer.
 */

global $logo_footer, $logo_text;
					if (get_custom_option('show_top_page') == 'yes' && get_custom_option('show_sidebar_top') == 'yes') {

						stopWrapper(); //<!-- </aside#tabBlog> -->

						global $THEMEREX_CURRENT_SIDEBAR;
						$THEMEREX_CURRENT_SIDEBAR = 'top';
						do_action( 'before_sidebar' );
						if ( ! dynamic_sidebar( get_custom_option('sidebar_top') ) ) {
							// Put here html if user no set widgets in sidebar
						}
					}
					
					stopWrapper(); //<!-- </div.content> -->

					// Show main sidebar
					get_sidebar();
					
					if (get_custom_option('body_style')!='fullscreen' && (!is_singular() || get_custom_option('single_style')!='single-portfolio-fullscreen')) {
						stopWrapper();	//<!-- </div.main> -->
					}
				?>
				</div> <!-- /.mainWrap -->

			<?php if (get_custom_option('show_sidebar_top') == 'yes') { ?>
			</div>	<!-- /.widgetTabs -->
			<?php } ?>

			<?php
			$show_user_footer = get_custom_option('show_user_footer');
			if (!empty($show_user_footer) && $show_user_footer != 'none') {
				$user_footer = themerex_strclear(get_custom_option('user_footer_content'), 'p');
				if (!empty($user_footer)) {
					$user_footer = substituteAll($user_footer);
					?>
					<div class="userFooterSection <?php echo $show_user_footer; ?>" style="display:none;">
						<?php
						//if ($show_user_footer != 'custom') { startWrapper('<div class="main">'); }
						echo $user_footer;
						//if ($show_user_footer != 'custom') { stopWrapper(); }
						?>
					</div>
					<?php
				}
			}
			?>


<!-- FOOTER CONTENT -->
      <?php $footer = get_page_by_title( 'footer'); ?>
      <div class="sign-up">
        <div class="sign-up__contain">
          <?php echo get_field('main_content', $footer->ID); ?>
          <?Php echo get_field('form', $footer->ID); ?>
        </div><!-- /sign-up__contain -->
      </div><!-- /sign-up -->
      <footer class="kinder-child-footer">
      <div class="kinder-child-footer__contain">
      <?php 
        echo '<p class="kinder-child-footer__intro">' . $footer->post_content . '</p>';
      ?>

      <span class="kinder-child-footer-nav">
        <?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
      </span>
      <div class="copy_socials socPage">
      <p>Connect With Us!</p>
      <ul>
        <?php
        $socials = get_theme_option('social_icons');
        foreach ($socials as $s) {
          if (empty($s['url'])) continue;
          $sn = basename($s['icon']);
          $sn = themerex_substr($sn, 0, themerex_strrpos($sn, '.'));
          if (($pos=themerex_strrpos($sn, '_'))!==false)
            $sn = themerex_substr($sn, 0, $pos);
          $soc = themerex_get_socials_url(basename($s['icon'])); //$s['icon'];
          ?>
          <li><a class="social_icons social_<?php echo $sn; ?>" style="background-image: url(<?php echo $soc; ?>);" target="_blank" href="<?php echo $s['url']; ?>"><span style="background-image: url(<?php echo $soc; ?>);"></    span></a></li>
          <?php
        }
        ?>
      </ul>
      </div>
      <?php wp_nav_menu( array( 'theme_location' => 'footer-sub-menu' ) ); ?>
      <p class="kinder-child-copy"><?php echo get_theme_option('footer_copyright'); ?></p>
      </div>
      </footer>
<!-- /FOOTER CONTENT -->  



			<div class="footerContentWrap" style="display:none;">
				<?php
				// ---------------- Footer contacts ----------------------
				if (($contact_style = get_custom_option('show_contacts_in_footer')) != 'no'  ) { 
					$address_1 = get_theme_option('contact_address_1');
					$address_2 = get_theme_option('contact_address_2');
					$phone = get_theme_option('contact_phone');
					$fax = get_theme_option('contact_fax');
					if ($contact_style=='yes') $contact_style = 'dark';
				?>
				<footer class="footerWrap footerStyle<?php echo themerex_strtoproper($contact_style); ?> contactFooterWrap">
					<div class="main contactFooter">
						<section>
							<div class="logo">
								<a href="<?php echo home_url(); ?>"><?php echo $logo_footer ? '<img src="'.$logo_footer.'" alt="">' : ''; ?><?php echo $logo_text ? '<span class="logo_text">'.apply_filters('theme_logo_text', $logo_text, 'footer').'</span>' : ''; ?></a>
							</div>
							<div class="contactAddress">
								<address class="addressRight">
									<?php echo __('Phone:', 'themerex') . ' ' . $phone; ?><br>
									<?php echo __('Fax:', 'themerex') . ' ' . $fax; ?>
								</address>
								<address class="addressLeft">
									<?php echo $address_2; ?><br>
									<?php echo $address_1; ?>
								</address>
							</div>
							<div class="contactShare">
								<ul>
									<?php
										$socials = get_theme_option('social_icons');
										foreach ($socials as $s) {
											if (empty($s['url'])) continue;
											$name = basename($s['icon']);
											$name = themerex_strtoproper(themerex_substr($name, 0, themerex_strrpos($name, '.')));
											if (($pos=themerex_strrpos($name, '_'))!==false)
												$name = themerex_substr($name, 0, $pos);
											$soc = themerex_get_socials_url(basename($s['icon'])); //$s['icon'];
											?><li><a class="social_icons fShare" href="<?php echo $s['url']; ?>" target="_blank" title="<?php echo $name; ?>" style="background-image: url(<?php echo $soc; ?>);"><span style="background-image: url(<?php echo $soc; ?>);"></span></a></li><?php 
										}
									?>
								</ul>
							</div>
						</section>
					</div>
				</footer>
				<?php } ?>

				<?php 
				// ---------------- Footer sidebar ----------------------
				if (get_custom_option('show_sidebar_footer') == 'yes'  ) { 
					global $THEMEREX_CURRENT_SIDEBAR;
					$THEMEREX_CURRENT_SIDEBAR = 'footer';
					$style = get_custom_option('sidebar_footer_style');
				?>
				<footer class="footerWrap footerStyle<?php echo themerex_strtoproper($style); ?>">
					<div class="main footerWidget widget_area">
						<?php
						do_action( 'before_sidebar' );
						if ( ! dynamic_sidebar( get_custom_option('sidebar_footer') ) ) {
							// Put here html if user no set widgets in sidebar
						}
						?>
					</div>
				</footer><!-- ./blackStyle -->
				<?php } ?>

				<?php if (get_custom_option('show_copyright_area_in_footer')=='yes') { ?> 
				<div class="copyWrap">
					<div class="copy main">
						<div class="copyright"><?php echo get_theme_option('footer_copyright'); ?> 
						<?php 
						$terms_link = get_theme_option('footer_terms_link');
						$terms_text = get_theme_option('footer_terms_text');
						if ($terms_link) {
							?>
							<a href="<?php echo $terms_link; ?>"><?php echo $terms_text; ?></a>
							<?php
						}
						$policy_link = get_theme_option('footer_policy_link');
						$policy_text = get_theme_option('footer_policy_text');
						if ($terms_link && $policy_link) {
							_e('and', 'themerex');
						}
						if ($policy_link) {
							?>
							<a href="<?php echo $policy_link; ?>"><?php echo $policy_text; ?></a>
							<?php
						}
						?>
						</div>
						<div class="copy_socials socPage">
							<ul>
							<?php
							$socials = get_theme_option('social_icons');
							foreach ($socials as $s) {
								if (empty($s['url'])) continue;
								$sn = basename($s['icon']);
								$sn = themerex_substr($sn, 0, themerex_strrpos($sn, '.'));
								if (($pos=themerex_strrpos($sn, '_'))!==false)
									$sn = themerex_substr($sn, 0, $pos);
								$soc = themerex_get_socials_url(basename($s['icon'])); //$s['icon'];
								?>
								<li><a class="social_icons social_<?php echo $sn; ?>" style="background-image: url(<?php echo $soc; ?>);" target="_blank" href="<?php echo $s['url']; ?>"><span style="background-image: url(<?php echo $soc; ?>);"></span></a></li>
								<?php 
							}
							?>
							</ul>
						</div>
					</div>
				</div>
				<?php } ?>
			
			</div><!-- /.footerContentWrap -->

			<?php
			if (get_custom_option('show_video_bg')=='yes' && (get_custom_option('video_bg_youtube_code')!='' || get_custom_option('video_bg_url')!='')) { ?>
				</div><!-- /.videoBackgroundOverlay -->
				<?php
			}
			?>

		</div><!-- ./boxedWrap -->

	</div><!-- ./main_content -->

<?php
get_template_part('templates/page-part-login');

get_template_part('templates/page-part-js-messages');

if (get_custom_option('show_right_panel')=='yes') {
  get_template_part('templates/page-part-customizer'); 
}
?>

<div class="upToScroll">
	<?php if (get_custom_option('show_right_panel')=='yes') { ?>
	<a href="#" class="addBookmark icon-star-empty" title="<?php _e('Add the current page into bookmarks', 'themerex'); ?>"></a>
	<?php } ?>
	<!-- <a href="#" class="scrollToTop icon-up-open-big" title="<?php _e('Back to top', 'themerex'); ?>"></a> -->
</div>

<div class="customHtmlSection">
<?php echo get_custom_option('custom_code'); ?>
</div>

<?php echo get_custom_option('gtm_code2'); ?>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/scripts/lib/unslider.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/scripts/scripts.js"></script>
<?php wp_footer(); ?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-64770158-1', 'auto');
  ga('send', 'pageview');
</script>
</body>
</html>
