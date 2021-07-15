<?php

/*
Plugin Name: 11 Media File Unzipper
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A brief description of the Plugin.
Version: 1.0
Author: tronghieu
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2
*/

class NTHMediaFileUnzipper
{
    function __construct()
    {
        add_action('admin_menu', [$this, 'addMenuPage']);
    }

    function addMenuPage()
    {
        add_menu_page(
            'Upload Media Zip',
            'Upload Media Zip',
            'manage_options',
            'nth-upload-media-zip',
            [$this, 'generatePage'],
            'dashicons-media-default',
            35
        );
    }

    function generatePage()
    {
        echo "<h3>Upload a media zip</h3>";

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['fileToUpload'])) {

            // Prepare the files to be uploaded to the server

            // Get the current uploads directory including the year and month
            $dir = "../wp-content/uploads" . wp_upload_dir()['subdir'];

            // Use regular PHP to upload the zip file to the uploads directory
            $targetFile = $dir . '/' . basename($_FILES['fileToUpload']['name']);
            move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $targetFile);

            $fileName = basename($_FILES['fileToUpload']['name']);

            // Create a new zip untility object
            $zip = new ZipArchive;

            // Attempt to open the zip file
            $res = $zip->open($targetFile);

            if ($res === FALSE) {
                echo "Error occured when trying to extract the zip file. Try again";
                return;
            }

            echo "<h3>The zip file $fileName was successfully unzipped to " . wp_upload_dir()['url'] . "</h3>";

            echo "There are " . $zip->numFiles . " files in this zip file. <br>";

            // Loop through each media file to process it for the media library
            for ($i = 0; $i < $zip->numFiles; $i++) {
                // Get the URL of the media file
                $mediaFileName = wp_upload_dir()['url'] . '/' . $zip->getNameIndex($i);

                // Get the file type of the media file
                $filetype = wp_check_filetype(basename($mediaFileName), null);
                $allowed = $this->checkValidFileType($filetype['type']);

                if (!$allowed) {
                    echo $zip->getNameIndex($i) . ' could not be uploaded. It\'s file type of ' . $filetype['type'] . ' is not allowed.';
                    continue;
                }

                // Display a link for the user to view the file on upload
                echo '<a href="' . $mediaFileName . '" target="_blank">' . $mediaFileName . '</a> ';
                echo 'Type: ' . $filetype['type'] . '<br>';

                // Prepare the attachment information array that will be used by the media library
                $attachment = [
                    'guid' => $mediaFileName,
                    'post_mime_type' => $filetype['type'],
                    'post_title' => preg_replace('/\.[^.]+$/', '', $zip->getNameIndex($i)),
                    'post_content' => '',
                    'post_status' => 'inherit'
                ];

                // Insert the attachment
                $attachID = wp_insert_attachment($attachment, $dir . '/' . $zip->getNameIndex($i));

                // Generate the metadata for the attachment
                $attachMetadata = wp_generate_attachment_metadata($attachID, $dir . '/' . $zip->getNameIndex($i));

                wp_update_attachment_metadata($attachID, $attachMetadata);
            }

            $zip->close();

            return;
        }

        echo '
            <form action="/wp-admin/admin.php?page=nth-upload-media-zip" method="post" enctype="multipart/form-data" class="server-form">
                <div>
                    <label for="file-input">Select ZIP File</label>
                    <input type="file" name="fileToUpload" id="file-input">
                </div>
                <div>
                    <input type="submit" value="Upload Zip File" name="submit" class="deploy-buttons">
                </div>
            </form>
        ';
    }

    function checkValidFileType($filetype)
    {
        $allowedFileTypes = ['image/png', 'image/jpeg', 'image/jpg', 'image/gif'];
        return in_array($filetype, $allowedFileTypes);
    }
}

$instance = new NTHMediaFileUnzipper();
