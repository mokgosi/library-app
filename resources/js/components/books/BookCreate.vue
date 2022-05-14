<template>
    <form class="space-y-6" @submit.prevent="saveBook">
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <div class="mt-1">
                <input type="text" name="title" id="title"
                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    v-model="form.title">
            </div>
            <div v-if="errors.title">
                <p v-for="error in errors.title" :key="error" class="text-sm text-red-500">
                    {{ error }}
                </p>
            </div>
        </div>
        <div>
            <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
            <div class="mt-1">
                <select name="category_id" id="category_id" v-model="school.province_id" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Select your category</option>
                    <option v-for="category in categories" :value="category.id" :key="category.id">
                        {{ category.name }}
                    </option>
                </select>
            </div>
            <div v-if="errors.category_id">
                <p v-for="error in errors.category_id" :key="error" class="text-sm text-red-500">
                    {{ error }}
                </p>
            </div>
        </div>
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <div class="mt-1">
                <textarea name="description" id="description"
                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    v-model="form.description">
                </textarea>>
            </div>
            <div v-if="errors.description">
                <p v-for="error in errors.description" :key="error" class="text-sm text-red-500">
                    {{ error }}
                </p>
            </div>
        </div>
        <div>
            <label for="isbn" class="block text-sm font-medium text-gray-700">ISBN</label>
            <div class="mt-1">
                <input type="text" name="isbn" id="isbn"
                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    v-model="form.isbn">
            </div>
            <div v-if="errors.isbn">
                <p v-for="error in errors.isbn" :key="error" class="text-sm text-red-500">
                    {{ error }}
                </p>
            </div>
        </div>
        <div>
            <label for="author" class="block text-sm font-medium text-gray-700">Author</label>
            <div class="mt-1">
                <input type="text" name="author" id="author"
                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    v-model="form.isbn">
            </div>
            <div v-if="errors.author">
                <p v-for="error in errors.author" :key="error" class="text-sm text-red-500">
                    {{ error }}
                </p>
            </div>
        </div>
        <div>
            <label for="no_of_issues" class="block text-sm font-medium text-gray-700">No. of Issues</label>
            <div class="mt-1">
                <input type="text" name="no_of_issues" id="no_of_issues"
                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    v-model="form.no_of_issues">
            </div>
            <div v-if="errors.no_of_issues">
                <p v-for="error in errors.no_of_issues" :key="error" class="text-sm text-red-500">
                    {{ error }}
                </p>
            </div>
        </div>
        <button type="submit"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 rounded-md border border-transparent ring-gray-300 transition duration-150 ease-in-out hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25">
            Create
        </button>
        <router-link :to="{ name: 'categories.index' }" class="inline-flex items-center font-semibold uppercase rounded-md text-xs px-4 py-2 ml-2 text-gray-900 first-letter:bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700   dark:hover:border-gray-600 dark:focus:ring-gray-700" >
            Cancel
        </router-link>
    </form>
</template> 
<script>

import useBooks from "../../composables/books"
import { onMounted, reactive } from "vue";

export default {
    setup() {
        const { errors, categories, getCategories, storeBook } = useBooks();

        const form = reactive({
            'name': '',
            'description': '',
            'author': '',
            'category_id': '',
            'isbn': '',
            'no_of_issues': ''
        })

        onMounted(getCategories)

        const saveBook= async () => {
            await storeBook({...form});
        }
        
        return {
            form,
            errors,
            categories,
            saveBook,
        };
    }
};
</script>       