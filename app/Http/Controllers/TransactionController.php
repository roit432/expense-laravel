<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', auth()->id())->latest()->get();
        return view('transactions.index', compact('transactions'));//this function return all transactions of the user
    }

    public function create()
    {
        return view('transactions.create');//in this function we return the view of create transaction form
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'category_name'=> 'nullable|string|max:255',
            'date' => 'required|date_format:Y-m-d', 
            
            
        ]);//this function validate the request data before storing it in the database

        Transaction::create([
            'title' => $request->title,
            'amount' => $request->amount,
            'category_name'=> $request->category_name ?? null,
            'date'=> $request->date,
            'user_id' => auth()->id(),
        ]);//this function create a new transaction and store it in the database

        return redirect()->route('transactions.index')->with('success', 'Transaction added successfully.');//here we retrub to the index page with a success message
    }

    public function edit(Transaction $transaction)
    {
        if ($transaction->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }//this function check if the transaction belongs to the authenticated user, if not it will abort with a 403 error

        return view('transactions.edit', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        if ($transaction->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }//this function check if the transaction belongs to the authenticated user, if not it will abort with a 403 error

        $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'category_name'=> 'nullable|string|max:255',
            'date'=> 'required|date_format:Y-m-d',
        ]);//this function validate the request data before updating it in the database

        $transaction->update($request->only('title', 'amount','category_name', 'date'));

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');//this function update the transaction in the database and return to the index page with a success message
    }

    public function destroy(Transaction $transaction)
    {
        if ($transaction->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }//this function check if the transaction belongs to the authenticated user, if not it will abort with a 403 error

        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');//this function delete the transaction from the database and return to the index page with a success message
    }


    // method to other controllers like pie chart and total summary
public function report(Request $request)
{   
    $userId = auth()->id(); // currently logged in user

    $query = Transaction::where('user_id', $userId); // sirf current user ke transactions

    // Filter by category (lowercase)
    if ($request->filled('category_name')) {
        $query->where('category_name', strtolower($request->category_name));
    }

    // Filter by date range (ignore time part)
    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereRaw('DATE(date) BETWEEN ? AND ?', [$request->start_date, $request->end_date]);
    }

    // Paginate results
    $transactions = $query->orderBy('date', 'desc')->paginate(10);
    $transactions->appends($request->all()); // Keep filters in pagination links

    // Totals for the current user
    $totalIncome = Transaction::where('user_id', $userId)
        ->whereRaw('LOWER(category_name) = ?', ['income'])
        ->when($request->filled('start_date') && $request->filled('end_date'), function($q) use ($request) {
            $q->whereBetween('date', [$request->start_date, $request->end_date]);
        })
        ->sum('amount');

    $totalExpenses = Transaction::where('user_id', $userId)
        ->whereRaw('LOWER(category_name) = ?', ['expenses'])
        ->when($request->filled('start_date') && $request->filled('end_date'), function($q) use ($request) {
            $q->whereBetween('date', [$request->start_date, $request->end_date]);
        })
        ->sum('amount');

    $totalExpenses = abs($totalExpenses); // Ensure expenses are positive

    // Calculate balance
    $balance = $totalIncome - $totalExpenses;

    // Pie chart data for current user
    $chartData = [
        'income' => $totalIncome ?? 0,
        'expense' => $totalExpenses ?? 0,
    ];

    return view('transactions.report', compact(
        'transactions',
        'totalIncome',
        'totalExpenses',
        'balance',
        'chartData'
    ));
}



}
