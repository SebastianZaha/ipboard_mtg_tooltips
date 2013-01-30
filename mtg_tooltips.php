<?php

/* 
  Plugin Name: Magic the Gathering Card Tooltips
  Plugin URI: https://github.com/SebastianZaha/ipboard_mtg_tooltips
  Description: Easily transform Magic the Gathering card names into links that show the card
    image in a tooltip when hovering over them.
  Author: Sebastian Zaha
  Author URI: http://deckbox.org
  Version: 0.1.1
*/
class bbcode_cards extends bbcode_parent_class implements bbcodePlugin {

    public function __construct(ipsRegistry $registry) {
        $this->currentBbcode = 'cards';
        parent::__construct($registry);
    }

    protected function _replaceText($txt) {
        $_tags = $this->_retrieveTags();

        foreach($_tags as $_tag) {
			$_tag = strtolower($_tag);

            preg_match("/^\[" . $_tag . "\]([^\[]*)/", $txt, $match);
            if ($match) {
                $txt = $match[1];
                $cards = preg_split("/[\r\n]/", $txt);

                foreach($cards as &$card) {
                    $card = trim($card);
                    preg_match('/([\s0-9x-]*)(.*)/', $card, $bits);
                    $card = $bits[1].'<a href="http://deckbox.org/mtg/'.$bits[2].'">'.$bits[2].'</a>';
                }
            
                return implode("<br/>", $cards);
            }
        }
        return $txt;
    }
}
