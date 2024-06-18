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
  return axios.post("http://localhost:8000/api/me",{}, {
    headers: {
      "Authorization": `Bearer ${token}`,
      "Content-Type": "application/json",
    },
  });
};
export { fetchGetUser };
