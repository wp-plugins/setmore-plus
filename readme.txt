=== SetMore Plus ===
Contributors: cdillon27
Tags: appointments, book, booking, calendar, salon, spa, schedule, scheduling
Requires at least: 3.3
Tested up to: 4.2
Stable tag: trunk
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Easy online appointments.

== Description ==

SetMore Plus by [WP Mission](http://www.wpmission.com) may not be the official plugin for [SetMore Appointments](http://setmore.com) but my clients like it better :)

SetMore offers easy online appointments. Use a **widget** to place a "Book Appointments" button on your website or **shortcode** to place the SetMore scheduler on a page.

*This plugin is offered by [WP Mission](http://www.wpmission.com). We have no affiliation with SetMore Appointments and provide no technical support for their service.*

We do, however, provide lifetime support for this plugin, including [free help](http://www.wpmission.com/contact) getting the "Book Appointment" button to match your theme.

This plugin will *leave no trace!* If you delete the plugin, all settings will be removed from the database. Guaranteed. However, simply deactivating it will leave your settings in place, as expected.

= Recommended =

* [Simple Custom CSS](http://wordpress.org/plugins/simple-custom-css/)
* [Wider Admin Menu](http://wordpress.org/plugins/wider-admin-menu/)

= Translations =

Can you help? [Contact me](http://www.wpmission.com/contact/).


== Installation ==

Option A: 

1. Go to `Plugins > Add New`.
1. Search for "setmore plus".
1. Click "Install Now".

Option B: 

1. Download the zip file.
1. Unzip it on your hard drive.
1. Upload the `setmore-plus` folder to the `/wp-content/plugins/` directory.

Option C:

1. Download the zip file.
1. Upload the zip file via `Plugins > Add New > Upload`.

Finally, activate the plugin.

1. Go to `Settings > SetMore Plus`.
1. In another browser tab, sign in to [my.setmore.com](http://my.setmore.com).
1. Copy your Booking Page URL from your "Profile" tab.
1. Paste that URL into the `SetMore Booking URL` field in WordPress. Remember to "Save Changes".
1. Use the widget to add a "Book Appointment" button to a sidebar, or use the shortcode `[setmoreplus]` to add the scheduler to a page.

Need help? Use the [support forum](http://wordpress.org/support/plugin/strong-testimonials) or [contact me](http://www.wpmission.com/contact/).


== Frequently Asked Questions ==

= How do I get a SetMore account? =

Visit [SetMore](http://setmore.com) to get your free account. A [premium plan](http://www.setmore.com/premium) with more features is also available.

= How do I change the "Book Appointment" button? =

In the widget, you can select the default image button, a trendy flat button, or a plain link. 

To create a custom button, select the plain link option, then add style rules for `a.setmore` in your theme's stylesheet or custom CSS function, or try [Simple Custom CSS](http://wordpress.org/plugins/simple-custom-css/).

For example, here's a square blue button with white text:
`
a.setmore {
	background: #4372AA;
	color: #eee;
	display: inline-block;
	margin: 10px 0;
	padding: 10px 20px;
	text-decoration: none;
	text-shadow: 1px 1px 1px rgba(0,0,0,0.5);
}

a.setmore:hover {
	background: #769CC9;
	color: #fff;
	text-decoration: none;
}
`

Need help? Use the [support forum](http://wordpress.org/support/plugin/setmore-plus) or [contact me](http://www.wpmission.com/contact).

= Leave no trace? What's that about? =

Some plugins and themes don't fully uninstall everything they installed - things like settings, database tables, subdirectories. That bugs me. Sometimes, it bugs your WordPress too.

So this plugin will completely remove itself upon deletion. Deactivating the plugin will leave the settings intact. You can also switch off "Leave No Trace" so the settings remain after deletion, if you want.


== Changelog ==

= 2.2.2 =
* Add filter to exempt shortcode from wptexturize in WordPress 4.0.1+.

= 2.2.1 =
* Fix bug in shortcode.

= 2.2 =
* Added "Leave No Trace" feature.
* Added uninstall.php, a best practice.
* Object-oriented refactor.

= 2.1 =
* Improved settings page.

= 2.0 =
* Forked from SetMore Appointments 1.0.
* Updated for WordPress 3.9. New minimum version 3.3.
* Improved widget options.
* New shortcode to add an iframe to a page.
* Using Colorbox for iframe lightbox.
* Ready for internationalization (i18n).

= 1.0 =
* This is the first version.


== Upgrade Notice ==

= 2.2.2 =
Compatible with WordPress 4.0.1.

= 2.2.1 =
Fixed a bug in shortcode.

= 2.2 =
Leave No Trace.

= 2.1 =
Improved settings page.

= 2.0 =
Updated for WordPress 3.9. Improved widget options.
