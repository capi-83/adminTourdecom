@if ($commanderMix)
<div>
	<p>
		<table border="1">
			@for ($i = 1; $i <= $nbplayer; $i++)
				<tr>
					<th> {{__('commanderMix.playerNumber')}} {{$i}} </th>
					@foreach ($commanderMix[$i-1] as $value)
						<td>
							<a href="{{$value->decklist}}" target="blank">{{__('commanderMix.'.$value->commander)}}</a>
							<i class="mi mi-{{$value->color}} mi-mana"></i>
						</td>
					@endforeach
				</tr>
			@endfor
		</table>
	</p>
</div>
@else
	{{__('commanderMix.failed')}}
@endif