<?php
$pageTitle = 'Тіркелу';
require 'includes/header.php';
$old = $_SESSION['old'] ?? [];
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['old'], $_SESSION['errors']);
?>
<div class="form-box">
  <h2>Тіркелу</h2>
  <?php foreach ($errors as $err): ?>
    <div class="alert error"><?= e($err) ?></div>
  <?php endforeach; ?>
  <form action="actions/register_action.php" method="POST" id="registerForm" novalidate>
    <?= csrf_field() ?>
    <label>Аты-жөні
      <input type="text" name="full_name" value="<?= e($old['full_name'] ?? '') ?>" required>
    </label>
    <label>Email
      <input type="email" name="email" value="<?= e($old['email'] ?? '') ?>" required>
    </label>
    <label>Құпиясөз (кемінде 6 таңба)
      <input type="password" name="password" required>
    </label>
    <label>Құпиясөзді қайталаңыз
      <input type="password" name="password2" required>
    </label>
    <button class="btn" type="submit">Тіркелу</button>
  </form>
  <p>Аккаунтыңыз бар ма? <a href="login.php">Кіру</a></p>
</div>
<?php require 'includes/footer.php'; ?>
