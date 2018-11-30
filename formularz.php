	<form id="register" action="register.php" method="post">
		<p><b>Zarejestruj się jeśli to Twoje pierwsze odwiedziny na stronie.</b></br></br>
		Nazwa użytkownika:
		<input type="text" value="" name="user_name"/></p>
		<p>E - mail kontaktowy:
		<input type="text" value="" name="user_email"/></p>
		<p>Wpisz hasło:
		<input type="password" value="" name="user_password"/></p>
		<p>Powtórz hasło:
		<input type="password" value="" name="user_password_repeat"/></p>
		<input type="submit" value="Zarejestruj się!" name="submit"/>
	</form>
	<form id="log_on" action="log_on.php" method="post">
		<p><b>Masz konto? Zaloguj się.</b></br></br>
		Nazwa użytkownika:
		<input type="text" value="" name="log_on_name"/></p>
		<p>Hasło:
		<input type="password" value="" name="log_on_password"/></p>
		<input type="submit" value="Zaloguj się!" name="submit"/>
	</form>
