<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MotaPhoto
 */

?>

<footer id="colophon" class="site-footer">

			<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
							'menu_class'     => 'menu-footer',
						)
						);
					?>

	</footer><!-- #colophon -->
</div><!-- #page -->
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/modal-contact.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/menu.js"></script>

</body>
</html>
