# wtf-wp-theme-template

A WordPress theme template based on the WTF framework.


## TODOs

- Migrate more theme-function.php functions.
- Disable emojis.
- Move the wtf__fonts_url function out of vendor/wtf.
	+ It is not general/generic enough to be in the vendor library.
	+ It may only be good in a specific child theme.

- Remove CSS Framework specific code.
	+ E.g., remove Bootstrap specific code.
		* CSS Classes:
			- bg-dark
			- collapse
			- justify-content-end
			- nav-link
			- navbar
			- navbar-brand
			- navbar-collapse
			- navbar-dark
			- navbar-expand-md
			- navbar-nav
			- navbar-toggler
			- navbar-toggler-icon
