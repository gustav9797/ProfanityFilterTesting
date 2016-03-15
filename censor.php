<?php
	
	class Censor {
		
		private $censorChar = "*";
		
		private $badwords = array();
		
		private $wordlist = array();
		
		public function initialize() {
			header('Content-Type: text/html; charset=UTF-8');
			
			mb_internal_encoding('UTF-8'); 
			mb_http_output('UTF-8'); 
			mb_http_input('UTF-8'); 
			mb_regex_encoding('UTF-8'); 

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
					//echo(" |testing1 " . $lowerWord . "| ");
					//echo(" |testing2 " . $current . "| ");
					foreach($this->badwords as $badword) {
						//echo(" |testing " . $badword . " in " . $word . "| ");
						//echo(" also " . $current . " with badword " . $badword);
						if(mb_strpos($lowerWord, $badword) !== false) {
							//echo(" censored \"" . $current . "\"");
							//echo(" before" . $current);
							$current = $this->censorStringInString($badword, $current);
							//echo(" after" . $current);

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
			//echo(" string \"" . $string . "\"");
			//echo(" mother \"" . $mother . "\"");
			$output = $mother;
			//echo(" in " . $mother);
			$pos = mb_strpos($mother, $string);
			if(is_numeric($pos)) {
				for($i = $pos; $i < mb_strlen($string) + $pos; ++$i) {
					//echo "asdo " . $i;
					//echo "length of \"" . $string . "\": " . mb_strlen($string);
					//$output{$i} = "*";
					$output = $this->mb_substr_replace($output, $this->censorChar, $i, $i + 1);
				}
			} else 
				echo("There was an issue with the word \"" . $mother . "\"");
			//echo(" out " . $output);
			return $output;
		}
		
		private function mb_substr_replace($output, $replace, $posOpen, $posClose) { 
			//echo " posopen " . $posOpen . " posClose " . $posClose;
        	return mb_substr($output, 0, $posOpen) . $replace . mb_substr($output, $posClose); 
    	} 
	}
?>