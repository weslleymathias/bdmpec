<?php
error_reporting(0); //excluir aqui
//include 'pdfparser-master/extratorPDF.php';
/*
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.
 
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 
This code is an improved version of what can be found at:
 
http://www.webcheatsheet.com/php/reading_clean_text_from_pdf.php
 
AUTHOR:
- Webcheatsheet.com (Original code)
- Joeri Stegeman (joeri210 [at] yahoo [dot] com) (Class conversion and fixes/adjustments)
 
DESCRIPTION:
This is a class to convert PDF files into ASCII text or so called PDF text extraction.
It will ignore anything that is not addressed as text within the PDF and any layout.
Currently supported filters are: ASCIIHexDecode, ASCII85Decode, FlateDecode
 
PURPOSE(S):
Most likely for people that want their PDF to be searchable.
 
SYNTAX:
include('class.pdf2text.php');
$a = new PDF2Text();
$a->setFilename('test.pdf');
$a->decodePDF();
echo $a->output(); 
 
ALTERNATIVES:
Other excellent options to search within a PDF:
- Apache PDFbox (http://pdfbox.apache.org/). An open source Java solution
- pdflib TET (http://www.pdflib.com/products/tet/)
- Online converter: http://snowtide.com/PDFTextStream
*/

 //ini_set('default_charset','ISO-8859-1');
class PDF2Text {
	// Some settings
	var $multibyte = 2; // Use setUnicode(TRUE|FALSE)
	var $convertquotes = ENT_QUOTES; // ENT_COMPAT (double-quotes), ENT_QUOTES (Both), ENT_NOQUOTES (None)
	
	// Variables
	var $filename = '';
	var $decodedtext = '';
	
	function setFilename($filename) { 
		// Reset
		$this->decodedtext = '';
		$this->filename = $filename;
	}
	
	function output() { 
		//if($echo) echo $this->decodedtext;
		return $this->decodedtext;
	}
	
	function setUnicode($input) { 
		// 4 for unicode. But 2 should work in most cases just fine
		if($input == true) $this->multibyte = 4;
		else $this->multibyte = 2;
	}
	
	function decodePDF(/*$ini, $end*/) { 
		// Read the data from pdf file
		
            /*$curl_handle=curl_init();
            curl_setopt($curl_handle, CURLOPT_URL,$this->filename);
            curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
            curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Your application name');
            $infile = curl_exec($curl_handle);
            curl_close($curl_handle);*/
           // echo $infile;
            if(file_get_contents($this->filename) != false)
            	$infile = file_get_contents($this->filename);
            echo $infile;
            //if(empty($infile))
            //{
              //  if(file_get_contents($this->filename, FILE_BINARY) != false)
                //        $infile = file_get_contents($this->filename, FILE_BINARY);
            if (empty($infile)) 
            	return ""; 
        //    }
		//$infile = file_get_contents($this->filename, FILE_BINARY); // coloca @
		/*if (empty($infile)) 
		return ""; */
		
		// Get all text data.
		$transformations = array(); 
		$texts = array(); 
		
		// Get the list of all objects.
		preg_match_all("#obj[\n|\r](.*)endobj[\n|\r]#ismU",  $infile, $objects); 
		$objects = $objects[1]; //colocar o @
		
		// Select objects with streams.
		$countObjects = count($objects);
                /*if($ini < 0){$ini = 0;}
                else if($ini > $countObjects){$ini = $countObjects;}
                if($end < 0){$end = 0;}
                else if($end > $countObjects){$end = $countObjects;}
                if($ini > $end) {$aux = $ini; $ini = $end; $end = $aux; }
                if($ini == null) {$ini = 0;}
                if($end === null) {$end = $countObjects;}*/
                
		//for ($i = $ini; $i < $end; $i++) { 
                $data = '';
                for ($i = 0; $i <$countObjects ; $i++) { 
                	$currentObject = $objects[$i]; 
                	
			// Check if an object includes data stream.
                	if (preg_match("#stream[\n|\r](.*)endstream[\n|\r]#ismU", $currentObject, $stream)) { 
                		$stream = ltrim($stream[1]); 
                		
				// Check object parameters and look for text data. 
                		$options = $this->getObjectOptions($currentObject); 
                		
                		if (!(empty($options["Length1"]) && empty($options["Type"]) && empty($options["Subtype"]))) 
                			continue; 
                		
				// Hack, length doesnt always seem to be correct
                		unset($options["Length"]);
                		
				// So, we have text data. Decode it.
				$data .= $this->getDecodedStream($stream, $options);//.'<br><br>'; 
                               // break;
                                //$data = str_replace("ET", " ET<br><br>", $data);
                                //$data = str_replace("BT", "<br><br>BT", $data);
				//echo 'DATA' . $i . ': <br><>br'.$data . '<br>-------------------------------------<br>';
			}
		}
                //echo $data . '<br><br>';
				if (strlen($data)>0) {    //comente aqui
					$textContainers = array();
                                        //preg_replace("#([0-9]+)\s+beginbfchar(.*)endbfchar#ismU", ' ', $data);
                                        //preg_match_all("#([0-9]+)\s+beginbfchar(.*)endbfchar#ismU", $stream, $chars, PREG_SET_ORDER);
                                        //preg_match_all("#([0-9]+)\s+beginbfrange(.*)endbfrange#ismU", $stream, $ranges, PREG_SET_ORDER);
                                        //echo $data . '<br><br>';
					if (preg_match_all("#BT\s(.*)\sET#ismU",$data, $textContainers)) {
						
					//if (preg_match_all("#BT[\n|\r](.*)ET[\n|\r]#ismU",  $data, $textContainers)) {
						echo $data . '<br><br>';
						$textContainers = @$textContainers[1]; // coloca o @
                                                //echo $textContainers[1];
						$this->getDirtyTexts($texts, $textContainers); 
						
						
						//$this->decodedtext = 'oi gente';						
					} else 
                                            //echo $data . '<br><br>';
					$this->getCharTransformations($transformations, $data); 
				} 
			//} 
		//} 
				
		// Analyze text blocks taking into account character transformations and return results.
                                //print_r($texts);
				$this->decodedtext = $this->getTextUsingTransformations($texts, $transformations); 
		//$this->decodedtext = $infile;
			}
			
			
			function decodeAsciiHex($input) {
				$output = "";
				
				$isOdd = true;
				$isComment = false;
				
				for($i = 0, $codeHigh = -1; $i < strlen($input) && $input[$i] != '>'; $i++) {
					$c = $input[$i];
					
					if($isComment) {
						if ($c == '\r' || $c == '\n' || $c == '\s')
							$isComment = false;
						continue;
					}
					
					switch($c) {
						case '\0': case '\t': case '\r': case '\f': case '\n': case ' ': case '\s': break;
						case '%': 
						$isComment = true;
						break;
						
						default:
						$code = hexdec($c);
						if($code === 0 && $c != '0')
							return "";
						
						if($isOdd)
							$codeHigh = $code;
						else
							$output .= chr($codeHigh * 16 + $code);
						
						$isOdd = !$isOdd;
						break;
					}
				}
				
				if($input[$i] != '>')
					return "";
				
				if($isOdd)
					$output .= chr($codeHigh * 16);
				
				return $output;
			}
			
			function decodeAscii85($input) {
				$output = "";
				
				$isComment = false;
				$ords = array();
				
				for($i = 0, $state = 0; $i < strlen($input) && $input[$i] != '~'; $i++) {
					$c = $input[$i];
					
					if($isComment) {
						if ($c == '\r' || $c == '\n' || $c == '\s')
							$isComment = false;
						continue;
					}
					
					if ($c == '\0' || $c == '\t' || $c == '\r' || $c == '\f' || $c == '\n' || $c == ' ' || $c == '\s')
						continue;
					if ($c == '%') {
						$isComment = true;
						continue;
					}
					if ($c == 'z' && $state === 0) {
						$output .= str_repeat(chr(0), 4);
						continue;
					}
					if ($c < '!' || $c > 'u')
						return "";
					
					$code = ord($input[$i]) & 0xff;
					$ords[$state++] = $code - ord('!');
					
					if ($state == 5) {
						$state = 0;
						for ($sum = 0, $j = 0; $j < 5; $j++)
							$sum = $sum * 85 + $ords[$j];
						for ($j = 3; $j >= 0; $j--)
							$output .= chr($sum >> ($j * 8));
					}
				}
				if ($state === 1)
					return "";
				elseif ($state > 1) {
					for ($i = 0, $sum = 0; $i < $state; $i++)
						$sum += ($ords[$i] + ($i == $state - 1)) * pow(85, 4 - $i);
					for ($i = 0; $i < $state - 1; $i++)
				//$ouput .= chr($sum >> ((3 - $i) * 8));
					{
						try {
							if(false == ($o = chr($sum >> ((3 - $i) * 8)))) {
								throw new Exception('Error');
							}
							$output .= $o;
						} catch (Exception $e) { /*Dont do anything*/ }
					}
				}
				
				return $output;
			}
			
			function decodeFlate($input) {
		return @gzuncompress($input);  //tira o @
	}
	
	function decodeFilterLZWDecode($data) 
	{
			// intialize string to return
		$decoded = '';
		 // data length
		$data_length = strlen($data);
		 // convert string to binary string
		$bitstring = '';
		for ($i = 0; $i < $data_length; ++$i) {
			$bitstring .= sprintf('%08b', ord($data{$i}));
		}
		 // get the number of bits
		$data_length = strlen($bitstring);
		 // initialize code length in bits
		$bitlen = 9;
		 // initialize dictionary index
		$dix = 258;
		 // initialize the dictionary (with the first 256 entries).
		$dictionary = array();
		for ($i = 0; $i < 256; ++$i) {
			$dictionary[$i] = chr($i);
		}
		 // previous val
		$prev_index = 0;
		 // while we encounter EOD marker (257), read code_length bits
		while (($data_length > 0) AND (($index = bindec(substr($bitstring, 0, $bitlen))) != 257)) {
			 // remove read bits from string
			$bitstring = substr($bitstring, $bitlen);
			 // update number of bits
			$data_length -= $bitlen;
			 if ($index == 256) { // clear-table marker
					 // reset code length in bits
			 	$bitlen = 9;
					 // reset dictionary index
			 	$dix = 258;
			 	$prev_index = 256;
					 // reset the dictionary (with the first 256 entries).
			 	$dictionary = array();
			 	for ($i = 0; $i < 256; ++$i) {
			 		$dictionary[$i] = chr($i);
			 	}
			 } elseif ($prev_index == 256) {
					 // first entry
			 	$decoded .= $dictionary[$index];
			 	$prev_index = $index;
			 } else {
				 // check if index exist in the dictionary
			 	if ($index < $dix) {
						 // index exist on dictionary
			 		$decoded .= $dictionary[$index];
			 		$dic_val = $dictionary[$prev_index].$dictionary[$index]{0};
						 // store current index
			 		$prev_index = $index;
			 	} else {
						 // index do not exist on dictionary
			 		$dic_val = $dictionary[$prev_index].$dictionary[$prev_index]{0};
			 		$decoded .= $dic_val;
			 	}
				 // update dictionary
			 	$dictionary[$dix] = $dic_val;
			 	++$dix;
				 // change bit length by case
			 	if ($dix == 2047) {
			 		$bitlen = 12;
			 	} elseif ($dix == 1023) {
			 		$bitlen = 11;
			 	} elseif ($dix == 511) {
			 		$bitlen = 10;
			 	}
			 }
			}
			return $decoded;
		}
		
		
		function getObjectOptions($object) {
			$options = array();
			
			if (preg_match("#<<(.*)>>#ismU", $object, $options)) {
				$options = explode("/", $options[1]);
				@array_shift($options);
				
				$o = array();
				for ($j = 0; $j < @count($options); $j++) {
				$options[$j] = preg_replace("#\s+#", " ", trim($options[$j])); //ver aqui
				if (strpos($options[$j], " ") !== false) {
					$parts = explode(" ", $options[$j]);
					$o[$parts[0]] = $parts[1];
				} else
				$o[$options[$j]] = true;
			}
			$options = $o;
			unset($o);
		}
		
		return $options;
	}
	
	function getDecodedStream($stream, $options) {
		$data = "";
		if (empty($options["Filter"]))
			$data = $stream;
		else {
			$length = !empty($options["Length"]) ? $options["Length"] : strlen($stream);
			$_stream = substr($stream, 0, $length);
			
			foreach ($options as $key => $value) {
                                //echo $key.'<br><br>';
				if ($key == "ASCIIHexDecode")
					$_stream = $this->decodeAsciiHex($_stream);
				if ($key == "ASCII85Decode")
					$_stream = $this->decodeAscii85($_stream);
				if ($key == "FlateDecode")
					$_stream = $this->decodeFlate($_stream);
				if ($key == "LZWDecode")
					$_stream = $this->decodeFilterLZWDecode($_stream);
				if ($key == "RunLengthDecode")
					$_stream = $this->decodeFilterRunLengthDecode($_stream);
				//if ($key == "Crypt") { // TO DO
				//}
			}
			$data = $_stream;
		}
		return $data;
	}
	
	public static function decodeFilterRunLengthDecode($data) {
		 // intialize string to return
		$decoded = '';
		 // data length
		$data_length = strlen($data);
		$i = 0;
		while($i < $data_length) {
				 // get current byte value
			$byte = ord($data{$i});
			if ($byte == 128) {
						 // a length value of 128 denote EOD
				break;
			} elseif ($byte < 128) {
						 // if the length byte is in the range 0 to 127
						 // the following length + 1 (1 to 128) bytes shall be copied literally during decompression
				$decoded .= substr($data, ($i + 1), ($byte + 1));
						 // move to next block
				$i += ($byte + 2);
			} else {
						 // if length is in the range 129 to 255,
						 // the following single byte shall be copied 257 - length (2 to 128) times during decompression
				$decoded .= str_repeat($data{($i + 1)}, (257 - $byte));
						 // move to next block
				$i += 2;
			}
		}
		return $decoded;
	}
	
	
	function getDirtyTexts(&$texts, $textContainers) {
		
		for ($j = 0; $j < count($textContainers); $j++) {
			/*if (preg_match_all("#\[(.*)\](\s)*TJ((\s)|(\r)|(\n))*#ismU", $textContainers[$j], $parts))
				$texts = array_merge($texts, @$parts[1]);
			elseif (preg_match_all("#\[(.*)\](\s)*Tj((\s)|(\r)|(\n))*#ismU", $textContainers[$j], $parts))
				$texts = array_merge($texts, @$parts[1]);
			elseif (preg_match_all("#(\(.*\))(\s)*TJ((\s)|(\r)|(\n))*#ismU", $textContainers[$j], $parts))
			$texts = array_merge($texts, @$parts[1]);*/
                        //if (preg_match_all("#(\(.*\)|\[(.*)\])(\s)*(Tj|TJ)((\s)|(\r)|(\n))*#ismU", $textContainers[$j], $parts))
                    //echo '<br>Text ' . $j . ': <br>' .$textContainers[$j] . '<br><br>';
                        // echo $textContainers[$j].'<br><br>';
			$textContainers[$j] = preg_replace('#(\s)((T\*)|TD|Td)(\s)#ismU', ' Tw ( )Tj Tw ', $textContainers[$j]);
			if (preg_match_all("#T[cdwcmrsLz](\s)*((\(.*(\(.*\).*)*\))|(\[(.*)\]))(\s)*(.*)(Tj|TJ)#ismU", $textContainers[$j], $parts))
				$texts = array_merge($texts, @$parts[2]);
                        //print_r($texts);
			
			/*elseif(preg_match_all("#T[d|w|c|m|r|s|L|z|\*|](\s)*(\(.*\))((\s)|(\r)|(\n))*Tj((\s)|(\r)|(\n))*#ismU", $textContainers[$j], $parts))
				$texts = array_merge($texts, @$parts[1]);
			elseif(preg_match_all("#T[d|w|c|m|r|s|L|z|\*|](\s)*(\(.*\))((\s)|(\r)|(\n))*TJ((\s)|(\r)|(\n))*#ismU", $textContainers[$j], $parts))
				$texts = array_merge($texts, @$parts[1]);
			elseif(preg_match_all("#T[d|w|c|m|r|s|L|z|\*|](\s)*(\[.*\])((\s)|(\r)|(\n))*Tj((\s)|(\r)|(\n))*#ismU", $textContainers[$j], $parts))
				$texts = array_merge($texts, @$parts[1]);
			elseif(preg_match_all("#T[d|w|c|m|r|s|L|z|\*|](\s)*(\[.*\])((\s)|(\r)|(\n))*TJ((\s)|(\r)|(\n))*#ismU", $textContainers[$j], $parts))
			$texts = array_merge($texts, @$parts[1]);*/
		}
                //print_r($texts);
		
	}
	function getCharTransformations(&$transformations, $stream) {
		preg_match_all("#([0-9]+)\s+beginbfchar(.*)endbfchar#ismU", $stream, $chars, PREG_SET_ORDER);
		preg_match_all("#([0-9]+)\s+beginbfrange(.*)endbfrange#ismU", $stream, $ranges, PREG_SET_ORDER);
		
		for ($j = 0; $j < count($chars); $j++) {
			$count = $chars[$j][1];
			$current = explode("\n", trim($chars[$j][2]));
			for ($k = 0; $k < $count && $k < count($current); $k++) {
				if (preg_match("#<([0-9a-f]{2,4})>\s+<([0-9a-f]{4,512})>#is", trim($current[$k]), $map))
					$transformations[str_pad($map[1], 4, "0")] = $map[2];
			}
		}
		for ($j = 0; $j < count($ranges); $j++) {
			$count = $ranges[$j][1];
			$current = explode("\n", trim($ranges[$j][2]));
			for ($k = 0; $k < $count && $k < count($current); $k++) {
				if (preg_match("#<([0-9a-f]{4})>\s+<([0-9a-f]{4})>\s+<([0-9a-f]{4})>#is", trim($current[$k]), $map)) {
					$from = hexdec($map[1]);
					$to = hexdec($map[2]);
					$_from = hexdec($map[3]);
					
					for ($m = $from, $n = 0; $m <= $to; $m++, $n++)
						$transformations[sprintf("%04X", $m)] = sprintf("%04X", $_from + $n);
				} elseif (preg_match("#<([0-9a-f]{4})>\s+<([0-9a-f]{4})>\s+[(.*)]#ismU", trim($current[$k]), $map)) {
					$from = hexdec($map[1]);
					$to = hexdec($map[2]);
					$parts = preg_split("#\s+#", trim($map[3]));
					
					for ($m = $from, $n = 0; $m <= $to && $n < count($parts); $m++, $n++)
						$transformations[sprintf("%04X", $m)] = sprintf("%04X", hexdec($parts[$n]));
				}
			}
		}
	}
	function getTextUsingTransformations($texts, $transformations) {
		$document = "";
		for ($i = 0; $i < count($texts); $i++){
			$isHex = false;
			$isPlain = false;
			
			$hex = "";
			$plain = "";
                        //echo $texts[$i]. '<br><br>';
                        //preg_replace("/-(\d)/", " ", $texts[$i]);
                        //echo utf8_encode($texts[$i]). '<br><br>';
			for ($j = 0; $j < strlen($texts[$i]); $j++) {
				$c = $texts[$i][$j];
                                //$document .= $c;
				switch($c) {
                                        /*case "-":
                                                $c2 = $texts[$i][$j + 1];
                                                if($c2 == 3) $plain = " ";
                                                break;*/
                                                case "<":
                                                $hex = "";
                                                $isHex = true;
                                                break;
                                                case ">":
						$hexs = str_split($hex, $this->multibyte); // 2 or 4 (UTF8 or ISO)
						for ($k = 0; $k < count($hexs); $k++) {
							$chex = str_pad($hexs[$k], 4, "0"); // Add tailing zero
							if (isset($transformations[$chex]))
								$chex = $transformations[$chex];
							$document .= html_entity_decode("&#x".$chex.";");
						}
						$isHex = false;
						break;
						case "(":
							$plain = "";
							$isPlain = true;
							break;
							case ")":
                                               /* if($j<strlen($texts[$i])-2)
                                                {
                                                    $c2 = $texts[$i][$j + 1];
                                                    //if(next($texts[$i]))
                                                    $c3 = $texts[$i][$j + 2];
                                                    if($c2 == '-' && ctype_digit($c3))
                                                        $document .= $plain . ' ';
                                                    else $document .= $plain;
                                                }
                                                else*/ $document .= $plain;
                                                $isPlain = false;
                                                break;
                                                case "\\":
                                                $c2 = $texts[$i][$j + 1];
                                                if (in_array($c2, array("\\", "(", ")"))) $plain .= $c2;
                                                elseif ($c2 == "n") $plain .= '\n';
                                                elseif ($c2 == "r") $plain .= '\r';
                                                elseif ($c2 == "t") $plain .= '\t';
                                                elseif ($c2 == "b") $plain .= '\b';
                                                elseif ($c2 == "f") $plain .= '\f'; 
                                                elseif ($c2 == "s")	$plain .= '\s';
                                                elseif ($c2 >= '0' && $c2 <= '9') {
                                                    //$plain .= ' ';
                                                	$oct = preg_replace("#[^0-9]#", "", substr($texts[$i], $j + 1, 3));
                                                	$j += strlen($oct) - 1;
                                                	$plain .= html_entity_decode("&#".octdec($oct).";", $this->convertquotes);
                                                }
                                                $j++;
                                                break; 
                                                
                                                default:
                                                
                                                if ($isHex)
                                                	$hex .= $c;
                                                if ($isPlain)
                                                	$plain .= $c;
                                                break;
                                            }
                                            if(($c == ' ') || ($c == ',') || ($c == '.') || ($c == '!') || ($c == '?') || ($c == ';') || ($c == ':'))
                                            {
                                    //$c = " ";
                                            	if(strlen($document) >= 5000)
                                            	{
                                            		if($this->codificacao($document) != 'UTF-8')
                                            			$document = utf8_encode ($document);
                                            		$document = $this->cleanString($document);
                                            		$document = preg_replace('/[^a-zA-Z -]/','', $document);
                                            		
                                            		if(strlen($document) >= 5000)
                                            			break;
                                            	}
                                            }
                                        }
                                        $document .= "\n";
                                        //echo $document;
                        //ultimas alterações
                                        if(strlen($document) >= 5000)
                                        {
                                        	if($this->codificacao($document) != 'UTF-8')
                                        		$document = utf8_encode ($document);
                                        	$document = $this->cleanString($document);
                                        	$document = preg_replace('/[^a-zA-Z -]/','', $document);

                                        	if(strlen($document) >= 5000)
                                        		break;
                                        }
                                    }
                                    
                                    if($this->codificacao($document) != 'UTF-8')
                                    	$document = utf8_encode ($document);
                                    $clean_document = $this->cleanString(/*utf8_encode(*/$document);
                                    	return preg_replace('/[^a-zA-Z -]/','', $clean_document);
                //return preg_replace('/[^ãÃáÁàÀêÊéÉèÈíÍìÌôÔõÕóÓòÒúÚùÙûÛçÇa-zA-Z]/',' ', utf8_encode($document));
                //return ereg_replace('^[:alpha:]',' ',$document);
                                    	
		//return $clean_document;
                                    }
                                    
                                    function codificacao($string) 
                                    {
                                    	return mb_detect_encoding($string.'x', 'UTF-8, ISO-8859-1');
                                    	
                                    }
                                    
                                    function cleanString($text) 
                                    {
                                    	$utf8 = array(
                                    		'/[0-9]/'     =>   ' ',
                                    		'/[áàâãªä]/u'   =>   'a',
                                    		'/[ÁÀÂÃÄ]/u'    =>   'A',
                                    		'/[ÍÌÎÏ]/u'     =>   'I',
                                    		'/[íìîï]/u'     =>   'i',
                                    		'/[éèêë]/u'     =>   'e',
                                    		'/[ÉÈÊË]/u'     =>   'E',
                                    		'/[óòôõºö]/u'   =>   'o',
                                    		'/[ÓÒÔÕÖ]/u'    =>   'O',
                                    		'/[úùûü]/u'     =>   'u',
                                    		'/[ÚÙÛÜ]/u'     =>   'U',
                                    		'/ç/'           =>   'c',
                                    		'/Ç/'           =>   'C',
                                    		'/ñ/'           =>   'n',
                                    		'/Ñ/'           =>   'N',
                '/–/'           =>   '-', // UTF-8 hyphen to "normal" hyphen
                '/[’‘‹›‚]/u'    =>   ' ', // Literally a single quote
                '/[“”«»„]/u'    =>   ' ', // Double quote
                '/ /'           =>   ' ', // nonbreaking space (equiv. to 0x160)
                );
return preg_replace(array_keys($utf8), array_values($utf8), $text);
}


}
function cleanString($text) 
{
	$utf8 = array(
        //'/[0-9]/'     =>   ' ',
		'/[´`~¨^]/u'       => '',
		'/[áàâãªä]/u'   =>    'a',
		'/[ÁÀÂÃÄ]/u'    =>   'A',
		'/[ÍÌÎÏ]/u'     =>   'I',
		'/[íìîï]/u'     =>   'i',
		'/[éèêë]/u'     =>   'e',
		'/[ÉÈÊË]/u'     =>   'E',
		'/[óòôõºö]/u'   =>   'o',
		'/[ÓÒÔÕÖ]/u'    =>   'O',
		'/[úùûü]/u'     =>   'u',
		'/[ÚÙÛÜ]/u'     =>   'U',
		'/ç/'           =>   'c',
		'/Ç/'           =>   'C',
		'/ñ/'           =>   'n',
		'/Ñ/'           =>   'N',
        '/–/'           =>   '-', // UTF-8 hyphen to "normal" hyphen
        '/([’‘‹›‚@$&%#*.:?!)(+-=§><;\|])|(\/)/u'    =>   ' ', // Literally a single quote
        '/[“”«»„]/u'    =>   ' ', // Double quote
       // '/[^´`~¨]/u'       => '',
        '/(\s)/' => ' ',
        //'/ /'           =>   ' ' // nonbreaking space (equiv. to 0x160)
        );
	return preg_replace(array_keys($utf8), array_values($utf8), $text);
}

function findPattern($string)
{
    //echo $string . '<br><br>';
	$string2 = cleanString($string);
	unset($string);
	$string3 = preg_replace('/[^a-zA-Z -]/', '', $string2);
	unset($string2);
	$matches = []; 
    //echo $string;
	$pattern = "#(Resumo|resumo|RESUMO)(.+)(Abstract|ABSTRACT|abstract|Introducao|INTRODUCAO|Motivacao|MOTIVACAO)#ismU";
	preg_match_all($pattern, $string3, $matches);
    //print_r($matches);
	$matched = '';
	foreach ($matches[2] as $val) 
	{
		$matched .= $val;
	}
	
	unset($matches);
	if (strlen($matched) < 20/* $matched == '' */) {
		unset($matched);
		return $string3;
	}
    //echo $string . '<br>'.strlen($string) . '<br><br>';
	else {
		unset($string3);
		return $matched;
    } //echo "matched: " . $matched;
}

/*function codificacao($string) 
{
    return mb_detect_encoding($string.'x', 'UTF-8, ISO-8859-1');
        
}*/
function extractTextFromPDF1($doc)
{
	$a = new PDF2Text();
	$a->setFilename($doc);
	$a->decodePDF();
	$result = $a->output();
	return $result;
}
/*function extractTextFromPDF($doc)
{
    set_time_limit(0);
    
    /*$curl_handle=curl_init();
    curl_setopt($curl_handle, CURLOPT_URL,$doc);
    curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Your application name');
    $infile = curl_exec($curl_handle);
    curl_close($curl_handle);*/
    
   // if(file_get_contents($doc, FILE_BINARY) != false)
   // {
        //echo 'ok';
            //$infile = file_get_contents($doc, FILE_BINARY);

            //echo '<br><br>'.$infile. '<br><br>';
            //if(empty($infile)) return "";
            //else if (!preg_match_all("#obj[\n|\r](.*)endobj[\n|\r]#ismU",  $infile, $objects)) {
                //return "";
            //}
            /* $a = new PDF2Text();
            $a->setFilename($doc);
            $a->decodePDF();
            $result = $a->output();
            //else 
            //{
                //echo $infile;
                //echo '<br><br> >>>>>>>>> OK <<<<<<<<<<br><br>';
                $result = extractTextPDF($doc);
                // if (\codificacao($result) != 'UTF-8') {
                   // $result = \utf8_decode($result);
                // }
                //echo $result;
                //set_time_limit(360);
                //echo "oi: ". findPattern($result) . '<br>'; 
                $resultText = explode(' ', findPattern($result));
                unset($resutl);
                $finalText = [];
                foreach ($resultText as $word) {
                    if(strlen($word)>2)
                    {
                        array_push($finalText, $word);
                    }
                }
                unset($resultText);
                $finalResult = implode(' ', $finalText);
                unset($finalText);
                return strtolower($finalResult);//findPattern($result); 
            //}
    //}
   // else return "";
            }*/


            

            ?>

