import axios from "axios";
import { ref } from "vue";
import { useRouter } from 'vue-router';

export default function useMembers() {

    const member = ref([])
    const members = ref([])
    const errors = ref('')
    const router = useRouter()

    const getMembers = async () => {
        let response = await axios.get('/api/members')
        members.value = response.data.data;
    }

    const getMember = async (id) => {
        let response = await axios.get(`/api/members/${id}`)
        member.value = response.data.data;
    }

    const storeMember  = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/members', data)
            await router.push({ name: 'members.index'})
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    const updateMember= async (id) => {
        errors.value = ''
        try {
            await axios.put(`/api/members/${id}`, member.value);
            await router.push({ name: 'members.index'})
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    const destroyMember = async (id) => {
        await axios.delete(`/api/members/${id}`);
    }

    return {
        errors,
        member,
        members,
        getMember,
        getMembers,
        storeMember,
        updateMember,
        destroyMember
    }
}