<template>
    <form class="space-y-6" @submit.prevent="saveTransaction">
        <div class="flex">
            <div class="w-1/2 pr-5">
                <div>
                    <label for="member_id" class="block text-sm font-medium text-gray-700">Member ID</label>
                    <div class="mt-1">
                        <input type="text" name="member_id" id="member_id"
                            placeholder="Type to search member"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="form.member_id" />
                    </div>
                    <div v-if="errors.member_id">
                        <p v-for="error in errors.member_id" :key="error" class="text-sm text-red-500">
                            {{ error }}
                        </p>
                    </div>
                </div>
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Member Name</label>
                    <div class="mt-1">
                        <input type="text" name="name" id="name"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="form.name" 
                            disabled />
                    </div>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <div class="mt-1">
                        <input type="text" name="email" id="email"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="form.email" 
                            disabled />
                    </div>
                </div>
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <div class="mt-1">
                        <input type="text" name="phone" id="phone"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="form.phone" 
                            disabled/>
                    </div>
                </div>
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Home Address</label>
                    <div class="mt-1">
                        <textarea type="text" name="home_address" id="home_address"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="form.home_address" 
                            disabled></textarea>
                    </div>
                </div>
            </div>
            <div class="w-1/2 pl-5">
                <div>
                    <label for="book_id" class="block text-sm font-medium text-gray-700">Book ID</label>
                    <div class="mt-1">
                        <input type="text" name="book_id" id="book_id"
                            placeholder="Type to search a book"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="form.book_id" />
                    </div>
                </div>
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <div class="mt-1">
                        <input type="text" name="title" id="title"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="form.book_id" />
                    </div>
                </div>
                <div>
                    <label for="isdn" class="block text-sm font-medium text-gray-700">ISBN</label>
                    <div class="mt-1">
                        <input type="text" name="isbn" id="isbn"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="form.isbn" />
                    </div>
                </div>
                <div>
                    <label for="author" class="block text-sm font-medium text-gray-700">Author</label>
                    <div class="mt-1">
                        <input type="text" name="author" id="author"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="form.author">
                    </div>
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <div class="mt-1">
                        <select name="status" id="status" 
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="form.status">
                            <option value="Pending">Pending</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                </div>
                <div v-if="errors.status">
                    <p v-for="error in errors.status" :key="error" class="text-sm text-red-500">
                        {{ error }}
                    </p>
                </div>
            </div>
        </div>
        <button type="submit"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 rounded-md border border-transparent ring-gray-300 transition duration-150 ease-in-out hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25">
            Create
        </button>
        <router-link :to="{ name: 'transactions.index' }" class="inline-flex items-center font-semibold uppercase rounded-md text-xs px-4 py-2 ml-2 text-gray-900 first-letter:bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700   dark:hover:border-gray-600 dark:focus:ring-gray-700" >
            Cancel
        </router-link>
    </form>

</template> 
<script>

import useTransactions from "../../composables/transactions"
import { onMounted, reactive } from "vue";

export default {
    setup() {
        const { errors, storeTransaction } = useTransactions();

        const form = reactive({
            'transaction_id': '',
            'member': '',
            'member_id': '',
        })

        // onMounted(getCategories)

        const saveTransaction = async () => {
            await storeTransaction({...form});
        }
        
        return {
            form,
            errors,
            // categories,
            saveTransaction,
        };
    }
};
</script>       