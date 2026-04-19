<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        return response()->json(Transaction::with(['category', 'account'])->latest()->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'account_id' => 'required|exists:accounts,id',
            'type' => 'required|in:income,expense',
            'date' => 'required|date',
        ]);

        $transaction = Transaction::create($validated);
        
        return response()->json($transaction->load(['category', 'account']), 201);
    }

    public function show($id)
    {
        return response()->json(Transaction::with(['category', 'account'])->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        
        $validated = $request->validate([
            'amount' => 'sometimes|required|numeric',
            'description' => 'nullable|string',
            'category_id' => 'sometimes|required|exists:categories,id',
            'account_id' => 'sometimes|required|exists:accounts,id',
            'type' => 'sometimes|required|in:income,expense',
            'date' => 'sometimes|required|date',
        ]);

        $transaction->update($validated);
        
        return response()->json($transaction->load(['category', 'account']));
    }

    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();
        return response()->json(null, 204);
    }
}
