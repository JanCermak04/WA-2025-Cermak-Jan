<?php
require_once '../../models/Database.php';
require_once '../../models/Book.php';

$db = (new Database())->getConnection();
$bookModel = new Book($db);
$books = $bookModel->getAll();

$editMode = false;
$bookToEdit = null;

if (isset($_GET['edit'])) {
    $editId = (int)$_GET['edit'];
    $bookToEdit = $bookModel->getById($editId);
    if ($bookToEdit) {
        $editMode = true;
    }
}
?>


<!-- HTML a tabulka, jak jsi poslal -->
<h2>Výpis knih</h2>
<?php if (!empty($books)): ?>
    <table class="table table-bordered table-hover">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Název</th>
                <th>Autor</th>
                <th>Kategorie</th>
                <th>Rok</th>
                <th>Cena</th>
                <th>ISBN</th>
                <th>Akce</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($books as $book): ?>
            <tr>
                <td><?= htmlspecialchars($book['id']) ?></td>
                <td><?= htmlspecialchars($book['title']) ?></td>
                <td><?= htmlspecialchars($book['author']) ?></td>
                <td><?= htmlspecialchars($book['category']) ?></td>
                <td><?= htmlspecialchars($book['year']) ?></td>
                <td><?= number_format($book['price'], 2, ',', ' ') ?> Kč</td>
                <td><?= htmlspecialchars($book['isbn']) ?></td>
                <td>
                    <a href="?edit=<?= $book['id'] ?>" class="btn btn-sm btn-warning">Upravit</a>
                    <a href="../../controllers/book_delete.php?id=<?= $book['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Opravdu chcete smazat tuto knihu?');">Smazat</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="alert alert-info">Žádná kniha nebyla nalezena.</div>
<?php endif; ?>
