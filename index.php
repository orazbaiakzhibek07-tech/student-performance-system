<?php
$pageTitle = 'Басты бет';
require 'includes/header.php';
?>
<section class="hero">
  <h1>Студенттердің үлгерімін есепке алу жүйесі</h1>
  <p>Студенттерді тіркеңіз, пәндер бойынша бағаларды енгізіңіз және орташа балды бақылаңыз.</p>
  <?php if (!is_logged_in()): ?>
    <a class="btn" href="register.php">Бастау</a>
    <a class="btn btn-outline" href="login.php">Кіру</a>
  <?php else: ?>
    <a class="btn" href="dashboard.php">Басқару панеліне өту</a>
  <?php endif; ?>
</section>

<section class="features">
  <div class="card"><h3>👩‍🎓 Студенттер</h3><p>Студент тізімін қосу және басқару.</p></div>
  <div class="card"><h3>📝 Бағалар</h3><p>Пәндер бойынша бағаларды есепке алу.</p></div>
  <div class="card"><h3>🔍 Іздеу</h3><p>Аты немесе тобы бойынша жылдам іздеу.</p></div>
</section>
<?php require 'includes/footer.php'; ?>
