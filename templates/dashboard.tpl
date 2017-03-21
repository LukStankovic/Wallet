{extends file="../templates/layout.tpl"}
{block name="title"}Dashboard{/block}
{block name="nav"}
	{include file="../templates/inline/nav.tpl"}
{/block}
{block name="body"}
	<div class="obal">
		<div class="g-radek">
			<div class="sl-3">
				<div class="box add-new">
					<div class="showBlock">
						<div class="box__header">
							<i class="fa fa-plus-circle" aria-hidden="true"></i> Přidat nový záznam
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="block--add-new">
			<h2>Přidat nový záznam</h2>
			<form method="post">
				<div class="g-radek">
					<div class="sl-4">
						<input name="title" type="text" placeholder="Název" class="white req" required>
					</div>
					<div class="sl-2">
						<select name="account">
							{foreach from=$accounts item=$account}
								<option value="{$account.id}">{$account.account_name}</option>
							{/foreach}
						</select>
					</div>
					<div class="sl-2">
						<select name="category">
							{foreach from=$categories item=$category}
								<option value="{$category.id}">{$category.name}</option>
							{/foreach}
						</select>
					</div>
					<div class="sl-2">
						<input name="amount" type="number" placeholder="Částka" class="white req" required>
					</div>
					<div class="sl-2">
						<input name="added" type="datetime-local" placeholder="Datum a čas" class="white req" required>
					</div>
				</div>
				<div class="g-radek">
					<div class="sl-12">
						<textarea name="desc" placeholder="Popis (nepovinné)" class="white"></textarea>
					</div>
				</div>
				<button name="save" class="btn--confirm btn--right">Uložit</button>
			</form>

		</div>
		<div class="g-radek">
			<h2>Poslední přidané záznamy</h2>
			<table class="table">
				<thead>
					<tr>
						<th></th>
						<th>Titulek</th>
						<th>Účet</th>
						<th>Čas</th>
						<th>Částka</th>
					</tr>
				</thead>
				<tbody>
					{foreach from=$latestRecords item=$record}
						<tr>
							<td><i class="fa fa-{$record.icon}"></i></td>
							<td>{$record.title}</td>
							<td>{$record.name}</td>
							<td>{$record.added}</td>
							<td>{$record.amount} {$record.currency_unit}</td>
						</tr>
					{/foreach}
				</tbody>


			</table>
		</div>
	</div>
{/block}
