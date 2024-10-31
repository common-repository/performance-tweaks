=== Performance Tweaks ===
Contributors: rhoekman
Tags: performance, speed, pagespeed, optimize
Requires at least: 5.0
Tested up to: 6.6.1
Requires PHP: 7.3
Stable tag: 0.6.5
License: GPLv2 (or later)

WordPress Performance Tweaks

== Description ==
Simple but effective performance tweaks for WordPress.

Currently the plugin includes the following performance options:

* **ContactForm7 Smart Loader:** Removes CSS and JavaScript from ContactForm7 on pages without a form.

* **Disable Advanced Custom Fields on Frontend:** ACF or Advanced Custom Fields is a WordPress plugin to create custom Meta Boxes on your site. Most sites uses ACF to show meta boxes in the Admin area of the site and rarely use it on the front-end. Despite that, ACF loads, JS/CSS files on the front-end as well which can add more resources on the front-end of your site.

* **Emoji Unloader:** Removes Emoji CSS and JavaScript from pages.

* **Defer JavaScript:** Add the defer attribute to JavaScript files. The defer attribute tells the browser not to wait for the script. Instead, the browser will continue to process the HTML and build the DOM. The script loads “in the background”, and then runs when the DOM has been fully built.

* **Async JavaScript:** Add the async attribute to JavaScript files. Add the async attribute to JavaScript files. Async scripts load in the background and they run immediately after they are loaded.

* **Remove Query Strings:** Remove query strings from static resources. WordPress by default adds a query string to all CSS and JS files used in your site. Having this query string might make some CDNs to not cache these files.

* **DNS Single Post Prefetch:** Enable DNS Prefetching on single posts, so when a user is on single post or page or any custom post type and clicks on the link for homepage then the homepage will open without any delay. Note: DNS Prefetching only works with HTTP2. So, if your server does not support HTTP2 then this will not work.

* **Disable XML-RPC:** The WordPress XML-RPC is a specification that aims to standardize communications between different systems. It uses the HTTP protocol and XML as an encoding mechanism which allows for various data to be transmitted. Are you using any desktop based application to write post for your blog? If not, then its best to disable XML-RPC on your site as this can be used to do a DDOS attack on your site.

* **Disable WordPress Heartbeat:** WP Heartbeat API works by calling the admin-ajax.php file and on server with low memory or shared hosting this can significantly slow down the website.

* **Limit Post Revisions:** Limit the number of Post Revisions to a maximum of 5. This will help to reduce the size of the database.

== Installation ==

= Installation from within WordPress =

1. Visit **Plugins > Add New**.
2. Search for **Performance Tweaks**.
3. Install and activate the Performance Tweaks plugin.

= Manual installation =

1. Upload the entire `rh-performance` folder to the `/wp-content/plugins/` directory.
2. Visit **Plugins**.
3. Activate the Performance Tweaks plugin.

= After activation =

1. Visit the new **Settings > Performance Tweaks** menu.
2. Enable the individual modules you would like to use.

== Changelog ==

= 0.6.5 =

Tested with latest WordPress and PHP 8.1

= 0.6.4 =

**Features**

Added an option to limit Post Revisions to a maximum of 5

= 0.6.3 =

**Bug Fixes**

* The 'defer' tag for JavaScript is now only inserted on the frontend.