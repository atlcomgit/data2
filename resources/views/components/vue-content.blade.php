<style>
    .div-content {
        position: absolute; left: 0; right: 0; top: 0; bottom: 0;
        width:100%; height:100%; overflow-x:hidden; overflow-y:auto;
        }
</style>

<div class="div-content" id="content_vue">
	{{ $slot }}
</div>
