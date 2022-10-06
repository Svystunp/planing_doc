<?php


$full1 = array();
$full2 = array();

$warning3 = array("in", "name_en");
$warning2 = array("in", "name_en");

$page = "https://wwwnc.cdc.gov/travel/notices";
$doc = new DOMDocument();
$doc->loadHTMLFile($page);
$div3 = $doc->getElementById('warning');
	$li = $div3->getElementsByTagName("li");

		foreach ($li as $country){
			$href = $country->getElementsByTagName('a');
			$string = get_inner_html($href[1]);
			
			$pieces = explode(' in ', $string);
			$last_word = array_pop($pieces);
			$span = $country->getElementsByTagName('span');
			$text = get_inner_html($span[1]);
			$link = 'https://wwwnc.cdc.gov'.$href[2]->getAttribute("href");
			$full1[] = array($last_word, $string, $text, $link);
			//print_r($text);
		
		}
	
$div2 = $doc->getElementById('alert');
	$li2 = $div2->getElementsByTagName("li");

		foreach ($li2 as $country){
			$href = $country->getElementsByTagName('a');
			$string = get_inner_html($href[1]);
			$pieces = explode(' in ', $string);
			$last_word = array_pop($pieces);
			$span = $country->getElementsByTagName('span');
			$text = get_inner_html($span[1]);
			$link = 'https://wwwnc.cdc.gov'.$href[2]->getAttribute("href");
			$full2[] = array($last_word, $string, $text, $link);
				
			
		}
$full3 = array($full1, $full2);		
print_r(JSON_ENCODE($full3, JSON_UNESCAPED_SLASHES));
function get_inner_html( $node ) {
    $innerHTML= '';
    $children = $node->childNodes;
    foreach ($children as $child) {
        $innerHTML .= $child->ownerDocument->saveXML( $child );
    }

    return $innerHTML;
}


function getElementsByClass(&$parentNode, $tagName, $className) {
    $nodes=array();

    $childNodeList = $parentNode->getElementsByTagName($tagName);
    for ($i = 0; $i < $childNodeList->length; $i++) {
        $temp = $childNodeList->item($i);
        if (stripos($temp->getAttribute('class'), $className) !== false) {
            $nodes[]=$temp;
        }
    }

    return $nodes;
}


?>