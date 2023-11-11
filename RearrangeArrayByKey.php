<?php

/**
 * Rearrange Array by Key in Laravel
 * 
 * This script demonstrates how to rearrange an array by a specific key using Laravel's collection methods.
 * It uses the 'keyBy' method to reindex a collection by a concatenated attribute called 'concated_app_type'.
 * This is useful when reorganizing data for easier access based on a unique key.
 * 
 * Usage:
 * - Place this script in an appropriate location within your Laravel application, such as in a controller method.
 * - Ensure that the collection `$existingAppTypeObj` is populated with the appropriate data before using 'keyBy'.
 * - Modify the 'concated_app_type' attribute used for keying as per your specific data structure.
 *
 * Sample Output:
 * Assuming `$existingAppTypeObj` contains a collection of arrays like:
 * [
 *   ['id' => 1, 'concated_app_type' => 'type1'],
 *   ['id' => 2, 'concated_app_type' => 'type2']
 * ]
 * After applying 'keyBy', the output will be:
 * [
 *   'type1' => ['id' => 1, 'concated_app_type' => 'type1'],
 *   'type2' => ['id' => 2, 'concated_app_type' => 'type2']
 * ]
 * 
 * Note:
 * - This script is ideal for scenarios where you need to index or re-index collections for efficient data manipulation.
 * - The attribute used for keying should be unique to prevent overwriting of data in the collection.
 */

// Assuming $existingAppTypeObj is a Laravel Collection with data
// Replace this with actual code to populate $existingAppTypeObj as per your application's logic

// Rearranging the array by the 'concated_app_type' key
$rearrangedArray = $existingAppTypeObj->keyBy('concated_app_type')->toArray();

// Output the rearranged array (for testing purposes, remove in production)
echo '<pre>';
print_r($rearrangedArray);
echo '</pre>';
