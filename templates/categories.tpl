{extends file="../templates/layout.tpl"}
{block name="title"}Kategorie{/block}
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
							<i class="fa fa-plus-circle" aria-hidden="true"></i> Přidat novou kategorii
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="block--add-new">
			<h2>Přidat nový záznam</h2>
			<form method="post">

				<button name="save" class="btn--confirm btn--right">Uložit</button>
			</form>

		</div>
		<div class="g-radek">
			<h2>Kategorie</h2>
			<table class="table">
				<thead>
					<tr>
						<th>Titulek</th>
						<th>Typ</th>
					</tr>
				</thead>
				<tbody>
					{foreach from=$categories item=$category}
						<tr>
							<td><i class="fa fa-{$category.icon}"></i> {$category.name}</td>
							<td>{($category.type == 1) ? "Příjem" : "Výdaj"}</td>
						</tr>
					{/foreach}
				</tbody>


			</table>
		</div>
	</div>
{/block}
