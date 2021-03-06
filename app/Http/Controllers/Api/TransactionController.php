<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use Carbon\Carbon;
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
        
        $transactions = Transaction::with(['member','book'])->get();
        return TransactionResource::collection($transactions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransactionRequest $request)
    {
        $data = $request->validated();

        $transactions = Transaction::where('member_id','=', $data['member_id'])
            ->where('status', '=', 'Pending')->get();
        
        //user cannot take out 5 books at once
        if(count($transactions) >= env('BOOKS_BORROWED_LIMIT')) {
            return response()->json(['errors' => ['message' => 'Member reached loan limit']], 422); 
        }
        
        //use cannot take 2 copies of the same book
        if($transactions->contains('book_id', $data['book_id'])) {
            return response()->json(['errors' => ['message' => 'Member currently loaning reqeusted book']], 422); 
        }

        $transaction = Transaction::create($data);

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
                     
        $transaction->with(['member','book'])->get();
        return new TransactionResource($transaction, $transaction->member, $transaction->book);
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
