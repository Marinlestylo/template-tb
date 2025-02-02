import { ref } from 'vue'
import { defineStore } from 'pinia'
import * as utils from '../utils.js';

export const useUserStore = defineStore('user', () => {
    const user = ref({
        id: null,
        name: '',
        role: '',
    })

    const fetchUser = async () => {
        if (user.value.id !== null) {
            return user.value;
        }

        const response = await utils.fetchApi('/api/user');
        if (response.status === 200) {
            const data = await response.json();
            user.value.id = data.id;
            user.value.name = data.name;
            user.value.role = data.role;
            return data;
        }
    }

    const logout = async () => {
        user.value.id = null;
        user.value.name = '';
        user.value.role = '';
    }

    return { user, fetchUser, logout }
});