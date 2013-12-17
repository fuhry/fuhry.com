My personal website, 2014 edition.
==================================

This is, perhaps, the simplest CMS-like thing I could come up with. It took about 45 minutes, including learning how to use Composer (which is the main reason I did this project - to learn Composer). Consider it public domain because it's such a hilariously tiny amount of code I'm pretty sure even the BSD license is longer.

## Setting up ##

Should be a simple `composer update` to install the dependencies.

Make sure `AllowOverride All` is set in your Apache configuration so that the FallbackResource directive works. FallbackResource was added sometime in either 2.2 or 2.4; write a few mod\_rewrite rules if you need to run it under another Apache version. You must have some form of URL rewriting in place, using a ?page\_name= scheme is ugly and will not work.

Finally, create the Smarty template cache directory:

```shell
cd /path/to/fuhry.com
mkdir cache
chmod 777 cache
```

## Known bugs ##

While this will work in any subdirectory under your docroot, you must specify a path relative to the docroot on the "FallbackResource" line in .htaccess if you wish for arbitrary subdirectories to be recognized (i.e. a URI like "/pages/whatever").

The base uri detection is iffy, it uses REQUEST\_URI and PHP\_SELF to approximate where it is located within the docroot. May require some tweaking.

Beyond that, well, if I managed to get serious bugs into 54 lines of code then something must be wrong with me.

Enjoy.
