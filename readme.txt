=== Plugin Name ===
Contributors: xxwca,littlebearz
Donate link: https://xxw.ca/
Tags: txt, sms, visitor, comment, little, bear, littlebear, xxw, canada
Requires at least: 3.0.0
Tested up to: 3.3
Stable tag: trunk

Send Text SMS message / Email on visitor hit.

== Description ==
Developed by - <a href="http://wp-visitor-to-sms.xxw.ca">LittleBearZ</a>.

On Visitor (human) hit , Email is dispatched to administrator email's address. 

Features:
* Send global SMS messages in the settings page
* No registration required
* Data deleted after 7 days. (give or take as crontab might take a couple more second.)
* Easy Accessibility
* CLI (command line interface) Enabled
* Free

Drawbacks:
* Uses No CSS, Looks Plain and Ugly
* Queue messaged one by one
* Not AJAX yet
* Lack connectivity between different social networks.


Automatic Email is now under review as too many message, going to combine it and send a digest sort of batch.

*   Required wp_remote_post and define your phone number in settings, please include the 011 and the country code for your phone number.

*  Please manually update the block list so search bot's hit does not initiate a new send. By default it blocks couple of search engines. This does not affect the ability for search engine to visit your blog but affect only this plugin's ability to alert you of new visitors.

*   TODO: check for GD package or some kind of image library and create a nice piechart or a summary email and give options of receiving each alert in a bundle or as a digest per daily.This plugin enables receive SMS message on commenter hits.

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `wp-visitor-to-sms.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Manually Edit Define area to suit your needs

== Frequently Asked Questions ==

= I have a problem, I want contact now =

No problem, go to the website and see if the live chat on the side is green, if so feel free to contact me. If i'm not online, feel free to use the texting on the menu and notify me. WARNING, this does send a text message to me, so please don't repeat yourself more than 3 times. I will respond by email shortly.

= Is it free? =

Personal Reasonable Usage Permitted. Educational and Research as well.

= How long does it take to deliver the SMS message? =

The message is queued and will send shortly. 30s to couple of days if a message is unable to deliver.

= Business Pricing? =

Please view the link to my website. 

== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the directory of the stable readme.txt, so in this case, `/tags/4.3/screenshot-1.png` (or jpg, jpeg, gif)
2. This is the second screen shot

== Changelog ==
= 1.0.7 =
* Updated the setting page, will make it integrate with the default style
= 1.0.6 =
* Added one comment
= 1.0.5 =
* Transition into default Settings, Create Better View.
= 1.0.4 =
* Forgot a ; on line 68 of the main php file.
= 1.0.3 =
* Added the potential for visitor to submit a comment and the comment is send to the administrator's phone using text message.
= 1.0.2 =
* Had problems with classes in 1.0 and 1.01 therfore reverted to 0.9
=======
= 1.0.1 =
* Fixed a fatal error with the implementation of register_setting during addition of classes. Hopefully everything ran perfectly.
= 1.0 =
* Followed http://www.slideshare.net/markjaquith/word-camp-savannah-5024921 and made the administrative menu more gui so the user can enter their phone number.
>>>>>>> .r400969
= 0.9 =
* get_option('admin_email') was finally found by Andrew Nacin, I didn't know the option get_option existed, was thinking of using database $db get the data
= 0.8 =
* Added baidu to one of the search engine so it doesn't get processed. Next release will try to solve concurrent connection so one ip only appears once per 10 minute or so.
= 0.7 =
* Changed the unique identifier to wp-visitor-to-sms so direct access is at domain.com/wp-admin/options-general.php?page=wp-visitor-to-sms
= 0.6 =
* fixed Parse error: syntax error, unexpected T_ECHO in /home//public_html/wp-content/plugins/wp-visitor-to-sms/wp-visitor-to-sms.php on line 42

= 0.5 =
* Added email address

= 0.4 =
* Made it more deployable thanks to Andrew Nacin from Wordpress

= 0.3 =
* Added HOW TO SWITCH TO SMS MODE

= 0.2 =
* Added IP ban list

= 0.1 =
* Submit
* Text Messaging commented out, fill it in and it will work. I think.

= 0.0 =
* Applied.

== Upgrade Notice ==

= 0.1 =
Upgrade notices describe the reason a user should upgrade.  No more than 300 characters.

= 0.0 =
This version fixes a security related bug.  Upgrade immediately.

== Arbitrary section ==

You may provide arbitrary sections, in the same format as the ones above.  This may be of use for extremely complicated
plugins where more information needs to be conveyed that doesn't fit into the categories of "description" or
"installation."  Arbitrary sections will be shown below the built-in sections outlined above.

== A brief Markdown Example ==

Ordered list:

1. Web to SMS
1. Automatic Alert
1. Option of SMS or Email

Unordered list:

* something
* something else
* third thing

Here's a link to [WordPress](http://wordpress.org/ "Your favorite software") and one to [Markdown's Syntax Documentation][markdown syntax].
Titles are optional, naturally.

[markdown syntax]: http://daringfireball.net/projects/markdown/syntax
            "Markdown is what the parser uses to process much of the readme file"

Markdown uses email style notation for blockquotes and I've been told:
> Asterisks for *emphasis*. Double it up  for **strong**.

`<?php code(); // goes in backticks ?>`