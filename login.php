<?php
$pageTitle = 'Кіру';
require 'includes/header.php';
$old = $_SESSION['old'] ?? [];
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['old'], $_SESSION['errors']);
?>
<div class="form-box">
  <h2>Кіру</h2>
  <?php foreach ($errors as $err): ?>
    <div class="alert error"><?= e($err) ?></div>
  <?php endforeach; ?>
  <form action="actions/login_action.php" method="POST" id="loginForm" novalidate>
    <?= csrf_field() ?>
    <label>Email
      <input type="email" name="email" value="<?= e($old['email'] ?? '') ?>" required>
    </label>
    <label>Құпиясөз
      <input type="password" name="password" required>
    </label>
    <button class="btn" type="submit">Кіру</button>
  </form>
  <p>Аккаунт жоқ па? <a href="register.php">Тіркелу</a></p>
</div>
<?php require 'includes/footer.php'; ?>
