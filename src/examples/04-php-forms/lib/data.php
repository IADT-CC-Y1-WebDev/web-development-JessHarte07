<?php

// Categories for the select dropdown
$categories = [
    ['id' => 1, 'name' => 'Electronics'],
    ['id' => 2, 'name' => 'Clothing'],
    ['id' => 3, 'name' => 'Books']
];

// Features for the checkboxes
$features = [
    ['id' => 1, 'name' => 'Free Shipping'],
    ['id' => 2, 'name' => 'Gift Wrapping'],
    ['id' => 3, 'name' => 'Express Delivery'],
    ['id' => 4, 'name' => 'Extended Warranty']
];

// Helper function to get category name by ID
function getCategoryName($id) {
    global $categories;
    foreach ($categories as $category) {
        if ($category['id'] == $id) {
            return $category['name'];
        }
    }
    return 'Unknown';
}

// Helper function to get feature names by IDs
function getFeatureNames($ids) {
    global $features;
    $names = [];
    foreach ($features as $feature) {
        if (in_array($feature['id'], $ids)) {
            $names[] = $feature['name'];
        }
    }
    return $names;
}
?>
