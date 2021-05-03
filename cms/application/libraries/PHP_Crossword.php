<?php
// ----------------------------------------------------------------------------
// This file is part of PHP Crossword.
//
// PHP Crossword is free software; you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation; either version 2 of the License, or
// (at your option) any later version.
// 
// PHP Crossword is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
// 
// You should have received a copy of the GNU General Public License
// along with Foobar; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
// ----------------------------------------------------------------------------

/**
 * PHP Crossword Generator
 *
 * @package     PHP_Crossword 
 * @copyright   Laurynas Butkus, 2004
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version     0.2
 */

define("_PC_DIR", dirname(__FILE__) . "/");

require_once _PC_DIR . "PHP_Crossword_Grid.php";
require_once _PC_DIR . "PHP_Crossword_Cell.php";
require_once _PC_DIR . "PHP_Crossword_Word.php";

define("PC_AXIS_H", 1);
define("PC_AXIS_V", 2);
define("PC_AXIS_BOTH", 3);
define("PC_AXIS_NONE", 4);
define("PC_WORDS_FULLY_CROSSED", 10);

class PHP_Crossword 
{
    var $dump = array();
    var $rows = 15;
    var $cols = 15;
    var $grid;

    var $max_full_tries = 10;
    var $max_words = 15;
    var $max_tries = 25;//50

    var $table = "tts_manual_questions";
    var $groupid = "";
    var $db;

    var $_match_line;
    var $_full_tries = 0;
    var $_tries = 0;
    var $_debug = FALSE;
    var $_items;

    var $message = '';

    /**
     * Constructor
     * @param int $rows 
     * @param int $cols
     */
    function __construct($rows = 15, $cols = 15, $ttsid="")
    {
        $this->ci =& get_instance();
        $this->ci->load->database();

        $this->rows  = (int)$rows;
        $this->cols  = (int)$cols;
        $this->groupid = (int)$ttsid;
    }

    /**
     * Enable / disable debugging
     * @param boolean $debug
     */
    function setDebug($debug = TRUE)
    {
        $this->_debug = (boolean)$debug;
    }

    /**
     * Set number of words the crossword shoud have
     * @param int $max_words
     */
    function setMaxWords($max_words)
    {
        $this->max_words = (int)$max_words;
    }

    /**
     * Set maximum number of tries to generate full crossword
     * @param int $max_full_tries
     */
    function setMaxFullTries($max_full_tries)
    {
        $this->max_full_tries = (int)$max_full_tries;
    }

    /**
     * Set max tries to pick the words
     * @param int $max_tries
     */
    function setMaxTries($max_tries)
    {
        $this->max_tries = (int)$max_tries;
    }

    /**
     * Generate crossword
     * @return boolean TRUE - if succeeded, FALSE - if unable to get required number of words
     */
    function generate()
    {
        // set the number of full tries
        $this->_full_tries = 0;
    
        // try to generate until we get required number of words
        while ($this->_full_tries < $this->max_full_tries)
        {
            // reset grid
            $this->reset();
            
            // count number of tried to generate crossword 
            // with required number of words
            $this->_full_tries++;

            // pick and place first word
            $this->__placeFirstWord();
            
            // try to find other words and place them
            $this->__autoGenerate();

            //dump($this->grid->countWords());

            // if we have enough words - 

            if ($this->grid->countWords() == $this->max_words)
            {
                $this->_items = $this->__getItems();
                return TRUE;
            }
        }

        // if ($this->_debug)
            $this->message .= "ERROR: unable to generate {$this->max_words} words crossword (tried {$this->_full_tries} times)<br>";
        
        return FALSE;
    }

    /**
     * Reset grid
     */
    function reset()
    {
        // create new grid object
        $this->grid = new PHP_Crossword_Grid($this->rows, $this->cols);
        
        // reset number of tries to pick words
        $this->_tries = 0;
        
        // reset crossword items
        $this->_items = NULL;
    }

    /**
     * Get crossword HTML (useful for generator debugging)
     * @param array params
     * @return string HTML
     */
    function getHTML($params = array())
    {
        return $this->grid->getHTML($params);
    }

    /**
     * Get crossword items
     * @return array
     */
    function getWords()
    {
        return $this->_items;
    }

    function getMessage()
    {
        return $this->message;
    }
    
    /**
     * Get crossword items array
     * @private
     * @return array  
     */
    function __getItems()
    {
        $items = array();

        for ($i = 0; $i < count($this->grid->words); $i++)
        {
            $w =& $this->grid->words[$i];

            $x = $w->getStartX() + 1;
            $y = $w->getStartY() + 1;
            $xe = $w->getEndX(strlen($w->word)) + 1;
            $ye = $w->getEndY(strlen($w->word)) + 1;

            $coordinate = array();
            for ($k = 0; $k < strlen($w->word); $k++)
            {
                if($k != 0){
                    if($x == $xe){
                    $type = 'menurun';
                    $y++;
                    }
                    elseif($y == $ye){
                        $type = 'mendatar';
                        $x++;
                    }
                }
                $coordinate[$k] = [$x,$y];
            }

            $items[] = array(
                "word"      => $w->word,
                "question"  => $this->getQuestion($w->word),
                "x"         => $w->getStartX() + 1,
                "y"         => $w->getStartY() + 1,
                "coordinate" => json_encode($coordinate),
                "type"      => $type,
                "axis"      => $w->axis,
                );
        }
        
        return $items;
    }

    /**
     * Get question for the word
     * @param string $word
     * @return string $question
     */
    function getQuestion($word)
    {
        $sql = $this->ci->db->query("SELECT question FROM {$this->table} WHERE id_tts = '{$this->groupid}' AND answer = '{$word}'");
        $res = $sql->result();
            
        return $res[0]->question;
    }

    /**
     * Try to generate crossword automatically 
     * (until we get enough word or reach number of maximum tries
     * @private
     */
    function __autoGenerate()
    {
        while ($this->grid->countWords() < $this->max_words && $this->_tries < $this->max_tries)
        {
            $this->_tries++;

            // dump( "Words: " . $this->grid->countWords() . ", Tries: $this->_tries" );

            $w =& $this->grid->getRandomWord();

            if ($w == "PC_WORDS_FULLY_CROSSED")
            {
                // echo "NOTE: All words fully crossed...\n";
                break;
            }

            $axis = $w->getCrossAxis();
            $cells =& $w->getCrossableCells();

            // dump( "TRYING WORD: ".$w->word );

            while (count($cells))
            {
                $n = array_rand($cells);
                $cell =& $cells[$n];

                //dump( "TRYING CELL: [$cell->x/$cell->y]:". $cell->letter );
                //dump( "COUNT CELLS: ". count($cells) );
                $getword = $this->__getWordWithStart($cell, $axis);
                $list =& $getword;
                $word = $list[0];
                $start =& $list[1];

                if ($start)
                {
                    $this->grid->placeWord($word, $start->x, $start->y, $axis);
                    break;
                }

                //dump("CAN'T FIND CROSSING FOR: ".$cells[$n]->letter);
                $cells[$n]->setCanCross($axis, FALSE);
                unset($cells[$n]);
            }
        }
    }

    /**
     * Try to pick the word crossing the cell
     * @private
     * @param object $cell Cell object to cross
     * @param int $axis 
     * @return array Array of 2 items - word and start cell object
     */
    function __getWordWithStart(&$cell, $axis)
    {
        $start = & $this->grid->getStartCell($cell, $axis);
        $end = & $this->grid->getEndCell($cell, $axis);

        $word = $this->__getWord($cell, $start, $end, $axis);

        if (!$word) return NULL;

        $pos = NULL;

        do
        {
            // dump( $this->_match_line );
            $s_cell = & $this->__calcStartCell($cell, $start, $end, $axis, $word, $pos);
            $can = $this->grid->canPlaceWord($word, $s_cell->x, $s_cell->y, $axis);
            
            //if ( !$can )
            // dump(strtoupper("Wrong start position [{$s_cell->x}x{$s_cell->y}]! Relocating..."));

        }
        while (!$can);

        return array($word, &$s_cell);
    }

    /**
     * Calculate starting cell for the word
     * @private
     * @param object $cell crossing cell
     * @param object $start minimum starting cell
     * @param object $end maximum ending cell
     * @param int $axis
     * @param string $word
     * @param int $pos last position
     * return object|FALSE starting cell object or FALSE ir can't find
     */
    function &__calcStartCell(&$cell, &$start, &$end, $axis, $word, &$pos)
    {
        $x = $cell->x;
        $y = $cell->y;

        if ($axis == PC_AXIS_H)
        {
            $t =& $x;
            $s = $cell->x - $start->x;
            $e = $end->x - $cell->x;
        }
        else
        {
            $t =& $y;
            $s = $cell->y - $start->y;
            $e = $end->y - $cell->y;
        }

        $l = strlen($word);

        do
        {
            $offset = isset($pos) ? $pos+1 : 0;
            $pos = strpos($word, $cell->letter, $offset);
            $a = $l-$pos-1;
            if ($pos <= $s && $a <= $e)
            {
                $t-= $pos;
                return $this->grid->cells[$x][$y];
            }
        }
        while ($pos !== FALSE);

        return FALSE;
    }

    /**
     * Try to get the word
     * @private
     * @param object $cell crossing cell
     * @param object $start minimum starting cell
     * @param object $end maximum ending cell
     * @param int $axis
     * @return string word
     */
    function __getWord(&$cell, &$start, &$end, $axis)
    {
        $this->_match_line = $this->__getMatchLine($cell, $start, $end, $axis);
        $match = $this->__getMatchLike($this->_match_line);
        $min = $this->__getMatchMin($this->_match_line);
        $max = strlen($this->_match_line);
        $regexp = $this->__getMatchRegexp($this->_match_line);

        $rs = $this->__loadWords($match, $min, $max);

        return $this->__pickWord($rs, $regexp);
    }

    /**
     * Pick the word from the resultset
     * @private
     * @param mysql_resultset $rs
     * @param string $regexp Regexp to match     
     * return string|NULL word or NULL if couldn't find
     */
    function __pickWord(&$rs, $regexp)
    {
        $n = count($rs);
        if(!$n){
            return NULL;
        }
        $list = range(0, $n-1);
        while (count($list))
        {
            $i = array_rand($list);
            if (preg_match("/{$regexp}/", $rs[$i]->answer))
            {
                return $rs[$i]->answer;
            }
            unset($list[$i]);
        }
        return NULL;
    }

    /**
     * Generate word matching line
     * @private
     * @param object $cell crossing cell
     * @param object $start minimum starting cell
     * @param object $end maximum ending cell
     * @param int $axis
     * @return string matching line
     */
    function __getMatchLine(&$cell, &$start, &$end, $axis)
    {
        $x = $start->x;
        $y = $start->y;

        if ($axis == PC_AXIS_H)
        {
            $n =& $x;
            $max = $end->x;
        }
        else
        {
            $n =& $y;
            $max = $end->y;
        }

        $str = '';

        while ($n <= $max)
        {
            $cell =& $this->grid->cells[$x][$y];
            $str.= isset($cell->letter) ? $cell->letter : '_';
            $n++;
        }

        return $str;
    }

    /**
     * Get minimum match string  
     * @private
     * @param string $str match string
     * @return string
     */
    function __getMatchMin($str)
    {
        $str = preg_replace("/^_+/", "", $str, 1);
        $str = preg_replace("/_+$/", "", $str, 1);
        return strlen($str);
    }

    /**
     * Get SQL LIKE match for the match string
     * @private
     * @param string $str match string
     * @return string
     */
    function __getMatchLike($str)
    {
        $str = preg_replace("/^_+/", "%", $str, 1);
        $str = preg_replace("/_+$/", "%", $str, 1);
        return $str;
    }

    /**
     * Get REGEXP for the match string
     * @private
     * @param string $str match string
     * @return string
     */
    function __getMatchRegexp($str)
    {
        $str = preg_replace_callback("/^_*/", function($m){ return '^.{0,'.strlen($m[0]).'}';}, $str);
        $str = preg_replace_callback("/_*$/", function($m){ return '.{0,'.strlen($m[0]).'}$';}, $str);
        $str = preg_replace_callback("/_+/", function($m){ return '.{'.strlen($m[0]).'}';}, $str);

        return $str;
    }

    /**
     * Place first word to the cell
     * @private
     */
    function __placeFirstWord()
    {
        $word = $this->__getRandomWord($this->grid->getCols());

        $x = $this->grid->getCenterPos(PC_AXIS_H, $word);
        $y = $this->grid->getCenterPos(PC_AXIS_V);

        $this->grid->placeWord($word, $x, $y, PC_AXIS_H);
    }
    
    /**
     * Load words for the match
     * @private
     * @param string $match SQL LIKE match
     * @param int $len_min minimum length of the word
     * @param int $len_max maximum length of the word
     * @return result SQL result
     */
    function __loadWords($match, $len_min, $len_max)
    {
        $used_words_sql = $this->__getUsedWordsSql();

        $sql = $this->ci->db->query("SELECT answer FROM ".$this->table." WHERE id_tts = ".$this->groupid." AND LENGTH(answer) <= ".$len_max." AND LENGTH(answer) >= ".$len_min." AND answer LIKE '".$match."' ".$used_words_sql);
        
        return $sql->result();
    }

    /**
     * Get used word SQL
     * @private
     * return string
     */
    function __getUsedWordsSql()
    {
        $sql = '';
        
        for ($i = 0; $i < count($this->grid->words); $i++)
            $sql .= " AND answer != '" . $this->grid->words[$i]->word . "' ";

        return $sql;
    }

    /**
     * Get random word
     * @private
     * @param int $max_length maximum word length
     * @return string word
     */
    function __getRandomWord($max_length)
    {
        $where["LENGTH(answer) <= "] = $max_length;

        $count = $this->__getWordsCount($where);

        if (!$count)
            die("ERROR: there is no words to fit in this grid" );

        $n = rand(0, $count-1);

        $where['id_tts'] = $this->groupid;
        $this->ci->db->select('answer');
        $this->ci->db->where($where);
        $this->ci->db->limit(1);
        $this->ci->db->offset($n);

        $result = $this->ci->db->get($this->table);
        $row    = $result->row();

        return $row->answer;
    }

    /**
     * Count words
     * @private
     * @param string $where SQL where
     * @return int
     */
    function __getWordsCount($where = array())
    {
        $where['id_tts'] = $this->groupid;
        $this->ci->db->where($where);            

        return $this->ci->db->count_all_results($this->table);
    }
    
    /**
     * Generate crossword from provided words list
     * @param string $words_list
     * @return boolean TRUE on success
     */
    function generateFromWords($words_list)
    {
        // save current settings
        $_max_words = $this->max_words;
        
        // try to generate crossword from all passed words
        $required_words = $this->__getWordsCount();
        
        // if user entered more words then max_words - require max_words...
        if ($required_words > $_max_words)
            $required_words = $_max_words;

        $success = FALSE;
    
        while ($required_words > 1)
        {
            $this->setMaxWords($required_words);
            
            if ($success = $this->generate()) 
                break;

            $required_words--;
        }

        // restore previous settings
        $this->setMaxWords($_max_words);

        return $success;
    }
    
}
?>
