<?php

/*
Plugin Name: 13 Quicktags Creator
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A brief description of the Plugin.
Version: 1.0
Author: tronghieu
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2
*/

class NTHQuicktagsCreator
{
    function __construct()
    {
        add_action('admin_print_footer_scripts', [$this, 'addQuickTag']);
    }

    function addQuicktag()
    {
        if (wp_script_is('quicktags')) {
?>

            <script type="text/javascript">
                // This function is used to retrieve the selected text from the text editor
                function getSel() {
                    var textArea = document.getElementById('content');
                    var start = textArea.selectionStart;
                    var finish = textArea.selectionEnd;
                    return textArea.value.substring(start, finish);
                }

                QTags.addButton(
                    "date_quicktag", "Today's Date", get_date
                );
                QTags.addButton(
                    "myname_quicktag", "Hello Trong Hieu", get_myname
                );

                function get_date() {
                    var selected_text = getSel();
                    QTags.insertContent(Date('d-m-Y'));
                }

                function get_myname() {
                    var selected_text = getSel();
                    QTags.insertContent('Chào Trọng Hiếu nhá');
                }
            </script>

<?php }
    }
}

$instance = new NTHQuicktagsCreator();
