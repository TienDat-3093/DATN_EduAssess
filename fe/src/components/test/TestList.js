import Search from "../testpage/Search";
import Filter from "../testpage/Filter";
import Test from "../test/Test";
export default function TestList() {
  return (
    <>
      <section className="ftco-section bg-light">
        <div className="container">
          <div className="row">
            <div className="col-lg-3 sidebar">
              <Search />
              <Filter/>
            </div>
            <div className="col-lg-9">
              <div className="row">
                <Test/>
                <Test/>
                <Test/>
                <Test/>
                <Test/>
                <Test/>
                <Test/>
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
