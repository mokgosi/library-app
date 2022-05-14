import axios from "axios";
import { ref } from "vue";
import { useRouter } from 'vue-router';

export default function useTransactions() {

    const transaction = ref([])
    const transactions = ref([])
    // const categories = ref([])
    const errors = ref('')
    const router = useRouter()

    const getTransactions = async () => {
        let response = await axios.get('/api/transactions')
        books.value = response.data.data;
    }

    const getTransaction = async (id) => {
        let response = await axios.get(`/api/transactions/${id}`)
        book.value = response.data.data;
    }

    const storeTransaction = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/transactions', data)
            await router.push({ name: 'transactions.index'})
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    // const getCategories = async () => {
    //     let response = await axios.get('/api/categories')
    //     categories.value = response.data.data;
    // }

    const updateTransaction = async (id) => {
        errors.value = ''
        try {
            await axios.put(`/api/transactions/${id}`, transaction.value);
            await router.push({ name: 'transactions.index'})
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    const destroyTransaction = async (id) => {
        await axios.delete(`/api/transactions/${id}`);
    }

    return {
        errors,
        transaction,
        transactions,
        categories,
        getTransaction,
        getTransactions,
        storeTransaction,
        updateTransaction,
        destroyTransaction,
    }
}