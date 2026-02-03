<?php

class Validator {
    private $data;
    private $rules;
    private $errors = [];
    private $customMessages = [];

    public function __construct($data, $rules, $customMessages = []) {
        $this->data = $data;
        $this->rules = $rules;
        $this->customMessages = $customMessages;
        $this->validate();
    }

    private function validate() {
        foreach ($this->rules as $field => $ruleString) {
            $rules = $this->parseRules($ruleString);
            $value = $this->getValue($field);

            foreach ($rules as $rule) {
                $this->applyRule($field, $value, $rule);
            }
        }
    }

    private function parseRules($ruleString) {
        if (is_array($ruleString)) {
            return $ruleString;
        }

        $rules = [];
        $ruleParts = explode('|', $ruleString);

        foreach ($ruleParts as $rulePart) {
            $rulePart = trim($rulePart);
            if (strpos($rulePart, ':') !== false) {
                list($ruleName, $ruleValue) = explode(':', $rulePart, 2);
                $rules[] = ['name' => $ruleName, 'value' => $ruleValue];
            } else {
                $rules[] = ['name' => $rulePart, 'value' => null];
            }
        }

        return $rules;
    }

    private function getValue($field) {
        return isset($this->data[$field]) ? $this->data[$field] : null;
    }

    private function applyRule($field, $value, $rule) {
        $ruleName = $rule['name'];
        $ruleValue = $rule['value'];

        switch ($ruleName) {
            case 'required':
                $this->validateRequired($field, $value);
                break;
            case 'notempty':
                $this->validateNotEmpty($field, $value);
                break;
            case 'array':
                $this->validateArray($field, $value);
                break;
            case 'min':
                $this->validateMin($field, $value, $ruleValue);
                break;
            case 'max':
                $this->validateMax($field, $value, $ruleValue);
                break;
            case 'email':
                $this->validateEmail($field, $value);
                break;
            case 'float':
                $this->validateFloat($field, $value);
                break;
            case 'integer':
                $this->validateInteger($field, $value);
                break;
            case 'minvalue':
                $this->validateMinValue($field, $value, $ruleValue);
                break;
            case 'maxvalue':
                $this->validateMaxValue($field, $value, $ruleValue);
                break;
            case 'boolean':
                $this->validateBoolean($field, $value);
                break;
            case 'regex':
                $this->validateRegex($field, $value, $ruleValue);
                break;
            case 'in':
                $this->validateIn($field, $value, $ruleValue);
                break;
            case 'subset':
                $this->validateSubset($field, $value, $ruleValue);
                break;
            case 'file':
                $this->validateFile($field, $value);
                break;
            case 'mimes':
                $this->validateMimes($field, $value, $ruleValue);
                break;
            case 'max_file_size':
                $this->validateMaxFileSize($field, $value, $ruleValue);
                break;
            case 'image':
                $this->validateImage($field, $value);
                break;
        }
    }

    private function validateRequired($field, $value) {
        if ($value === null || $value === '' || (is_array($value) && empty($value))) {
            $this->addError($field, "The $field field is required.");
        }
    }

    private function validateNotEmpty($field, $value) {
        if ($value === '' || (is_array($value) && empty($value))) {
            $this->addError($field, "The $field field must not be empty.");
        }
    }

    private function validateArray($field, $value) {
        if ($value !== null && $value !== '' && !is_array($value)) {
            $this->addError($field, "The $field must be an array.");
        }
    }

    private function validateMin($field, $value, $min) {
        if ($value === null || $value === '') {
            return;
        }

        $length = is_array($value) ? count($value) : mb_strlen($value);

        if ($length < $min) {
            if (is_array($value)) {
                $this->addError($field, "The $field must have at least $min items.");
            } else {
                $this->addError($field, "The $field must be at least $min characters.");
            }
        }
    }

    private function validateMax($field, $value, $max) {
        if ($value === null || $value === '') {
            return;
        }

        $length = is_array($value) ? count($value) : mb_strlen($value);

        if ($length > $max) {
            if (is_array($value)) {
                $this->addError($field, "The $field must not have more than $max items.");
            } else {
                $this->addError($field, "The $field must not exceed $max characters.");
            }
        }
    }

    private function validateEmail($field, $value) {
        if ($value === null || $value === '') {
            return;
        }

        if (is_array($value)) {
            foreach ($value as $item) {
                if (!filter_var($item, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($field, "All values in $field must be valid email addresses.");
                    break;
                }
            }
        } else {
            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $this->addError($field, "The $field must be a valid email address.");
            }
        }
    }

    private function validateFloat($field, $value) {
        if ($value === null || $value === '') {
            return;
        }

        if (is_array($value)) {
            foreach ($value as $item) {
                if (!is_numeric($item) || filter_var($item, FILTER_VALIDATE_FLOAT) === false) {
                    $this->addError($field, "All values in $field must be valid floats.");
                    break;
                }
            }
        } else {
            if (!is_numeric($value) || filter_var($value, FILTER_VALIDATE_FLOAT) === false) {
                $this->addError($field, "The $field must be a valid float.");
            }
        }
    }

    private function validateInteger($field, $value) {
        if ($value === null || $value === '') {
            return;
        }

        if (is_array($value)) {
            foreach ($value as $item) {
                if (!filter_var($item, FILTER_VALIDATE_INT) && $item !== 0 && $item !== '0') {
                    $this->addError($field, "All values in $field must be integers.");
                    break;
                }
            }
        } else {
            if (!filter_var($value, FILTER_VALIDATE_INT) && $value !== 0 && $value !== '0') {
                $this->addError($field, "The $field must be an integer.");
            }
        }
    }

    private function validateMinValue($field, $value, $min) {
        if ($value === null || $value === '') {
            return;
        }

        if (is_array($value)) {
            foreach ($value as $item) {
                if (!is_numeric($item)) {
                    $this->addError($field, "All values in $field must be numeric to validate minimum value.");
                    return;
                }
                if ($item < $min) {
                    $this->addError($field, "All values in $field must be at least $min.");
                    break;
                }
            }
        } else {
            if (!is_numeric($value)) {
                $this->addError($field, "The $field must be numeric to validate minimum value.");
                return;
            }

            if ($value < $min) {
                $this->addError($field, "The $field must be at least $min.");
            }
        }
    }

    private function validateMaxValue($field, $value, $max) {
        if ($value === null || $value === '') {
            return;
        }

        if (is_array($value)) {
            foreach ($value as $item) {
                if (!is_numeric($item)) {
                    $this->addError($field, "All values in $field must be numeric to validate maximum value.");
                    return;
                }
                if ($item > $max) {
                    $this->addError($field, "All values in $field must not exceed $max.");
                    break;
                }
            }
        } else {
            if (!is_numeric($value)) {
                $this->addError($field, "The $field must be numeric to validate maximum value.");
                return;
            }

            if ($value > $max) {
                $this->addError($field, "The $field must not exceed $max.");
            }
        }
    }

    private function validateBoolean($field, $value) {
        if ($value === null || $value === '') {
            return;
        }

        $booleanValues = [true, false, 0, 1, '0', '1', 'true', 'false', 'True', 'False'];

        if (is_array($value)) {
            foreach ($value as $item) {
                if (!in_array($item, $booleanValues, true)) {
                    $this->addError($field, "All values in $field must be boolean values.");
                    break;
                }
            }
        } else {
            if (!in_array($value, $booleanValues, true)) {
                $this->addError($field, "The $field must be a boolean value.");
            }
        }
    }

    private function validateRegex($field, $value, $pattern) {
        if ($value === null || $value === '') {
            return;
        }

        if (is_array($value)) {
            foreach ($value as $item) {
                if (!preg_match($pattern, $item)) {
                    $this->addError($field, "All values in $field must match the required format.");
                    break;
                }
            }
        } else {
            if (!preg_match($pattern, $value)) {
                $this->addError($field, "The $field format is invalid.");
            }
        }
    }

    private function validateIn($field, $value, $allowedValues) {
        if ($value === null || $value === '') {
            return;
        }

        $allowedArray = explode(',', $allowedValues);
        $allowedArray = array_map('trim', $allowedArray);

        if (is_array($value)) {
            foreach ($value as $item) {
                if (!in_array($item, $allowedArray, true)) {
                    $allowed = implode(', ', $allowedArray);
                    $this->addError($field, "All values in $field must be one of: $allowed.");
                    break;
                }
            }
        } else {
            if (!in_array($value, $allowedArray, true)) {
                $allowed = implode(', ', $allowedArray);
                $this->addError($field, "The $field must be one of: $allowed.");
            }
        }
    }

    private function validateSubset($field, $value, $allowedValues) {
        if ($value === null || $value === '') {
            return;
        }

        if (!is_array($value)) {
            $this->addError($field, "The $field must be an array for subset validation.");
            return;
        }

        $allowedArray = explode(',', $allowedValues);
        $allowedArray = array_map('trim', $allowedArray);

        foreach ($value as $item) {
            if (!in_array($item, $allowedArray, true)) {
                $allowed = implode(', ', $allowedArray);
                $this->addError($field, "All values in $field must be one of: $allowed.");
                break;
            }
        }
    }

    private function validateFile($field, $value) {
        if ($value === null || $value === '') {
            return;
        }

        // Check if value is a file upload array
        if (!is_array($value) || !isset($value['error'])) {
            $this->addError($field, "The $field must be a file.");
            return;
        }

        // Check for upload errors (except UPLOAD_ERR_NO_FILE which means optional file not provided)
        if ($value['error'] !== UPLOAD_ERR_OK && $value['error'] !== UPLOAD_ERR_NO_FILE) {
            $this->addError($field, "File upload error: " . $this->getUploadErrorMessage($value['error']));
        }
    }

    private function validateMimes($field, $value, $allowedMimes) {
        if ($value === null || $value === '') {
            return;
        }

        // Skip if no file was uploaded
        if (!is_array($value) || !isset($value['tmp_name']) || $value['error'] === UPLOAD_ERR_NO_FILE) {
            return;
        }

        // Check if file upload had errors
        if ($value['error'] !== UPLOAD_ERR_OK) {
            return; // Let the 'file' rule handle upload errors
        }

        // Get MIME type
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $value['tmp_name']);
        finfo_close($finfo);

        // Parse allowed MIME types
        $allowedArray = explode(',', $allowedMimes);
        $allowedArray = array_map('trim', $allowedArray);

        // Convert extensions to MIME types
        $mimeTypeMap = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'pdf' => 'application/pdf',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'txt' => 'text/plain'
        ];

        $allowedMimeTypes = [];
        foreach ($allowedArray as $item) {
            if (isset($mimeTypeMap[$item])) {
                $allowedMimeTypes[] = $mimeTypeMap[$item];
            } else {
                $allowedMimeTypes[] = $item;
            }
        }

        if (!in_array($mimeType, $allowedMimeTypes, true)) {
            $allowed = implode(', ', $allowedArray);
            $this->addError($field, "The $field must be a file of type: $allowed.");
        }
    }

    private function validateMaxFileSize($field, $value, $maxSize) {
        if ($value === null || $value === '') {
            return;
        }

        // Skip if no file was uploaded
        if (!is_array($value) || !isset($value['size']) || $value['error'] === UPLOAD_ERR_NO_FILE) {
            return;
        }

        // Check if file upload had errors
        if ($value['error'] !== UPLOAD_ERR_OK) {
            return; // Let the 'file' rule handle upload errors
        }

        if ($value['size'] > $maxSize) {
            $maxSizeMB = round($maxSize / 1048576, 2);
            $this->addError($field, "The $field must not exceed $maxSizeMB MB.");
        }
    }

    private function validateImage($field, $value) {
        if ($value === null || $value === '') {
            return;
        }

        // Skip if no file was uploaded
        if (!is_array($value) || !isset($value['tmp_name']) || $value['error'] === UPLOAD_ERR_NO_FILE) {
            return;
        }

        // Check if file upload had errors
        if ($value['error'] !== UPLOAD_ERR_OK) {
            return; // Let the 'file' rule handle upload errors
        }

        // Validate that file is an image
        $imageInfo = getimagesize($value['tmp_name']);
        if ($imageInfo === false) {
            $this->addError($field, "The $field must be a valid image.");
        }
    }

    private function getUploadErrorMessage($errorCode) {
        switch ($errorCode) {
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                return "File is too large.";
            case UPLOAD_ERR_PARTIAL:
                return "File was only partially uploaded.";
            case UPLOAD_ERR_NO_TMP_DIR:
                return "Missing temporary folder.";
            case UPLOAD_ERR_CANT_WRITE:
                return "Failed to write file to disk.";
            case UPLOAD_ERR_EXTENSION:
                return "Upload stopped by extension.";
            default:
                return "Unknown upload error.";
        }
    }

    private function addError($field, $message) {
        if (isset($this->customMessages[$field])) {
            $message = $this->customMessages[$field];
        }

        if (!isset($this->errors[$field])) {
            $this->errors[$field] = [];
        }

        $this->errors[$field][] = $message;
    }

    public function fails() {
        return !empty($this->errors);
    }

    public function passes() {
        return empty($this->errors);
    }

    public function errors() {
        return $this->errors;
    }

    public function firstError($field = null) {
        if ($field) {
            return isset($this->errors[$field]) ? $this->errors[$field][0] : null;
        }

        foreach ($this->errors as $fieldErrors) {
            return $fieldErrors[0];
        }

        return null;
    }

    public function allErrors() {
        $allErrors = [];
        foreach ($this->errors as $fieldErrors) {
            $allErrors = array_merge($allErrors, $fieldErrors);
        }
        return $allErrors;
    }
}
