<?php
require_once 'vendor/autoload.php';

// Check if URL is set
if (!isset($_GET['url'])) {
    http_response_code(400);
    echo "Error: No README URL provided.";
    exit;
}

$url = $_GET['url'];

// Validate URL
if (filter_var($url, FILTER_VALIDATE_URL) === false) {
    http_response_code(400);
    echo "Error: Invalid URL.";
    exit;
}

// Validate it is a GitHub URL
$parsedUrl = parse_url($url);
if (!isset($parsedUrl['host']) || $parsedUrl['host'] !== 'github.com') {
    http_response_code(400);
    echo "Error: Only GitHub URLs are supported.";
    exit;
}

// Extract the raw GitHub URL
$urlParts = explode('/', trim($parsedUrl['path'], '/'));
if (count($urlParts) < 2) {
    http_response_code(400);
    echo "Error: Invalid GitHub URL. Expected format: https://github.com/{user}/{repo}";
    exit;
}

$user = $urlParts[0];
$repo = $urlParts[1];

// Try 'main' branch first, then fall back to 'master'
$branches = ['main', 'master'];
$readmeContent = false;

foreach ($branches as $branch) {
    $rawReadmeURL = "https://raw.githubusercontent.com/{$user}/{$repo}/{$branch}/README.md";
    $readmeContent = @file_get_contents($rawReadmeURL);
    if ($readmeContent !== false) {
        break;
    }
}

// Check if fetching was successful
if ($readmeContent === false) {
    http_response_code(404);
    echo "Error: Failed to fetch README. Could not find README.md on main or master branch.";
    exit;
}

// Parse README and output HTML
$Parsedown = new Parsedown();
$Parsedown->setSafeMode(true);
echo $Parsedown->text($readmeContent);
