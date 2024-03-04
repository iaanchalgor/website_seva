<?php

require_once('admin_header.php');

$projectId = 'lastt-93374';
$apiKey = 'AIzaSyAqRZyrj5EGKGPEUkwMHeMBqxgvBECg9Dc'; // Replace 'YOUR_API_KEY' with your actual API key
$collectionName = 'register';
$endpoint = "https://firestore.googleapis.com/v1/projects/$projectId/databases/(default)/documents/$collectionName?key=$apiKey";

// Initialize cURL session
$curl = curl_init();

// Set cURL options
curl_setopt($curl, CURLOPT_URL, $endpoint);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// Execute the cURL request
$response = curl_exec($curl);

// Check if request was successful
if ($response === false) {
    die('Error: ' . curl_error($curl));
}

// Close cURL session
curl_close($curl);

// Decode JSON response
$data = json_decode($response, true);

// Check if data exists
if (isset($data['documents']) && !empty($data['documents'])) {
    // Loop through documents and display data
    foreach ($data['documents'] as $document) {
        $fields = $document['fields'];
        
        // Check if required keys exist
        $name = isset($fields['fname']['stringValue']) && isset($fields['lname']['stringValue']) ? $fields['fname']['stringValue'] . ' ' . $fields['lname']['stringValue'] : 'N/A';
        $email = isset($fields['email']['stringValue']) ? $fields['email']['stringValue'] : 'N/A';
        $phone = isset($fields['phno']['stringValue']) ? $fields['phno']['stringValue'] : 'N/A';

        // Display data
        echo "Name: $name <br>";
        echo "Email: $email <br>";
        echo "Phone: $phone <br>";
        echo "<hr>";
    }
} else {
    echo "No data found in Firestore.";
}


?>

<?php require_once('admin_footer.php'); ?>



