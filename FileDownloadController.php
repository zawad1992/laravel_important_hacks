<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * File Download Controller
 *
 * This controller contains a method to handle the downloading of a PDF file in Laravel.
 * It demonstrates the correct way to provide a file download functionality,
 * particularly for a static file located in the public directory.
 *
 * Usage:
 * - Place this method inside a relevant controller in your Laravel application.
 * - Call this method from a route when you need to trigger the download of a specific file.
 * - Update the file path and headers as necessary for different file types or locations.
 *
 * Example:
 * - This example specifically demonstrates downloading a PDF file named 'info.pdf' located in 'public/download'.
 *
 * Note:
 * - Ensure the file exists in the specified path before triggering the download.
 * - Adjust the MIME type in the headers for different file types.
 */

class FileDownloadController extends Controller
{
    /**
     * Trigger a file download for a PDF file.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDownload()
    {
        // Define the file path to the PDF file in the public directory
        $file = public_path() . "/download/info.pdf";

        // Define the headers for the file download response
        $headers = ['Content-Type' => 'application/pdf'];

        // Trigger the file download
        return response()->download($file, 'filename.pdf', $headers);
    }
}
