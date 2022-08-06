<?php

/**
 * Joins different paths into one
 * @return string The new absolute/relative path
 */
function j(): string
{
  return join(DIRECTORY_SEPARATOR, func_get_args());
}

$current_date = date('d/m/Y', time());
$current_date = date('Y-m-d', time());

if (isset($_POST['entry']['day'])) {
  $current_date = $_POST['entry']['day'];
}

$conn = null;

require_once j(__DIR__, 'config.php');
require_once j(__DIR__, 'db.php');
require_once j(__DIR__, 'form.php');

$entry = get_entry_by_date($current_date);

checkSubmit();

?>

<!DOCTYPE html>
<html lang="en" class="w-100 h-100">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Life Organizer</title>

  <!--
    EXTERNAL DEPENDENCIES
  -->

  <!-- BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body class="d-flex justify-content-center w-100 h-100">

  <div class="container-md w-100 h-100">
    <form method="GET" action="" class="p-3 shadow rounded m-sm-3 form" style="max-width: 350px;">
      <label for="date" class="form-label">Current date:</label>
      <div class="input-group">
        <input type="date" class="form-control" name="date" value="<?= $current_date ?>">
        <input type="submit" class="input-group-btn btn btn-primary" name="submit" value="Change!">
      </div>
    </form>
    <form method="POST" action="" class="p-3 shadow rounded m-sm-3 form">
      <legend class="legend mb-3">Notepad formulary for <?= $current_date ?></legend>

      <!-- SECURITY RISK, BUT IT'S JUST A POC -->
      <input type="hidden" name="entry[day]" value="<?= $current_date ?>">
      <input type="hidden" name="entry[id]" id="entryId" value="<?= $entry['id'] ?>">

      <textarea type=" text" class="form-control textarea" id="entryText" name="entry[text]"><?= $entry['text'] ?></textarea>

      <div class="btn-group w-100">
        <input type="submit" name="submit" value="Save/Update" class="btn btn-success">
      </div>
    </form>
  </div>
</body>

</html>