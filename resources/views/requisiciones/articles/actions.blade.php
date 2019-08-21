<ul class="header-dropdown m-r--5">
<li class="dropdown" style="list-style:none">
    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
        <i class="material-icons">more_horiz</i>
    </a>
    <ul class="dropdown-menu pull-right">
    	@can('article.edit')
        <li><a href="{{ route('article.edit', $id) }}">Editar</a></li>
    	@endcan
        <li><a href="{{ route('article.active', $id) }}">Inactivar</a></li>
    </ul>
</li>
</ul>