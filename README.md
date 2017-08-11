
# Fireplug-in

A wordpress plugin for fireplug tagging and credit goodness.

## Features

* Offers an easy method of installing the widget on all WordPress sites (22% of all sites!)
* Pre-tags all articles with Fireplug-computed subjects. (planned)
* Provides site-specifc subject pages for all these subjects. (planned)
* Fully-based on the WordPress [Plugin API](http://codex.wordpress.org/Plugin_API).
* Uses [PHPDoc](http://en.wikipedia.org/wiki/PHPDoc) conventions to document the code.
* Includes a `.pot` as a starting translation file.

## Vagrant install

1. Bring up the [vagrant-wordpress](https://github.com/cmwslw/vagrant-wordpress) build configuration. Running `vagrant up` will take about 45 minutes on an average machine, so hold tight.
2. Navigate to `http://localhost:8081/wp-admin/install.php` and go through the configuration steps.
3. The test WordPress will now be available at `http://localhost:8081/`.
4. Clone this repo into your `wp-content/plugins` directory on your Vagrant box.
5. `git checkout develop`
6. Navigate to the *Plugins* dashboard page
7. Locate the menu item that reads *Plugin Name*
8. Click on *Activate*

## Standalone install

1. Clone this repo into your `wp-content/plugins` directory
2. `git checkout develop`
3. Navigate to the *Plugins* dashboard page
4. Locate the menu item that reads *Plugin Name*
5. Click on *Activate*

This will activate the WordPress Plugin Boilerplate. Because the Boilerplate has no real functionality, nothing will be added to WordPress; however, this demonstrates exactly how your plugin should behave while you're working with it.

A new menu item will be added to the *Plugins* menu if you uncomment Line 71 in the class file which contains the following line:

`add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );`

## Assets

The assets directory provides two files that are used to represent plugin header images.

When committing your work to the WordPress Plugin Repository, these files should reside in their own `assets` directory, not in the root of the plugin. The initial repository will contain three directories:

1. `branches`
2. `tags`
3. `trunk`

You'll need to add an `assets` directory into the root of the repository. So the final directory structure should include *four* directories:

1. `assets`
2. `branches`
3. `tags`
4. `trunk`

Next, copy the contents of the `assets` directory that are bundled with the Boilerplate into the root of the repository. This is how the WordPress Plugin Repository will retrievie the plugin header image.

Of course, you'll want to customize the header images from the place holders that are provided with the Boilerplate.

For more, in-depth information about this, read [this post](http://make.wordpress.org/plugins/2012/09/13/last-december-we-added-header-images-to-the/) by [Otto](https://twitter.com/Otto42).

Plugin screenshots can be saved to one of two locations:

* The traditional location is to keep them in the root of the plugin directory. This will increase the size of the download of the plugin, but make the images accessible for those who install it.
* Alternatively, you can save the screenshots in the `assets` directory, as well. The repository will look here for the screenshot files as well; however, they will not be included in the plugin download thus reducing the size of the plugin.
