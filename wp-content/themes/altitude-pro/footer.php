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
	    <table>
			<tr class="footer-above-tr">
			<div class="nav-links" style="text-align:center;">
			  <strong>
			      <a href="/">HOME</a>&nbsp; &nbsp;|&nbsp; &nbsp;
			      <a href="/who-we-are.html">WHO WE ARE</a>&nbsp;&nbsp; |&nbsp; &nbsp;
			      <a href="/gallery.html">GALLERY</a>&nbsp; &nbsp;|&nbsp; &nbsp;
			      <a href="/news--events.html">NEWS &amp; EVENTS</a>&nbsp;&nbsp; |&nbsp; &nbsp;
			      <a href="/covenants.html">COVENANTS</a>&nbsp; &nbsp;|&nbsp; &nbsp;
			    <a href="/contact-us.html"><font size="4">CONTACT US</font></a>
			  </strong>
			</div>

	
	          <td class="footer-above-col" style="width:15.839161828918%; padding:0 15px;">
	            <div class="footer-above-header"><em><strong>Member Dues</strong></em></div>
	            <div id="936165657879808569" align="left" style="width: 100%; overflow-y: hidden;" class="wcustomhtml">
	              <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
	                <input type="hidden" name="cmd" value="_s-xclick">
	                <input type="hidden" name="hosted_button_id" value="CANQLXU6NXSFN">
	                <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
	                <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	              </form>
	            </div>
	          </td>
	          <td class="footer-above-col" style="width:20.904737602476%; padding:0 15px;">
	            <div class="footer-above-header"><em><strong>Email</strong></em><br></div>
	            <div class="footer-above-paragraph"><span style="color:rgb(31, 31, 31)"><span>bill.fortresshomeinspection@gmail.com</span></span><br><span style="color:rgb(31, 31, 31)"><span>Send email</span></span></div>
	          </td>
	          <td class="footer-above-col" style="width:22.616373696222%; padding:0 15px;">
	            <div class="footer-above-header"><em><strong>Facebook</strong></em></div>
	            <div class="footer-above-paragraph footer-above-facebook"><a href="http://facebook.com/MountainShadowsCOS" target="_blank">/MountainShadowsCOS</a></div>
	          </td>
	          <td class="footer-above-col" style="width:19.939867251807%; padding:0 15px;">
	            <div class="footer-above-header"><em><strong>E-Blasts</strong></em></div>
	            <div style="text-align:left;">
	              <div style="height: 10px; overflow: hidden;"></div>
	              <a class="footer-above-button footer-above-button-small footer-above-button-highlight" href="http://mscaweb.us13.list-manage.com/subscribe?u=475250ae3c4dcf7edc5d66d6d&amp;id=ba2fa1a6c1" target="_blank">
	                <span class="footer-above-button-inner">SIGN UP</span>
	              </a>
	              <div style="height: 10px; overflow: hidden;"></div>
	            </div>
	          </td>
	          <td class="footer-above-col" style="width:20.699859620578%; padding:0 15px;">
	            <div class="footer-above-header"><em><strong>Mailing Address</strong></em></div>
	            <div class="footer-above-paragraph">MSCA<br>PO Box 49072<br>Colorado Springs, CO 80949-9072<br></div>
	          </td>
	        </tr>
	    </table>
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
