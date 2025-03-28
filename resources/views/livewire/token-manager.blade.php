<div>
	<h2 class="text-xl font-semibold text-gray-800 mb-2">{{ __('sanctum-token-manager::labels.api-tokens') }}</h2>

	@if (session('token'))
		<div class="alert alert-success text-green-700">
			{{ __('sanctum-token-manager::messages.token-generated') }}:
			<code>{{ session('token') }}</code>
		</div>
	@endif

	@if (session('message'))
		<div class="alert alert-info">
			{{ session('message') }}
		</div>
	@endif

	<div class="bg-white p-6 rounded-lg shadow-md">
		<form wire:submit.prevent="createToken">
			<div class="mb-4">
				<label for="token" class="block text-sm font-medium text-gray-700">{{ __('sanctum-token-manager::labels.new-token') }}</label>
				<input
					type="text"
					id="name"
					wire:model="name"
					class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
			</div>

			<div class="mt-4">
				<button
					type="submit"
					class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-50 transition ease-in-out duration-150">
					{{ __('sanctum-token-manager::labels.generate') }}
				</button>
			</div>
		</form>
	</div>

	<hr />

	<h3 class="text-xl font-semibold text-gray-800 mt-5 mb-2">{{ __('sanctum-token-manager::labels.current-tokens') }}</h3>
	<div class="overflow-x-auto bg-white shadow-md rounded-lg">
		<div class="overflow-x-auto bg-white shadow-md rounded-lg">
			@if ($tokens->isEmpty())
				<div class="p-4 text-center text-gray-500">
					<p>{{ __('sanctum-token-manager::labels.no-tokens-found') }}</p>
				</div>
			@else
				<table class="min-w-full divide-y divide-gray-200">
					<thead class="bg-gray-50">
						<tr>
							<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
								{{ __('sanctum-token-manager::labels.token-name') }}
							</th>
							<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
								{{ __('sanctum-token-manager::labels.generation-date') }}
							</th>
							<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
								{{ __('sanctum-token-manager::labels.actions') }}
							</th>
						</tr>
					</thead>
					<tbody class="bg-white divide-y divide-gray-200">
						@foreach ($tokens as $token)
							<tr>
								<td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $token->name }}</td>
								<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $token->created_at->format('d/m/Y H:i') }}</td>
								<td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600 hover:text-blue-900">
									<a
										class="inline-flex items-center px-4 py-2 bg-red-800 dark:bg-red-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-white-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-50 transition ease-in-out duration-150"
										wire:click="deleteToken({{ $token->id }})"
										title="@lang('sanctum-token-manager::labels.delete')"
										onclick="confirm('Are you sure you want to remove this Record?') || event.stopImmediatePropagation()">
										{{ __('sanctum-token-manager::labels.delete') }}
									</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			@endif
		</div>
	</div>
</div>
