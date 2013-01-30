Addon for MTG Card Tooltips
===========================

Enables card images to show on mouseover for Magic the Gathering cards.

Description
-----------

[deckbox.org](http://deckbox.org) provides a javascript utility that enables links to its 
Magic the Gathering card pages to automatically show card image tooltips on hover. 
For more information see [the tooltips integration page](http://deckbox.org/help/tooltips).

This **IPBoard** plugin provides the bbcode tag `[cards]` that turns a simple card list
into links to card pages. 


Installation
------------

1. Download the [zipfile distribution of this addon](https://github.com/SebastianZaha/ipboard_mtg_tooltips/archive/master.zip).

2. In your IPBoard admin panel go to `Look and Feel -> Post Content -> BBCode Management`.
   At the bottom of the page in the `Import new BBCodes` section upload the `bbcode.xml` from
   the zipfile.
   
3. Upload the file `mtg_tooltips.php` to your forum installation in the folder 
   `admin/sources/classes/bbcode/custom/`.

4. Go to `Look and Feel -> Manage Skin sets and Templates`. Edit the file 
   `Global Templates / includeJS` and paste the following code at the bottom of it:
   
   ```
   <script src="http://deckbox.org/javascripts/bin/tooltip.js"></script>
   ```

5. There is no step 5! After installing, use the `[cards]` bbcode to surround MtG card names
   or deck lists in your posts.


Support and development
-----------------------

If you run into problems installing or using the plugin, please contact 
[support@deckbox.org](mailto:support@deckbox.org).

If you would like to contribute, I will gladly accept pull requests. I spent some time 
trying to figure out how to package this as an uploadable plugin / application for IPBoard
but i have not managed to find a proper documentation for it. If anyone would like to 
try their hand at it, I'll be glad to repackage.
