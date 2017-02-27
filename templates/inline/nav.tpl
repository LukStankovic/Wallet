<header>
	<nav class="obal">
		<i class="mobile--btn fa fa-bars" aria-hidden="true"></i>
		<ul>
			{foreach from=$menuitems item=$item}
				<li>
					<a href="{$item.url}" {if $selected == $item.url}class="active"{/if}>
						<i class="fa fa-{$item.icon}" aria-hidden="true"></i> {$item.translate}
					</a>
				</li>
			{/foreach}
		</ul>
	</nav>
</header>