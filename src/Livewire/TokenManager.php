<?php

namespace Yuloma\SanctumTokenManager\Livewire;

use Livewire\Component;
use Laravel\Sanctum\PersonalAccessToken;

class TokenManager extends Component
{
    public $name;
    public $tokens;

    public function mount()
    {
        $this->tokens = auth()->user()->tokens;
    }

    public function createToken()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        $token = auth()->user()->createToken($this->name);

        session()->flash('token', $token->plainTextToken);

        $this->tokens = auth()->user()->tokens;
    }

    public function deleteToken($tokenId)
    {
        $token = PersonalAccessToken::find($tokenId);
        $token->delete();

        session()->flash('message', __('sanctum-token-manager::messages.token-deleted'));
        $this->tokens = auth()->user()->tokens;
    }

    public function render()
    {
        $view = view('sanctum-token-manager::livewire.token-manager');

        if ($layout = config('sanctum_token_manager.livewire_layout')) {
            return $view->layout($layout);
        }

        return $view;
    }
}
