<?php require_once join(DIRECTORY_SEPARATOR, [__DIR__, 'form.php']); ?>

<!DOCTYPE html>
<html lang="en" class="w-100 h-100">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Life Organizer</title>

  <!-- EXTERNAL DEPENDENCIES -->

  <!-- BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body class="d-flex justify-content-center w-100 h-100">

  <div class="container-md w-100 h-100">
    <form method="POST" action="" class="p-3 shadow rounded m-sm-3">
      <legend class="legend mb-3">Notepad formulary for <?= $current_date ?></legend>

      <?php if ($entries) : ?>
        <?php foreach ($entries as $entry_index => $entry) : ?>
          <fieldset class="rounded mb-3">
            <input type="hidden" name="entries[id][] ?>]" value="<?= $entry['id'] ?>" />
            <textarea type=" text" class="form-control textarea" id="<?= $entry['id'] ?>" name="entries[text][] ?>]"><?= $entry['text'] ?></textarea>
            <small class="text-muted">Last updated at: <?= $entry['updated_at'] ?></small>
          </fieldset>
        <?php endforeach; ?>
      <?php endif; ?>

      <div class="btn-group w-100">
        <input type="submit" value="Save/Update" class="btn btn-success">
      </div>
    </form>
  </div>
</body>

</html>