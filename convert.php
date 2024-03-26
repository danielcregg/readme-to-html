<?php
require_once 'vendor/autoload.php'; 

// Check if URL is set
if(isset($_GET['url'])) {
    // Validate URL
    if (filter_var($_GET['url'], FILTER_VALIDATE_URL) === false) {
        http_response_code(400);
        echo "Error: Invalid URL.";
        exit;
    }

    // Extract the raw GitHub URL
    $urlParts = explode('/', $_GET['url']);
    if(count($urlParts) < 5) {
        http_response_code(400);
        echo "Error: Invalid GitHub URL.";
        exit;
    }
    $rawReadmeURL = "https://raw.githubusercontent.com/" . $urlParts[3] . "/" . $urlParts[4] . "/main/README.md";

    // Fetch README contents
    $readme_content = @file_get_contents($rawReadmeURL);
    // Check if fetching was successful
    if ($readme_content === false) {
        http_response_code(500);
        echo "Error: Failed to fetch README.";
        exit;
    }
    // Parse README
    $Parsedown = new Parsedown();
    echo $Parsedown->text($readme_content);
} else {
    http_response_code(400);
    echo "Error: No README URL provided.";
    exit;
}
?>