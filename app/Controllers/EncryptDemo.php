<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;

class EncryptDemo extends Controller
{
    public function encrypt()
    {
        $encrypter = Services::encrypter();

        $plainText = 'This is my secret message!';
        $encrypted = $encrypter->encrypt($plainText);

        $encoded = base64_encode($encrypted);

        return $this->response->setJSON([
            'original' => $plainText,
            'encrypted' => $encoded,
        ]);
    }

    public function decrypt($encodedData = null)
    {
        if ($encodedData === null) {
            return $this->response->setJSON(['error' => 'No data provided to decrypt']);
        }

        $encrypter = Services::encrypter();

        try {
            $encrypted = base64_decode($encodedData);
            $decrypted = $encrypter->decrypt($encrypted);

            return $this->response->setJSON([
                'decrypted' => $decrypted,
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'error' => 'Failed to decrypt: ' . $e->getMessage(),
            ]);
        }
    }
}
