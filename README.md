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

This branch works on __ipboard versions newer than 3.4__. For older versions please check the instructions in the branch `ipboard_before_3.4`.


Installation
------------

1. Download the [zipfile distribution of this addon](https://github.com/SebastianZaha/ipboard_mtg_tooltips/archive/master.zip).

2. In your IPBoard admin panel go to `Look and Feel -> Post Content -> BBCode Management`.
   At the bottom of the page in the `Import new BBCodes` section upload the `bbcode.xml` from
   the zipfile.
   
3. Upload the file `mtg_tooltips.php` to your forum installation in the folder 
   `admin/sources/classes/text/parser/bbcode/`.

4. Go to `Look and Feel -> Manage Skin sets and Templates`. Edit the file 
   `Global Templates / includeJS` and paste the following code at the bottom of it:
   
   ```
   <script src="http://deckbox.org/javascripts/bin/tooltip.js"></script>
   ```

5. There is no step 5! After installing, use the `[cards]` bbcode to surround MtG card names
   or deck lists in your posts. The tags `[c]` and `[card]` are valid aliases and work the same 
   as `[cards]`.


Upgrade
-------

Follow these steps if you already have this plugin installed and you want to upgrade to a 
newer version:

1. Download the new zipfile from the link at Installation / Step 1.

2. In `Look and Feel -> Post Content -> BBCode Management` delete the BBCode called 
   `Magic the gathering Cards` and re-upload the new bbcode.xml file.
   
3. Re-upload `mtg_tooltips.php` as explained in Installation / Step 3.



Support and development
-----------------------

If you run into problems installing or using the plugin, please contact 
[support@deckbox.org](mailto:support@deckbox.org).

If you would like to contribute, I will gladly accept pull requests. I spent some time 
trying to figure out how to package this as an uploadable plugin / application for IPBoard
but i have not managed to find a proper documentation for it. If anyone would like to 
try their hand at it, I'll be glad to repackage.
