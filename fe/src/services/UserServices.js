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
//EndUsers
const fetchAllExams = ()=>{
  return axios.get("http://localhost:8000/api/exams/index");
}
export {fetchAllExams};

const fetchDetailExam = (id)=>{
  return axios.get(`http://localhost:8000/api/exams/show/${id}`);
}
export {fetchDetailExam};

const fetchQuestionsToUser = (userId) => {
  return axios.get(`http://localhost:8000/api/questions/index`,{params: { userId }});
}
export {fetchQuestionsToUser}

const fetchQuestionsToFilter = (userId,adminRole,levelIds,topicIds) => {
  return axios.get(`http://localhost:8000/api/questions/filter`,{params: { userId,adminRole,levelIds,topicIds }});
}
export {fetchQuestionsToFilter}

const fetchQuestionsToSearch = (userId,adminRole,keyword) => {
  return axios.get(`http://localhost:8000/api/questions/search`,{params: { userId,adminRole,keyword }});
}
export {fetchQuestionsToSearch}

const fetchShowQuestion = (userId,adminRole,questionId) => {
  return axios.get(`http://localhost:8000/api/questions/show`,{params: { userId,adminRole,questionId }});
}
export {fetchShowQuestion}

const fetchCreateQuestion = (formData) => {
  return axios.post(
    "http://localhost:8000/api/questions/create",
    { formData },
    {
      headers: {
        "Content-Type": "multipart/form-data",
      },
    }
  );
};
export {fetchCreateQuestion}

const fetchEditQuestion = (formData) => {
  return axios.post(
    "http://localhost:8000/api/questions/edit",
    { formData },
    {
      headers: {
        "Content-Type": "multipart/form-data",
      },
    }
  );
};
export {fetchEditQuestion}

const fetchDeleteQuestion = (formData) => {
  return axios.post(
    "http://localhost:8000/api/questions/delete",{ formData },
    {
      headers: {
        "Content-Type": "multipart/form-data",
      },
    }
  );
};
export {fetchDeleteQuestion}


const fetchExamsToUser = (userId) => {
  return axios.get(`http://localhost:8000/api/exams/index-user`,{params: { userId}});
}
export {fetchExamsToUser}

const fetchGetQuestion = (levelIds,topicIds,userId,quantity,quesReturnId) => {
  return axios.get(`http://localhost:8000/api/exams/get-question`,{params: {levelIds,topicIds,userId,quantity,quesReturnId}});
}
export {fetchGetQuestion}

const fetchCreateExam = (formData) => {
  return axios.post(
    "http://localhost:8000/api/exams/create",
    { formData },
    {
      headers: {
        "Content-Type": "multipart/form-data",
      },
    }
  );
};
export {fetchCreateExam}

const fetchEditExam = (formData) => {
  return axios.post(
    "http://localhost:8000/api/exams/edit",
    { formData },
    {
      headers: {
        "Content-Type": "multipart/form-data",
      },
    }
  );
};
export {fetchEditExam}

const fetchShowExamEdit = (userId,adminRole,examId) => {
  return axios.get(`http://localhost:8000/api/exams/show-edit`,{params: { userId,adminRole,examId }});
}
export {fetchShowExamEdit}

const fetchDeleteExam = (formData) => {
  return axios.post(
    "http://localhost:8000/api/exams/delete",
    { formData },
    {
      headers: {
        "Content-Type": "multipart/form-data",
      },
    }
  );
};
export {fetchDeleteExam}

const fetchExamToSearch = (userId,keyword) => {
  return axios.get(`http://localhost:8000/api/exams/search`,{params: { userId,keyword }});
}
export {fetchExamToSearch}

const fetchExamToFilter = (userId,now,outstanding) => {
  return axios.get(`http://localhost:8000/api/exams/filter`,{params: { userId,now,outstanding }});
}
export {fetchExamToFilter}

//
const fetchCreateUserStats = (formData) => {
  return axios.post(
    "http://localhost:8000/api/user-stats/create",
    { formData },
    {
      headers: {
        "Content-Type": "multipart/form-data",
      },
    }
  );
};
export {fetchCreateUserStats}

const fetchUserStatsToUser = (userId, page,itemsPerPage) => {
  return axios.get(`http://localhost:8000/api/user-stats/index-user`,{params: { userId,page,itemsPerPage}});
}
export {fetchUserStatsToUser}