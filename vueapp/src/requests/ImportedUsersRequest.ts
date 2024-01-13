import axios from "axios";

export default class ImportedUsersRequest {
    async getAll() {
        try {
            const response = await axios.get(`http://localhost:8000/api/github-users`);
            return response.data.data;
        } catch (error) {
            return {success: false, data: [], message: 'Erro ao buscar usuários'};
        }
    }

    async getUser(login: string) {
        try {
            const response = await axios.get(`http://localhost:8000/api/github-users/${login}`);
            return response.data;
        } catch (error) {
            return {success: false, data: [], message: 'Erro ao buscar usuário'};
        }
    }

    async importUser(login: string) {
        try {
            const response = await axios.post(`http://localhost:8000/api/github-users`, {user_login: login});
            return response.data;
        } catch (error) {
            return {success: false, data: [], message: 'Erro ao importar'};
        }
    }

    async deleteUser(login: string) {
        try {
            const response = await axios.delete(`http://localhost:8000/api/github-users/${login}`);
            return response.data
        } catch (error) {
            return {success: false, data: [], message: 'Erro ao deletar usuário'};
        }
    }
}