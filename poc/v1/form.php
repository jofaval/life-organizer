<?php

/**
 * Quotes a DB field
 * @param string $value The raw value
 * @return string The properly quoted value
 */
function parseDbFields(string $value): string
{
  return "`$value`";
}

/**
 * Quotes a DB value
 * @param string $value The raw value
 * @return string The properly quoted value
 */
function parseDbValues(string $value): string
{
  return "'$value'";
}

function getUpdateQuery(array $entry): string
{
  $temp_entry = $entry;
  $temp_entry['updated_at'] = date('Y-m-d H:i:s', time());
  unset($temp_entry['id']);

  // Generate the fields assignation
  array_walk($temp_entry, function (string &$value, string $key): void {
    $value = "`{$key}`='{$value}'";
  });
  $fields = join(', ', $temp_entry);

  return "UPDATE journal SET {$fields} WHERE `day` = '{$entry['day']}'";
}

function getInsertQuery(array $entry): string
{
  $temp_entry = $entry;
  $temp_entry['created_at'] = date('Y-m-d H:i:s', time());
  $temp_entry['updated_at'] = date('Y-m-d H:i:s', time());
  unset($temp_entry['id']);

  $columns = join(', ', array_keys($temp_entry));
  $values = join(', ', array_map('parseDbValues', array_values($temp_entry)));
  return "INSERT INTO journal({$columns}) VALUES ($values)";
}

function saveOrUpdate(): void
{
  global $entry, $conn;

  if (isset($_POST['entry'])) $entry = $_POST['entry'];
  $query = '';
  $alreadyExists = $entry['id'] != -1;

  if ($alreadyExists) {
    $query = getUpdateQuery($entry);
  } else {
    $query = getInsertQuery($entry);
  }

  $success = mysqli_query($conn, $query);

  if (!$alreadyExists) {
    // Retrieve the new entry object
    $query_result = mysqli_query(
      $conn,
      "SELECT * FROM journal WHERE `day` = '{$entry['day']}' LIMIT 1"
    );
    // echo '<pre>';
    // var_dump('Query result');
    // var_dump($query_result);
    // echo '</pre>';

    $entry = $query_result->fetch_assoc();
  }

  echo '<pre>';
  var_dump($success);
  var_dump($query);
  var_dump($_POST);
  echo '</pre>';
}

function changeDate(): void
{
  global $current_date;

  // var_dump($_GET['date']);
  $current_date = $_GET['date'];
}

function get_entry_by_date(string $date): array
{
  global $conn;

  $query_result = $conn->query("SELECT * FROM journal WHERE `day` = '{$date}' LIMIT 1");

  if ($query_result->num_rows > 0) {
    // var_dump("SELECT * FROM journal WHERE `day` = '{$date}'", $query_result);
    return $query_result->fetch_assoc();
  }

  return ['id' => -1, 'text' => date('d/m/Y H:i:s', time())];
}

function checkPost(): void
{
  switch ($_POST['submit']) {
    case 'Save/Update':
      saveOrUpdate();
      break;
  }
}

function checkGet(): void
{
  switch ($_GET['submit']) {
    case 'Change!':
      changeDate();
      break;
  }
}

function checkSubmit(): void
{
  if (!empty($_POST)) checkPost();
  if (!empty($_GET)) checkGet();
}
