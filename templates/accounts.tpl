{extends file="../templates/layout.tpl"}
{block name="title"}Účty{/block}
{block name="header"}
	<link rel="stylesheet" href="../js/remodal/remodal.css">
	<link rel="stylesheet" href="../js/remodal/remodal-default-theme.css">
{/block}
{block name="nav"}
	{include file="../templates/inline/nav.tpl"}
{/block}
{block name="body"}
	<div class="remodal" data-remodal-id="newaccount">
		<button data-remodal-action="close" class="remodal-close"></button>
		<form name="newaccount" method="post">
			<div class="g-radek">
				<div class="sl-5">
					<input type="text" class="white req" name="name" placeholder="Název účtu" required>
				</div>
				<div class="sl-3">
					<input type="text" class="white" name="icon" placeholder="Název FA ikony bez fa-">
				</div>
				<div class="sl-4">
					<select name="currency">
						{foreach from=$allcur item=$cur}
							<option value="{$cur.id}">{$cur.name}</option>
						{/foreach}
					</select>
				</div>
			</div>
			<div class="g-radek">
				<div class="sl-12">
					<textarea class="white" name="desc" placeholder="Popis"></textarea>
				</div>
			</div>
			<div class="g-radek" style="margin-bottom: 0;">
				<div class="sl-12">
					<button name="save" class="btn--confirm btn--right">Uložit</button>
				</div>
			</div>
		</form>
	</div>

	<div class="obal">
		<div class="g-radek">
			<div class="sl-3">
				<div class="box add-new">
					<a data-remodal-target="newaccount">
						<div class="box__header">
							<i class="fa fa-plus-circle" aria-hidden="true"></i> Přidat nový účet
						</div>
					</a>
				</div>
			</div>
		</div>
		<h2>Účty</h2>
        {foreach from=$accounts item=$account}
            {$account.account_name} <br>
        {/foreach}
	</div>
{/block}
{block name="footer"}
	<script src="../js/remodal/remodal.min.js"></script>
{/block}
