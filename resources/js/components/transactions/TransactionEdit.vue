<template>
    <form class="space-y-6" @submit.prevent="saveTransaction">

        <div class="flex">
            <div class="w-1/4 mr-5 bg-zinc-100 p-2 rounded-md">
                <div class>
                    <label for="transaction_id" class="mt-2 block text-sm font-medium text-gray-700">Transaction ID</label>
                    <div class="mt-2">
                        <input type="text" name="transaction_id" id="transaction_id"
                                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                v-model="transaction.transaction_id"
                                readonly/>
                    </div>
                </div>
            </div>
            <div class="w-1/4 mr-5 bg-zinc-100 p-2 rounded-md">
                <div class>
                    <label for="status" class="mt-2 block text-sm font-medium text-gray-700">Status</label>
                    <div class="mt-2">
                        <select type="text" name="status" id="status"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="transaction.status">
                            <option value="Pending">Pending</option>
                            <option value="Returned">Returned</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="w-1/4 bg-zinc-100 p-2 rounded-md">
                <div class>
                    <label for="penalty" class="mt-2 block text-sm font-medium text-gray-700">Fine Paid</label>
                    <div class="mt-2">
                        <input type="text" name="penalty" id="penalty"
                                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                v-model="transaction.penalty" />
                    </div>
                </div>
            </div>
        </div>

        <div class="flex">
            <div class="w-1/2 pr-5">

                <div class="flex">
                    <div class="w-2/5">

                        <div>
                            <label for="id_number" class="mt-2 block text-sm font-medium text-gray-700">Member ID#</label>
                            <div class="mt-2">
                                <input type="text" name="id_number" id="id_number"
                                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    v-model="transaction.member.id_number"
                                    disabled />

                                <input type="hidden" name="member_id" id="member_id"
                                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    v-model="transaction.member_id" />
                            </div>
                        </div>
                    </div>
                    <div class="w-3/5 pl-5">
                        <div>
                            <label for="full_name" class="mt-2 block text-sm font-medium text-gray-700">Member Name</label>
                            <div class="mt-2">
                                <input type="text" name="full_name" id="full_name"
                                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    v-model="transaction.member.full_name" 
                                    disabled />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex">
                    <div class="w-1/2">
                        <div>
                            <label for="email" class="mt-2 block text-sm font-medium text-gray-700">Email</label>
                            <div class="mt-2">
                                <input type="text" name="email" id="email"
                                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    v-model="transaction.member.email" 
                                    disabled />
                            </div>
                        </div>
                    </div>
                    <div class="w-1/2 pl-5">
                        <div>
                            <label for="phone" class="mt-2 block text-sm font-medium text-gray-700">Phone</label>
                            <div class="mt-2">
                                <input type="text" name="phone" id="phone"
                                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    v-model="transaction.member.phone" 
                                    disabled/>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <label for="phone" class="mt-2 block text-sm font-medium text-gray-700">Home Address</label>
                    <div class="mt-2">
                        <input type="text" name="home_address" id="home_address"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="transaction.member.home_address" 
                            disabled />
                    </div>
                </div>
            </div>
            <div class="w-1/2 pl-5">
                <!-- <div class="bg-gray-300 p-2 rounded">
                    <label for="book_id" class="mt-2 block text-sm font-medium text-gray-700">Book ID</label>
                    <div class="mt-2">
                        <input type="text" name="book_id" id="book_id"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="transaction.book_id" 
                            disabled />
                    </div>
                </div> -->
                <div>
                    <label for="title" class="mt-2 block text-sm font-medium text-gray-700">Title</label>
                    <div class="mt-2">
                        <input type="text" name="title" id="title"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="transaction.book.title" 
                            disabled/>
                    </div>
                </div>
                <div class="flex">
                    <div class="w-1/2">
                        <div>
                            <label for="isdn" class="mt-2 block text-sm font-medium text-gray-700">ISBN</label>
                            <div class="mt-2">
                                <input type="text" name="isbn" id="isbn"
                                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    v-model="transaction.book.isbn" 
                                    disabled/>
                            </div>
                        </div>
                    </div>
                    <div class="w-1/2 pl-5">
                        <div>
                            <label for="author" class="mt-2 block text-sm font-medium text-gray-700">Author</label>
                            <div class="mt-2">
                                <input type="text" name="author" id="author"
                                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    v-model="transaction.book.author"
                                    disabled />
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <label for="date_due" class="mt-2 block text-sm font-medium text-gray-700">Date Due</label>
                    <div class="mt-2">
                        <input type="text" name="date_due" id="date_due"
                                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                v-model="transaction.date_due"
                                 />
                    </div>
                </div>
            </div>
        </div>
        <button type="submit"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 rounded-md border border-transparent ring-gray-300 transition duration-150 ease-in-out hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25">
            Update
        </button>
        <router-link :to="{ name: 'transactions.index' }" class="inline-flex items-center font-semibold uppercase rounded-md text-xs px-4 py-2 ml-2 text-gray-900 first-letter:bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700   dark:hover:border-gray-600 dark:focus:ring-gray-700" >
            Cancel
        </router-link>
    </form>

</template> 

<script>

import useTransactions from "../../composables/transactions"
import { onMounted, reactive } from 'vue'

export default {
    props: {
        id: {
            required: true,
                type: String
        }
    },
    setup(props) {
        
        const { errors, transaction, getTransaction, updateTransaction} = useTransactions();

        onMounted(getTransaction(props.id));

        const saveTransaction = async () => {
            await updateTransaction(props.id);
        }

        return {
            errors,
            transaction,
            saveTransaction
        }
    }
}
</script>

