import { fetchAllExams } from "../../services/UserServices";
import React, { useEffect, useState } from "react";
import { NavLink } from "react-router-dom";
import DOMPurify from "dompurify";
import Swal from "sweetalert2";

export default function TestList() {
  const [data, setData] = useState("");
  console.log("data", data);
  const getAllExam = async () => {
    try {
      const response = await fetchAllExams();
      if (response) {
        setData(response.data.data);
      }
    } catch (error) {}
  };
  const handleCopyLink = (url) => {
    const linkToCopy = "http://localhost:3000" + url;

    navigator.clipboard
      .writeText(linkToCopy)
      .then(() => {})
      .catch((err) => {
        console.error("Không thể sao chép link: ", err);
      });
  };
  const generateSlug = (name) => {
    return name
      .toString()
      .toLowerCase()
      .replace(/\s+/g, "-")
      .replace(/[^\w\-]+/g, "")
      .replace(/\-\-+/g, "-")
      .replace(/^-+/, "")
      .replace(/-+$/, "");
  };
  const isValidImageUrl = (url) => {
    const regex = /^http:\/\/localhost:8000\/.*\.(jpg|jpeg|png|gif)$/i;
    return regex.test(url);
  };
  useEffect(() => {
    getAllExam();
  }, []);
  return (
    <>
      <section className="ftco-section bg-light pt-5">
        <div className="container">
          <div className="row">
            <div className="col-lg-3 sidebar">
              <div className="sidebar-box bg-white ftco-animate fadeInUp ftco-animated">
                <form action="#" className="search-form">
                  <div className="form-group">
                    <span className="icon fa fa-search" />
                    <input
                      type="text"
                      className="form-control"
                      placeholder="Search..."
                    />
                  </div>
                </form>
              </div>
              <div className="sidebar-box bg-white p-4 ftco-animate fadeInUp ftco-animated">
                <h3 className="heading-sidebar">Course Category</h3>
                <form action="#" className="browse-form">
                  <label htmlFor="option-category-1">
                    <input
                      type="checkbox"
                      id="option-category-1"
                      name="vehicle"
                      defaultValue=""
                    />{" "}
                    Design &amp; Illustration
                  </label>
                  <br />
                  <label htmlFor="option-category-2">
                    <input
                      type="checkbox"
                      id="option-category-2"
                      name="vehicle"
                      defaultValue=""
                    />{" "}
                    Web Development
                  </label>
                  <br />
                  <label htmlFor="option-category-3">
                    <input
                      type="checkbox"
                      id="option-category-3"
                      name="vehicle"
                      defaultValue=""
                    />{" "}
                    Programming
                  </label>
                  <br />
                  <label htmlFor="option-category-4">
                    <input
                      type="checkbox"
                      id="option-category-4"
                      name="vehicle"
                      defaultValue=""
                    />{" "}
                    Music &amp; Entertainment
                  </label>
                  <br />
                  <label htmlFor="option-category-5">
                    <input
                      type="checkbox"
                      id="option-category-5"
                      name="vehicle"
                      defaultValue=""
                    />{" "}
                    Photography
                  </label>
                  <br />
                  <label htmlFor="option-category-6">
                    <input
                      type="checkbox"
                      id="option-category-6"
                      name="vehicle"
                      defaultValue=""
                    />{" "}
                    Health &amp; Fitness
                  </label>
                  <br />
                </form>
              </div>
            </div>
            <div className="col-lg-9">
              <div className="row">
                {data && data.length > 0 ? (
                  data.map((exam, index) => (
                    <div className="col-md-4 d-flex align-items-stretch ftco-animate fadeInUp ftco-animated">
                      <div className="project-wrap">
                        <NavLink
                          to={`/exams/${exam.id}-${generateSlug(
                            exam.name.replace(/<\/?(p|strong|i)[^>]*>/gi, "")
                          )}`}
                          className="img"
                          style={{
                            backgroundImage:
                              exam.test_img && isValidImageUrl(exam.test_url)
                                ? `url('${exam.test_url}')`
                                : "url(../images/work-2.jpg)",
                          }}
                        >
                          <span className="price">Bắt đầu</span>
                        </NavLink>

                        <div className="text p-4">
                          <div>
                            <h3
                              className="fs-4"
                              dangerouslySetInnerHTML={{
                                __html: DOMPurify.sanitize(exam.name),
                              }}
                            />
                          </div>

                          <p className="advisor">
                            Tác giả: <span>{exam.user &&exam.user.admin_role ==0 ? exam.user.username:'ADMIN'}</span>
                          </p>  
                          <button
                            className="btn text-muted"
                            onClick={() =>
                              handleCopyLink(
                                `/exams/${exam.id}-${generateSlug(
                                  exam.name.replace(
                                    /<\/?(p|strong|i)[^>]*>/gi,
                                    ""
                                  )
                                )}`
                              )
                            }
                          >
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              width="16"
                              height="16"
                              fill="currentColor"
                              class="bi bi-copy"
                              viewBox="0 0 16 16"
                            >
                              <path
                                fill-rule="evenodd"
                                d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"
                              />
                            </svg>
                          </button>
                          <ul className="d-flex flex-wrap list-unstyled">
                            {exam.tags
                              ? exam.tags.map((tag, index) => (
                                  <li
                                    key={index}
                                    className="topic-item badge text-black m-1"
                                    style={{
                                      display: "inline-block",
                                      maxWidth: "100px",
                                      overflow: "hidden",
                                      textOverflow: "ellipsis",
                                      whiteSpace: "nowrap",
                                    }}
                                  >
                                    {tag.name}
                                  </li>
                                ))
                              : ""}
                          </ul>
                        </div>
                      </div>
                    </div>
                  ))
                ) : (
                  <div
                    className="empty-result-section text-center"
                    style={{ marginLeft: 150 }}
                  >
                    <img
                      src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/search/a60759ad1dabe909c46a.png"
                      alt="Empty Result Icon"
                      className="img-fluid"
                    />
                    <div className="empty-result-section__title">
                      Không tìm thấy kết quả nào
                    </div>
                  </div>
                )}
              </div>
              <div className="row mt-5">
                <div className="col">
                  <div className="block-27">
                    <ul>
                      <li>
                        <a href="#">&lt;</a>
                      </li>
                      <li className="active">
                        <span>1</span>
                      </li>
                      <li>
                        <a href="#">2</a>
                      </li>
                      <li>
                        <a href="#">3</a>
                      </li>
                      <li>
                        <a href="#">4</a>
                      </li>
                      <li>
                        <a href="#">5</a>
                      </li>
                      <li>
                        <a href="#">&gt;</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </>
  );
}
