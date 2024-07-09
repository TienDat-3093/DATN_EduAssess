import React, { useState, useEffect, useRef } from "react";
import { NavLink, useLocation } from "react-router-dom";
import { fetchCreateUserStats } from "../../services/UserServices";
import Swal from "sweetalert2";
export default function Testing() {
  const location = useLocation();
  const user =  JSON.parse(localStorage.getItem("user"));
  const { examsData } = location.state || {};

  const [startTime, setStartTime] = useState(new Date().getTime());
  const [endTime, setEndTime] = useState(null);
  const [currentTime, setCurrentTime] = useState(0);
  const [userResponses, setUserResponses] = useState(
    Array(examsData.questions.length)
      .fill()
      .map(() => [])
  );
  const [results, setResults] = useState(null);
  const [submitted, setSubmitted] = useState(false);
  const [isTimerRunning, setIsTimerRunning] = useState(true);
  
  console.log("userResponses", userResponses);
  const timerIntervalRef = useRef(null);
  useEffect(() => {
    if (isTimerRunning) {
      timerIntervalRef.current = setInterval(() => {
        setCurrentTime(new Date().getTime() - startTime);
      }, 1000);
    } else {
      clearInterval(timerIntervalRef.current);
    }

    return () => clearInterval(timerIntervalRef.current);
  }, [isTimerRunning, startTime]);

  const formatTime = (milliseconds) => {
    const totalSeconds = Math.floor(milliseconds / 1000);
    const hours = Math.floor(totalSeconds / 3600);
    const minutes = Math.floor((totalSeconds % 3600) / 60);
    const seconds = totalSeconds % 60;
    return `${hours.toString().padStart(2, "0")}:${minutes
      .toString()
      .padStart(2, "0")}:${seconds.toString().padStart(2, "0")}`;
  };
  const otificationOfResults = () => {
    if (results) {
      const correctAnswersCount = results
        ? results.filter((item) => item.isCorrect).length
        : 0;
        
      return (<span className="font-weight-bold">{'Số câu đúng: '+correctAnswersCount +'/'+results.length}</span>);
    }
  };
  const handleAnswerSelection = (questionIndex, answerIndex, inputType) => {
    if (submitted) return;
    setUserResponses((prevResponses) => {
      const updatedResponses = [...prevResponses];
      if (!inputType) {
        updatedResponses[questionIndex] = [answerIndex];
      } else {
        if (updatedResponses[questionIndex].includes(answerIndex)) {
          updatedResponses[questionIndex] = updatedResponses[
            questionIndex
          ].filter((id) => id !== answerIndex);
        } else {
          updatedResponses[questionIndex] = [
            ...updatedResponses[questionIndex],
            answerIndex,
          ];
        }
      }
      return updatedResponses;
    });
  };
  const handleSubmit = () => {
    const endTime = new Date().getTime();
    console.log("kthuc", endTime);
    setEndTime(endTime);
    console.log("endTime", endTime, "start", startTime);
    setIsTimerRunning(false);
    if (!examsData) return;
    const results = examsData.questions.map((question, index) => {
      const userAnswerKeys = userResponses[index];
      const correctAnswerIndexes = Object.values(question.answers)
        .map((answer, index) => (answer.is_correct === 1 ? index : -1))
        .filter((index) => index !== -1);

      const isCorrect =
        correctAnswerIndexes.length === userAnswerKeys.length &&
        correctAnswerIndexes.every((id, idx) => userAnswerKeys[idx] === id);

      return {
        questionId: question.id,
        userAnswerKeys,
        correctAnswerIndexes,
        isCorrect,
      };
    });
    setResults(results);
    setSubmitted(true);
    
  };

  console.log("examData", examsData);
  const handleCreateStats = async(correctAnswersCount)=>{
   
    try {
      const formData= {
        userId:user ? user.id :0,
        testId:examsData.id,
        questionRight:correctAnswersCount,
        totalQuestion:results && results.length,
        totalTimer: endTime - startTime,
        endTime: endTime,
      }
      console.log('formData',formData)
      const response = await fetchCreateUserStats(formData);
      if(response)
      {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          },
        });
        Toast.fire({
          icon: "success",
          title: response.data.message,
        });
        
      }
      console.log('resub',response)
      
    } catch (error) {
      console.log('err',error)
    }
  }
  useEffect(()=>{
    if (submitted && results) {
      const correctAnswersCount = results
        ? results.filter((item) => item.isCorrect).length
        : 0;
      
      handleCreateStats(correctAnswersCount)
    }
   
  },[submitted,results])

  return (
    <>
      {/*  <section className="ftco-section bg-light">
        <div className="container">
          <div className="row">
            <div className="col-lg-3 sidebar">
              
              <div className="sidebar-box bg-white p-4 ftco-animate fadeInUp ftco-animated">
                <form action="#" className="browse-form">
                  <h3 className="heading-sidebar"></h3>
                  <label htmlFor="option-category-3">
                    Time: <span>{formatTime(currentTime)}</span>s
                  </label>
                  <br />
                </form>
              </div>
              {result()}

              
            </div>
            <div className="col-lg-9">
              <div className="row">
                <div className="col-md-9 d-flex align-items-stretch ftco-animate fadeInUp ftco-animated">
                  <div
                    className="project-wrap overflow-auto"
                    style={{ maxHeight: 550 }}
                  >
                    <div class="container mt-5">
                      <ul class="list-unstyled">{loadExams}</ul>
                      <div class="text-center">
                        <button
                          onClick={handleSubmit}
                          class="btn btn-warning btn-lg"
                          disabled={submitted}
                        >
                          Submit
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section> */}
      <div className="container mt-4">
        <div className="card mb-5">
          <div className="card-header text-center">
            <h4>
              {examsData &&
                examsData.name.replace(/<\/?(p|strong|i)[^>]*>/gi, "")}
            </h4>
          </div>
          <div className="card-body">
            <div className="bg-light p-2 mb-3 rounded d-flex justify-content-between align-items-center">
              <span className="font-weight-bold">
                Tổng số câu: {examsData && examsData.questions.length}
              </span>
                {otificationOfResults()}
              <span className="font-weight-bold">
                Thời gian: {formatTime(currentTime)}
              </span>
            </div>
            {/* Question 1 */}
            {examsData &&
              examsData.questions &&
              examsData.questions.map((question, index) => {
                let isCorrect = "";
                isCorrect =
                  results && results !== null
                    ? results[index].isCorrect === true
                      ? "border border-success"
                      : "border border-danger"
                    : "";

                return (
                  <>
                    <div className="card mb-3" key={index}>
                      <div className={`card-body ${isCorrect}`}>
                        <p className="font-weight-bold">
                          Câu {index + 1}:{" "}
                          {question.question_text.replace(
                            /<\/?(p|strong|i)[^>]*>/gi,
                            ""
                          )}
                        </p>
                        {question && question.question_img ? (
                          <div className="mb-1">
                            <div>
                              <img
                                src={question.question_url}
                                alt="Uploaded"
                                style={{
                                  maxWidth: "100%",
                                  height: "100px",
                                }}
                              />
                            </div>
                          </div>
                        ) : (
                          ""
                        )}
                        {Object.values(question.answers).map((answer, key) => (
                          <div className="form-check" key={key}>
                            <div className="form-check-inline">
                              <input
                                className="form-check-input"
                                type={
                                  question.question_type_id === 1
                                    ? "checkbox"
                                    : "radio"
                                }
                                disabled={submitted}
                                name={`answer_${question.id}`}
                                id={`answer_${key}`}
                                value={key}
                                onChange={() =>
                                  handleAnswerSelection(
                                    index,
                                    key,
                                    question.question_type_id === 1
                                  )
                                }
                              />
                              <label
                                className="form-check-block mb-1"
                                htmlFor={`answer_${key}`}
                              >
                                {answer.text}
                              </label>
                            </div>
                            {answer.img ? (
                              <div className="mb-3">
                                <div>
                                  <img
                                    src={answer.answer_url}
                                    alt="Uploaded"
                                    style={{
                                      maxWidth: "100%",
                                      height: "100px",
                                    }}
                                  />
                                </div>
                              </div>
                            ) : (
                              ""
                            )}
                          </div>
                        ))}
                        {/*  <label
                          className="form-check-block mb-1"
                          htmlFor={`answer`}
                        >
                          Đáp án: {}
                        </label> */}
                      </div>
                    </div>
                  </>
                );
              })}
          </div>
          {submitted===false? <button onClick={handleSubmit} disabled={submitted} className="btn btn-primary w-100">
            Nộp bài
          </button>: user ? <NavLink to="/dashboard/my-exams" className="btn btn-primary w-100">
            Trở về
          </NavLink>:<NavLink to="/" className="btn btn-primary w-100">
            Trở về
          </NavLink>}
         
        </div>
      </div>
    </>
  );
}
