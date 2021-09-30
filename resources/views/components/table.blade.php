<table {{$attributes->class([
	'',
])->merge([
	'border' => '0',
	'cellpadding' => '0',
	'cellspacing' => '0',
])}}>
	{{ $slot }}
</table>