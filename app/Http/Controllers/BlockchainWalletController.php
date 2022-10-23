<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlockchainWallet;
use App\Models\BlockchainTransaction;

use kornrunner\Ethereum\Address;
use kornrunner\Secp256k1;
use kornrunner\Serializer\HexSignatureSerializer;

use InvalidArgumentException;

class BlockchainWalletController extends Controller
{

    // public function home(Request $request)
    // {
    //     $user_id = $request->user()->id;
    //     $wallets = BlockchainWallet::where('user_id', $user_id)->get();
    //     $transactions = BlockchainTransaction::where('user_id', $user_id)->get();
    //     return view('blockchain.user_home', compact('wallets', 'transactions'));
    // }

    // public function generate_wallet()
    // {
    //     $user_id = auth()->user()->id;
    //     $address = new Address();
    //     $wallet = new BlockchainWallet;

    //     $wallet->address = $address->get();
    //     $wallet->public_key = $address->getPublicKey();
    //     $wallet->private_key = $address->getPrivateKey();
    //     $wallet->user_id = $user_id;

    //     $wallet->save();

    //     return $wallet->id;
    // }

    // public function transfer_token(Request $request)
    // {
    //     $tx = new BlockchainTransaction;
    //     $tx->char('token', 6);
    //     $tx->char('transaction_hash', 128);
    //     $tx->integer('block_number');
    //     $tx->char('to', 128);            
    //     $tx->decimal('amount', 18, 6)->default(0);
    //     $tx->foreignId('blockchain_wallet_id')->constrained('blockchain_wallets');               
    //     $tx->foreignId('user_id')->constrained('users'); 
    // }

    // public function sign_message($message, $private_key)
    // {
    //     $secp256k1 = new Secp256k1();
    //     $signature = $secp256k1->sign($message, $private_key);                
    //     $r = $signature->getR();        
    //     $s = $signature->getS();    
    //     // $v = $signature->getRecoveryParam();

    //     // $message_signature = $signature->toHex();  
        
    //     // return array($message, $message_signature, $message_hash);
    // }

    // function sign($message, $private_key, $verbose = False) {
    //     $secp256k1 = new Secp256k1();
    
    //     if ($verbose) {
    //         echo "Sign(message):            $message\r\n";
    //     }
    
    //     $signature = $secp256k1->sign($message, $privateKey, [
    //         "canonical" => true,
    //         "n" => null,
    //     ]);
    //     $result = "0x" . $signature->toHex();
    
    //     // kornrunner library does not add the recovery param (recid) at the end, so we must do it ourselves
    //     // This hack with 0 is ok, as recovery param is always between 0 and 3
    //     $result = $result . "0" . dechex($signature->getRecoveryParam());
    
    //     return $result;
    // }   
    
    // function sign_hash($message, $private_key, $verbose = False) {
    //     if ($verbose) {
    //         echo "SignHash(message):        " . bin2hex($message) . "\r\n";
    //     }
    //     $msglen = strlen($message);
    //     $msg    = hex2bin("19") . "Ethereum Signed Message:" . hex2bin("0A") . $msglen . $message;
    //     $hash   = Keccak::hash($msg, 256);
    //     return $this->sign($hash, $private_key, $verbose);
    // }    

    // public function verify_message($message, $signature, $address) {
    //     $msglen = strlen($message);
    //     $hash   = Keccak::hash("\x19Ethereum Signed Message:\n{$msglen}{$message}", 256);
    //     $sign   = ["r" => substr($signature, 2, 64), 
    //                "s" => substr($signature, 66, 64)];
    //     $recid  = ord(hex2bin(substr($signature, 130, 2))) - 27; 
    //     if ($recid != ($recid & 1)) 
    //         return false;
    
    //     $ec = new EC('secp256k1');
    //     $pubkey = $ec->recoverPubKey($hash, $sign, $recid);
    
    //     return $address == pubKeyToAddress($pubkey);
    // }
 
 
}
