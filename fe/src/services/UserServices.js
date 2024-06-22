import axios from "axios";

const fetchLogin = (email, password) => {
  return axios.post(
    "http://localhost:8000/api/login",
    { email, password },
    {
      headers: {
        "Content-Type": "application/json",
      },
    }
  );
};
export { fetchLogin };

const fetchLogout = (token) => {
  console.log(`Bearer ${token}`)
  return axios.post("http://localhost:8000/api/logout",{}, {
    headers: {
      "Authorization": `Bearer ${token}`,
      "Content-Type": "application/json",
    },
  });
};
export { fetchLogout };

const fetchGetUser = (token) => {
  console.log(`Bearer ${token}`)
  return axios.post("http://localhost:8000/api/profile",{}, {
    headers: {
      "Authorization": `Bearer ${token}`,
      "Content-Type": "application/json",
    },
  });
};
export { fetchGetUser };

const fetchRefreshAccess = (token) => {
  console.log(`Bearer ${token}`)
  return axios.post("http://localhost:8000/api/refresh",{}, {
    headers: {
      "Authorization": `Bearer ${token}`,
      "Content-Type": "application/json",
    },
  });
};
export { fetchRefreshAccess };

const fetchRegister = (username,email,date_of_birth,password,avatar) => {
  return axios.post(
    "http://localhost:8000/api/register",
    { username,email,date_of_birth,password,avatar },
    {
      headers: {
        "Content-Type": "multipart/form-data",
      },
    }
  );
};
export { fetchRegister };