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
 * PHP Crossword Grid
 *
 * @package		PHP_Crossword 
 * @copyright	Laurynas Butkus, 2004
 * @license		http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version		0.2
 */

class PHP_Crossword_Grid
{
	var $rows;
	var $cols = 1;
	var $cells 		= array();
	var $words 		= array();

	var $inum 		= 0; # sandy addition
	var $maxinum 	= 0; # sandy addition
	var $totwords 	= 0; # sandy addition
	var $coordinate;

	/**
	 * Constructor
	 * @param int $rows
	 * @param int $cols
	 * Initialize cells (create celll objects)
	 */
	function __construct($rows, $cols)
	{
		$this->rows = (int)$rows;
		$this->cols = (int)$cols;

		$class = "PHP_Crossword_Cell";
		for ($y = 0; $y < $this->rows; $y++){
			for ($x = 0; $x < $this->cols; $x++){
				$this->cells[$x][$y] = new $class($x, $y);
			}
		}
	}

	/**
	 * Count words in the grid
	 * @return int 
	 */
	function countWords()
	{
		$this->totwords = count($this->words); // sandy addition
		return $this->totwords;
	}

	/**
	 * Get random word from the grid (not fully crossed)
	 * @return object word object
	 */
	function &getRandomWord()
	{
		$words = array();

		for ($i = 0; $i < count($this->words); $i++){
			if (!$this->words[$i]->isFullyCrossed()){
				$words[] = $i;
			}
		}

		if (!count($words)){
			$return = "PC_WORDS_FULLY_CROSSED";
			return $return;
		}

		$n = array_rand($words);
		$n = $words[$n];

		return $this->words[$n];
	}

	/**
	 * Place word
	 * @param string $word
	 * @param int $x 
	 * @param int $y
	 * @param int $axis 
	 */
	function placeWord($word, $x, $y, $axis)
	{
		$class = "PHP_Crossword_Word";
		$w = new $class($word, $axis, $this->cells[$x][$y]);

		++$this->inum; // sandy addition
		++$this->maxinum; // sandy addition

		$w->inum = $this->inum; // sandy addition

		$this->words[] =& $w;

		$cx = $x;
		$cy = $y;

		if ($axis == PC_AXIS_H)
		{
			$s = $x;
			$c =& $cx;
			$t =& $cy;
		}
		else
		{
			$s = $y;
			$c =& $cy;
			$t =& $cx;
		}

		// dump( "PLACING WORD: $cx x $cy - {$w->word}" );

		for ($i = 0; $i < strlen($word); $i++)
		{
			$c = $s + $i;
			$cell =& $this->cells[$cx][$cy];

			$cell->setLetter($w->word[$i], $axis, $this);
			$w->cells[$i] =& $cell;
		}

		// disable cell before first cell
		$c = $s - 1;
		if ($c >= 0 )
			$this->cells[$cx][$cy]->setCanCross(PC_AXIS_BOTH, FALSE);

		// $this->cells[$cx][$cy]->number = $w->inum; // sandy addition

		if(empty($this->cells[$cx][$cy])) $this->cells[$cx][$cy] = new stdClass();
		@$this->cells[$cx][$cy]->number = $w->inum;


		// disable cell after last cell
		$c = $s + strlen($word);
		if (isset($this->cells[$cx][$cy]) && is_object($this->cells[$cx][$cy]))
			$this->cells[$cx][$cy]->setCanCross(PC_AXIS_BOTH, FALSE);

		// avoid starting "corner word" - which would use the same
		// number cell as this word
		$c = $s - 1;
		$t = $t + 1;
		if ($c >= 0 && isset($this->cells[$cx][$cy]) && is_object($this->cells[$cx][$cy]))
			$this->cells[$cx][$cy]->setCanCross(PC_AXIS_BOTH, FALSE);
	}

	/**
	 * Check if it's possible to place the word
	 * @param string $word
	 * @param int $x
	 * @param int $y
	 * @param int $axis
	 * @return boolean
	 */
	function canPlaceWord($word, $x, $y, $axis)
	{
		for ($i = 0; $i < strlen($word); $i++)
		{
			if ($axis == PC_AXIS_H )
			$cell =& $this->cells[$x+$i][$y];
			else
			$cell =& $this->cells[$x][$y+$i];

			if (!is_object($cell))
			{
				echo "ERROR!!! Word: $word, x=$x, y=$y, axis=$axis";
				echo $this->getHTML(1);
			}

			if (!$cell->canSetLetter($word[$i], $axis))
			return FALSE;
		}
		return TRUE;
	}

	/**
	 * Get number of columns in the grid
	 * @return int
	 */
	function getCols()
	{
		return $this->cols;
	}

	/**
	 * Get number of rows in the grid
	 * @return int
	 */
	function getRows()
	{
		return $this->rows;
	}

	/**
	 * Get random position
	 * @param int $axis
	 * @param string $word
	 * @return int 
	 */
	function getRandomPos($axis, $word = NULL)
	{
		$n = $axis == PC_AXIS_H ? $this->cols : $this->rows;

		if (!is_null($word))
		$length = strlen($word);

		if ($n == $length) return 0;

		return rand(0, $n-$length-1);
	}

	/**
	 * Get center position
	 * @param int $axis
	 * @param string $word
	 * @return int
	 */
	function getCenterPos($axis, $word = '')
	{
		$n = $axis == PC_AXIS_H ? $this->cols : $this->rows;
		$n-= strlen($word);
		$n = floor($n / 2);
		return $n;
	}

	/**
	 * Get minimum starting cell on the axis
	 * @param object $cell crossing cell
	 * @param int $axis
	 * @return object cell
	 */
	function &getStartCell(&$cell, $axis )
	{
		$x = $cell->x;
		$y = $cell->y;

		if ($axis == PC_AXIS_H)
		$n =& $x;
		else
		$n =& $y;

		while ($n >= 0)
		{
			if (!$this->cells[$x][$y]->canCross($axis))
			break;

			$n--;

			if (isset($this->cells[$x][$y]->letter))
			{
				$n++;
				break;
			}
		}

		$n++;

		return $this->cells[$x][$y];
	}

	/**
	 * Get maximum ending cell on the axis
	 * @param object $cell crossing cell
	 * @param int $axis
	 * @return object cell
	 */
	function &getEndCell(&$cell, $axis)
	{
		$x = $cell->x;
		$y = $cell->y;

		if ($axis == PC_AXIS_H)
		{
			$n =& $x;
			$max = $this->getCols() - 1;
		}
		else
		{
			$n =& $y;
			$max = $this->getRows() - 1;
		}

		while ($n <= $max)
		{
			if (!$this->cells[$x][$y]->canCross($axis))
			break;

			$n++;

			if (isset($this->cells[$x][$y]->letter))
			{
				$n--;
				break;
			}
		}

		$n--;

		return $this->cells[$x][$y];
	}

	/**
	 * Get HTML (for debugging)
	 * @param array params
	 * @return string HTML
	 */
	function getHTML($params = array())
	{
		extract((array)$params);

		$color = "white";
		$html  = "<table border=0 class='crossTable xx' align='center'>";

		$dd = -1;
		for ($y = $dd; $y < $this->rows; $y++)
		{
			$html.= "<tr align='center' y='".$y."'>";

			for ($x = $dd; $x < $this->cols; $x++)
			{
				$class = isset($this->cells[$x][$y]->letter) ? 'cellLetter' : 'cellEmpty';

				$html .= "\n";
				if (isset($this->cells[$x][$y]->number))
				{
					$tempinum = $this->cells[$x][$y]->number; # sandy addition
					$html.= "<td class='cellNumber' align=right valign=bottom><b>$tempinum</b></td>"; # sandy addition
				}
				elseif ($y == $dd){
					$html.= "<td bgcolor='{$color}' class='{$class}'></td>";
				}
				elseif ($x == $dd){
					$html.= "<td bgcolor='{$color}' class='{$class}'></td>";
				}

				elseif (isset($this->cells[$x][$y]->letter))
				{
					$letter = $this->cells[$x][$y]->letter;
					$html.= "<td bgcolor='{$color}' class='{$class}'>$letter</td>";
				}
				else{
					$html.= "<td bgcolor='{$color}' class='{$class}'></td>";
				}
			}
			$html.= "</tr>";
		}

		$html.= "</table>";

		return $html;
	}

	// function getHTML($params = array()) //debug
	// {
	// 	extract((array)$params);

	// 	$color = "white";
	// 	$html  = "<table border=0 class='crossTable xx' align='center'>";

	// 	$dd = -1;
	// 	for ($y = $dd; $y < $this->rows; $y++)
	// 	{
	// 		$html.= "<tr align='center' y='".$y."'>";

	// 		for ($x = $dd; $x < $this->cols; $x++)
	// 		{
	// 			// if ($x > $dd && $y > $dd)
	// 			// {
	// 			// 	switch ($this->cells[$x][$y]->getCanCrossAxis())
	// 			// 	{
	// 			// 		case PC_AXIS_H:
	// 			// 		$color = "yellow";
	// 			// 		break;

	// 			// 		case PC_AXIS_V:
	// 			// 		$color = "brown";
	// 			// 		break;

	// 			// 		case PC_AXIS_NONE:
	// 			// 		$color = "red";
	// 			// 		break;

	// 			// 		case PC_AXIS_BOTH:
	// 			// 		$color = "lightgreen";
	// 			// 		break;
	// 			// 	}
	// 			// }

	// 			$class = isset($this->cells[$x][$y]->letter) ? 'cellLetter' : 'cellEmpty';

	// 			$html .= "\n";
	// 			if (isset($this->cells[$x][$y]->number))
	// 			{
	// 				$tempinum = $this->cells[$x][$y]->number; # sandy addition
	// 				$html.= "<td '".$x."' class='cellNumber' align=right valign=bottom><b>$tempinum</b></td>"; # sandy addition
	// 			}
	// 			elseif ($y == $dd){
	// 				$html.= "<td '".$x."' bgcolor='{$color}' class='{$class}'>".($x+1).".".($y+1)."|"."</td>";
	// 			}
	// 			elseif ($x == $dd){
	// 				$html.= "<td '".$x."' bgcolor='{$color}' class='{$class}'>".($x+1).".".($y+1)."|"."</td>";
	// 			}

	// 			elseif (isset($this->cells[$x][$y]->letter))
	// 			{
	// 				$letter = $this->cells[$x][$y]->letter;
	// 				$html.= "<td '".$x."' bgcolor='{$color}' class='{$class}'>$letter</td>";//".($x+1).".".($y+1)."
	// 			}
	// 			else{
	// 				$html.= "<td '".$x."' bgcolor='{$color}' class='{$class}'>".($x+1).".".($y+1)."|"."</td>";
	// 			}
	// 		}
	// 		$html.= "</tr>";
	// 	}

	// 	$html.= "</table>";

	// 	return $html;
	// }
}
?>
