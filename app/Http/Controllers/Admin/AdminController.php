<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function showForm()
    {
        $users = User::all();

        return view('backend.admin.form', compact('users'));
    }

    public function generateKeys(Request $request)
    {
        $userIds = $request->input('user_ids', []);

        foreach ($userIds as $userId) {
            $user = User::find($userId);

            if ($user) {
                $keys = $this->generateKeyPair();

                // Encode the public key with base64
                $encodedPublicKey = base64_encode($keys['public_key']);
                // Extract the key without delimiters
                $publicKeyWithoutDelimiters = str_replace(["-----BEGIN PUBLIC KEY-----", "-----END PUBLIC KEY-----", "\n", "\r"], '', $keys['public_key']);

                // Encode the private key with base64
                $encodedPrivateKey = base64_encode($keys['private_key']);
                // Extract the key without delimiters
                $privateKeyWithoutDelimiters = str_replace(["-----BEGIN PRIVATE KEY-----", "-----END PRIVATE KEY-----", "\n", "\r"], '', $keys['private_key']);

                // Log the generated keys
                Log::debug("Generated keys for user $userId:\nPublic Key:\n{$encodedPublicKey}\nPrivate Key:\n{$encodedPrivateKey}");

                // Log the user's existing keys before the update
                Log::debug("Before Update - User $userId:\nPublic Key:\n{$user->public_key}\nPrivate Key:\n{$user->private_key}");

                // Check for errors during the update
                if (!$user->update([
                    'public_key' => $encodedPublicKey,
                    'public_key_without_delimiters' => $publicKeyWithoutDelimiters,
                    'private_key' => $encodedPrivateKey,
                    'private_key_without_delimiters' => $privateKeyWithoutDelimiters,
                ])) {
                    Log::error("Error updating keys for user $userId");
                    return redirect()->back()->with('error', 'Error updating keys for user ' . $userId);
                }

                // Log the user's keys after the update
                Log::debug("After Update - User $userId:\nPublic Key:\n{$user->public_key}\nPrivate Key:\n{$user->private_key}");
            } else {
                Log::error("User not found with ID $userId");
                return redirect()->back()->with('error', 'User not found with ID ' . $userId);
            }
        }

        return redirect()->back()->with('success', 'Keys generated and updated successfully.');
    }

    private function generateKeyPair()
    {
        // Check if OpenSSL is available
        if (!function_exists('openssl_pkey_new')) {
            Log::error('OpenSSL extension is not available.');
            return redirect()->back()->with('error', 'Error generating keys. OpenSSL extension is not available.');
        }

        // Generate a new OpenSSL key pair
        $config = [
            'private_key_bits' => 2048,
            'private_key_type' => OPENSSL_KEYTYPE_RSA,
        ];

        $res = openssl_pkey_new($config);

        if (!$res) {
            Log::error('Error generating OpenSSL key pair.');
            return redirect()->back()->with('error', 'Error generating keys. Please check the logs for more details.');
        }

        openssl_pkey_export($res, $privateKey);

        // Extract public key
        $publicKeyDetails = openssl_pkey_get_details($res);
        $publicKey = $publicKeyDetails['key'];

        return [
            'public_key' => $publicKey,
            'private_key' => $privateKey,
        ];
    }
}
