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
        $title_content = $title->item(0)->childNodes->item(0)->nodeValue;
        $id_content = $id->item(0)->childNodes->item(0)->nodeValue;
        if ($title->item(0)->nodeType == 1 ) { // Remember, since <title> doesn't have any children, we can access it using $title->index(0)
            if (stristr($title_content, $q)) {
                // If there is a matching question to the query, display it
                if ($hint = "") { // If there are no hints
                    $hint = "<a href=answers.php?id=".$id_content.">".$title_content."</a>"; // "$title->item(0)->childNodes->item(0)->nodeValue" just gets the content of the question
                } else { // If there are  hints already
                    $hint = $hint."<br /><a href=answers.php?id=".$id_content.">".$title_content."</a>";
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