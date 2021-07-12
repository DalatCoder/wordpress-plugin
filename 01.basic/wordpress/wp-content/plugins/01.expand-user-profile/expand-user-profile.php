<?php

/**
 * Plugin Name: Expand User Profile
 * Description: Expand User Profile
 * Version: 1.0
 * Author: 2nth
 */

class ExpandUserProfile
{
    function __construct()
    {
        add_action('show_user_profile', [$this, 'showExtraProfileFields']);
        # add_action('edit_user_profile', [$this, 'showExtraProfileFields']);

        add_action('personal_options_update', [$this, 'saveExtraProfileFields']);
        # add_action('edit_user_profile_update', [$this, 'saveExtraProfileFields']);
    }

    function showExtraProfileFields($user)
    {
        echo sprintf("
            <h3>Extra information</h3>

            <table class='form-table'>
                <tr>
                    <th><label for='job_title'>Job Title</label></th>
                    <td>
                        <input 
                            type='text' 
                            name='job_title' 
                            id='job_title' 
                            class='regular-text ltr'
                            value='%s'
                        >
                        <p class='description'>Please enter your job title</p>
                    </td>
                </tr>
            </table>
        ", esc_attr(get_the_author_meta('job_title', $user->ID)));
    }

    function saveExtraProfileFields($user_id)
    {
        if (!current_user_can('edit_user', $user_id)) return false;

        update_user_meta($user_id, 'job_title', esc_attr($_POST['job_title']));
    }
}

$expandUserProfile = new ExpandUserProfile();
