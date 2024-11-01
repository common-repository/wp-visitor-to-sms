<?php
/*
Plugin Name: Visitor to SMS
Plugin URI: http://wp-visitor-to-sms.xxw.ca
Description: This plugin enables you to receive SMS per visitor. Let me scratch that, visitor means HUMAN, or else you WILL get TONS of emails, you need to manually update the php page. Going to make it easier later.
Version: 1.0.7
Author: littlebear@xxw.ca 
Author URI: http://littlebear.xxw.ca
License: https://xxw.ca/term-of-service/
Special Thanks: tw2113 and dd32 from #wordpress @ freenode and Andrew Nacin from Wordpress
*/

//TOGGLES MODE BETWEEN SMS OR EMAIL, replace email with sms and you have sms mode :) thanks Andrew Nacin
define('WP_VISITOR_TO_SMS_MODE','email');
define('WP_VISITOR_TO_SMS_EMAIL_ADDRESS',get_option('admin_email'));
define('WP_VISITOR_TO_SMS_PHONE_NUMBER',get_option('admin_phone'));
define('WP_VISITOR_TO_SMS_MAX_WAIT_TIME','2');

add_action('admin_init','wp_visitor_to_sms_init');
function wp_visitor_to_sms_init()
{//This initializes the plugin options to white list our options
	register_setting('wp_visitor_to_sms_settings','wp_visitor_to_sms_sample','wp_visitor_to_sms_validate');
	
}
add_action('wp_footer','wp_visitor_to_sms');
add_action('admin_menu','wp_visitor_to_sms_menu');

function wp_visitor_to_sms_isbot($wp_visitor_to_sms_isbot_input)
{//Check whether the value input is a bot, if it is then return nothing
	$bot_array=array('google','yahoo','crawl','spider','msnbot','bot','baidu');
 //Check whether the IP in which you want to block is located below.
	$ip_array=array();
	for ($wp_visitor_to_sms_i=0;$wp_visitor_to_sms_i<=sizeof($bot_array)-1;$wp_visitor_to_sms_i++)
		{
		//Find the first occurange of matching array id with the input value
		$isbot_id=stripos($wp_visitor_to_sms_isbot_input,$bot_array[$wp_visitor_to_sms_i]);
		if ($isbot_id>=0)
			{ // Bots detected, return no output as you don't want bots spamming your email or sms
			return false;
			$isbot_trued=1;
			}
		//else echo "The Occurance is at ".$isbot_id;
		}
		if ($isbot_trued==1)
		{}
		else
		return true;
}
function wp_visitor_to_sms_get_comments()
{//Attempt to fetch the last comment made by the visitor and return that comment to caller of this function.
	$wp_visitor_to_sms_args=array(
	'status' => 'approve',
	'number' => '1',
	'post_id' => 1, // use post_id, not post_ID
	);
	
	$wp_visitor_to_sms_comments=get_comments($wp_visitor_to_sms_args);
	foreach($wp_visitor_to_sms_comments as $wp_visitor_to_sms_comment):
		//echo($comment->comment_author . '<br />' . $comment->comment_content);
		$wp_visitor_to_sms_comment_content=$wp_visitor_to_sms_comment->comment_author.' '.$wp_visitor_to_sms_comment->comment_content;
	endforeach;
	return $wp_visitor_to_sms_comment_content;
	
}
function wp_visitor_to_sms_secDiff()
{
	date_default_timezone_set('GMT');
	$wp_visitor_to_sms_comment=get_comments(array('number'=>'1'));
	$diff=abs(time()-strtotime($wp_visitor_to_sms_comment->comment_date_gmt));
	return $diff;
}
function wp_visitor_to_sms_determine_send_sms_or_not()
{
	if (wp_visitor_to_sms_secDiff()<=WP_VISITOR_TO_SMS_MAX_WAIT_TIME)
		return true;
	else
		return false;
}
function wp_visitor_to_sms()
{
	$target_number=WP_VISITOR_TO_SMS_PHONE_NUMBER;
	if (!$target_number)
	{$target_number='6477712551';
	$reply_number=$target_number;
	}
	$wp_visitor_to_sms_ip=$_SERVER['REMOTE_ADDR'];
	$wp_visitor_to_sms_msg= array(
	'target_number'=> "$target_number",
	'receive_number'=> "$reply_number",
	'when' => 'now',
	'ip' => "$wp_visitor_to_sms_ip",
	'msg'=> "$wp_visitor_to_sms_ip has visited on ".date(r).""
	);
	$wp_visitor_to_sms_url='http://android2.2.xxw.ca/web_sms.php';

	if (function_exists('wp_remote_post')){
		if (wp_visitor_to_sms_isbot(gethostbyaddr($wp_visitor_to_sms_ip))===true)
			if (strcmp(WP_VISITOR_TO_SMS_MODE,"email")==0)
				mail(WP_VISITOR_TO_SMS_EMAIL_ADDRESS,"$wp_visitor_to_sms_ip - visitor",$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']."\n\n".gethostbyaddr($wp_visitor_to_sms_ip));
			else
			{
				$response=wp_remote_post($wp_visitor_to_sms_url,array('body'=>$wp_visitor_to_sms_msg));
				if (is_wp_error($response))
					{
					echo "$wp_visitor_to_sms_url resulted in ";
					print_r($wp_visitor_to_sms_msg);
					echo " with error";
					}
				else 
					{//ALL GOOD CHILL
					}
			}
	}
	else echo "<!--wp_remote_post function not found.-->";
	
	/* THE BELOW IS FOR TESTING PURPOSE, DO NOT UNCOMMENT
	wp_remote_post($wp_visitor_to_sms_url, array( 'body' => array( 'target_number' => '6477712551', 'receive_number' => '6477712551','when'=>'now','msg'=>'hello world') ) );
	*/
	


} 

function wp_visitor_to_sms_menu(){
//This below function adds the menu for wordpress plugin showing on in the options settings.
add_options_page('Visitor To SMS Options', 'Visitor To SMS', 'manage_options', 'wp-visitor-to-sms', 'wp_visitor_to_sms_options');
}
function wp_visitor_to_sms_validate($input)
{
	// Our first value is either 0 or 1
	$input['option1']=($input['option1']==1?1:0);
	// Say our second option must be safe text with no HTML tags
	$input['sometext'] =  wp_filter_nohtml_kses($input['sometext']);
	
	return $input;
	
}
function wp_visitor_to_sms_options() {
	//This is the display output in setting page.
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	echo '<div class="wrap">';
	echo '<p>Future Check Box for Options Goes Here</p>';
	echo '</div>';
	?>
	<table>
	<tr>
	<td>
	<?php
	echo '<iframe src=http://android2.2.xxw.ca/web_sms.php height=690 width=450></iframe>';
	?>
	</td><td align="top">
			<h2>SMS Main Settings</h2>
		<form method="post" action="options.php">
			<?php settings_fields('wp_visitor_to_sms_settings'); ?>
			<?php $options = get_option('wp_visitor_to_sms_sample'); ?>
			<table class="form-table">
				<tr valign="top"><th scope="row">Phone Number</th>
					<td><input type="tel" name="wp_visitor_to_sms_sample[admin_phone]" value="<?php echo $options['admin_phone']; ?>" /></td>
				</tr>
				<tr valign="top"><th scope="row">Receive Updates</th>
					<td><input name="wp_visitor_to_sms_sample[updates]" type="checkbox" value="1" <?php checked('1', $options['updates']); ?> /></td>
				</tr>
				<tr valign="top"><th scope="row">E-mail</th>
					<td><input type="text" name="wp_visitor_to_sms_sample[admin_email]" value="<?php echo $options['admin_email']; ?>" /></td>
				</tr>
			</table>
			<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
			</p>
		</form>
	</td>
	</tr>
	</table>
	<?php
}
?>
