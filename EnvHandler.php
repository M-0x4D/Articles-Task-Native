<?php

// Function to load and parse the .env file
if (!function_exists('loadEnv')) {

    function loadEnv($filePath)
    {
        $data = [];

        // Check if the file exists
        if (file_exists($filePath)) {
            // Read the file line by line
            $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            // Parse each line as key-value pair
            foreach ($lines as $line) {
                // Ignore comments (lines starting with # or ;)
                if (strpos(trim($line), '#') === 0 || strpos(trim($line), ';') === 0) {
                    continue;
                }

                list($key, $value) = explode('=', $line, 2);
                $data[trim($key)] = trim($value);
            }
        }

        return $data;
    }
}
// Specify the path to your .env file
$envFilePath = __DIR__ . '\\.env';

// Load and parse the .env file
$envData = loadEnv($envFilePath);

return $envData;
