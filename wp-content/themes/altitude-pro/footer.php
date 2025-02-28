<?php
/**
 *
 * @package Genesis\Templates
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/genesis/
 */

genesis_structural_wrap( 'site-inner', 'close' );
genesis_markup(
	[
		'close'   => '</div>',
		'context' => 'site-inner',
	]
);

/**
 * Fires immediately after the site inner closing markup, before `genesis_footer` action hook.
 *
 * @since 1.0.0
 */
do_action( 'genesis_before_footer' );


?>
<div class="footer-above-parent">
  <div class="footer-above-widget">

    <!-- Navigation Links -->
    <div class="footer-above-col nav-links text-center">
      <strong>
        <a href="/">HOME</a> &nbsp;|&nbsp;
        <a href="/who-we-are/">WHO WE ARE</a> &nbsp;|&nbsp;
        <a href="/gallery/">GALLERY</a> &nbsp;|&nbsp;
        <a href="/news-events/">NEWS &amp; EVENTS</a> &nbsp;|&nbsp;
        <a href="/covenants/">COVENANTS</a> &nbsp;|&nbsp;
        <a href="/contact-us/" class="contact-link">CONTACT US</a>
      </strong>
    </div>

    <div class="footer-columns">

      <!-- Mailing Address -->
      <div class="footer-above-col">
        <div class="footer-above-paragraph">
        <span><strong><a href="www.facebook.com/MountainShadowsCOS">Facebook MountainShadowsCOS</a></strong></span><br>
		    <span class="email"><strong>bill.fortresshomeinspection@gmail.com</strong></span><br>
          PO Box 49072<br>
          Colorado Springs, CO 80949-9072<br>
        </div>
      </div>

	  <!-- Buy Membership -->
      <div class="footer-above-col">
        <div class="buy-membership">
          <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="CANQLXU6NXSFN">
            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
          </form>
        </div>
      </div>

      <!-- E-Blasts -->
      <div class="footer-above-col">
        <div class="e-blasts">
          <a class="footer-above-button footer-above-button-small footer-above-button-highlight" href="http://mscaweb.us13.list-manage.com/subscribe?u=475250ae3c4dcf7edc5d66d6d&amp;id=ba2fa1a6c1" target="_blank">
            <span class="footer-above-button-inner">E-Blasts SIGN UP</span>
          </a>
        </div>
      </div>

    </div>
  </div>
</div>





<?php

/**
 * Fires to display the main footer content.
 *
 * @since 1.0.1
 */
do_action( 'genesis_footer' );

/**
 * Fires immediately after the `genesis_footer` action hook, before the site container closing markup.
 *
 * @since 1.0.0
 */
do_action( 'genesis_after_footer' );

genesis_markup(
	[
		'close'   => '</div>',
		'context' => 'site-container',
	]
);

/**
 * Fires immediately before wp_footer(), after the site container closing markup.
 *
 * @since 1.0.0
 */
do_action( 'genesis_after' );
wp_footer(); // We need this for plugins.

genesis_markup(
	[
		'close'   => '</body>',
		'context' => 'body',
	]
);

?>
</html>
