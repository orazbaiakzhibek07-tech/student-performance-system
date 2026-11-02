<?php
require 'includes/db.php';
require 'includes/functions.php';
require_login();

$errors = [];

// Студент қосу (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_csrf();
    $name  = trim($_POST['full_name'] ?? '');
    $group = trim($_POST['group_name'] ?? '');

    if (mb_strlen($name) < 3) $errors[] = 'Студент аты-жөні кемінде 3 таңба болуы керек.';
    if ($group === '' || mb_strlen($group) > 30) $errors[] = 'Топ атауын дұрыс енгізіңіз.';

    if (!$errors) {
        $stmt = $pdo->prepare('INSERT INTO students (full_name, group_name, created_by) VALUES (?, ?, ?)');
        $stmt->execute([$name, $group, $_SESSION['user_id']]);
        set_flash('success', 'Студент қосылды.');
        header('Location: dashboard.php');
        exit;
    }
}

// Іздеу (GET)
$q = trim($_GET['q'] ?? '');
$sql = 'SELECT s.id, s.full_name, s.group_name, ROUND(AVG(g.grade), 1) AS avg_grade, COUNT(g.id) AS grades_count
        FROM students s LEFT JOIN grades g ON g.student_id = s.id
        WHERE s.created_by = :uid';
$params = [':uid' => $_SESSION['user_id']];
if ($q !== '') {
    $sql .= ' AND (s.full_name LIKE :q OR s.group_name LIKE :q)';
    $params[':q'] = "%$q%";
}
$sql .= ' GROUP BY s.id ORDER BY s.full_name';
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$students = $stmt->fetchAll();

$pageTitle = 'Басқару панелі';
require 'includes/header.php';
?>
<h2>Басқару панелі</h2>

<div class="grid-2">
  <div class="card">
    <h3>Жаңа студент қосу</h3>
    <?php foreach ($errors as $err): ?>
      <div class="alert error"><?= e($err) ?></div>
    <?php endforeach; ?>
    <form method="POST" id="studentForm" novalidate>
      <?= csrf_field() ?>
      <label>Аты-жөні <input type="text" name="full_name" required></label>
      <label>Топ <input type="text" name="group_name" placeholder="Мыс: ИС-21" required></label>
      <button class="btn" type="submit">Қосу</button>
    </form>
  </div>

  <div class="card">
    <h3>Іздеу</h3>
    <form method="GET">
      <label>Аты немесе тобы
        <input type="text" name="q" value="<?= e($q) ?>" placeholder="Іздеу...">
      </label>
      <button class="btn" type="submit">Іздеу</button>
      <a class="btn btn-outline" href="dashboard.php">Тазалау</a>
    </form>
  </div>
</div>

<h3>Студенттер тізімі (<?= count($students) ?>)</h3>
<div class="table-wrap">
<table>
  <thead>
    <tr><th>#</th><th>Аты-жөні</th><th>Топ</th><th>Бағалар саны</th><th>Орташа балл</th></tr>
  </thead>
  <tbody>
  <?php if (!$students): ?>
    <tr><td colspan="5">Студенттер табылмады.</td></tr>
  <?php endif; ?>
  <?php foreach ($students as $i => $s): ?>
    <tr>
      <td><?= $i + 1 ?></td>
      <td><?= e($s['full_name']) ?></td>
      <td><?= e($s['group_name']) ?></td>
      <td><?= (int)$s['grades_count'] ?></td>
      <td><?= $s['avg_grade'] !== null ? e($s['avg_grade']) : '—' ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
</div>
<?php require 'includes/footer.php'; ?>
