import http from "../../http";

async function login(credentials) {

    const response = await http.post("/login_check", credentials);
    const token = response.data.token;

    window.localStorage.setItem('jwt', token);


};

function setTokenAutorization(token) {
    axios.defaults.headers["Authorization"] = "Bearer " + token;
}

function logout() {
    window.localStorage.removeItem("jwt");
    delete axios.defaults.headers["Authorization"];
}

function setTokenUsers() {
    const token = window.localStorage.getItem("jwt");

    if (token) {
        const { exp: tokenExpiration } = jwtDecode(token);
        if (tokenExpiration * 1000 > new Date().getTime()) {
            setTokenAutorization(token);
        }
    }
}

function isAuthenticated() {
    const token = window.localStorage.getItem("jwt");

    if (token) {
        const { exp: tokenExpiration } = jwtDecode(token);
        if (tokenExpiration * 1000 > new Date().getTime()) {
            return true;
        } else {
            return false;
        }
    }
    return false;
}
const AuthService = {
    login,
    logout,
    setTokenUsers,
    isAuthenticated,
};

export default AuthService;