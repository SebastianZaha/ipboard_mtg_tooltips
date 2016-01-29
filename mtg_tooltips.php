<?php

/*
  Plugin Name: Magic the Gathering Card Tooltips
  Plugin URI: https://github.com/SebastianZaha/ipboard_mtg_tooltips
  Description: Easily transform Magic the Gathering card names into links that show the card
    image in a tooltip when hovering over them.
  Author: Sebastian Zaha
  Author URI: https://deckbox.org
  Version: 1.0.0
*/

if( !class_exists('bbcode_parent_main_class') ) {
    require_once( IPS_ROOT_PATH . 'sources/classes/text/parser/bbcode/defaults.php' );
}
     function kill($data) { echo "<pre>"; var_dump($data); echo "</pre>"; exit; }


class bbcode_plugin_cards extends bbcode_parent_main_class
{
    public function __construct( ipsRegistry $registry, $_parent='' ) {
        $this->currentBbcode = 'cards';
        parent::__construct( $registry, $_parent );
    }

    /**
     * Do the actual replacement
     *
     * @access  protected
     * @param   string      $txt    Parsed text from database to be edited
     * @return  string              BBCode content, ready for editing
     */
    protected function _replaceText( $txt )
    {
        $_tags = $this->_retrieveTags();
        foreach( $_tags as $_tag )
        {
            //-----------------------------------------
            // Infinite loop catcher
            //-----------------------------------------

            $_iteration = 0;

            //-----------------------------------------
            // Start building open tag
            //-----------------------------------------

            $open_tag = '[' . $_tag . ']';

            //-----------------------------------------
            // Doz I can haz opin tag? Loopy loo
            //-----------------------------------------

            while( ( $this->cur_pos = stripos( $txt, $open_tag, $this->cur_pos ) ) !== false )
            {
                //-----------------------------------------
                // Stop infinite loops
                //-----------------------------------------

                if( $_iteration > $this->settings['max_bbcodes_per_post'] )
                {
                    break;
                }

                $_iteration++;

                //-----------------------------------------
                // Grab the new position to jump to
                //-----------------------------------------

                $new_pos = strpos( $txt, ']', $this->cur_pos ) ? strpos( $txt, ']', $this->cur_pos ) : $this->cur_pos + 1;
                $close_tag  = '[/' . $_tag . ']';

                //-----------------------------------------
                // No closing tag
                //-----------------------------------------

                $_content   = substr( $txt, ($this->cur_pos + strlen($open_tag)),
                                     (stripos( $txt, $close_tag, $this->cur_pos ) - ($this->cur_pos + strlen($open_tag))) );

                if ( $_content or $_content === '0' )
                {
                    if ( $this->_buildOutput( $_content) )
                    {
                        $txt = substr_replace( $txt,
                               $this->_buildOutput( $_content ),
                               $this->cur_pos,
                               ( stripos( $txt, $close_tag, $this->cur_pos ) + strlen( $close_tag ) - $this->cur_pos ) );
                    }
                } else {
                    $txt = substr_replace( $txt, '', $this->cur_pos, (stripos( $txt, $close_tag, $this->cur_pos ) + strlen($close_tag) - $this->cur_pos) );
                }

                //-----------------------------------------
                // And reset current position to end of open tag
                //-----------------------------------------

                $this->cur_pos = stripos( $txt, $open_tag ) ? stripos( $txt, $open_tag ) : $this->cur_pos + 1; //$new_pos;

                if( $this->cur_pos > strlen($txt) )
                {
                    //-----------------------------------------
                    // Need to reset for next "tag"
                    //-----------------------------------------

                    $this->cur_pos  = 0;
                    break;
                }
            }
        }

        return $txt;
    }

    /**
     * Build the actual output to show
     *
     * @access  protected
     * @param   string      $content    Text
     * @return  string                  Content to replace bbcode with
     */
    protected function _buildOutput( $content )
    {
        $cards = preg_split("/[\r\n]/", $content);
        foreach($cards as &$card) {
            $card = trim(strip_tags($card));
            if (strlen($card) > 0) {
                preg_match('/([\s0-9x-]*)(.*)/', $card, $bits);
                $card = $bits[1].'<a href="http://deckbox.org/mtg/'.$bits[2].'">'.$bits[2].'</a>';
            }
        }

        return implode("<br/>", $cards);
    }
}
