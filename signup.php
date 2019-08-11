<?php
require"header.php"
?>

<main>
<div class="wrapper-main">
<section class="section-default">
<h1>لقد خرجت!</h1>
<form action="includes/signup.inc.php" method="post">
<input type="text" name="uid" placeholder="اسم المستخدم">
<input type="text" name="mail" placeholder="البريد الإلكتروني">
<input type="password" name="pwd" placeholder="  كلمه السر">
<input type="password" name="pwd-repeat" placeholder="اعد كلمة السر">
<button type="submit" name="signup-submit">سجل</button>

</form>
</section>
</div>
</main>


<?php
require "footer.php"
?>