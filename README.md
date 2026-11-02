# Студенттердің үлгерімін есепке алу жүйесі

PHP + MySQL веб-қосымшасы.

## Мақсаты
Оқытушыға студенттерді тіркеп, пәндер бойынша бағаларды есепке алуға және орташа балды бақылауға мүмкіндік беру.

## Беттер тізімі
- index.php — басты бет
- register.php — тіркелу
- login.php — кіру
- dashboard.php — студенттер тізімі, қосу, іздеу
- logout.php — шығу

## Дерекқор (ER)
users (1) — (N) students (1) — (N) grades (N) — (1) subjects

## Орнату
1. XAMPP/OpenServer-де Apache және MySQL қосыңыз.
2. `database.sql` файлын phpMyAdmin арқылы импорттаңыз.
3. Жоба қалтасын `htdocs`-қа салыңыз.
4. `includes/db.php` ішіндегі логин/құпиясөзді тексеріңіз.
5. Браузерде `http://localhost/student-performance-system/` ашыңыз.
