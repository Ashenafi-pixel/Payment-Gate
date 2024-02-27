<?php

namespace App\Http\Controllers\Merchant;
use App\Models\ApiKey;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiKeyController extends Controller
{
    //
    public function activateKey($id)
    {
        $key = ApiKey::findOrFail($id);
        $key->update(['is_enabled' => true]);

        return redirect()->back()->with('success', 'Key activated successfully.');
    }

    public function deactivateKey($id)
    {
        $key = ApiKey::findOrFail($id);
        $key->update(['is_enabled' => false]);

        return redirect()->back()->with('success', 'Key deactivated successfully.');
    }
}
