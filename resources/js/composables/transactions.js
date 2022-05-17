import axios from "axios";
import { ref } from "vue";
import { useRouter } from 'vue-router';

export default function useTransactions() {

    const transaction = ref([])
    const transactions = ref([])
    // const categories = ref([])
    const errors = ref('')
    const router = useRouter()

    const member = ref([])
    const book = ref([])
    const member_id_error = ref('');
    const book_id_error = ref('');
    const canBorrow = ref(true);

    const getTransactions = async () => {
        let response = await axios.get('/api/transactions')
        transactions.value = response.data.data;
    }

    const getTransaction = async (id) => {
        let response = await axios.get(`/api/transactions/${id}`)
        transaction.value = response.data.data;
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

    const searchMember = async (id) => {
        await axios.get(`/api/members/${id}`)
            .then((response) => {
                member_id_error.value = ''
                member.value = response.data.data;
                if(response.data.data.transactions.length >= 5) {
                    canBorrow.value = false
                }
            })
            .catch( (error) => {
                member_id_error.value = error.response.data.message
            }) 
    }

    const searchBook = async (id) => {
        await axios.get(`/api/books/${id}`)
            .then((response) => {
                book_id_error.value = ''
                book.value = response.data.data;
                if(response.data.data.transactions_count === 0 ) {
                    canBorrow.value = false
                }
            })
            .catch( (error) => {
                book_id_error.value = error.response.data.message
            }) 
        
    }

    const destroyTransaction = async (id) => {
        await axios.delete(`/api/transactions/${id}`);
    }

    return {
        errors,
        book_id_error,
        member_id_error,

        transaction,
        transactions,

        member,
        book,
        canBorrow,

        getTransaction,
        getTransactions,
        storeTransaction,
        updateTransaction,
        destroyTransaction,

        searchMember,
        searchBook
    }
}