{extends file="../templates/layout.tpl"}
{block name="title"}Přihlášení{/block}
{block name="header"}
	<link rel="stylesheet" href="../style/login.css" type="text/css">
{/block}
{block name="body"}
	<div class="container">
		<div class="register_blok">
			<form name="register_form" method="post">
				<div id="login" class="blok_text">
					<h1>Registrace</h1>
					<ul class="err">

					</ul>
					<ul>
						<li><input type="email" name="email" id="mail" class="req" placeholder="E-mail" required></li>
						<li><input type="password" name="pass" id="pass" class="req" placeholder="Heslo" required></li>
						<li><input type="text" name="fname" id="fname" class="req" placeholder="Jméno" required></li>
						<li><input type="text" name="lname" id="lname" class="req" placeholder="Příjmení" required></li>
					</ul>
					<button name="save" class="buttonreg" type="submit">Registrovat</button>
				</div>
			</form>
		</div>
	</div>
{/block}
