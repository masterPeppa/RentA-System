<?php
	$xml = new domdocument();
	$xml -> load("../Xmlfile/barangays.xml");
	$locations = $xml->getElementsByTagName("location");
	
	$locationName = ucwords($_REQUEST["q"]);
	$hint = "";
	
	foreach($locations as $location){
		
		$barangay = $location -> getElementsByTagName("barangay") -> item(0) -> nodeValue;
		if (ucwords($locationName) == ucwords(substr($barangay, 0, strlen($locationName)))){
			
			$suggest = ucwords(substr($barangay, 0, strlen($locationName)));
			$suggest1 = substr($barangay, -strlen($barangay)+strlen($locationName), strlen($barangay));
			
			if($hint == ""){
				if($suggest != $barangay){
					$hint = "<button class='btnSuggestion' style='' value='$suggest$suggest1'>&nbsp;&nbsp;<b>$suggest</b>$suggest1</button></a>";
				}
				else{
					$hint = "<button class='btnSuggestion' style='' value='$suggest'>&nbsp;&nbsp;<b>$suggest</b></button></a>";
				}
			}
			else{
				if($suggest != $barangay){
					$hint .= "<br/><button class='btnSuggestion' style='' value='$suggest$suggest1'>&nbsp;&nbsp;<b>$suggest</b>$suggest1</button></a>";
				}
				else{
					$hint .= "<br/><button class='btnSuggestion' style='' value='$suggest'>&nbsp;&nbsp;<b>$suggest</b></button></a>";
				}
			}
		}
	}
		if($hint==""){
			$result = "
			<div class='no-suggestion'>
				<a style='' > No Suggestion </a>
			</div>";
		}
		else{
			$result = $hint;
		}
		echo $result;
?>