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
				$lowerWord = $word;
				foreach($this->leet_replace as $key => $value)
					$lowerWord = preg_replace('/' . $value . '/i', $key, $lowerWord);

				if(in_array($lowerWord, $this->badwords)) {
					$badness = 2;
					$outputWord = $this->censorString($word);
				} else if(!in_array($lowerWord, $this->wordlist)) {
					$current = $lowerWord;
					foreach($this->badwords as $badword) {
						while(mb_strpos($current, $badword) !== false) {
							$current = $this->censorStringInString($badword, $current);
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
			if(!$censor)
				return $output;
			else {
				$outputString = "";
				foreach($output as $outputWord) {
					$outputString .= ($outputWord . " ");
				}
	
				return $outputString;
			}
		}
		
		private function censorString($string) {
			return $this->censorStringInString($string, $string);
		}
		
		private function censorStringInString($string, $mother) {
			$output = $mother;
			$pos = mb_strpos($mother, $string);
			if(is_numeric($pos)) {
				for($i = $pos; $i < mb_strlen($string) + $pos; ++$i) {
					$output = $this->mb_substr_replace($output, $this->censorChar, $i, $i + 1);
				}
			} else 
				echo("There was an issue with the word \"" . $mother . "\" ");
			return $output;
		}
		
		private function mb_substr_replace($output, $replace, $posOpen, $posClose) { 
        	return mb_substr($output, 0, $posOpen) . $replace . mb_substr($output, $posClose); 
    	} 
	}
?>