<?php

namespace Carbonite\GravityForms;

use Defuse\Crypto\Key;
use Defuse\Crypto\Crypto;

use Defuse\Crypto\Exception\BadFormatException;
use Defuse\Crypto\Exception\EnvironmentIsBrokenException;
use Defuse\Crypto\Exception\WrongKeyOrModifiedCiphertextException;

/**
 * Class Encryption
 *
 * @author Matt Nicholls
 * @date 2019-02-21
 * @version 1.3
 * @package Carbonite\GravityForms
 */
class Encryption
{

    private $censor_text = '********';

    private $message_decrypted = 'This data has been decrypted for display.';

    private $message_encrypted = 'This data is encrypted, for access please contact an administrator.';


    public function __construct()
    {
        // Add Encrypt option to fields
        add_action( 'gform_field_advanced_settings', array($this, 'add_field_setting_option'), 10, 2 );
        add_action( 'gform_editor_js', array($this, 'editor_script') );
        add_filter( 'gform_tooltips', array($this, 'add_encryption_tooltips') );

        // Only encrypt if dependencies exist
        if (class_exists('Defuse\Crypto\Key') && class_exists('Defuse\Crypto\Crypto')) {
            // Encrypt Field on save
            add_filter( 'gform_save_field_value', array($this,'encrypt_entry'), 10, 4 );
        }

        // Decrypt Field
        add_filter( 'gform_get_field_value', array($this,'decrypt_entry'), 10, 3 );

        // Decrypt Field
        add_filter( 'gform_export_field_value', array($this,'decrypt_export'), 10, 4 );

        // Add Padlock icon to entries list fields
        add_filter( 'gform_entries_field_value', array($this,'check_padlock'), 10, 4 );

        // Add Padlock icon to entry detail fields
        add_filter( 'gform_entry_field_value', array($this,'check_padlock'), 10, 4 );

    }


    /**
     * Create a new encryption key as a string.
     * Once set, this should not change.
     *
     * @return string | bool
     */
    public function new_key()
    {
        try {
            $hash = Key::createNewRandomKey();
            $key  = $hash->saveToAsciiSafeString();
        } catch (EnvironmentIsBrokenException $ex) {
            $key = false;
        }

        return $key;
    }


    /**
     * Get the encryption key
     *
     * @return Key | bool
     */
    private function get_key()
    {
        if (!class_exists('Defuse\Crypto\Key'))
            return false;

        $key = (defined('GFORM_ENCRYPT_KEY')) ? GFORM_ENCRYPT_KEY : '';
        if (empty($key)) return false;

        try {
            $hash = Key::loadFromAsciiSafeString($key);
        } catch (EnvironmentIsBrokenException $ex) {
            $hash = false;
        } catch (BadFormatException $ex) {
            $hash = false;
        }

        return $hash;
    }


    /**
     * Field options HTML
     *
     * @param $position
     * @param $form_id
     * @return void
     */
    public function add_field_setting_option( $position, $form_id )
    {

        //create settings on position 50 (right after Admin Label)
        if ( $position == 50 ) {
            ?>
            <li class="encrypt_setting ">
                <label for="field_admin_label" class="section_label">
                    <?php _e("Encryption", "gravityforms"); ?>
                    <?php gform_tooltip("form_field_encrypt_value") ?>
                </label>
                <input type="checkbox" id="field_encrypt_value" onclick="SetFieldProperty('encryptField', this.checked);" /> encrypt field value
            </li>
            <?php
        }
    }


    /**
     * Action to inject supporting script to the form editor page
     *
     * @return void
     **/
    public function editor_script()
    {
        ?>
        <script type='text/javascript'>
            //adding setting to fields of type "text"
            fieldSettings.text += ", .encrypt_setting";

            //binding to the load field settings event to initialize the checkbox
            jQuery(document).bind("gform_load_field_settings", function(event, field, form){
                jQuery("#field_encrypt_value").attr("checked", field["encryptField"] == true);
            });
        </script>
        <?php
    }


    /**
     * Filter to add a new tooltip
     *
     * @param array $tooltips
     * @return array
     **/
    public function add_encryption_tooltips( $tooltips )
    {
        $tooltips['form_field_encrypt_value'] = "<h6>Encryption</h6>Check this box to encrypt this field's data";
        return $tooltips;
    }


    /**
     * Encrypt GravityField Entries
     *
     * @param string $value
     * @param object $lead
     * @param object $field
     * @param object $form
     * @return string
     */
    public function encrypt_entry( $value, $lead, $field, $form )
    {

        if ($field->encryptField) {
            $value = $this->encrypt($value);
        }

        return $value;
    }


    /**
     * Encrypt GravityField Entries from view
     *
     * @param string $value
     * @param object $lead
     * @param object $field
     * @return string
     */
    public function decrypt_entry( $value, $lead, $field )
    {
        if (isset($field->encryptField) && $field->encryptField) {
            if ( apply_filters('carbon_gforms_decrypt', true) ) {
                if (is_array($value)):
                    foreach($value as $key => $item):
                        $value[$key] = $this->decrypt($item);
                    endforeach;
                else:
                    $value = $this->decrypt($value);
                endif;
            } else {
                $value = $this->censor($value);
            }
        }

        return $value;
    }


    /**
     * Encrypt GravityField Entries for Exporter
     *
     * @param string $value
     * @param integer $form_id
     * @param integer $field_id
     * @param object $entry
     * @return string
     */
    public function decrypt_export( $value, $form_id = 0, $field_id = 0, $entry = null )
    {
        $field = $this->get_field($form_id, $field_id);

        if (isset($field->encryptField) && $field->encryptField) {
            if ( apply_filters('carbon_gforms_decrypt', true) ) {
                if (is_array($value)):
                    foreach($value as $key => $item):
                        $value[$key] = $this->decrypt($item);
                    endforeach;
                else:
                    $value = $this->decrypt($value);
                endif;
            } else {
                $value = $this->censor($value);
            }
        }

        return $value;
    }


    /**
     * Add padlock icon to non-decrypted text
     *
     * @param $value
     * @param $form_id
     * @param $field_id
     * @param $entry
     * @return string
     */
    public function check_padlock( $value, $form_id, $field_id, $entry )
    {

        if ( is_array($field_id) ) {
            $field = $form_id;
            $org = rgar( $field_id, $field->id );
        } else {
            $org = rgar( $entry, $field_id );

            $form = \GFAPI::get_form( $form_id );
            foreach ($form['fields'] as $item) {
                if ($item->id == $field_id) {
                    $field = $item;break;
                }
            }
        }

        if ( $field->encryptField && apply_filters('carbon_gforms_decrypt', true) === true && $value !== $org && substr($org,0,4) == 'def5' ) {
            $value = $this->padlock($value, 'decrypted');
        }

        if ( $field->encryptField && apply_filters('carbon_gforms_decrypt', true) === false && $value == $this->censor_text) {
            $value = $this->padlock($value, 'encrypted');
        }


        return $value;
    }


    /**
     * Get a Gravity Forms field array by ID
     *
     * @param integer $form_id
     * @param integer $field_id
     * @return array|bool
     */
    private function get_field($form_id, $field_id)
    {
        $field = false;
        $form = \GFAPI::get_form( $form_id );
        foreach ($form['fields'] as $item) {
            if ($item->id == $field_id) {
                $field = $item;break;
            }
        }

        return $field;
    }


    /**
     * Add padlock icon to non-decrypted text
     *
     * @param string $value
     * @param string $type
     * @return string
     */
    private function padlock( $value, $type )
    {

        if ($type=='decrypted') {
            $icon    = 'unlock';
            $message = apply_filters('carbon_gforms_message_decrypted', $this->message_decrypted );
        } else {
            $icon    = 'lock';
            $message = apply_filters('carbon_gforms_message_encrypted', $this->message_encrypted );
        }

        $padlock = ' <a href="#" onclick="return false;" onkeypress="return false;" class="gf_tooltip tooltip tooltip_form_field_encrypt_value" title="<h6>Encrypted</h6>'. $message .'"><i class="fa fa-'.$icon.'"></i></a> ';
        $value = $value.$padlock;

        return $value;
    }


    /**
     * Censor Encrypted String
     *
     * @param string $string - The message to censor
     * @return string
     * @throws
     */
    private function censor($string)
    {
        if (substr($string,0,4) === 'def5') {
            $string = $this->censor_text;
        }

        return $string;
    }


    /**
     * Encrypt a message
     *
     * @param string $message - The message to encrypt
     * @return string
     * @throws
     */
    private function encrypt($message)
    {
        $key = $this->get_key();
        if ($key===false) return $message;

        $encrypt = Crypto::encrypt($message, $key);
        return $encrypt;
    }


    /**
     * Decrypt a message
     *
     * @param string $encrypted - The encrypted message
     * @return string
     * @throws
     */
    private function decrypt($encrypted)
    {
        $key = $this->get_key();
        if ($key===false) return $this->censor($encrypted);

        try {
            $plain = Crypto::decrypt($encrypted, $key);
        } catch (WrongKeyOrModifiedCiphertextException $ex) {

            $plain = $this->censor($encrypted);
        } catch (EnvironmentIsBrokenException $ex) {
            $plain = $this->censor($encrypted);
        }

        return $plain;
    }
}
