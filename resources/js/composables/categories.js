import axios from "axios";
import { ref } from "vue";
import { useRouter } from 'vue-router';

export default function useCategories() {

    const category = ref([])
    const categories = ref([])
    const errors = ref('')
    const router = useRouter()

    const getCategories = async () => {
        let response = await axios.get('/api/categories')
        categories.value = response.data.data;
    }

    const getCategory = async (id) => {
        let response = await axios.get(`/api/categories/${id}`)
        category.value = response.data.data;
    }

    const storeCategory  = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/categories', data)
            await router.push({ name: 'categories.index'})
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    const updateCategory = async (id) => {
        errors.value = ''
        try {
            await axios.put(`/api/categories/${id}`, category.value);
            await router.push({ name: 'categories.index'})
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    const destroyCategory = async (id) => {
        await axios.delete(`/api/categories/${id}`);
    }

    return {
        errors,
        category,
        categories,
        getCategory,
        getCategories,
        storeCategory,
        updateCategory,
        destroyCategory
    }
}