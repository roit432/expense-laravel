@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            
            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif 
            <!-- this is for flash msg -->

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">My Transactions</h5>
                    <a href="{{ route('transactions.create') }}" class="btn btn-light btn-sm">+ Add Transaction</a>
                </div>
                <div class="card-body">
                    @if(isset($transactions))
                        {{-- Display the count of transactions --}}
                        <h6 class="mb-3">Total Transactions: 
                            <span class="badge bg-secondary">{{ $transactions->count() }}</span>
                        </h6>

                        
                    
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Category</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transactions as $index => $transaction)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $transaction->category_name }}</td>
                                            <td>₹ {{ number_format($transaction->amount, 2) }}</td>
                                            <td>{{ $transaction->date}}</td>
                                            <td>{{ $transaction->created_at->format('h:i A') }}</td>
                                            <td class="text-center">
                                                {{-- Edit button --}}
                                                <a href="{{ route('transactions.edit', $transaction->id) }}" 
                                                   class="btn btn-sm btn-warning">Edit</a>

                                                {{-- Delete button --}}
                                                <form action="{{ route('transactions.destroy', $transaction->id) }}" 
                                                      method="POST" class="d-inline"
                                                      onsubmit="return confirm('Are you sure to delete this transaction?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted text-center">No transactions found. Add your first one!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
