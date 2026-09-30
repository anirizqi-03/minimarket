<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KasirController extends Controller
{

    public function index()
    {
        return view('admin.pages.kasir.index');
    }


    public function searchProduct(Request $request)
    {
        $q = trim($request->input('q', ''));

        if ($q === '') {
            return response()->json([]);
        }

        $products = Product::where('is_active', true)
            ->where(function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                      ->orWhere('id', $q);
            })
            ->orderBy('name')
            ->limit(10)
            ->get(['id', 'name', 'price', 'stock', 'category']);

        return response()->json($products);
    }

  
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name'    => 'nullable|string|max:255',
            'customer_phone'   => 'nullable|string|max:20',
            'items'            => 'required|array|min:1',
            'items.*.product_id' => 'nullable|integer|exists:products,id',
            'items.*.name'     => 'required|string|max:255',
            'items.*.price'    => 'required|numeric|min:0',
            'items.*.qty'      => 'required|integer|min:1',
            'discount_percent' => 'nullable|numeric|min:0|max:100',
            'tax_amount'       => 'nullable|numeric|min:0',
            'other_fee'        => 'nullable|numeric|min:0',
            'paid'             => 'required|numeric|min:0',
            'payment_method'   => 'required|in:tunai,qris,debit',
            'note'             => 'nullable|string',
        ], [
            'items.required'   => 'Keranjang tidak boleh kosong.',
            'items.min'        => 'Minimal 1 produk di keranjang.',
            'paid.required'    => 'Jumlah bayar wajib diisi.',
        ]);

        DB::beginTransaction();

        try {
            // Hitung subtotal
            $subtotal = 0;
            foreach ($validated['items'] as $item) {
                $subtotal += $item['price'] * $item['qty'];
            }

            // Diskon
            $discountPercent = $validated['discount_percent'] ?? 0;
            $discountAmount  = $subtotal * ($discountPercent / 100);

            // Pajak & biaya lain
            $taxAmount = $validated['tax_amount'] ?? 0;
            $otherFee  = $validated['other_fee'] ?? 0;

            // Total
            $total = $subtotal - $discountAmount + $taxAmount + $otherFee;

            // Validasi bayar
            if ($validated['paid'] < $total) {
                return response()->json([
                    'success' => false,
                    'message' => 'Uang bayar kurang dari total. Kurang Rp ' . number_format($total - $validated['paid'], 0, ',', '.'),
                ], 422);
            }

            $change = $validated['paid'] - $total;

            // Buat transaksi
            $transaction = Transaction::create([
                'code'             => Transaction::generateCode(),
                'user_id'          => Auth::id(),
                'customer_name'    => $validated['customer_name'] ?: 'Umum',
                'customer_phone'   => $validated['customer_phone'] ?? null,
                'subtotal'         => $subtotal,
                'discount_percent' => $discountPercent,
                'discount_amount'  => $discountAmount,
                'tax_amount'       => $taxAmount,
                'other_fee'        => $otherFee,
                'total'            => $total,
                'paid'             => $validated['paid'],
                'change'           => $change,
                'payment_method'   => $validated['payment_method'],
                'status'           => 'paid',
                'note'             => $validated['note'] ?? null,
            ]);

            // Buat item & kurangi stok
            foreach ($validated['items'] as $item) {
                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id'     => $item['product_id'] ?? null,
                    'product_name'   => $item['name'],
                    'price'          => $item['price'],
                    'qty'            => $item['qty'],
                    'subtotal'       => $item['price'] * $item['qty'],
                ]);

                // Kurangi stok produk
                if (!empty($item['product_id'])) {
                    $product = Product::find($item['product_id']);
                    if ($product) {
                        $product->decrement('stock', $item['qty']);
                    }
                }
            }

            DB::commit();

            return response()->json([
                'success'       => true,
                'message'       => 'Transaksi berhasil disimpan.',
                'transaction'   => [
                    'id'    => $transaction->id,
                    'code'  => $transaction->code,
                    'total' => $transaction->total,
                    'change'=> $transaction->change,
                ],
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }


    public function receipt(Transaction $transaction) {

        $transaction->load('items', 'user');

        return view('admin.pages.kasir.receipt', compact('transaction'));
    }
}
