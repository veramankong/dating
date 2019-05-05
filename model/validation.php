<?php

/** Validate a name is all alphabetic
 * @param String name
 * @return boolean
 */
function validName($name) {
    return !empty($name) && ctype_alpha($name);
}

/** Validate if age is numeric and between 18 & 118
 * @param String age
 * @return boolean
 */
function validAge($age) {
    return (!empty($age) && ctype_digit($age) && ($age >= 18 && $age <= 118));
}

/** Validates phone number
 * @param String phone
 * @return boolean
 */
function validPhone($phone) {
    return (!empty($phone));
}

/** Validates email
 * @param String email
 * @return boolean
 */
function validEmail($email) {
    $email = filter_var(trim($email), FILTER_VALIDATE_EMAIL);
    if($email != false) {
        return true;
    }
    return false;
}

/** Validates each interest against
 * a list of valid options
 * @param String interests
 * @return boolean
 */
function validInterests($interests) {

    //Interests are optional
    if (empty($interests)) {
        return true;
    }
    //validate selected interests
    foreach ($interests as $interest) {
        if (!in_array($interest, $interests)) {
            return false;
        }
    }
    return true;
}
