<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take-Note App</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .main-panel,
        .card {
            margin: 10px;
            overflow-y: auto;
        }

        .note-content {
            max-height: 10em;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">"</a>
        <button class="btn btn-outline-secondary ml-auto" data-toggle="modal" data-target="#addNoteModal">
            <i class="fa fa-plus"></i>
        </button>
    </nav>

    <div class="container mt-4">
        <div class="modal fade" id="addNoteModal" tabindex="-1" role="dialog" aria-labelledby="addNoteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNoteModalLabel">Tambah Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="endpoint/add_note.php">
                            <div class="form-group">
                                <input type="text" class="form-control" id="noteTitle" name="note_title" placeholder="Nama Barang">
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-secondary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <?php
                            include('conn/conn.php');

                            $stmt = $conn->prepare("SELECT * FROM `tbl_notes`");
                            $stmt->execute();

                            $result = $stmt->fetchAll();

                            foreach ($result as $row) {
                                $noteID = $row['tbl_notes_id'];
                                $noteTitle = $row['note_title'];
                                $noteDateTime = $row['date_time'];

                                // Convert the date_time value to a formatted date and time string
                                $formattedDateTime = date('F j, Y H:i A', strtotime($noteDateTime));
                            ?>
                                <li class="list-group-item">
                                    <div class="btn-group float-right">
                                        <button onclick="delete_note('<?php echo $noteID ?>')" type="button" class="btn btn-sm btn-light" title="Remove"><i class="fa fa-trash"></i></button>
                                    </div>
                                    <h3 style="text-transform:uppercase;"><b><?php echo $noteTitle ?></b></h3>
                                    <small class="text-muted"><i class="fa fa-clock-o"></i> <?php echo $formattedDateTime ?></small>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

    <script>
        function delete_note(id) {
            if (confirm("Hapus?")) {
                window.location = "endpoint/delete_note.php?delete=" + id;
            }
        }
    </script>

</body>

</html>