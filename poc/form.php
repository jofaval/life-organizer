<?php

define('DATE_FORMAT', 'd/m/Y H:i:s');
$current_date = date('d/m/Y', time());

/**
 * Zips the entries so that all the parameters are at the same level
 * @param array $entries The raw unzipped entries
 * @return array The entries
 */
function zip_entries(array $entries): array
{
    // Zips without keys N number of arrays
    $new_entries = array_map(null, $entries['id'], $entries['text']);

    // Only compute if there's values, if not, just return the new empty array
    if (empty($new_entries)) {
        return $new_entries;
    }

    // Retrieves the keys
    $old_keys = array_keys($new_entries[0]);
    $new_keys = array_keys($entries[0]);

    // Remaps the mapped keys to the real keys
    foreach ($old_keys as $index => $old_key) {
        $new_entries[$new_keys[$index]] = $new_entries[$old_key];
        unset($new_entries[$old_key]);
    }

    return $new_entries;
}

$entries = [];
echo '<pre>';
// var_dump($_POST);
if (isset($_POST['entries'])) var_dump(zip_entries($_POST['entries']));
echo '</pre>';
if (isset($_POST['entries'])) {
    $entries = $_POST['entries'];
    $entries = array_merge($entries);
    $element = array_map(function (array $element): array {
        $new_element = $element;
        $new_element['updated_at'] = date(DATE_FORMAT, time());
        return $new_element;
    }, $entries);
}

for ($entry_id = 0; $entry_id < 5; $entry_id++) {
    $entries[] = [
        'id' => $entry_id,
        'updated_at' => date(DATE_FORMAT, time()),
        'text' => 'Lorem ipsum dolor sit amet',
    ];
}
