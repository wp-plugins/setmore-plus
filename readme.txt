=== SetMore Plus ===
Contributors: cdillon27
Donate link: http://www.wpmission.com/donate/
Tags: appointments, book, booking, calendar, free, online, salon, spa, schedule, scheduling
Requires at least: 3.3
Tested up to: 3.9.1
Stable tag: trunk
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Let your customers book appointments directly on your website using SetMore Appointments.

== Description ==

SetMore Plus by [WP Mission](http://www.wpmission.com) may not be the official plugin for [SetMore Appointments](http://setmore.com) but my clients like it better :)

Use a widget to place a "Book Appointments" button on your website or use a shortcode to place the SetMore scheduler on a page.

= About SetMore Appointments =

*SetMore offers easy online appointments. This plugin is offered by [WP Mission](http://www.wpmission.com). We have no affiliation with SetMore Appointments and provide no technical support for their service.*

*We do, however, provide lifetime support for this plugin, including [free help](http://www.wpmission.com/contact) getting the "Book Appointment" button to match your theme.*

== Installation ==

* Upload `/setmore-plus` to the `/wp-content/plugins/` directory.

or

* Search for "SetMore Plus" on your `Plugins > Add New` page.

then

1. Activate the plugin.
1. Go to `Settings > SetMore Plus`.
1. In another browser tab, sign in to [my.setmore.com](http://my.setmore.com).
1. Copy your Booking Page URL from your "Profile" tab.
1. Paste that URL into the `SetMore Booking URL` field in WordPress. Remember to "Save Changes".
1. Use the widget to add a "Book Appointment" button to a sidebar, or use the shortcode `[setmoreplus]` to add the scheduler to a page.

== Frequently Asked Questions ==

= How do I get a SetMore account? =

Visit [SetMore](http://setmore.com) to get your free account. A [premium plan](http://www.setmore.com/premium) with more features is also available.

= How do I change the "Book Appointment" button? =

In the widget, you can select the default image button, a trendy flat button, or a plain link. 

To create a custom button, select the plain link option, then add style rules for `a.setmore` in your theme's stylesheet or custom CSS function.

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

Need more help? Use the [support forum](http://wordpress.org/support/plugin/setmore-plus) or [contact me](http://www.wpmission.com/contact).

== Changelog ==

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

= 2.1 =
Improved settings page.

= 2.0 =
Updated for WordPress 3.9. Improved widget options.
