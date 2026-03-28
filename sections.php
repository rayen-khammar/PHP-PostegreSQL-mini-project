<?php
session_start();
require_once 'autoload.php';

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}

$role = $_SESSION['role'];
$repo = new SectionsRepository();
$sections = $repo->findAll();
?>
<!DOCTYPE html>
<html data-bs-theme="dark" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sections</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.bootstrap5.min.css">
</head>

<body>

<?php include 'navbar.php'; ?>

<div class="container mt-4">
    <table id="sectionsTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Designation</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sections as $sec): ?>
                <tr>
                    <td><?php echo $sec->id; ?></td>
                    <td><?php echo htmlspecialchars($sec->des); ?></td>
                    <td><?php echo htmlspecialchars($sec->description); ?></td>
                    <td>
                        <a href="students.php?section=<?php echo $sec->id; ?>" class="btn btn-sm btn-info">
                            <i class="bi bi-list-ul"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.print.min.js"></script>

<script>
    const table = new DataTable('#sectionsTable', {
        layout: {
            topStart: 'buttons'
        },
        buttons: [
            { extend: 'copy',  text: '<i class="bi bi-clipboard"></i> Copy',  className: 'btn btn-secondary btn-sm' },
            { extend: 'excel', text: '<i class="bi bi-file-earmark-excel"></i> Excel', className: 'btn btn-success btn-sm' },
            { extend: 'csv',   text: '<i class="bi bi-filetype-csv"></i> CSV',   className: 'btn btn-primary btn-sm' },
            { extend: 'pdf',   text: '<i class="bi bi-file-earmark-pdf"></i> PDF',   className: 'btn btn-danger btn-sm' },
        ]
    });
</script>

</body>
</html>