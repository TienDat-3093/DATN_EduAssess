import { useState } from "react";
import Login from "./Login";
import Register from "./Register";

export default function Banner1({ onLoginSuccess }) {
  const [showRegister, setShowRegister] = useState(false);
  

  const handleRegisterClick = () => {
    setShowRegister(true);
  };
  const handleLoginClick = () => {
    setShowRegister(false);
  };
  return (
    <>
      <div
        className="hero-wrap js-fullheight"
        style={{ backgroundImage: `url("../images/bg_1.jpg")`, height: 700 }}
      >
        
        <div className="container">
          <div
            className="row no-gutters slider-text js-fullheight align-items-center"
            data-scrollax-parent="true"
            style={{ height: 730 }}
          >
            <div className="col-md-7 ftco-animate fadeInUp ftco-animated">
              <span className="subheading">Welcome to StudyLab</span>
              <h1 className="mb-4">We Are Online Platform For Make Learn</h1>
              <p className="caps">
                Far far away, behind the word mountains, far from the countries
                Vokalia and Consonantia
              </p>
              <p className="mb-0">
                <a href="#" className="btn btn-primary">
                  Our Course
                </a>{" "}
                <a href="#" className="btn btn-white">
                  Learn More
                </a>
              </p>
            </div>
          </div>
        </div>
      </div>
      {showRegister ? (
        <Register onLoginClick={handleLoginClick}  />
      ) : (
        <Login
          onLoginSuccess={onLoginSuccess}
          onRegisterClick={handleRegisterClick}
        />
      )}
    </>
  );
}
