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
                    <a href="newrecord.php">
                        <div class="box__header">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i> Přidat nový záznam
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <h2>Dashboard</h2>
    </div>
{/block}
