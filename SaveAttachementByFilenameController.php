<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * File Upload Controller
 *
 * This controller demonstrates how to handle file uploads in Laravel.
 * It includes processing the uploaded file's name, cleaning it, and appending a timestamp
 * before saving the file. This approach ensures unique and clean filenames for the stored files.
 *
 * Usage:
 * - Place this code in a controller method in your Laravel application.
 * - Call this method from a route where files are uploaded.
 *
 * Note:
 * - The `spcharclean` function should be defined to clean special characters from the filename.
 * - Ensure that the file upload functionality adheres to your application's validation and storage requirements.
 */

class SaveAttachementByFilenameController extends Controller
{
    /**
     * Handle a file upload request.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function uploadFile(Request $request)
    {
        // Assuming 'extension_doc' is the name attribute in the file input
        $extensionDoc = $request->file('extension_doc');
        $extension = $extensionDoc->getClientOriginalExtension();

        // Process the original filename
        $originName = pathinfo($extensionDoc->getClientOriginalName(), PATHINFO_FILENAME);
        $originName = str_replace(' ', '_', $originName);
        $originName = substr($originName, 0, 20);
        $originName = $this->spcharclean($originName); // Custom function to clean special characters

        // Create the new filename with a timestamp
        $fileName = $originName . "_" . date("His") . ".{$extension}";
        $fileName = strtolower($fileName);

        // Save the file (replace with your actual file storage logic)
        $path = $extensionDoc->storeAs('uploads', $fileName);

        // Return the path or other response (modify as per your requirement)
        return response()->json(['path' => $path]);
    }

    /**
     * Custom function to clean special characters from a string.
     *
     * @param string $string
     * @return string
     */
    private function spcharclean($string)
    {
        // Replace or remove special characters as needed
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    }
}
