<template>
    <div v-if="errors">
        <p v-for="error in v" :key="error" class="text-sm text-red-500">
            {{ error }}
        </p>
    </div>
    <form class="space-y-6" @submit.prevent="saveCategory">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Category</label>
            <div class="mt-1">
                <input type="text" name="name" id="name"
                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    v-model="form.name">
            </div>
            <div v-if="errors.name">
                <p v-for="error in errors.name" :key="error" class="text-sm text-red-500">
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

import useCategories from "../../composables/categories"
import { onMounted, reactive } from "vue";

export default {
    setup() {
        const { errors, member, storeCategory } = useCategories();

        const form = reactive({
            'name': '',
        })

        const saveCategory = async () => {
            await storeCategory({...form});
        }
        
        return {
            form,
            errors,
            saveCategory,
        };
    }
};
</script>       