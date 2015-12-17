=== SO Simple Gallery ===
Contributors: senlin
Tags: gallery, css, rollover effect,
Donate link: http://so-wp.com/donations
Requires at least: 4.0
Tested up to: 4.4
Stable tag: 1.2.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The SO Simple Gallery plugin gives you a mini gallery with a beautiful CSS rollover effect using a simple shortcode.

== Description ==

Inspired by a [LinkedIn discussion](https://www.linkedin.com/groupItem?view=&gid=154024&type=member&item=5867588708181516289) and the [Simple CSS Roll-over Image Gallery tutorial](http://demosthenes.info/blog/58/CSS-and-Images-Simple-Roll-over-Image-Gallery) by [Dudley Storey](http://github.com/dudleystorey) I decided to cook up the concept of it in a plugin.

It works with a Simple Gallery custom post type to which you can upload a maximum of 8 images using the [Meta Box plugin](http://wordpress.org/plugins/meta-box/). This is my 3rd "extension" for that plugin, which - if you have not yet installed it - will be semi-automatically added to your Plugins folder; just follow the on-screen instructions.

Once you have added images to your Simple Gallery you can add it to your Post or Page using a simple shortcode. This shortcode shows after you have published or updated the Simple Gallery. And you can also find the shortcode on the main Simple Galleries screen.

When you use the Visual Editor you will find a nice shortcode button that by clicking it adds `[so-simple-gallery id=""]` to your Post or Page content. Between the double quotes you only have to fill in the ID of the Simple Gallery you would like to add.

If you use the Text Editor instead, you can copy the shortcode from the main Simple Galleries screen and paste it into your Edit Post/Page screen.

If you would like to add a gallery to a template file, then you need to add the following code to it:
`&lt;?php if ( function_exists( 'sosg_shortcode' ) ) {
	echo do_shortcode( '[so-simple-gallery id="123"]' );
} ?&gt;`
where 123 is the ID of your Simple Gallery.

Please have a look at the "Other Notes" tab to find the Known Limitations.

See [the demo](http://so-wp.com/?p=115) over at SO-WP.com

== Installation ==

Go to **Plugins > Add New** in your WordPress Dashboard, do a search for "so simple gallery" and install it.

 &hellip; OR &hellip;

 1. Download zip file.

 2. Upload the zip file via the Plugins > Add New > Upload page &hellip; OR &hellip; unpack and upload with your favourite FTP client to the /plugins/ folder.

 3. Activate the plugin on the Plugins page.
 
 4. If you have not yet installed the Meta Box plugin (where this plugin depends on to function) you will see an error message with a link to a new install page called "Required Plugin". Go there and follow the instructions.
 
 5. Optional; Have a look under Settings > Simple Gallery to read the instructions..

Done!

== Frequently Asked Questions ==

= Where are the Settings? =

There are no settings yet, instead I have included an Instructions page where you can read how to use the SO Simple Gallery plugin. I first want to see if there are enough people that like this plugin, before I develop it further with an options page.

= Why is the plugin showing an error message after activation? =

This plugin is an Extension for the [Meta Box plugin](http://wordpress.org/plugins/meta-box/). If you don't have that installed, this plugin will not work. If you click on the link that shows with the error message you will go to a new page "Required Plugin" to install the Meta Box plugin.

= I have an issue with this plugin, where can I get support? =

Please open an issue over at [Github](https://github.com/senlin/so-simple-gallery/issues)

== Other Notes ==

= Known Limitations =

* The SO Simple Gallery looks best with a maximum of 5 landscape images OR when using portrait style image between 6 and 8 images. Mixing portrait and landscape image in one gallery is <strong>not a good idea</strong>.

* If you are uploading images with different sizes then it is best to put the shortest images as the top image. The reason for that is that the first image always shows (to create the placeholder image), so even when you hover over the other images, that first image is still there. This can be solved with some javascript, but I first want to see if there are enough people that like this plugin, before I develop it further.

* I have not yet included any Options to change things like size, background color, text color, add titles and what not. Again I would like to wait and see if there are enough people that like this plugin, before I develop it further.

* Depending on what theme you use, adding a SO Simple Gallery to a full-width template does not always look great.

== Screenshots ==

1. Add/edit Simple Gallery
2. Simple Galleries main screen with shortcodes of existing galleries
3. Demo SO Simple Gallery

== Changelog ==

= 1.2.0 (2015.12.17) =

* update TGM-Plugin-Activation class to 2.5.2 fixes [issue #2](https://github.com/senlin/so-simple-gallery/issues/2)

= 1.1.5 (2015.11.20) =

* revert to [semantic versioning](http://semver.org/)
* [BUG FIX] fixed bug that visually removed the edit permalink from all post/page edit screens, should only be on simple gallery post type.

= 1.1.4 (2015.04.23) =

* update TGM Plugin Activation class to 2.4.1 which fixes reported [XSS vulnerability](http://wptavern.com/xss-vulnerability-what-to-do-if-you-buy-or-sell-items-on-themeforest-and-codecanyon) 

= 1.1.3 (2015.04.09) =

* changed logos
* new banner image for WP.org Repo by [Kyle Szegedi](https://unsplash.com/kyleszegedi)

= 1.1.2 (2014.07.30) =

* added the check for the metabox plugin (all files were there, but had forgotten to build the check for it in)
* get rid of ob_end_flush() error that sometimes occurs
* tested up to WP 4.0-beta-2

= 1.1.1 (2014.05.08) =

* polishing
* add documentation
* add FAQs
* add language file
* add screenshots

= 1.0 (2014.05.04) =

* initial release

== Upgrade Notice ==

= 1.1.5 (2015.11.20) =

* revert to [semantic versioning](http://semver.org/) - this means that the update doesn't show in your Dashboard, because 2015.04.23 is a higher number than 1.1.5. There really is no other good way to do this other than to remove the plugin from the Repo and admit it again using a different name. That also would not help you as the plugin still would not show an update in your Dashboard. Therefore, many apologies for the inconvenience.
