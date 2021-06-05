<?php
$xmlDoc = new DOMDocument();
$xmlDoc->load("questions.xml");

$x = $xmlDoc->getElementsByTagName('question');

// Get the 'q' parameter from URL
$q = $_GET["q"]; // $q is our query

// Lookup all questions from the xml file if length of q > 0 
if (strlen($q) > 0) {
    $hint = "";
    for ($i = 0; $i < ($x->length); $i++) {
        $id = $x->item($i)->getElementsByTagName('id');
        $title = $x->item($i)->getElementsByTagName('title');
        if ($title->item(0)->nodeType == 1 ) { // Remember, since <title> doesn't have any children, we can access it using $title->index(0)
            if (stristr($title->item(0)->childNodes->item(0)->nodeValue, $q)) {
                // If there is a matching question to the query, display it
                if ($hint = "") {
                    $hint = "<p>".$title->item(0)->childNodes->item(0)->nodeValue."</p>"; // "$title->item(0)->childNodes->item(0)->nodeValue" just gets the content of the question
                } else {
                    $hint = $hint."<br /><p>".$title->item(0)->childNodes->item(0)->nodeValue."</p>";
                }
            }
        }
    }
}

// Sets the output if there is no matching hint, or if the query is correct
if ($hint == "") {
    $response = "No suggestion";
} else {
    $response = $hint;
}

echo $response;
?>