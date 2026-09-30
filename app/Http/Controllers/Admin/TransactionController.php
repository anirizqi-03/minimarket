<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * List semua transaksi dengan filter
     */
    public function index(Request $request)
    {
        $query = Transaction::with('user')->latest();

        // Filter search
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('code', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_phone', 'like', "%{$search}%");
            });
        }

        // Filter status
        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        // Filter metode bayar
        if ($method = $request->input('payment_method')) {
            $query->where('payment_method', $method);
        }

        // Filter tanggal
        if ($from = $request->input('date_from')) {
            $query->whereDate('created_at', '>=', $from);
        }
        if ($to = $request->input('date_to')) {
            $query->whereDate('created_at', '<=', $to);
        }

        $transactions = $query->paginate(15)->withQueryString();

        // Statistics
        $stats = [
            'total_count'   => Transaction::where('status', 'paid')->count(),
            'total_revenue' => Transaction::where('status', 'paid')->sum('total'),
            'today_count'   => Transaction::where('status', 'paid')->whereDate('created_at', today())->count(),
            'today_revenue' => Transaction::where('status', 'paid')->whereDate('created_at', today())->sum('total'),
        ];

        return view('admin.pages.transaksi.index', compact('transactions', 'stats'));
    }

    /**
     * Detail transaksi
     */
    public function show(Transaction $transaction)
    {
        $transaction->load('items', 'user');

        return view('admin.pages.transaksi.show', compact('transaction'));
    }

    /**
     * Batalkan transaksi
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->update(['status' => 'cancelled']);

        return redirect()
            ->route('admin.transaksi.index')
            ->with('success', 'Transaksi ' . $transaction->code . ' berhasil dibatalkan.');
    }
}
