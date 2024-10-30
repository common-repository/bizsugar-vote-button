<?php

/*
Plugin Name: bizSugar.com Vote Button
Version: 1.2
Plugin URI: http://www.bizsugar.com/tools.php
Author URI: http://www.outthinkgroup.com
Author: Tim Grahl

Description: Adds bizSugar Vote button to your WordPress blog posts. See installation instructions to learn about all features of this plugin.

SEE INSTALLATIONS INSTRUCTIONS TO LEARN ABOUT ALL FEATURES OF THIS PLUGIN

*/

$message = "";

if (!function_exists('smbsugar_request_handler')) {
    function smbsugar_request_handler() {
        global $message;

        if ($_POST['smbsugar_action'] == "update options") {
            $smbsugar_align_v = $_POST['smbsugar_align_sl'];

   			update_option("smbsugar_box_align", $smbsugar_align_v);

			if($_POST['smbsugar_home'] == "on") update_option('smbsugar_display_home', "checked=on");
        	else update_option('smbsugar_display_home', "");

        	if($_POST['smbsugar_page'] == "on") update_option('smbsugar_display_page', "checked=on");
        	else update_option('smbsugar_display_page', "");

        	if($_POST['smbsugar_post'] == "on") update_option('smbsugar_display_post', "checked=on");
        	else update_option('smbsugar_display_post', "");

        	if($_POST['smbsugar_cat'] == "on") update_option('smbsugar_display_cat', "checked=on");
        	else update_option('smbsugar_display_cat', "");

        	if($_POST['smbsugar_archive'] == "on") update_option('smbsugar_display_archive', "checked=on");
        	else update_option('smbsugar_display_archive', "");

   			update_option("smbsugar_button", $_POST['smbsugar_button']);

            $message = '<br clear="all" /> <div id="message" class="updated fade"><p><strong>Options saved. </strong></p></div>';
        }
    }
}

if(!function_exists('smbsugar_add_menu')) {
    function smbsugar_add_menu () {
        add_options_page("bizSugar Vote Options", "bizSugar", 8, basename(__FILE__), "smbsugar_displayOptions");
    }
}

if (!function_exists('smbsugar_displayOptions')) {
    function smbsugar_displayOptions() {

        global $message;
        echo $message;

		print('<div class="wrap">');
		print('<h2>bizSugar Voting Button Options</h2>');

        print ('<form name="smbsugar_form" action="'. get_bloginfo("wpurl") . '/wp-admin/options-general.php?page=wp-bizsugar-vote.php' .'" method="post">');
?>
<table class="form-table">
	<tr valign="top">
		<th scope="row">Align</th>
		<td>
        <select name="smbsugar_align_sl" id="smbsugar_align_sl">
			<option value="Top Left"   <?php if (get_option("smbsugar_box_align") == "Top Left") echo " selected"; ?> >Top Left</option>
			<option value="Top Right"   <?php if (get_option("smbsugar_box_align") == "Top Right") echo " selected"; ?> >Top Right</option>
			<option value="Bottom Left"  <?php if (get_option("smbsugar_box_align") == "Bottom Left") echo " selected"; ?> >Bottom Left</option>
			<option value="Bottom Right"  <?php if (get_option("smbsugar_box_align") == "Bottom Right") echo " selected"; ?> >Bottom Right</option>
			<option value="None"  <?php if (get_option("smbsugar_box_align") == "None") echo " selected"; ?> >None</option>
		</select>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row">Display bizSugar on...</th>
		<td>
			<INPUT TYPE=CHECKBOX NAME="smbsugar_home" <?php echo get_option('smbsugar_display_home'); ?> />home page<br />
			<INPUT TYPE=CHECKBOX NAME="smbsugar_page" <?php echo get_option('smbsugar_display_page'); ?> />static pages<br />
			<INPUT TYPE=CHECKBOX NAME="smbsugar_post" <?php echo get_option('smbsugar_display_post'); ?> />post pages<br />
			<INPUT TYPE=CHECKBOX NAME="smbsugar_cat" <?php echo get_option('smbsugar_display_cat'); ?> />category pages<br />
			<INPUT TYPE=CHECKBOX NAME="smbsugar_archive" <?php echo get_option('smbsugar_display_archive'); ?> />archive pages<br /><br />
		</td>
	</tr>
	<tr>
		<th scope="row">Which bizSugar button would you like to use?</th>
		<td>
			<fieldset>
				<label style="display:block;text-align:center;width:120px;"><input type="radio" name="smbsugar_button" value="1" <?php if(get_option('smbsugar_button') == '1') : ?>checked="checked"<?php endif; ?> /><br /><img src="http://www.bizsugar.com/templates/yget/images/evb_examples/evbexample.png" alt="" /></label><br />
				<label style="display:block;text-align:center;width:120px;"><input type="radio" name="smbsugar_button" value="2" <?php if(get_option('smbsugar_button') == '2') : ?>checked="checked"<?php endif; ?> /><br /><img src="http://www.bizsugar.com/templates/yget/images/evb_examples/evbexample-b.png" alt="" /></label><br />
				<label style="display:block;text-align:center;width:120px;"><input type="radio" name="smbsugar_button" value="3" <?php if(get_option('smbsugar_button') == '3') : ?>checked="checked"<?php endif; ?> /><br /><img src="http://www.bizsugar.com/templates/yget/images/evb_examples/evbexample3.png" alt="" /></label><br />
				<label style="display:block;text-align:center;width:120px;"><input type="radio" name="smbsugar_button" value="4" <?php if(get_option('smbsugar_button') == '4') : ?>checked="checked"<?php endif; ?> /><br /><img src="http://www.bizsugar.com/templates/yget/images/evb_examples/evbexample2.png" alt="" /></label>
			</fieldset>
		</td>
	</tr>
</table>
<p class="submit">
<input class="button-primary" type="submit" value="Save Changes" name="Submit"/>
</p>	

<?php
		print ('<input type="hidden" name="smbsugar_action" value="update options" />');
		print('</form></div>');

    }
}

if (!function_exists('smbsugar_bizsugarhtml')) {
	function smbsugar_bizsugarhtml($float,$button_url) {
		global $wp_query;
		$post = $wp_query->post;
     	$id = $post->ID;
		$permalink = get_permalink($id);
        $title = urlencode($post->post_title);
		$bizsugarhtml = <<<CODE

<!-- FINE TUNE BUTTON POSITION FOR METHOD A AND B HERE -->
    <span style="margin-top: 10px;
				 margin-right: 10px;
				 margin-bottom: 10px;
				 margin-left: 10px; 
				 
				 float: $float;">

	<script type="text/javascript">
	submit_url = "$permalink";
	</script>
    <script type="text/javascript" src="http://www.bizsugar.com/$button_url"></script>
	</span>
CODE;
	return  $bizsugarhtml;
	}
}


if (!function_exists('smbsugar_addbutton')) {
	function smbsugar_addbutton($content) {
		$smbsugar_display = true;
		if(is_home() && !get_option('smbsugar_display_home') == 'checked=on')
           $smbsugar_display = false;
     	if(is_page() && !get_option('smbsugar_display_page') == 'checked=on')
           $smbsugar_display = false;
     	if(is_single() && !get_option('smbsugar_display_post') == 'checked=on')
           $smbsugar_display = false;
     	if(is_category() && !get_option('smbsugar_display_cat') == 'checked=on')
           $smbsugar_display = false;
     	if(is_archive() && !get_option('smbsugar_display_archive') == 'checked=on' && !is_category())
           $smbsugar_display = false;

		if(get_option('smbsugar_button') == '2') {
			$button_url = "evb/button-b.php";
		} else if (get_option('smbsugar_button') == '3') {
			$button_url = "evb3/button.php";
		} else if (get_option('smbsugar_button') == '4') {
			$button_url = "evb2/check_url2.js.php";
		} else {
			$button_url = "evb/button.php";
		}
		
		if($smbsugar_display === true) {
    		if(! preg_match('|<!--bizsugar-->|', $content)) {
    		    $smbsugar_align = get_option("smbsugar_box_align");
    		    if ($smbsugar_align) {
                    switch ($smbsugar_align) {
                        case "Top Left":
        		              return smbsugar_bizsugarhtml("left",$button_url).$content;
                              break;
                        case "Top Right":
        		              return smbsugar_bizsugarhtml("Right",$button_url).$content;
                              break;
                        case "Bottom Left":
        		              return $content.smbsugar_bizsugarhtml("left",$button_url);
                              break;
                        case "Bottom Right":
        		              return $content.smbsugar_bizsugarhtml("right",$button_url);
                              break;
                        case "None":
        		              return $content;
                              break;
                        default:
        		              return smbsugar_bizsugarhtml("left",$button_url).$content;
                              break;
                    }
                } else {
        		      return smbsugar_bizsugarhtml("left",$button_url).$content;
                }

    		} else {
                  return str_replace('<!--bizsugar-->', smbsugar_bizsugarhtml("",$button_url), $content);
            }
        } else {
			return $content;
        }
	}
}


if (!function_exists('show_bizsugar')) {
	function show_bizsugar($float = "left") {
        global $post;
		$permalink = get_permalink($post->ID);
		echo <<<CODE

<!-- FINE TUNE BUTTON POSITION FOR METHOD C HERE -->
    <span style="margin-top: 10px;
				 margin-right: 10px;
				 margin-bottom: 10px;
				 margin-left: 10px; 
				 
				 float: $float;">

	<script type="text/javascript">
	submit_url = "$permalink";
	</script>
    <script type="text/javascript" src="http://www.bizsugar.com/evb/button.php"></script>
	</span>
CODE;
    }
}

add_filter('the_content', 'smbsugar_addbutton', 999);
add_action('admin_menu', 'smbsugar_add_menu');
add_action('init', 'smbsugar_request_handler');

?>
