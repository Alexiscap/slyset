## Piwik modifications to libs/

In general, bug fixes and improvements are reported upstream.  Until these are
included upstream, we maintain a list of bug fixes and local mods made to
third-party libraries:

 * Event/
   - in r41, php 5 incompatibility
   - in r1035 and r1041, profiling hook via increaseNotificationCount()
   - in r1287, fix php 5.3.x incompatibilities 
   - in r1296, strip require_once (to support autoloading)
 * HTML/Quickform2/
   - in r2626, php 5.1.6 incompatibility
   - in r3040, exception classes don't follow PEAR naming convention
 * pChart2.1.3/
   - the following unused files were removed:
     class/pBarcode39.class.php, class/pBarcode128.class.php,
     class/pBubble.class.php, class/pCache.class.php, class/pIndicator.class.php,
     class/pRadar.class.php, class/pScatter.class.php, class/pSplit.class.php,
     class/pSpring.class.php, class/pStock.class.php, class/pSurface.class.php,
     data/, examples/, fonts/, palettes/
 * PclZip/
   - in r1960, ignore touch() - utime failed warning
 * PEAR/, PEAR.php
   - in r2419, add static keyword to isError and raiseError as it throws notices
     in HTML_Quickform2
   - in r2422, is_a() is deprecated for php 5.0 to 5.2.x
 * Smarty/
   - in r3773, chmod after tempnam
 * sparkline/
   - in r1296, remove require_once
   - empty sparklines with floats, off-by-one errors, and locale conflict
 * tcpdf/
   - in r6786 fixed a notice to avoid Strict Notice when using Imagick #3322
   - in r5540 and r5598, fix a temp file bug when embedding images in PDF
 * Zend/
   - strip require_once (to support autoloading)
   - in r3694, fix ZF-10888 and ZF-10835
   - ZF-10871 - undefined variables when socket support disabled
