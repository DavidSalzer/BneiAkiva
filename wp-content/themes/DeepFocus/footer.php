				<div id="footer">
                    <div id="footer-newsletter">
                        <!--<form>
                            
                            <input type="text" name="">
                            <input type="submit" value="הרשם">
                        </form>-->
                        
                        

    <!--<div class="widget_wysija_cont html_wysija"><div id="msg-form-wysija-html532ef52bc0b5c-2" class="wysija-msg ajax"></div><form id="form-wysija-html532ef52bc0b5c-2" method="post" action="#wysija" class="widget_wysija html_wysija"><div class="wysija-msg"><div class="notice-msg updated"><ul><li>הטופס שלך נשמר.</li></ul></div></div><div class="wysija-msg ajax"></div><input type="hidden" value="e460dfd4cd" id="wysijax" />
    <p class="wysija-paragraph">
        <input type="checkbox" name="newsletter" id="newsletter" checked="checked" /><label for="newsletter">ברצוני לקבל את הניוזלטר של קהילת ירוחם</label>
        <input type="text" name="wysija[user][email]" class="wysija-input validate[required,custom[email]]" title=""  value="" />
        <input class="wysija-submit wysija-submit-field" type="submit" value="הירשם" />
    </p>
    <input type="hidden" name="form_id" value="2" />
    <input type="hidden" name="action" value="save" />
    <input type="hidden" name="controller" value="subscribers" />
    <input type="hidden" value="1" name="wysija-page" />
    <input type="hidden" name="wysija[user_list][list_ids]" value="1" />
</form></div>-->



<!--end-->
    


<script type="text/javascript">
//<![CDATA[
if (typeof newsletter_check !== "function") {
window.newsletter_check = function (f) {
    var re = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-]{1,})+\.)+([a-zA-Z0-9]{2,})+$/;
    if (!re.test(f.elements["ne"].value)) {
        alert("The email is not correct");
        return false;
    }
    if (f.elements["ny"] && !f.elements["ny"].checked) {
        alert("You must accept the privacy statement");
        return false;
    }
    return true;
}
}
//]]>
</script>

<div class="newsletter newsletter-subscription">
<form method="post" action="http://localhost/kehila/wp-content/plugins/newsletter/do/subscribe.php" onsubmit="return newsletter_check(this)">

<!--<table cellspacing="0" cellpadding="3" border="0">-->

<!-- email -->
<!--<tr>-->
	<!--<th>Email</th>-->
    <input type="checkbox" name="newsletter" id="newsletter" checked="checked" /><label for="newsletter">ברצוני לקבל את הניוזלטר של קהילת ירוחם</label>
	<!--<td align="left">--><input class="newsletter-email" id="the-newsletter-email" type="email" name="ne" size="30" required><!--</td>-->
<!--</tr>-->

<!--<tr>-->
	<!--<td colspan="2" class="newsletter-td-submit">-->
		<input class="newsletter-submit" id="the-newsletter-submit" type="submit" value="הירשם"/>
	<!--</td>-->
<!--</tr>-->

<!--</table>-->
</form>
</div>




<!--end-->




                    </div>
                    
    
                    <!--<script src="https://apis.google.com/js/client.js?onload=OnLoadCallback"></script>
					<div id="footer-wrapper">
                        <iframe src="https://www.google.com/calendar/embed?showTitle=0&amp;showCalendars=0&amp;showTz=0&amp;height=430&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=vfot1h1682mg47q2rido0vgeos%40group.calendar.google.com&amp;color=%235F6B02&amp;ctz=Asia%2FJerusalem" style=" border-width:0 " width="530" height="430" frameborder="0" scrolling="no"></iframe>-->
                        
                        <div id="footer-center">
							<div class="container">
								<?php if (!is_home()) { ?>
									<div id="footer-widgets" class="clearfix">
										<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer') ) : ?>
										<?php endif; ?>
									</div> <!-- end #footer-widgets -->
								<?php } ?>
								<p id="copyright"><a href="#">&#169; כל הזכויות שמורות לקהילת בני עקיבא</a></p>
                                <div id="contact-us">צור קשר</div>
                                <p id="developer"><?php esc_html_e('Developed by ','DeepFocus'); ?> <a target="_blank" href="http://www.cambium.co.il" title="Cambium"></a></p>
							</div> <!-- end .container -->
						</div> <!-- end #footer-center -->
					</div> <!-- end #footer-wrapper -->
				</div> <!-- end #footer -->

			</div> <!-- end .center-highlight -->

	</div> <!-- end #content-full -->

	<?php get_template_part('includes/scripts'); ?>

	<?php wp_footer(); ?>
</body>
</html>