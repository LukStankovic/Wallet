{extends file="../templates/layout.tpl"}
{block name="title"}Přihlášení{/block}
{block name="header"}
	<link rel="stylesheet" href="../style/login.css" type="text/css">
{/block}
{block name="body"}
	<a href="register.php" class="regbtn">Registrovat se</a>
	<div class="container">
		<div class="login_blok">
			<form name="login_formular" method="post">
				<div id="login" class="blok_text">
					<h1>Přihlášení</h1>
					<ul class="err">
						{if $status == 0}
							Špatný email, nebo heslo!
						{/if}
						{if $status == 1}
							Nyní se můžete přihlásit!
						{/if}
					</ul>
					<ul>
						<li><input type="text" name="email" id="mail" placeholder="E-mail"></li>
						<li><input type="password" name="heslo" id="pass" placeholder="Heslo"></li>
					</ul>
				</div>
				<button name="login" class="button" type="submit">Přihlásit</button>
			</form>
		</div>
	</div>
{/block}
