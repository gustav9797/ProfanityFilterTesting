<?php
	
	class Censor {
		
		private $censorChar = "*";
		
		private $badwords = array();
		
		private $wordlist = array();
		
		public function initialize() {
			$this->badwords = file("Svenska.txt", FILE_IGNORE_NEW_LINES);
			$this->wordlist = file("ordlista.txt", FILE_IGNORE_NEW_LINES);
		}
		
		public function run($text) {
			$output = array();
			
			$words = explode(" ", $text);
			foreach($words as $word) {
				$outputWord = $word;
				$lowerWord = strtolower(preg_replace("/[^A-Za-z0-9åäöÅÄÖ ]/", '', $word));
				if(in_array($lowerWord, $this->badwords)) {
					//echo(" censored \"" . $word . "\"");
					$outputWord = $this->censorString($word);
				} else if(!in_array($lowerWord, $this->wordlist)) {
					//TODO: översätt från leet translator till svenska
					//TODO: om finns med i lista med fula ord, filtrera bort
					//echo(" |testing " . $lowerWord . "| ");
					$current = $lowerWord;
					foreach($this->badwords as $badword) {
						//echo(" |testing " . $badword . " in " . $word . "| ");
						if(mb_strpos($lowerWord, $badword) !== false) {
							//echo(" censored \"" . $word . "\"");
							$current = $this->censorStringInString($badword, $current);

						}
					}
					if(strcmp($current, $lowerWord) != 0)
						$outputWord = $current;
				}
				
				array_push($output, $outputWord);
			}
			//echo("<br>");
			$outputString = "";
			foreach($output as $outputWord) {
				$outputString .= ($outputWord . " ");
			}
			return $outputString;
			//TODO: remove empty space at end of output string
		}
		
		private function censorString($string) {
			return $this->censorStringInString($string, $string);
		}
		
		private function censorStringInString($string, $mother) {
			$output = $mother;
			$pos = mb_strpos($mother, $string);
			if(is_numeric($pos)) {
				for($i = $pos; $i < strlen($string) && $i < strlen($mother); ++$i)
					$output{$i} = $this->censorChar;
			} else 
				echo("There was an issue with the word \"" . $mother . "\"");
			return $output;
		}
	}
?>