import { setAuthorization } from "./general";
export function login(credentials) {
    return new Promise((res, rej) => {
        axios.post('/api/auth/login', credentials)
            .then((response) => {
                setAuthorization(response.data.access_token);
                res(response.data);
            })
            .catch((err) =>{
                rej("Wrong email or password");
            })
    })
}






export function register(credentials) {
    return new Promise((res, rej) => {
        axios.post('/api/auth/signup', credentials)
            .then((response) => {
               // setAuthorization(response.data.access_token);
                res(response.data);
            })
            .catch((err) =>{
                rej("Registration Failed");
            })
    })
}




export function setToken(credentials){
    setAuthorization(credentials);
}


export function googleLoginRegister(credentials){
    return new Promise((res, rej) => {
        axios.get(`https://cors-anywhere.herokuapp.com/https://oauth2.googleapis.com/tokeninfo?id_token=${credentials}` )
            .then((response) => {
                
                res(response.data);
            })
            .catch((err) =>{
                alet("Oops try again")
                rej("Wrong token");
            })
    })

}






export function getLocalUser() {
    const userStr = localStorage.getItem("user");

    if(!userStr) {
        return null;
    }

    return JSON.parse(userStr);
}