<?php if (! defined('BASEPATH')) exit('No Direct script access allowed');

/**
Copyright (c) 2011, Matthew Craig
All rights reserved.

This license is a legal agreement between you and Matthew Craig for the use 
of this Validation Class (the "Software"). By obtaining the Software you 
agree to comply with the terms and conditions of this license.

Permitted Use

You are permitted to use, copy, modify, and distribute the Software and its 
documentation, with or without modification, for any purpose, provided that 
the following conditions are met:

   1. A copy of this license agreement must be included with the distribution.
   2. Redistributions of source code must retain the above copyright notice 
        in all source code files.
   3. Redistributions in binary form must reproduce the above copyright notice 
        in the documentation and/or other materials provided with the 
        distribution.
   4. Any files that have been modified must carry notices stating the nature 
        of the change and the names of those who changed them.
   5. Products derived from the Software must include an acknowledgment that 
        they are derived from the "Software" in their documentation and/or 
        other materials provided with the distribution.

Indemnity

You agree to indemnify and hold harmless the authors of the Software and any 
contributors for any direct, indirect, incidental, or consequential 
third-party claims, actions or suits, as well as any related expenses, 
liabilities, damages, settlements or fees arising from your use or misuse of 
the Software, or a violation of any terms of this license.

Disclaimer of Warranty

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESSED OR 
IMPLIED, INCLUDING, BUT NOT LIMITED TO, WARRANTIES OF QUALITY, PERFORMANCE, 
NON-INFRINGEMENT, MERCHANTABILITY, OR FITNESS FOR A PARTICULAR PURPOSE.

Limitations of Liability

YOU ASSUME ALL RISK ASSOCIATED WITH THE INSTALLATION AND USE OF THE SOFTWARE. 
IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS OF THE SOFTWARE BE LIABLE 
FOR CLAIMS, DAMAGES OR OTHER LIABILITY ARISING FROM, OUT OF, OR IN CONNECTION 
WITH THE SOFTWARE. LICENSE HOLDERS ARE SOLELY RESPONSIBLE FOR DETERMINING THE 
APPROPRIATENESS OF USE AND ASSUME ALL RISKS ASSOCIATED WITH ITS USE, INCLUDING 
BUT NOT LIMITED TO THE RISKS OF PROGRAM ERRORS, DAMAGE TO EQUIPMENT, LOSS OF 
DATA OR SOFTWARE PROGRAMS, OR UNAVAILABILITY OR INTERRUPTION OF OPERATIONS.
*/

// Define the lowest possible integer if not already done.
if (!defined('PHP_INT_MIN')) {
    define('PHP_INT_MIN', ((PHP_INT_MAX * -1) - 1));
}

/**
 * Validate 
 * 
 * This class is used to validate input to programmer
 * specified parameters. 
 * 
 * THIS DOES NOT PERFORM ANY SANITATION, OR VARIABLE CLEANUP
 * WHAT SO EVER.  SANITATION (VARIABLE CLEANING) MUST OCCUR
 * PRIOR TO VALIDATION, OR USAGE.
 * 
 * @package     Validate
 * @version     14 
 * @date        2011-05-23
 * @copyright   2011 Matthew Craig
 * @author      Matthew Craig <matt@taggedzi.com> 
 */
class Validate
{
    /**
     * error 
     * 
     * @var string 
     * @access public
     */
    var $error;

    // Define constants to be used for string validation
    // Users can define their own, but this is for quick reference.
    const ALPHA               = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const ALPHA_NUMERIC       = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    const ALPHA_DASH          = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_';
    const ALPHA_SPACE         = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ ';
    const ALPHA_SPACE_NUMERIC = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ 0123456789';
    const ALPHA_SPACE_DASH    = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ 0123456789-_';

    /**
     * __construct  
     * 
     * @access protected
     * @return void
     */
    function __construct()
    {
        $this->error = '';
    }

    /**
     * unique 
     * 
     * This is a faster form of array_unique. It flips the values and keys
     * because there cannot be duplicate keys, any douplicates are saved as values instead of
     * testing for a new key. (much faster on larger strings)
     * @param   array $input 
     * @access  private
     * @return  array
     */
    private function unique($input = array())
    {
        return array_flip(array_flip($input));
    }
	
	
	/**
     * check password strong  
     * 
	 */
	function valid_pass($candidate) {
		$r1='/[A-Z]/';  //Uppercase
	   	$r2='/[a-z]/';  //lowercase
	   	$r3='/[!@#$%^&*()\-_=+{};:,<.>]/';  // whatever you mean by 'special char'
	   	$r4='/[0-9]/';  //numbers
	
	   	if(preg_match_all($r1,$candidate, $o)<1) return FALSE;
	
	   	if(preg_match_all($r2,$candidate, $o)<1) return FALSE;
	
	   	if(preg_match_all($r3,$candidate, $o)<1) return FALSE;
	
	   	if(preg_match_all($r4,$candidate, $o)<1) return FALSE;
	
	   	if(strlen($candidate)<8) return FALSE;
	
	   	return TRUE;
	}
	

    /**
     * check_integer  
     * 
     * This function checks an input to make sure it is a validated integer.
     * This does not "sanitized" your input in any way, it simply checks to make sure it is a valid,
     * and correct integer.
     * @param   mixed   $input          The number you wish to validate
     * @param   int     $min            The lowest allowed value (inclusive)
     * @param   int     $max            The highest allowed value (inclusive)
     * @param   bool    $allow_empty     IF the input can be valid when "empty" or no input specified.
     * @access  public
     * @return  bool    True if valid integer / False if not.  The reason why not is placed in the $this->error var.
     */
    public function check_integer($input = null, $min = PHP_INT_MIN, $max = PHP_INT_MAX, $allow_empty = FALSE)
    {
        // Make sure there are no errors in memory from previous validation attempts.
        $this->error = '';

        // Sanity Checks
        if (!is_int($min) || !is_int($max)) 
        {
            $this->error = 'Min/Max Values Must be integers';
            return FALSE;
        }

        // Make sure Min <= Max if min == max only that number is allowed...
        if ($max < $min) 
        {
            $this->error = 'Failed Sanity Check, minium allowed value cannot be greater than maximum';
            return FALSE;
        }

        // Make sure allow_empty is the correct type
        if (!is_bool($allow_empty)) 
        {
            $this->error = 'Allow empty must be of type boolean.';
            return FALSE;
        }

        // if input is empty not including zero as it is a valid integer.
        if (empty($input) && ($input !== 0))
        {
            if ($allow_empty) 
            {
                return TRUE;
            } 
            else
            {
                $this->error = 'Input is empty or null not allowed as valid entry.';    
                return FALSE;
            }
        }

        // if the input is not number
        if (!is_numeric($input)) 
        {
            $this->error = 'Input is not of a valid numeric type.';
            return FALSE;
        }
      
        // make sure this is an integer... 
        if (!is_int($input))
        {
            $this->error = 'Input is not a valid integer.';
            return FALSE;
        }

        // Make sure it is not less than the min
        if ($input < $min) 
        {
            $this->error = 'Input is lower than specified minimum.';
            return FALSE;
        }

        // Make sure it is not greater than the max
        if ($input > $max) 
        {
            $this->error = 'Input is higher than specified maxiumum.';
            return FALSE;
        }

        // If no other items failed it must be valid right?
        return TRUE;
    }

    /**
     * check_integer_array 
     * 
     * This function checks an array of integers for validity.
     * @param array $input          The Item to test
     * @param int   $min            The lower bound Must be FLOAT
     * @param int   $max            The upper bound must be FLOAT
     * @param bool  $allow_empty    IF zero/null/empty/'' is allowed
     * @access public
     * @return array                The keys are maintained array('value' => original value, 'validation' => validation status, 'error' => The reason it failed validation);
     */
    public function check_integer_array($input, $min = PHP_INT_MIN, $max = PHP_INT_MAX, $allow_empty = FALSE)
    {
        // Make sure there is an array
        if (is_array($input)) 
        {
            // Make sure we can walk through it.
            if (!empty($input))
            {
                foreach($input as $key => $value)
                {
                    $output[$key]['value'] = $value;
                    $output[$key]['validation'] = $this->check_integer($value, $min, $max, $allow_empty);
                    if ($output[$key]['validation'] === FALSE) 
                    {
                        $output[$key]['error'] = $this->error;
                    }
                }
                return $output;
            }
            else 
            {
                $this->error = 'Input is an empty array.';
                return FALSE;
            }
        }
        else
        {
            $this->error = 'Input not an array.';
            return FALSE;
        }
    }

    /**
     * check_float 
     * 
     * This is a float validation method. If the input fails validation
     * the reason for failure is placed in the class var "error".
     * Be aware that allowing null input will allow "null", '', false, 
     * FALSE and array() as "empty" inputs.
     * @param mixed $input          The input you wish to validate
     * @param float $min            The minimum value that can be accepted
     * @param float $max            The maximum value that can be accepted
     * @param bool  $allow_empty    IF "empty" values are allowed as input.  
     * @access public
     * @return bool
     */
    public function check_float($input = null, $min = -1.8e307, $max = 1.8e307, $allow_empty = FALSE)
    {
        // Sanity Checks
        $this->error = '';

        // Maker sure min/max is float
        if (!is_float($min) || !is_float($max)) 
        {
            $this->error = 'Min/Max are not valid float values.';
            return FALSE;
        }
        else 
        {
            // make sure the float is not out of bounds
            if (is_infinite($min) || is_infinite($max)) 
            {
                $this->error = 'Min/Max values are not finite values';
                return FALSE;
            }
        }

        // Make sure allow empty is of the right type.
        if(!is_bool($allow_empty)) 
        {
            $this->error = 'Allow empty must be of type boolean.';
            return FALSE;
        }

        // check for null
        if (empty($input) && ($input !== 0.0))
        {
            // if input is nulll
            if ($allow_empty)
            {
                return TRUE;
            }
            else 
            {
                $this->error = "Input is empty or null and is not permitted.";
                return FALSE;
            }
        }

        // validate numeric
        if (!is_numeric($input))
        {
            $this->error = 'Input is not a number.';
            return FALSE;
        }

        // validate float
        if (!is_float($input)) 
        {
            $this->error = 'Input is not a float.';
            return FALSE;
        }

        // check min
        if ($input < $min) 
        {
            $this->error = 'Input is below miniumum bounds.';
            return FALSE;
        }

        // check max
        if ($input > $max)
        {
            $this->error = 'Input is above maximum bounds.';
            return FALSE;
        }

        // If we made it this far it is good.
        return TRUE;
    }

    /**
     * check_float_array  
     *
     * This function takes an array of potential float point numbers and validates
     * them within the specified bounds.
     * @param array $input          An array of floats to validate
     * @param float $min            Min allowed value
     * @param float $max            Max allowed value
     * @param bool  $allow_empty    If Empty values are allowed to be validated.
     * @access public
     * @return array        Array keys are maintained, but 2 fields added "validation" and if validation = false, then error is also added.
     */
    public function check_float_array($input, $min = -1.8e307, $max = 1.8e307, $allow_empty = FALSE)
    {
        // Make sure the input is an array of integes.
        if(is_array($input)) 
        {
            if(!empty($input))
            {
                $output = array();
                // Go through the array checking each item with specified params.
                foreach($input as $key => $value)
                {
                    $output[$key]['value'] = $value;
                    $output[$key]['validation'] = $this->check_float($value, $min, $max, $allow_empty);
                    if ($output[$key]['validation'] === FALSE) 
                    {
                        $output[$key]['error'] = $this->error;
                    }
                }
                // Kick it back.
                return $output;
            }
            else
            {
                $this->error = 'Input is an empty array.';
                return FALSE;
            }
        }
        else 
        {
            // The input was an unexpected type.
            $this->error = 'Input not an array';
            return FALSE;
        }
    }
    
    /**
     * check_string 
     * 
     * This method validates a string according to the specified params
     * @param   string    $input            The input to be validated
     * @param   int       $min_length       The min allowed size of the input
     * @param   int       $max_length       The max allowed size of the input
     * @param   string    $allowed_chars    A string containing all allowed characters
     * @param   bool      $allow_empty      If empty strings are valid.
     * @access  public
     * @return  bool      True if it passes all validations / False if a validation fails. Reason given in object property "error".
     */
    public function check_string($input = '', 
            $min_length = 0, $max_length = PHP_INT_MAX, 
            $allowed_chars = self::ALPHA_SPACE_DASH, $allow_empty = FALSE)
    {
        // Clear any previous errors.
        $this->error = '';
		
        // make sure we have some basic sanity checks installed.
        // Make sure min/max are integers.
        if (!is_int($min_length) || !is_int($max_length)) 
        {
            $this->error = 'Min/Max values must be integers.';
            return FALSE;
        }

        // Make sure the min length not negative
        if ($min_length < 0)
        {
            $this->error = 'Min length cannot be a negative number.';
            return FALSE;
        }

        // Make sure that max length is not negative or not equal to zero
        if ($max_length < 1) 
        {
            $this->error = 'Max length cannot be less than 1.';
            return FALSE;
        }

        // Make sure criteria is possible
        if ($min_length > $max_length) 
        {
            $this->error = 'The minimum length is greater than the allowed maxiumum length.';
            return FALSE;
        }

        // Make sure the allowed Chars is of type string
        if (!is_string($allowed_chars)) 
        {
            $this->error = 'The allowed character list must be of type string.';
            return FALSE;
        }

        // Maker sure this is at least 1 allowed character
        if (strlen($allowed_chars) < 1) 
        {
            $this->error = 'At least 1 character must be allowed for validation.';
            return FALSE;
        }

        // Maker sure allow_empty is bool.
        if (!is_bool($allow_empty))
        {
            $this->error = 'Allow Empty parameter must be a boolean.';
            return FALSE;
        }

        // Make sure the input is a string.
        if (!is_string($input))
        {
            $this->error = 'Input put must be of type string.';
            return FALSE;
        }

        // Make sure there is an input to process.
        $size = strlen($input);
        if ($size <= 0) 
        {
            // if Input is empty find out if empty is allowed.
            if ($allow_empty) 
            {
                // If input is empty, and empty is allowed... it passes.
                return TRUE;
            } 
            else 
            {
                // if input is empty and empty is not allowed, it fails and explain why
                $this->error = 'An input value is required.';
                return FALSE;
            }
        }

        // Min Size Validation
        if ($size < $min_length) 
        {
            $this->error = 'The input does not meet the minium length required.';
            return FALSE;
        }

        // Max Size Validation
        if ($size > $max_length)
        {
            $this->error = 'The input is over the maximum allowed length.';
            return FALSE;
        }

        // Split the allowed chars into an array
        // No point in allowing duplicates in allowed chars.
        $allowed_array = $this->unique(str_split($allowed_chars));

        // split the input in to an array of unique characters...
        // No point in checking any character twice.
        $input_array = $this->unique(str_split($input));
        
        // go through the entire input and make sure that each character is allowed.
        
        
        foreach ($input_array as $character_to_test) 
        {
            // if the character is not in the allowed array... 
            // it is illegal.
            if (!in_array($character_to_test, $allowed_array, TRUE)) {
                $this->error = 'Illegal characters are in the array.';
                return FALSE;
            }
        }
		
        // If we made it this far... it must be good.
        return TRUE;
    }

    public function check_string_array($input = array(),
            $min_length = 0, $max_length = PHP_INT_MAX,
            $allowed_chars = self::ALPHA_SPACE_DASH, $allow_empty = FALSE)
    {
        // Make sure input is an array that can be walked through
        if (is_array($input)) 
        {
            if(!empty($input))
            {
                $output = array();

                // go through the item list
                foreach ($input as $key => $value) 
                {
                    $output[$key]['value'] = $value;
                    $output[$key]['validation'] = $this->check_string($value, $min_length, $max_length, $allowed_chars, $allow_empty);
                    if ($output[$key]['validation'] === FALSE) 
                    {
                        $output[$key]['error'] = $this->error;
                    }
                }
                return $output;
            }
            else 
            {
                $this->error = 'Input is an empty array.';
                return FALSE;
            }
        } 
        else
        {
            $this->error = 'Input not an array.';
            return FALSE;
        }
    }


    /**
     * check_arranged_string 
     * 
     * This method uses a pattern replace and pattern match technique
     * to perform validation on strings.
     * 
     * @param string $input         The string to validate 
     * @param array $replacements   A keyed array. Key = the replacement char, Value = characters to repace
     * @param array $allowed_forms  An array of allowed final patters.
     * @access public
     * @return bool 
     */
    public function check_arranged_string($input = '', 
            $replacements = array(), $allowed_forms = array())
    {
        // ie for phone numbers.
        // $replacements = array('#' => '0123456789');
        // $allowed_forms = array ('##########', '(###) ###-####', etc.);
        // all numbers from input are replaced with #
        // Then the pattern is compares to allowed forms..

        $this->error = ''; 

        // Sanity Checks
        if (!is_string($input)) 
        {
            $this->error = 'Input is not of type string.';
            return FALSE;
        }

        if (!is_array($replacements)) 
        {
            $this->error = 'Replacements must be a keyed array.';
            return FALSE;
        }

        if (empty($replacements))
        {
            $this->error = 'Replacements array is empty.';
            return FALSE;
        }

        // Turn the replacment array into a multi
        // dimensional array for internal purposes.
        foreach ($replacements as $key => $value) 
        {
            $replacements[$key] = str_split($value); 
        }
        unset($key, $value);

        if (!is_array($allowed_forms))
        {
            $this->error = 'Allowed Forms is not of type array.';
            return FALSE;
        }

        if (empty($allowed_forms))
        {
            $this->error = 'Allowed Forms array is empty.';
            return FALSE;
        }

        // This has to be a separate loop to make sure that 
        // none of the "keys" occures naturally in the string 
        // producing false positivies.
        foreach($replacements as $key => $value) 
        {
            if (strpos($input, $key) !== FALSE) {
                $this->error = 'Replacement Key found within text.';
                return FALSE;
            }
        }
        unset($key, $value);

        // replace all of the "contextual" chars with keys.
        foreach ($replacements as $key => $replacement_array) 
        {
            foreach ($replacement_array as $char) 
            {
                $input = str_replace($char, $key, $input);
            }
            unset($char);
        }
        unset($key, $replacement_array);

        // what is left over should now either match the allowed forms 
        // or it is not valid.
        if (in_array($input, $allowed_forms, TRUE)) 
        {
            return TRUE;
        }
        else 
        {
            $this->error = "Input does not match any allowed forms.";
            return FALSE;
        }
    }

    /**
     * check_arranged_string_array 
     * 
     * @param array $input 
     * @param array $replacements 
     * @param array $allowed_forms 
     * @access public
     * @return array 
     */
    public function check_arranged_string_array($input = array(), $replacements = array(), $allowed_forms = array())
    {
        if (is_array($input)) 
        {
            if (!empty($input)) 
            {
                $output = array();
                foreach($input as $key => $value) 
                {
                    $output[$key]['value'] = $value;
                    $output[$key]['validation'] = $this->check_arranged_string($value, $replacements, $allowed_forms);
                    if ($output[$key]['validation'] === FALSE) {
                        $output[$key]['error'] = $this->error;
                    }
                }
                return $output;
            }
            else
            {
                $this->error = 'Input is an empty array.';
                return FALSE;
            }
        }
        else 
        {
            $this->error = 'Input not an array.';
            return FALSE;
        }
    }

    /**
     * check_formatted_string 
     * 
     * This method validates "formatted" strings, where each character has a 
     * specific list of allowed characters.  
     * @param   string  $input 
     * @param   array   $codec 
     * @access  public
     * @return  bool
     */
    public function check_formatted_string($input = '', $codec = array())
    {
        // Clear any previous errors.
        $this->error = '';

        // Sanity Checks
        if (!is_array($codec)) 
        {
            $this->error = 'Codec is not of type array.';
            return FALSE;
        }

        if (empty($codec)) 
        {
            $this->error = 'Codec is empty.';
            return FALSE;
        }
        
        if(!is_string($input))
        {
            $this->error = 'Input is not of type string.';
            return FALSE;
        }

        if (empty($input)) 
        {
            $this->error = 'Input is empty.';
            return FALSE;
        }

        // Go through each character "slot" in the input.
        $size  = strlen($input);
        $slots = count($codec);

        // Make sure the size of the input matches the codec parameters.
        if ($size != $slots)
        {
            $this->error = 'Input size does not match given codec.';
            return FALSE;
        }

        // Free up memory.
        unset($slots);

        // Iterate through each character of the input
        for ($i = 0; $i < $size; $i++) 
        {
            // make sure the codec contains a string list.
            if (!is_string($codec[$i]))
            {
                $this->error = 'Codec value must be of type string.';
                return FALSE;
            }

            // Build an array of allowed chars in this "slot"
            $spot_check = str_split($codec[$i]); 

            // Check to see if the input char is in the slot white list.
            if (!in_array($input[$i], $spot_check))
            {
                $this->error = 'Input characters do not match codec.';
                return FALSE;
            }
            
            // Free up some memory
            unset($spot_check);
        }

        // Free up memory
        unset($i, $size);

        // if every character passed the codec it must be good.
        return TRUE;
    }

    /**
     * check_formatted_string_array 
     * 
     * @param array $input 
     * @param array $codec 
     * @access public
     * @return array 
     */
    public function check_formatted_string_array($input = array(), $codec = array())
    {
        if (is_array($input)) 
        {
            if (!empty($input)) 
            {
                $output = array();
                foreach($input as $key => $value) 
                {
                    $output[$key]['value'] = $value;
                    $output[$key]['validation'] = $this->check_formatted_string($value, $codec);
                    if ($output[$key]['validation'] === FALSE) {
                        $output[$key]['error'] = $this->error;
                    }
                }
                return $output;
            }
            else
            {
                $this->error = 'Input is an empty array.';
                return FALSE;
            }
        }
        else 
        {
            $this->error = 'Input not an array.';
            return FALSE;
        }
    }
	
	public function is_json($string, $return_data = false) {
	  	$data = json_decode($string);
	    	return (json_last_error() == JSON_ERROR_NONE) ? ($return_data ? $data : TRUE) : FALSE;
	}
	
	public function is_base64($s){
	    // Check if there are valid base64 characters
	    if (!preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $s)) return false;
	
	    // Decode the string in strict mode and check the results
	    $decoded = base64_decode($s, true);
	    if(false === $decoded) return false;
	
	    // Encode the string again
	    if(base64_encode($decoded) != $s) return false;
	
	    return true;
	}
	
	public function msword_conversion($text)
	{
		$text = htmlspecialchars($text, ENT_QUOTES, "UTF-8");
	    $text = str_replace(get_html_translation_table(), " ", $text);
	    $text = str_replace("/", "", $text);
	    $text = str_replace("=", "", $text);
	    $text = preg_replace("/[-]+/i", " ", $text);
		
	    return $text;
	}
	
	public function check_filetype($filename){
		
		$allowed =  array('gif','png' ,'jpg');
		
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		
		if(!in_array($ext,$allowed) ) {
		    return false;
		}
		
		return true;
	}
	
	public function check_file_exists($file){
		if (file_exists($file)) {
			if( (int)filesize($file) > 0 ){
				
				$info = getimagesize($file);
								
				if( !empty($info) ){					
					return true;
				} else {					
					return false;
				}
				
			} else {
				return false;
			}
		} else {
			return false;
		}	
	}
	
	public function check_file_info($file){
		if (file_exists($file)) {
			
			$info = getimagesize($file);
			
			return $info;
		} else {
			$mess = 'Error: Could not load image ' . $file . '!';
			return $mess;
		}	
	} 
	
	function esc_attr($text)
	{
	    $safe_text = $this->wp_check_invalid_utf8($text);
	    $safe_text = $this->_wp_specialchars($safe_text, ENT_QUOTES);
	    /**
	     * Filter a string cleaned and escaped for output in an HTML attribute.
	     *
	     * Text passed to esc_attr() is stripped of invalid or special characters
	     * before output.
	     *
	     * @since 2.0.6
	     *
	     * @param string $safe_text The text after it has been escaped.
	     * @param string $text      The text prior to being escaped.
	     */
	    return $safe_text;
	}
	
	function _wp_specialchars($string, $quote_style = ENT_NOQUOTES, $charset = false, $double_encode = false)
	{
	    $string = (string) $string;
	    if (0 === strlen($string))
	        return '';
	    // Don't bother if there are no specialchars - saves some processing
	    if (!preg_match('/[&<>"\']/', $string))
	        return $string;
	    // Account for the previous behaviour of the function when the $quote_style is not an accepted value
	    if (empty($quote_style))
	        $quote_style = ENT_NOQUOTES;
	    elseif (!in_array($quote_style, array(
	        0,
	        2,
	        3,
	        'single',
	        'double'
	    ), true))
	        $quote_style = ENT_QUOTES;
	    // Store the site charset as a static to avoid multiple calls to wp_load_alloptions()	   
	    if (in_array($charset, array(
	        'utf8',
	        'utf-8',
	        'UTF8'
	    )))
	        $charset = 'UTF-8';
	    $_quote_style = $quote_style;
	    if ($quote_style === 'double') {
	        $quote_style  = ENT_COMPAT;
	        $_quote_style = ENT_COMPAT;
	    } elseif ($quote_style === 'single') {
	        $quote_style = ENT_NOQUOTES;
	    }
	    // Handle double encoding ourselves
	    if ($double_encode) {
	        $string = @htmlspecialchars($string, $quote_style, $charset);
	    } else {
	        // Decode &amp; into &
	        $string = $this->wp_specialchars_decode($string, $_quote_style);
	        // Now re-encode everything except &entity;
	        $string = preg_split('/(&#?x?[0-9a-z]+;)/i', $string, -1, PREG_SPLIT_DELIM_CAPTURE);
	        for ($i = 0; $i < count($string); $i += 2)
	            $string[$i] = @htmlspecialchars($string[$i], $quote_style, $charset);
	        $string = implode('', $string);
	    }
	    // Backwards compatibility
	    if ('single' === $_quote_style)
	        $string = str_replace("'", '&#039;', $string);
	    return $string;
	}	
	
	/**
	 * Converts a number of HTML entities into their special characters.
	 *
	 * Specifically deals with: &, <, >, ", and '.
	 *
	 * $quote_style can be set to ENT_COMPAT to decode " entities,
	 * or ENT_QUOTES to do both " and '. Default is ENT_NOQUOTES where no quotes are decoded.
	 *
	 * @since 2.8.0
	 *
	 * @param string $string The text which is to be decoded.
	 * @param mixed $quote_style Optional. Converts double quotes if set to ENT_COMPAT, both single and double if set to ENT_QUOTES or none if set to ENT_NOQUOTES. Also compatible with old _wp_specialchars() values; converting single quotes if set to 'single', double if set to 'double' or both if otherwise set. Default is ENT_NOQUOTES.
	 * @return string The decoded text without HTML entities.
	 */
	function wp_specialchars_decode($string, $quote_style = ENT_NOQUOTES)
	{
	    $string = (string) $string;
	    if (0 === strlen($string)) {
	        return '';
	    }
	    // Don't bother if there are no entities - saves a lot of processing
	    if (strpos($string, '&') === false) {
	        return $string;
	    }
	    // Match the previous behaviour of _wp_specialchars() when the $quote_style is not an accepted value
	    if (empty($quote_style)) {
	        $quote_style = ENT_NOQUOTES;
	    } elseif (!in_array($quote_style, array(
	        0,
	        2,
	        3,
	        'single',
	        'double'
	    ), true)) {
	        $quote_style = ENT_QUOTES;
	    }
	    // More complete than get_html_translation_table( HTML_SPECIALCHARS )
	    $single      = array(
	        '&#039;' => '\'',
	        '&#x27;' => '\''
	    );
	    $single_preg = array(
	        '/&#0*39;/' => '&#039;',
	        '/&#x0*27;/i' => '&#x27;'
	    );
	    $double      = array(
	        '&quot;' => '"',
	        '&#034;' => '"',
	        '&#x22;' => '"'
	    );
	    $double_preg = array(
	        '/&#0*34;/' => '&#034;',
	        '/&#x0*22;/i' => '&#x22;'
	    );
	    $others      = array(
	        '&lt;' => '<',
	        '&#060;' => '<',
	        '&gt;' => '>',
	        '&#062;' => '>',
	        '&amp;' => '&',
	        '&#038;' => '&',
	        '&#x26;' => '&'
	    );
	    $others_preg = array(
	        '/&#0*60;/' => '&#060;',
	        '/&#0*62;/' => '&#062;',
	        '/&#0*38;/' => '&#038;',
	        '/&#x0*26;/i' => '&#x26;'
	    );
	    if ($quote_style === ENT_QUOTES) {
	        $translation      = array_merge($single, $double, $others);
	        $translation_preg = array_merge($single_preg, $double_preg, $others_preg);
	    } elseif ($quote_style === ENT_COMPAT || $quote_style === 'double') {
	        $translation      = array_merge($double, $others);
	        $translation_preg = array_merge($double_preg, $others_preg);
	    } elseif ($quote_style === 'single') {
	        $translation      = array_merge($single, $others);
	        $translation_preg = array_merge($single_preg, $others_preg);
	    } elseif ($quote_style === ENT_NOQUOTES) {
	        $translation      = $others;
	        $translation_preg = $others_preg;
	    }
	    // Remove zero padding on numeric entities
	    $string = preg_replace(array_keys($translation_preg), array_values($translation_preg), $string);
	    // Replace characters according to translation table
	    return strtr($string, $translation);
	}
	
	/**
	 * Checks for invalid UTF8 in a string.
	 *
	 * @since 2.8.0
	 *
	 * @param string $string The text which is to be checked.
	 * @param boolean $strip Optional. Whether to attempt to strip out invalid UTF8. Default is false.
	 * @return string The checked text.
	 */
	function wp_check_invalid_utf8($string, $strip = false)
	{
	    $string = (string) $string;
	    if (0 === strlen($string)) {
	        return '';
	    }
	    // Store the site charset as a static to avoid multiple calls to get_option()
	    static $is_utf8;
	    /*if (!isset($is_utf8)) {
	        $is_utf8 = in_array(get_option('blog_charset'), array(
	            'utf8',
	            'utf-8',
	            'UTF8',
	            'UTF-8'
	        ));
	    }*/
	    if (!$is_utf8) {
	        return $string;
	    }
	    // Check for support for utf8 in the installed PCRE library once and store the result in a static
	    static $utf8_pcre;
	    if (!isset($utf8_pcre)) {
	        $utf8_pcre = @preg_match('/^./u', 'a');
	    }
	    // We can't demand utf8 in the PCRE installation, so just return the string in those cases
	    if (!$utf8_pcre) {
	        return $string;
	    }
	    // preg_match fails when it encounters invalid UTF8 in $string
	    if (1 === @preg_match('/^./us', $string)) {
	        return $string;
	    }
	    // Attempt to strip the bad chars if requested (not recommended)
	    if ($strip && function_exists('iconv')) {
	        return iconv('utf-8', 'utf-8', $string);
	    }
	    return '';
	}

}


/*  End of Validate.php */
