<?php

class ImageUpload {
    private $targetDir;

    public function __construct($targetDir = null) {
        if ($targetDir === null) {
            $this->targetDir = dirname(__DIR__) . '/images/';
        } else {
            $this->targetDir = $targetDir;
        }

        // Ensure target directory exists
        if (!is_dir($this->targetDir)) {
            mkdir($this->targetDir, 0755, true);
        }
    }

    /**
     * Process an uploaded image file.
     * Assumes validation has already been performed.
     *
     * @param array $file The $_FILES array element for the uploaded file
     * @param string|null $existingFilename The filename of an existing image to replace (will be deleted)
     * @return string|false The filename of the saved image, or false on failure
     */
    public function process($file, $existingFilename = null) {
        // Get MIME type
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        // Generate unique filename
        $extension = $this->getExtensionFromMimeType($mimeType);
        $filename = $this->generateUniqueFilename($extension);
        $targetPath = $this->targetDir . $filename;

        // Move the uploaded file
        if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
            return false;
        }

        // Delete old image if updating
        if ($existingFilename && $existingFilename !== $filename) {
            $this->deleteImage($existingFilename);
        }

        return $filename;
    }

    /**
     * Check if a file was uploaded for a given field.
     *
     * @param string $key The key to check in the $_FILES array
     * @return bool True if a file was uploaded, false otherwise
     */
    public function hasFile($key) {
        return isset($_FILES[$key]) && $_FILES[$key]['error'] === UPLOAD_ERR_OK;
    }

    public function deleteImage($filename) {
        if (empty($filename)) {
            return true;
        }

        $filePath = $this->targetDir . $filename;
        if (file_exists($filePath)) {
            return unlink($filePath);
        }

        return true;
    }

    private function generateUniqueFilename($extension) {
        do {
            $filename = uniqid('product_', true) . '.' . $extension;
            $filePath = $this->targetDir . $filename;
        } while (file_exists($filePath));

        return $filename;
    }

    private function getExtensionFromMimeType($mimeType) {
        switch ($mimeType) {
            case 'image/jpeg':
            case 'image/jpg':
                return 'jpg';
            case 'image/png':
                return 'png';
            default:
                return 'jpg';
        }
    }
}
