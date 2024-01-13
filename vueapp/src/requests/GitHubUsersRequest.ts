import axios from "axios";

export default class GitHubUsersRequest {
    async getAll() {
        try {
            const usersLogin = ['wallysonn', 'diego3g', 'filipedeschamps', 'rmanguinho'];
            let githubUsers:Array<{}> = [];

            usersLogin.forEach(async (userLogin)=>{
                const response = await axios.get(`https://api.github.com/users/${userLogin}`);

                if(response.status === 200) {
                    githubUsers.push({
                        id: response.data.id,
                        name: response.data.name,
                        login: response.data.login,
                        avatar_url: response.data.avatar_url,
                        total_repositories: response.data.public_repos,
                        total_followers: response.data.followers,
                        total_following: response.data.following,
                        created_at: response.data.created_at,
                        already_imported: false
                    });
                }
            })
            
            return {success: true, data: githubUsers, message: ''};
        } catch (error) {
            return {success: false, data: [], message: 'Erro ao buscar dados'};
        }
    }

    async findUser(userLogin: string) {
        try {
            const response = await axios.get(`https://api.github.com/users/${userLogin}`);
            return response.data;
        } catch (error) {
            return {success: false, data: [], message: 'Erro ao buscar dados'};
        }
    }

    async getUserRepositories(userLogin: string) {
        try {
            const response = await axios.get(`https://api.github.com/users/${userLogin}/repos?per_page=50`);
            return response.data;
        } catch (error) {
            return {success: false, data: [], message: 'Erro ao buscar dados'};
        }
    }
}