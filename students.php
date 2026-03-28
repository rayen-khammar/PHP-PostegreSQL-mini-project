<?php
session_start();
require_once 'autoload.php';
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}
$role = $_SESSION['role'];
$bdd = ConnexionBD::getInstance();
$repo = new StudentsRepository();

if (isset($_GET['section'])) {
    $students = $repo->findBySection($_GET['section']);
} else {
    $students = $repo->findAllWithSection();
}

if ($role == 'admin') {
    $sections = $bdd->query("SELECT * FROM section")->fetchAll();
}
?>
<!DOCTYPE html>
<html data-bs-theme="dark" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.bootstrap5.min.css">
</head>

<body>

    <?php include 'navbar.php'; ?>

    <div class="container mt-4">
        <?php if ($role == 'admin'): ?>
            <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="bi bi-person-add"></i> Add Student
            </button>
        <?php endif; ?>

        <table id="studentsTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Date de naissance</th>
                    <th>Section</th>
                    <?php if ($role == 'admin'): ?>
                        <th>Actions</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?php echo $student->id; ?></td>
                        <td>
                            <?php if ($student->img): ?>
                                <img src="<?php echo htmlspecialchars($student->img); ?>" width="50" height="50"
                                    style="object-fit:cover; border-radius:50%;">
                            <?php else: ?>
                                <span>No image</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($student->name); ?></td>
                        <td><?php echo $student->date_de_naiss; ?></td>
                        <td><?php echo htmlspecialchars($student->section); ?></td>
                        <?php if ($role == 'admin'): ?>
                            <td>
                                <button class="btn btn-sm btn-primary edit-btn" data-id="<?php echo $student->id; ?>"
                                    data-name="<?php echo htmlspecialchars($student->name); ?>"
                                    data-date="<?php echo $student->date_de_naiss; ?>"
                                    data-section="<?php echo $student->section_id; ?>"" data-bs-toggle="modal"
                                    data-bs-target="#editModal">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-danger delete-btn" data-id="<?php echo $student->id; ?>"
                                    data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php if ($role == 'admin'): ?>

        <!-- Add Modal -->
        <div class="modal fade" id="addModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Student</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addForm">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" id="addName" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Photo</label>
                                <input type="file" name="img" id="addImg" class="form-control" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Date de naissance</label>
                                <input type="date" name="date_de_naiss" id="addDate" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Section</label>
                                <select name="section" id="addSection" class="form-select">
                                    <?php foreach ($sections as $sec): ?>
                                        <option value="<?php echo $sec['id']; ?>"><?php echo $sec['des']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" id="confirmAdd">Add</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Student</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm">
                            <input type="hidden" id="editId">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" id="editName" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Date de naissance</label>
                                <input type="date" id="editDate" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Section</label>
                                <select id="editSection" class="form-select">
                                    <?php foreach ($sections as $sec): ?>
                                        <option value="<?php echo $sec['id']; ?>"><?php echo $sec['des']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-warning" id="confirmEdit">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Student</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="deleteId">
                        Are you sure you want to delete this student?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>

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
        const table = new DataTable('#studentsTable', {
            layout: {
                topStart: 'buttons'
            },
            buttons: [
                { extend: 'copy', text: '<i class="bi bi-clipboard"></i> Copy', className: 'btn btn-secondary btn-sm' },
                { extend: 'excel', text: '<i class="bi bi-file-earmark-excel"></i> Excel', className: 'btn btn-success btn-sm' },
                { extend: 'csv', text: '<i class="bi bi-filetype-csv"></i> CSV', className: 'btn btn-primary btn-sm' },
                { extend: 'pdf', text: '<i class="bi bi-file-earmark-pdf"></i> PDF', className: 'btn btn-danger btn-sm' },
            ]
        });

        <?php if ($role == 'admin'): ?>

            document.querySelectorAll('.edit-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    document.getElementById('editId').value = this.dataset.id;
                    document.getElementById('editName').value = this.dataset.name;
                    document.getElementById('editDate').value = this.dataset.date;
                    document.getElementById('editSection').value = this.dataset.section;
                });
            });

            document.addEventListener('click', function (e) {
                const btn = e.target.closest('.delete-btn');
                if (btn) {
                    document.getElementById('deleteId').value = btn.dataset.id;
                }
            });

            // ADD
            document.getElementById('confirmAdd').addEventListener('click', function () {
                const formData = new FormData();
                formData.append('action', 'add');
                formData.append('name', document.getElementById('addName').value);
                formData.append('date', document.getElementById('addDate').value);
                formData.append('section', document.getElementById('addSection').value);
                formData.append('img', document.getElementById('addImg').files[0]);

                fetch('studentsAction.php', { method: 'POST', body: formData })
                    .then(res => res.json())
                    .then(data => { if (data.success) location.reload(); });
            });

            // EDIT
            document.getElementById('confirmEdit').addEventListener('click', function () {
                const formData = new FormData();
                formData.append('action', 'edit');
                formData.append('id', document.getElementById('editId').value);
                formData.append('name', document.getElementById('editName').value);
                formData.append('date', document.getElementById('editDate').value);
                formData.append('section', document.getElementById('editSection').value);

                fetch('studentsAction.php', { method: 'POST', body: formData })
                    .then(res => res.json())
                    .then(data => { if (data.success) location.reload(); });
            });

            // DELETE
            document.getElementById('confirmDelete').addEventListener('click', function () {
                const formData = new FormData();
                formData.append('action', 'delete');
                formData.append('id', document.getElementById('deleteId').value);

                fetch('studentsAction.php', { method: 'POST', body: formData })
                    .then(res => res.json())
                    .then(data => { if (data.success) location.reload(); });
            });

        <?php endif; ?>
    </script>

</body>

</html>