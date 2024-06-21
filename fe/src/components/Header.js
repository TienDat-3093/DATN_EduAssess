import { NavLink } from "react-router-dom";
import Banner1 from "./Banner1";
import Banner2 from "./Banner2";
import React, { useState, useEffect } from "react";
import { Dropdown } from "react-bootstrap";
import {
  fetchLogout,
  fetchGetUser,
  fetchRefreshAccess,
} from "../services/UserServices";
//thu vien kiem tra token het han
import { jwtDecode } from "jwt-decode";

export default function Header() {
  const [isLoggedIn, setIsLoggedIn] = useState(false);
  const [user, setUser] = useState(null);
  const token = localStorage.getItem("token");

  const isTokenExpiringSoon = (beforeTime = 60) => {
    if (!token) {
      return false;
    }
    const decodedToken = jwtDecode(token);
    const currentTime = Date.now();
    return (decodedToken.exp - currentTime) < beforeTime;
  };

  const refreshToken = async () => {
    if (isTokenExpiringSoon()) {
      try {
        const response = await fetchRefreshAccess(token);
        const newToken = response.data.access_token;
        localStorage.setItem("token", newToken);
        console.log("refresh", response.data.access_token);
      } catch (err) {
        console.log("Failed to fetch refreshToken", err);
      }
    }
  };
  useEffect(() => {
    const loggedStatus = localStorage.getItem("isLoggedIn");
    if (loggedStatus === "true") {
      setIsLoggedIn(true);
    }
    const handleGetUser = async () => {
      if (token) {
        try {
          const response = await fetchGetUser(token);
          setUser(response.data);
        } catch (err) {
          console.error("Failed to fetch user data", err);
        }
      }
    };
    handleGetUser();
    /* refreshToken(); */
    //tu dong lam moi
    const interval = setInterval(() => {
      refreshToken();
    }, 30000);
    //xoa
    return () => clearInterval(interval);

  }, [token]);
  const handleLogin = () => {
    setIsLoggedIn(true);

    localStorage.setItem("isLoggedIn", "true");
  };
  const handleLogout = async () => {
    /* setIsLoggedIn(false);
    localStorage.removeItem("isLoggedIn");
    localStorage.removeItem("token"); */

    if (token) {
      try {
        const response = await fetchLogout(token);
        setIsLoggedIn(false);
        localStorage.removeItem("isLoggedIn");
        localStorage.removeItem("token");
        setUser(null);
        console.log("logout successful:", response.data);
      } catch (err) {
        console.error("Logout failed:", err);
      }
    } else {
      console.log("no token");
    }
  };

  return (
    <>
      <nav
        className="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light"
        id="ftco-navbar"
      >
        <div className="container">
          <a className="navbar-brand" href="index.html">
            <span>EduAssess</span>
          </a>
          <button
            className="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#ftco-nav"
            aria-controls="ftco-nav"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span className="oi oi-menu" /> Menu
          </button>
          <div className="collapse navbar-collapse" id="ftco-nav">
            <ul className="navbar-nav ml-auto">
              <li className="nav-item active">
                <NavLink to="/" className="nav-link">
                  Home
                </NavLink>
              </li>
              <li className="nav-item">
                <NavLink href="#" className="nav-link">
                  About
                </NavLink>
              </li>
              <li className="nav-item">
                <NavLink to="/test" className="nav-link">
                  Test
                </NavLink>
              </li>
              <li className="nav-item">
                <NavLink href="#" className="nav-link">
                  Instructor
                </NavLink>
              </li>
              {isLoggedIn ? (
                <li className="nav-item">
                  <NavLink to="/dashboard" className="nav-link">
                    Create Test
                  </NavLink>
                </li>
              ) : (
                <li className="nav-item"></li>
              )}

              {isLoggedIn ? (
                <li className="nav-item">
                  <Dropdown>
                    <Dropdown.Toggle
                      as="div"
                      className="nav-link"
                      id="dropdown-custom-components"
                    >
                      <div className="d-flex align-items-center">
                        <div
                          className="user-img"
                          style={{
                            backgroundImage:
                              user && user.image
                                ? `url(${user.image})`
                                : "url(/images/person_1.jpg)",
                            width: "40px",
                            height: "40px",
                            backgroundSize: "cover",
                            backgroundPosition: "center",
                            borderRadius: "50%",
                          }}
                        />
                        <div className="pl-2 mt-2">
                          <p className="name">
                            {user && user.username
                              ? user.username
                              : "Loading..."}
                          </p>
                        </div>
                      </div>
                    </Dropdown.Toggle>
                    <Dropdown.Menu>
                      <Dropdown.Item href="#/profile">Profile</Dropdown.Item>
                      <Dropdown.Item href="#/logout" onClick={handleLogout}>
                        Log out
                      </Dropdown.Item>
                    </Dropdown.Menu>
                  </Dropdown>
                </li>
              ) : (
                <li className="nav-item"></li>
              )}
            </ul>
          </div>
        </div>
      </nav>
      {/* END nav */}
      {/* Banner */}
      {isLoggedIn ? <Banner2 /> : <Banner1 onLoginSuccess={handleLogin} />}

      {/* EndBanner */}
    </>
  );
}
