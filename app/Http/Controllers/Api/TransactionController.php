<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return TransactionResource::collection(Transaction::all());

        return TransactionResource::collection(
            Transaction::select(
                'transactions.id',
                'transactions.date_issued',
                'transactions.date_due',
                'transactions.date_returned', 
                'transactions.status', 
                'transactions.penalty', 
                'transactions.transaction_id', 
                'books.id', 
                'books.title', 
                'books.copies',
                DB::raw("CONCAT(members.first_name,' ',members.last_name) AS member"))
            ->leftJoin('members', 'members.id','=','transactions.member_id')
            ->leftJoin('books', 'books.id','=','transactions.book_id')
            ->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransactionRequest $request)
    {
        $transaction= Transaction::create($request->validated());

        return new TransactionResource($transaction);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return new TransactionResource($transaction);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransactionRequest  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        $transaction->update($request->validated());
        
        return new TransactionResource($transaction);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return response()->noContent();
    }
}
