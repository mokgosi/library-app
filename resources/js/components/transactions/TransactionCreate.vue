<template>
    <form class="space-y-6" @submit.prevent="saveTransaction">
        <div class="flex">
            <div class="w-1/2 pr-5">
                <div class="bg-gray-300 p-2">
                    <label for="member_id" class="mt-2 block text-sm font-medium text-gray-700">Member ID</label>
                    <div class="mt-2">
                        <input type="text" name="member_id" id="member_id"
                            placeholder="Type id to search member - eg. 1,2,3..."
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="form.member_id" 
                            v-on:change="findMember"/>
                    </div>
                    <div v-if="member_id_error">
                        <p class="text-sm text-red-500">
                            {{ member_id_error }}
                        </p>
                    </div>
                </div>
                <div class="flex">
                    <div class="w-1/2">
                        <div>
                            <label for="name" class="mt-2 block text-sm font-medium text-gray-700">Member Name</label>
                            <div class="mt-2">
                                <input type="text" name="name" id="name"
                                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    v-model="member.full_name" 
                                    disabled />
                            </div>
                        </div>
                    </div>
                    <div class="w-1/2 pl-5">
                        <div>
                            <label for="status" class="mt-2 block text-sm font-medium text-gray-700">Status</label>
                            <div class="mt-2">
                                <input type="text" name="status" id="status"
                                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    v-model="member.status" 
                                    disabled/>
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
                                    v-model="member.email" 
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
                                    v-model="member.phone" 
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
                            v-model="member.home_address" 
                            disabled />
                    </div>
                </div>

                <table class="min-w-full mt-5">
                    <thead>
                        <tr>
                            <th class="px-3 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-100">
                                Trans ID
                            </th>
                            <th class="px-3 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-100">
                                Title
                            </th>
                            <th class="px-3 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-100">
                                Issued
                            </th>
                            <th class="px-3 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-100">
                                Date Due
                            </th>
                            <th class="px-3 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-100">
                                Days Overdue
                            </th>
                            <th class="px-3 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-100">
                                Fee
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <template v-for="transaction in member.transactions" :key="transaction.id"> 
                            <tr>
                                <td class="px-3 py-3 text-sm font-medium whitespace-no-wrap border-b border-gray-200">
                                    {{ transaction.transaction_id }}
                                </td>
                                <td class="px-3 py-3 text-sm font-medium whitespace-no-wrap border-b border-gray-200" >
                                    Multi-channelled
                                </td>
                                <td class="px-3 py-3 text-sm font-medium whitespace-no-wrap border-b border-gray-200">
                                    {{ transaction.date_issued}}
                                </td>
                                <td class="px-3 py-3 text-sm font-medium whitespace-no-wrap border-b border-gray-200">
                                    {{ transaction.date_due}}
                                </td>
                                <td class="px-3 py-3 text-sm font-medium whitespace-no-wrap border-b border-gray-200">
                                    {{ transaction.days_overdue}}
                                </td>
                                <td class="px-3 py-3 text-sm font-medium whitespace-no-wrap border-b border-gray-200">
                                    {{ transaction.penalty_fee}}
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
            <div class="w-1/2 pl-5">
                <div class="bg-gray-300 p-2">
                    <label for="book_id" class="mt-2 block text-sm font-medium text-gray-700">Book ID</label>
                    <div class="mt-2">
                        <input type="text" name="book_id" id="book_id"
                            placeholder="Type id to search a book - eg. 1,2,3... "
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="form.book_id" 
                            v-on:change="findBook"/>
                    </div>
                    <div v-if="book_id_error">
                        <p class="text-sm text-red-500">
                            {{ book_id_error }}
                        </p>
                    </div>
                </div>
                <div>
                    <label for="title" class="mt-2 block text-sm font-medium text-gray-700">Title</label>
                    <div class="mt-2">
                        <input type="text" name="title" id="title"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="book.title" 
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
                                    v-model="book.isbn" 
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
                                    v-model="book.author"
                                    disabled />
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <label for="date_due" class="mt-2 block text-sm font-medium text-gray-700">Date Due</label>
                    <div class="mt-2">
                        <Datepicker 
                            v-model="form.date_due" 
                            format="format"
                            :minDate="new Date()"
                            locale="en-ZA" textInput/>

                    </div>
                </div>
                <span class="mt-2 text-xs font-semibold inline-block py-5 px-5 rounded text-zinc-600 bg-zinc-200 uppercase last:mr-0 mr-1">
                    Copies 
                    <span class="mt-2 text-xs font-semibold block">{{book.copies}}</span>
                </span>

                <span class="text-xs font-semibold inline-block py-5 px-5 rounded text-emerald-600 bg-emerald-200 uppercase last:mr-0 mr-1">
                    Available
                    <span class="mt-2 text-xs font-semibold block">{{book.transactions_count}}</span>
                </span>
            </div>
        </div>
        <button type="submit" v-if="canBorrow"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 rounded-md border border-transparent ring-gray-300 transition duration-150 ease-in-out hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25">
            Create
        </button>
        <span v-else class="text-red-500">Cannot Borrow!</span>
        <router-link :to="{ name: 'transactions.index' }" class="inline-flex items-center font-semibold uppercase rounded-md text-xs px-4 py-2 ml-2 text-gray-900 first-letter:bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700   dark:hover:border-gray-600 dark:focus:ring-gray-700" >
            Cancel
        </router-link>
    </form>

</template> 
<script>

import useTransactions from "../../composables/transactions"
import { onMounted, reactive, ref } from "vue";
// import Datepicker from 'vue3-datepicker'
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';

export default {
    components: { Datepicker },
    setup() {
        const { member, book, book_id_error, member_id_error, canBorrow, errors, 
                searchMember, searchBook, storeTransaction,  } = useTransactions();

        const form = reactive({
            'transaction_id': '',
            'member': '',
            'member_id': '',
            'book_id': '',
            'date_due': '',
        })

        const date = ref(new Date());

        const format = (date) => {
            const day = date.getDate();
            const month = ("0" + (date.getMonth() + 1)).slice(-2)
            const year = date.getFullYear();
            const hour = date.getHours();
            const minutes = date.getMinutes();
            const seconds = ("0" + (date.getSeconds())).slice(-2)
            

            form.date_due = `${year}-${month}-${day} ${hour}:${minutes}:${seconds}`;

            return `${year}-${month}-${day} ${hour}:${minutes}:${seconds}`;
        }

        const findMember = async () => {
            await searchMember(form.member_id);
        }

        const findBook = async () => {
            await searchBook(form.book_id);
        }

        const saveTransaction = async () => {
            await storeTransaction({...form});
        }
        
        return {
            errors,
            canBorrow,
            member_id_error,
            book_id_error,
            
            form,
            book,
            member,

            format,
            findBook,
            findMember,
            saveTransaction,
        };
    }
};
</script>       