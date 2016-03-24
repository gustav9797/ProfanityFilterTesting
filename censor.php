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
			
			$leet_replace = array();
			$leet_replace['a'] = '(a|a\.|a\-|4|@|Á|á|À|Â|à|Â|â|Ã|ã|α|Δ|Λ|λ)';
			$leet_replace['b'] = '(b|b\.|b\-|8|\|3|ß|Β|β)';
			$leet_replace['c'] = '(c|c\.|c\-|Ç|ç|¢|€|<|\(|{|©)';
			$leet_replace['d'] = '(d|d\.|d\-|&part;|\|\)|Þ|þ|Ð|ð)';
			$leet_replace['e'] = '(e|e\.|e\-|3|€|È|è|É|é|Ê|ê|∑)';
			$leet_replace['f'] = '(f|f\.|f\-|ƒ)';
			$leet_replace['g'] = '(g|g\.|g\-|6|9)';
			$leet_replace['h'] = '(h|h\.|h\-|Η)';
			$leet_replace['i'] = '(i|i\.|i\-|!|\||\]\[|]|1|∫|Ì|Í|Î|Ï|ì|í|î|ï)';
			$leet_replace['j'] = '(j|j\.|j\-)';
			$leet_replace['k'] = '(k|k\.|k\-|Κ|κ)';
			$leet_replace['l'] = '(l|1\.|l\-|!|\||\]\[|]|£|∫|Ì|Í|Î|Ï)';
			$leet_replace['m'] = '(m|m\.|m\-)';
			$leet_replace['n'] = '(n|n\.|n\-|η|Ν|Π)';
			$leet_replace['o'] = '(o|o\.|o\-|0|Ο|ο|Φ|¤|°|ø)';
			$leet_replace['p'] = '(p|p\.|p\-|ρ|Ρ|¶|þ)';
			$leet_replace['q'] = '(q|q\.|q\-)';
			$leet_replace['r'] = '(r|r\.|r\-|®)';
			$leet_replace['s'] = '(s|s\.|s\-|5|\$|§)';
			$leet_replace['t'] = '(t|t\.|t\-|Τ|τ)';
			$leet_replace['u'] = '(u|u\.|u\-|υ|µ)';
			$leet_replace['v'] = '(v|v\.|v\-|υ|ν)';
			$leet_replace['w'] = '(w|w\.|w\-|ω|ψ|Ψ)';
			$leet_replace['x'] = '(x|x\.|x\-|Χ|χ)';
			$leet_replace['y'] = '(y|y\.|y\-|¥|γ|ÿ|ý|Ÿ|Ý)';
			$leet_replace['z'] = '(z|z\.|z\-|Ζ)';
			$leet_replace['å'] = '(å|å\.|å\-|Å)';
			$leet_replace['ä'] = '(ä|ä\.|ä\-|Ä)';
			$leet_replace['ö'] = '(ö|ö\.|ö\-|Ö)';
			$this->leet_replace = $leet_replace;
		}
		
		public function run($text, $censor = false) {
			$output = array();
			
			$words = explode(" ", $text);
			foreach($words as $word) {
				$badness = 0;
				$outputWord = $word;
				//$lowerWord = strtolower(preg_replace("/[^A-Za-z0-9åäöÅÄÖ ]/", '', $word));
				$lowerWord = $word;
				foreach($this->leet_replace as $key => $value) {
					//echo "key " . $key . " value " . $value;
					$lowerWord = preg_replace('/' . $value . '/i', $key, $lowerWord);

				}
				//$lowerWord = str_ireplace(array_values($this->leet_replace), array_keys($this->leet_replace), $word);
				//echo "<br/>" . $lowerWord;
				if(in_array($lowerWord, $this->badwords)) {
					$badness = 1;
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
						while(mb_strpos($current, $badword) !== false) {
							//echo(" censored \"" . $current . "\"");
							//echo(" before" . $current);
							$current = $this->censorStringInString($badword, $current);
							//echo(" after" . $current);
							$badness = 1;

						}
					}
					if(strcmp($current, $lowerWord) != 0)
						$outputWord = $current;
				}
				if(!$censor) {
					if(!array_key_exists($word, $output))
						$output[$word] = array();
					array_push($output[$word], $badness);
				} else
					array_push($output, $outputWord);
			}
			//echo("<br>");
			if(!$censor)
				return $output;
			else {
				$outputString = "";
				foreach($output as $outputWord) {
					$outputString .= ($outputWord . " ");
				}
	
				return $outputString;
			}
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
				echo("There was an issue with the word \"" . $mother . "\" ");
			//echo(" out " . $output);
			return $output;
		}
		
		private function mb_substr_replace($output, $replace, $posOpen, $posClose) { 
			//echo " posopen " . $posOpen . " posClose " . $posClose;
        	return mb_substr($output, 0, $posOpen) . $replace . mb_substr($output, $posClose); 
    	} 
	}
?>