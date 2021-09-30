<footer class='py-3 border-top text-center'>
    <x-vue id="footer_vue">
        @isset ($module)
            <div class="container" v-if="count !== null">
                <x-table class="w-100 h-100">
                    <tr>
                        <td align="left" v-if="count > 0">Записей: <strong>@{{ count }}</strong></td>
                        <td align="left" v-else>[-]</td>
                    </tr>
                </x-table>
            </div>
            <div class="container" v-else>
                &nbsp;
            </div>
        @else
            <div class="container">
                &nbsp;
            </div>
        @endisset

        
    </x-vue>
</footer>
