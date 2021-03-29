@extends('layouts.layout')

@section('content')
<div class="row mx-0">
	<div class="col-md-8">
		<select id = "nbPlayer">
		<option value = "0"></option>
		@for ($i = $playerMin; $i <= $playerMax; $i++)
			<option value = "{{$i}}"> {{$i}} </option>
		@endfor
		</select>
	</div>
</div>
<div class="row mx-0">
	<div class="col-md-8" id = "resultCommanderMix">
	</div>
</div>

@endsection

@section('js')
<script>
        (() => {
            // Variables
            const headers = {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }

			//Show CommanderMix
            const showCommanderMix = e => {
				var nbPlayer = document.getElementById(e.target.id).value;
                e.preventDefault();
                showCommander(nbPlayer);
            }
            // Show commander
            const showCommander = async (nbPlayer) => {

				var url = '{{ route("commandermix.gamble", ":nbPlayer") }}';
				url = url.replace(':nbPlayer', nbPlayer);
                // Send request
                const response = await fetch(url, {
                    method: 'GET',
                    headers: headers
                });
                // Wait for response
                const data = await response.json();
                console.warn(data); //test
                document.getElementById('resultCommanderMix').innerHTML = data.html;
            }
            // Listener wrapper
            const wrapper = (selector, type, callback, condition = 'true', capture = false) => {
                const element = document.querySelector(selector);
                if(element) {
                    document.querySelector(selector).addEventListener(type, e => {
                        if(eval(condition)) {
                            callback(e);
                        }
                    }, capture);
                }
            };
            // Set listeners
            window.addEventListener('DOMContentLoaded', () => {
                wrapper('#nbPlayer', 'change', showCommanderMix);
            })
        })()
    </script>
@endsection