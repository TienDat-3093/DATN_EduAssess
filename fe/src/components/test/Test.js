export default function Test() {
  return (
    <>
      <div className="col-md-4 d-flex align-items-stretch ftco-animate fadeInUp ftco-animated">
        <div className="project-wrap">
          <a
            href="#"
            className="img"
            style={{ backgroundImage: "url(images/work-1.jpg)" }}
          >
            <span className="price">Software</span>
          </a>
          <div className="text p-4">
            <h3>
              <a href="#">Design for the web with adobe photoshop</a>
            </h3>
            <p className="advisor">
              Advisor <span>Tony Garret</span>
            </p>
            <ul className="d-flex justify-content-between">
              <li>
                <span className="flaticon-shower" />
                2300
              </li>
              <li className="price">$199</li>
            </ul>
          </div>
        </div>
      </div>
    </>
  );
}
