export default function UserStats() {
  return (
    <>
      <div className="container mt-5 mb-5">
        <div className="card">
          <div className="card-header">
            <h5 className="mb-0">LỊCH SỬ HOẠT ĐỘNG</h5>
          </div>
          <div className="card-body">
            <table className="table table-hover">
              <thead className="thead-light">
                <tr>
                  <th>Người làm</th>
                  <th>Tổng số câu hỏi</th>
                  <th>Số câu đúng</th>
                  <th>Số câu sai</th>
                  <th>Thời gian hoàn thành</th>
                  <th>Thời gian kết thúc bài thi</th>
                </tr>
              </thead>
              {/* <tbody>
                {data &&
                  data.map((item, index) => (
                    <tr key={index}>
                      <td>
                        {item.testName.replace(/<\/?(p|strong|i)[^>]*>/gi, "")}
                      </td>
                      <td>{item.totalQuestion}</td>
                      <td>{item.questionRight}</td>
                      <td>{item.questionWrong}</td>

                      <td>{item.totalTime} giây</td>
                      <td>{item.finished}</td>
                    </tr>
                  ))}
              </tbody> */}
            </table>
          </div>
        </div>
        {/* <div className="row mt-5 justify-content-center">
          <div className="col-auto">
            <div className="block-27">
              <ul className="pagination">
                <li className={`page-item ${currentPage === 1 && "disabled"}`}>
                  <button
                    className="page-link"
                    onClick={() => handlePageChange(currentPage - 1)}
                  >
                    &lt;
                  </button>
                </li>
                {[...Array(totalPages)].map((_, index) => (
                  <li
                    key={index}
                    className={`page-item ${
                      currentPage === index + 1 && "active"
                    }`}
                  >
                    <button
                      className="page-link"
                      onClick={() => handlePageChange(index + 1)}
                    >
                      {index + 1}
                    </button>
                  </li>
                ))}
                <li
                  className={`page-item ${
                    currentPage === totalPages && "disabled"
                  }`}
                >
                  <button
                    className="page-link"
                    onClick={() => handlePageChange(currentPage + 1)}
                  >
                    &gt;
                  </button>
                </li>
              </ul>
            </div>
          </div>
        </div> */}
      </div>
    </>
  );
}
