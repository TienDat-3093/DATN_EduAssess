export default function Register() {
  return (
    <>
      <div className="login-wrap p-4 p-md-5">
        <h3 className="mb-4">Register Now</h3>
        <form action="#" className="signup-form">
          <div className="form-group">
            <label className="label" htmlFor="name">
              Full Name
            </label>
            <input
              type="text"
              className="form-control"
              placeholder="John Doe"
            />
          </div>
          <div className="form-group">
            <label className="label" htmlFor="email">
              Email Address
            </label>
            <input
              type="text"
              className="form-control"
              placeholder="johndoe@gmail.com"
            />
          </div>
          <div className="form-group">
            <label className="label" htmlFor="password">
              Password
            </label>
            <input
              id="password-field"
              type="password"
              className="form-control"
              placeholder="Password"
            />
          </div>
          <div className="form-group">
            <label className="label" htmlFor="password">
              Confirm Password
            </label>
            <input
              id="password-field"
              type="password"
              className="form-control"
              placeholder="Confirm Password"
            />
          </div>
          <div className="form-group d-flex justify-content-end mt-4">
            <button type="submit" className="btn btn-primary submit">
              <span className="fa fa-paper-plane" />
            </button>
          </div>
        </form>
        <p className="text-center">
          Already have an account? <a href="#signin">Sign In</a>
        </p>
      </div>
    </>
  );
}
